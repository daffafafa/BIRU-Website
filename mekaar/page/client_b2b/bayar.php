<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../../fungsi.php";
if (!isLoggedIn() && !isB2B()) {
    die(json_encode(array(false, 'pesan' => 'Unauthorized')));
}

include "../../contact.php";
if ($_POST) {
    if (isset($_POST['type']) && $_POST['type'] != "") {
        switch ($_POST['type']) {
            case "premi":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    switch($_POST['prod']){
                        case "PR002":
                            if (!isset($_POST["kode"])) {
                                die(json_encode(array(false, 'pesan' => 'Unknown Request 4')));
                            }
                            $trxUUID = json_decode($_POST["kode"]);
                            $mainProd = mysqli_escape_string($conection, trim($_POST["prod"]));
                            if (count($trxUUID) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Tidak ada data terpilih')));
                            }
                            //ambil rekening penerima dana main produk
                            $sql = 'SELECT DANA_IN_VA_NO `no`,DANA_IN_VA_BANK `bank` FROM ma2001 WHERE PROD_ID="'.$mainProd.'"';
                            $query = mysqli_query($conection,$sql);
                            $va = mysqli_fetch_array($query);
                            //ambil semua detail trans terpilih
                            $sql = 'SELECT c.VA_IN_NO,c.VA_IN_BANK,c.PEMBAGIAN_SYSTEM_ID,c.TRX_DETAIL_SYSTEM_ID,c.ENTITY_ID,c.NILAI ' .
                                ' FROM tr0001 a '.
                                ' JOIN tr0002_b2c b ON a.TRX_UUID=b.TRX_SYSTEM_ID AND b.TRX_PARENT="tr0001" '.
                                ' JOIN tr0003_b2c c ON b.TRX_DETAIL_SYSTEM_ID=c.TRX_DETAIL_SYSTEM_ID '.
                                ' WHERE a.TRX_STATUS=0 AND a.TRX_UUID IN ("'.implode('","',$trxUUID).'") '.
                                ' AND a.ENTITY_ID="'.$_SESSION['user_cli_group'].'"';
                            $query = mysqli_query($conection, $sql);
                            if(mysqli_num_rows($query)==0){
                                die(json_encode(array(false, 'pesan' => 'Pembayaran gagal diproses')));
                            }
                            $pembagian = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            $entity = array();
                            $arr_pembagian_id = array();
                            $nilaiTotal = 0;
                            foreach($pembagian as $row){
                                if(array_key_exists($row['ENTITY_ID'],$entity)){
                                    if(array_key_exists($row['VA_IN_BANK'].','.$row['VA_IN_NO'], $entity[$row['ENTITY_ID']])){
                                        $entity[$row['ENTITY_ID']][$row['VA_IN_BANK'].','.$row['VA_IN_NO']] += $row['NILAI'];
                                    }else{
                                        $entity[$row['ENTITY_ID']][$row['VA_IN_BANK'].','.$row['VA_IN_NO']] = $row['NILAI'];
                                    }
                                }else{
                                    $entity[$row['ENTITY_ID']][$row['VA_IN_BANK'].','.$row['VA_IN_NO']] = $row['NILAI'];
                                    $arr_pembagian_id[$row['ENTITY_ID']][$row['VA_IN_BANK'].','.$row['VA_IN_NO']] = array();
                                }
                                $arr_pembagian_id[$row['ENTITY_ID']][$row['VA_IN_BANK'].','.$row['VA_IN_NO']][] = $row['PEMBAGIAN_SYSTEM_ID'];
                                $nilaiTotal += $row['NILAI'];
                            }
                            //insert pembayaran, harusnya data rekening dan total pembayaran didapat dari server BAnk
                            //harusnya diketahui data pembayaran yg disimpan cabang atau perusahaan
                            $datetime = new DateTime();
                            $paymentUUID = generateUUID();
                            
                            $sql = 'INSERT INTO py0001_b2c (PAYMENT_SYSTEM_ID,PAYMENT_DATE,CLI_GROUP,PAYMENT_AMOUNT,VA_BANK,VA_NO,VA_NAMA,`STATUS`,PAYMENT_TYPE) VALUES '.
                                    ' ("'.$paymentUUID.'","'.$datetime->format('Y-m-d H:i:s').'","'.$_SESSION['user_cli_group'].'",'.$nilaiTotal.',"'.$va['bank'].'","'.$va['no'].'","",0,0)';
                            if(!mysqli_query($conection, $sql)){
                                die(json_encode(array(false, 'pesan' => 'Transaksi pembayaran gagal disimpan')));
                            }
                            // belum selesai, Belum ada kejelasan masa aktif transaksi
                            
                            // $masa_aktif = new DateTime();
                            // $masa_aktif->modify("1 year");

                            //update payment_id & status transaksi = paid, harusnya ada log pembayaran, paymentUUID untuk trxUUID yg mana saja
                            $sql = 'UPDATE tr0001 SET `TRX_STATUS`=1, PAYMENT_SYSTEM_ID="'.$paymentUUID.'"'.
                                //',TRX_DUE="'.$masa_aktif->format('Y-m-d H:i:s').'", TRX_NO_POLICY="'.$policy.'"'.
                                ' WHERE TRX_STATUS=0 AND TRX_UUID IN ("'.implode('","',$trxUUID).'") '.
                                ' AND ENTITY_ID="'.$_SESSION['user_cli_group'].'"';
                            if(!mysqli_query($conection, $sql)){
                                die(json_encode(array(false, 'pesan' => 'Transaksi pembayaran gagal disimpan-')));
                            }

                            //proses penyerahan premi yg sudah dibagi
                            $sqlPenyerahanPremi = 'INSERT INTO py0002_b2c (RECEIVED_SYSTEM_ID,PAYMENT_SYSTEM_ID,CLI_GROUP,RECEIVED_AMOUNT,REKENING_BANK,REKENING_NO,REKENING_NAMA) VALUES ';
                            $valPenyerahanPremi = '';
                            $sqlUpdatePembagian = 'UPDATE tr0003_b2c SET ';
                            $valUpdatePembagian = 'RECEIVED_SYSTEM_ID = (Case PEMBAGIAN_SYSTEM_ID ';
                            foreach($entity as $id_entity=>$arr_va_key){
                                foreach($arr_va_key as $va_key => $val){
                                    $receivedUUID = generateUUID();

                                    list($va_bank,$va_no) = explode(',',$va_key);
                                    $valPenyerahanPremi.= '("'.$receivedUUID.'","'.$paymentUUID.'","'.$id_entity.'",'.$val.',"'.$va_bank.'","'.$va_no.'",""),';
                                    foreach($arr_pembagian_id[$id_entity][$va_key] as $pembagianID){
                                        $valUpdatePembagian .= ' WHEN ' . $pembagianID . ' THEN "'.$receivedUUID.'"';
                                    }
                                }
                            }
                            $valUpdatePembagian .= ' END)';
                            $valPenyerahanPremi = substr($valPenyerahanPremi,0,-1);  
                            //start transaksi
                            mysqli_autocommit($conection, false);
                            $all_query_ok = true;
                            //insert tabel received
                            mysqli_query($conection, $sqlPenyerahanPremi.$valPenyerahanPremi) ? null : $all_query_ok = false;
                            mysqli_query($conection, $sqlUpdatePembagian.$valUpdatePembagian) ? null : $all_query_ok = false;
                            //update status payment = sudah disalurkan
                            $sql = 'UPDATE py0001_b2c SET `STATUS`=1 WHERE PAYMENT_SYSTEM_ID="'.$paymentUUID.'"';
                            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                            
                            if ($all_query_ok) {
                                //simpan data
                                mysqli_commit($conection);
                                //kirim respon
                                die(json_encode(array(true, 'pesan' => 'Pembayaran berhasil diproses')));
                            } else {
                                mysqli_rollback($conection);
                                //update status payment, jika gagal disalurkan tapi nasabah sudah bayar
                                //mysqli_query($conection, 'UPDATE py0001_b2c SET `STATUS`=1 WHERE PAYMENT_SYSTEM_ID="'.$paymentUUID.'"') ? null : $all_query_ok = false;
                                die(json_encode(array(false, 'pesan' => 'Pembayaran gagal diproses')));
                            }
                            break;
                        case "PR123":
                            break;
                        default: die(json_encode(array(false, 'pesan' => 'Unknown Product')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Unknown Request : 5')));
                }

                break;
            default:
                die(json_encode(array(false, 'pesan' => 'Unknown Request : 3')));
        }
    } else {
        die(json_encode(array(false, 'pesan' => 'Unknown Request : 2')));
    }
} else {
    die(json_encode(array(false, 'pesan' => 'Unknown Request : 1')));
}
