<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../../contact.php";
require_once "../../fungsi.php";
if (!isLoggedIn() || !has_permission('create_gempa')) {
    die(json_encode(array(false, 'pesan' => 'Unauthorized')));
}

date_default_timezone_set('Asia/Jakarta');

//belum di cek claim type (terikat & bebas)

//cek token crsf
if (@hash_equals($_SESSION['token'], $_POST['token'])) {
    $dt = mysqli_escape_string($conection, trim($_POST["skala"]));
    $dt1 = mysqli_escape_string($conection, trim($_POST["dalam"]));
    $dt2 = mysqli_escape_string($conection, trim($_POST["koord"]));
    $koor = explode(',', $dt2);
    if (count($koor) == 2) {
        $pesan = '';
        //add gempa
        $sqlGempa = 'INSERT INTO gempa2 (koor1,koor2,eks,skala,eksekusi,kedalaman,wilayah,waktu)' .
        ' VALUES ("' . $koor[0] . '","' . $koor[1] . '",1,"' . $dt . '",0,' .
        '"' . $dt1 . ' KM","-","' . date('Y-m-d h:i:s', time()) . '")';
        if (mysqli_query($conection, $sqlGempa)) {
            $pesan .= 'Gempa berhasil ditambah';
        } else {
            die(json_encode(array(false, 'pesan' => 'Gagal menambah gempa!')));
        }
        $idGempa = mysqli_insert_id($conection);

        //ambil transaksi sub prod dca eq yg aktif dimana belum terkena dca eq
        //dan diantara jarak & skala
        $sqlPeserta =
            ' SELECT ' .
            ' c.CREATED_BY,c.BANK_REKENING,c.NO_REKENING,c.NAMA_REKENING,'.
            ' a.TRX_DETAIL_SYSTEM_ID,a.ID_KEY,a.TRX_SYSTEM_ID,a.TRX_PARENT,' .
            ' d.LOKASI_NAMA,e.SUB_PROD_ID,' .
            ' (c.TRX_PLAFOND*e.PERSEN_SANTUNAN/100) SANTUNAN,f.PROD_CURR PARENT_CURR,' .
            ' e.PERSEN_SANTUNAN,e.JARAK_TERDEKAT,e.JARAK_TERJAUH,e.SKALA_MINIMAL,e.SKALA_MAKSIMAL,' .
            ' (6371 * acos (' .
            ' cos( radians(' . $koor[0] . ') ) ' .
            ' * cos( radians( d.lat ) )     ' .
            ' * cos( radians( d.lng ) - radians(' . $koor[1] . ') ) ' .
            ' + sin( radians(' . $koor[0] . ') )' .
            '  * sin( radians( d.lat ) ) ' .
            ' )  ) AS distance '.
            ' FROM tr0002_b2c a ' .
            ' JOIN ma2001 b ON b.PROD_ID=a.SUB_PROD_ID AND b.PROD_TYPE="dca eq" ' .
            ' JOIN tr0001 c ON c.TRX_UUID=a.TRX_SYSTEM_ID ' . 
            //belum selesai, belum lengkap karena masih prod tr0001
            ' JOIN ma1003 d ON d.LOKASI_ID=c.CABANG_ID ' .
            ' JOIN dca001 e ON e.SUB_PROD_ID=a.SUB_PROD_ID ' .
            ' JOIN ma2001 f ON f.PROD_ID=a.SUB_PROD_ID ' .
            ' WHERE a.TRX_PARENT="tr0001" AND c.TRX_STATUS=1 AND a.EQ_SYSTEM_ID IS NULL '.
                ' AND ' . $dt . ' BETWEEN e.SKALA_MINIMAL AND e.SKALA_MAKSIMAL ' .
            ' HAVING distance BETWEEN e.JARAK_TERDEKAT and e.JARAK_TERJAUH';
        $queryTerdampak = mysqli_query($conection, $sqlPeserta);
        
        if (mysqli_num_rows($queryTerdampak) > 0) {

            $valueInsertNotifKewajiban = $insertTRValues = array();
            $dataTerdampak = mysqli_fetch_all($queryTerdampak, MYSQLI_ASSOC);

            $startRow = 0;
            $chunkSize = (count($dataTerdampak) > 100) ? 100 : count($dataTerdampak);
            //Tagihan Santunan Tiap Detail
            $tagihanDetail = $tagihanDetailEntity = $tagihanEntity = array();
            $sqlUpdateTerdampakChunk = $subProdRules = array();
            //proses looping tiap row peserta/properti terdampak pada chunk
            while ($startRow < count($dataTerdampak)) {
                $santunan = 'CLAIM_NILAI = (Case TRX_DETAIL_SYSTEM_ID ';
                $resiko = 'EQ_RESIKO = (Case TRX_DETAIL_SYSTEM_ID ';
                $jarak = 'EQ_JARAK = (Case TRX_DETAIL_SYSTEM_ID ';
                $idTerdampak = '';
                for ($i = $startRow; $i < ($startRow + $chunkSize); $i++) {
                    $idTerdampak .= '"' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '",';
                    $santunan .= ' WHEN "' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '" THEN ' . $dataTerdampak[$i]['SANTUNAN'] . '';
                    $jarak .= ' WHEN "' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '" THEN ' . $dataTerdampak[$i]['distance'] . '';
                    $resiko .= ' WHEN "' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '" THEN ' . $dataTerdampak[$i]['PERSEN_SANTUNAN'] . '';
                    
                    $subProd = $dataTerdampak[$i]['SUB_PROD_ID'];
                    //kelompokkan sub produk gempa dan rules jika sub prod belum ada di array
                    if (!array_key_exists($subProd, $subProdRules)) {
                        $subProdRules[$subProd] = array();
                        //ambil rules untuk tiap prod gempa terdampak
                        $sql = 'SELECT a.PROD_ID,a.SHA_RISK,a.SHA_ENTITY,a.SHA_ENTITY_LEVEL,a.BANK_REKENING,a.NO_REKENING,a.NAMA_REKENING ' .
                            ' FROM ma2003 a ' .
                            ' WHERE a.PROD_ID = "' . $dataTerdampak[$i]['SUB_PROD_ID'] . '"' .
                            ' AND a.SHA_STATUS=0 AND SHA_RISK > 0' .
                            ' ORDER BY a.PROD_ID';
                        $query = mysqli_query($conection, $sql);
                        foreach (mysqli_fetch_all($query, MYSQLI_ASSOC) as $rule) {
                            $subProdRules[$subProd][] = $rule;
                        }
                    }
                    $tsiTotal = $dataTerdampak[$i]['SANTUNAN'];
                    //pembagian kewajiban jumlah santunan sesuai porsi resiko
                    foreach ($subProdRules[$subProd] as $tagihan) {
                        //jika reasuransi
                        if($tagihan['SHA_ENTITY_LEVEL']==1)
                        {
                            //belum selesai, belum ada pengaturan(rules) aliran dana
                            //cari si asuransi, dan tambahkan rekening asuransi ke target pembayaran re asuransi
                            $asuransi = array_filter($subProdRules[$subProd], function($d){return $d['SHA_ENTITY_LEVEL'] == 0;});
                            $asuransi = array_shift($asuransi); //ambil data pertama tanpa bergantung index
                            $tagihanDetail[] = '("' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '"' .
                                ',"' . $tagihan['SHA_ENTITY'] . '"' .
                                ',' . ($tsiTotal * $tagihan['SHA_RISK'] / 100) .
                                ',"'.$asuransi['BANK_REKENING'].'","'.$asuransi['NO_REKENING'].'","'.$asuransi['NAMA_REKENING'].'"' .
                                ',0,1,0)';//kewajiban status = new, is_reas, is_from_reas
                        }
                        else
                        {
                            //tambahkan rekening cabang ke target pembayaran asuransi
                            $tagihanDetail[] = '("' . $dataTerdampak[$i]['TRX_DETAIL_SYSTEM_ID'] . '"' .
                                ',"' . $tagihan['SHA_ENTITY'] . '"' .
                                ',' . ($tsiTotal * $tagihan['SHA_RISK'] / 100) .
                                ',"'.$dataTerdampak[$i]['BANK_REKENING'].'","'.$dataTerdampak[$i]['NO_REKENING'].'","'.$dataTerdampak[$i]['NAMA_REKENING'].'"' .
                                ',0,0,0)';//kewajiban status = new, is_reas, is_from_reas
                        }
                    }
                }
                $santunan .= ' END)';
                $jarak .= ' END)';
                $resiko .= ' END)';
                $sqlUpdateTerdampakChunk[] = $santunan . ',' . $resiko . ',' . $jarak .
                ' WHERE TRX_DETAIL_SYSTEM_ID IN (' . substr($idTerdampak, 0, -1) . ');';

                $startRow += $chunkSize + 1;
            }

            //start trans
            mysqli_autocommit($conection, false);
            $all_query_ok = true;
            $claim_due = (new DateTime())->modify("1 day")->format('Y-m-d H:i:s');
            //update semua chunk terdampak
            foreach ($sqlUpdateTerdampakChunk as $str) {
                $sql = 'UPDATE tr0002_b2c SET EQ_SYSTEM_ID=' . $idGempa . ', CLAIM_STATUS=1, CLAIM_DUE="' . $claim_due . '", ' . $str;
                mysqli_query($conection, $sql) ? null : $all_query_ok = false;
            }

            //insert tabel tagihan batch
            $startRow = 0;
            $chunkSize = (count($tagihanDetail) > 1000) ? 1000 : count($tagihanDetail);
            while ($startRow < count($tagihanDetail)) {
                $valueTagihanDetail = '';
                for ($i = $startRow; $i < ($startRow + $chunkSize); $i++) {
                    $valueTagihanDetail .= $tagihanDetail[$i] . ',';
                }
                $sql = 'INSERT INTO tr0004_b2c (TRX_DETAIL_SYSTEM_ID,ENTITY_ID,NILAI,BANK_REKENING,NO_REKENING,NAMA_REKENING,KEWAJIBAN_STATUS,is_reas,is_from_reas) VALUES ' . substr($valueTagihanDetail, 0, -1);
                mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                $startRow += $chunkSize + 1;
            }

            if ($all_query_ok) {
                mysqli_commit($conection);
                die(json_encode(array(true, 'pesan' => $pesan . "")));
            } else {
                mysqli_rollback($conection);
                $sql = "UPDATE gempa2 SET eks=0 WHERE no=" . $idGempa;
                mysqli_query($conection, $sql);
                die(json_encode(array(false, 'pesan' => $pesan . "\nTrigger Gagal diproses!")));
            }
        } else {
            die(json_encode(array(false, 'pesan' => $pesan . "\nTidak ada peserta yg terkena dampak!")));
        }
    } else {
        die(json_encode(array(false, 'pesan' => 'Koordinat tidak sesuai!')));
        // Log this as a warning and keep an eye on these attempts
    }
} else {
    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
    // Log this as a warning and keep an eye on these attempts
}
