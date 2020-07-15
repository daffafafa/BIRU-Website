<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../../contact.php";
include "../../fungsi.php";
if (!isLoggedIn() || !isB2B()) {
    die(json_encode(array(false, 'pesan' => 'Unauthorized')));
}

if ($_GET) {
    if (isset($_GET['type']) && $_GET['type'] != "") {
        switch ($_GET['type']) {
            case "get_provinsi":
            case "get_kabupaten":
            case "get_kecamatan":
            case "get_kelurahan":
                if (isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['lvl']) && $_GET['lvl'] != "") {
                    if ($_GET['type'] == "get_kelurahan") {
                        $field = 'a.kode_wilayah_bps,a.nama,a.zonasi,a.pos,a.lat,a.lng';
                    } else {
                        $field = 'a.kode_wilayah_bps,a.nama,a.zonasi,a.pos';
                    }
                    if ($_GET['lvl'] == 4) {
                        $sql2 = ' SELECT ' . $field . ' FROM daerah3 b ' .
                        ' LEFT JOIN daerah3 a ON a.mst_kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' WHERE a.level=4 AND b.kode_wilayah_bps="' . mysqli_escape_string($conection, $_GET['id']) . '"';
                    } else if ($_GET['lvl'] == 3) {
                        $sql2 = ' SELECT ' . $field . ' FROM daerah3 b ' .
                        ' LEFT JOIN daerah3 a ON a.mst_kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' WHERE a.level=3 AND b.kode_wilayah_bps="' . mysqli_escape_string($conection, $_GET['id']) . '"';
                    } else if ($_GET['lvl'] == 2) {
                        $sql2 = ' SELECT ' . $field . ' FROM daerah3 b ' .
                        ' LEFT JOIN daerah3 a ON a.mst_kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' WHERE a.level=2 AND b.kode_wilayah_bps="' . mysqli_escape_string($conection, $_GET['id']) . '"';
                    } else { // 1 prov
                        $sql2 = ' SELECT ' . $field . ' FROM daerah3 a ' .
                            ' WHERE a.level=1';
                    }
                    $query2 = mysqli_query($conection, $sql2);
                    $data = '[';
                    while ($row = mysqli_fetch_row($query2)) {
                        foreach ($row as $i => $v) {$row[$i] = addslashes(trim($row[$i]));}
                        if (!isset($row[4]) || !isset($row[5]) || ($row[4]) == "" || ($row[5]) == "") {
                            $data .= '{"id":"' . $row[0] . '","nama":"' . stripslashes($row[1]) . '","zona":"' . $row[2] . '","pos":"' . $row[3] . '"},';
                        } else {
                            $data .= '{"id":"' . $row[0] . '","nama":"' . stripslashes($row[1]) . '","zona":"' . $row[2] . '","pos":"' . $row[3] . '","koor":"' . $row[4] . ',' . $row[5] . '"},';
                        }
                    }
                    $data = substr($data, 0, -1);
                    $data .= ']';
                    if (mysqli_affected_rows($conection) == 0) {
                        die(json_encode(false));
                    }
                    die($data);
                } else {
                    die(json_encode(false));
                }

                break;
            case "provinsi":
                $sql2 = ' SELECT kode_wilayah_bps,nama FROM daerah3 WHERE LEVEL = 1';
                $query2 = mysqli_query($conection, $sql2);
                $data = '[';
                while ($row = mysqli_fetch_row($query2)) {
                    foreach ($row as $i => $v) {$row[$i] = addslashes(trim($row[$i]));}
                    $data .= '{"id":"' . $row[0] . '","nama":"' . stripslashes($row[1]) . '"},';
                }
                $data = substr($data, 0, -1);
                $data .= ']';
                if (mysqli_affected_rows($conection) == 0) {
                    die(json_encode(false));
                }
                die($data);
                break;
            case "kabupaten":
            case "kecamatan":
            case "kelurahan":
                if (isset($_GET['id']) && $_GET['id'] != "") {
                    if ($_GET['type'] == "kelurahan") {
                        $field = 'kode_wilayah_bps,nama,zonasi,pos,lat,lng';
                    } else {
                        $field = 'kode_wilayah_bps,nama,zonasi,pos';
                    }
                    $sql2 = ' SELECT ' . $field . ' FROM daerah3 WHERE mst_kode_wilayah_bps="' . mysqli_escape_string($conection, $_GET['id']) . '"';
                    $query2 = mysqli_query($conection, $sql2);
                    $data = '[';
                    while ($row = mysqli_fetch_row($query2)) {
                        foreach ($row as $i => $v) {$row[$i] = addslashes(trim($row[$i]));}
                        if (!isset($row[4]) || !isset($row[5]) || ($row[4]) == "" || ($row[5]) == "") {
                            $data .= '{"id":"' . $row[0] . '","nama":"' . stripslashes($row[1]) . '","zona":"' . $row[2] . '","pos":"' . $row[3] . '"},';
                        } else {
                            $data .= '{"id":"' . $row[0] . '","nama":"' . stripslashes($row[1]) . '","zona":"' . $row[2] . '","pos":"' . $row[3] . '","koor":"' . $row[4] . ',' . $row[5] . '"},';
                        }
                    }
                    $data = substr($data, 0, -1);
                    $data .= ']';
                    if (mysqli_affected_rows($conection) == 0) {
                        die(json_encode(false));
                    }
                    die($data);
                } else {
                    die(json_encode(false));
                }

                break;
            case 'libur_hari':
                $sql = 'SELECT HARI FROM libur_sistem_hari';
                $query = mysqli_query($conection, $sql);
                $hari = array();
                while ($data = mysqli_fetch_array($query)) {
                    $hari[] = $data[0];
                }
                die(json_encode(array('hari' => $hari, 'status' => true)));
                break;
            case "libur_kalender":
                if (!isset($_POST['unix']) && count($_POST['unix'] == 2)) {
                    die(json_encode(array('tgl' => null, 'status' => true)));
                }

                $unix = $_POST['unix'];
                $awal = date_timestamp_set(date_create(), $unix[0]);
                $tgl = array();
                function getHolidays
                ($y, $m, $s) {
                    return new DatePeriod(
                        new DateTime("first $s of $y-$m"),
                        DateInterval::createFromDateString('next ' . $s),
                        new DateTime("last day of $y-$m 23:59:59")
                    );
                }
                $sql = 'SELECT HARI FROM libur_sistem_hari';
                $query = (mysqli_query($conection, $sql));
                while ($dayLibur = mysqli_fetch_row($query)) {
                    if ($dayLibur[0] == 'MINGGU') {
                        $holiday = 'sunday';
                    } else if ($dayLibur[0] == 'SENIN') {
                        $holiday = 'monday';
                    } else if ($dayLibur[0] == 'SELASA') {
                        $holiday = 'tuesday';
                    } else if ($dayLibur[0] == 'RABU') {
                        $holiday = 'wednesday';
                    } else if ($dayLibur[0] == 'KAMIS') {
                        $holiday = 'thursday';
                    } else if ($dayLibur[0] == 'JUMAT') {
                        $holiday = 'friday';
                    } else if ($dayLibur[0] == 'SABTU') {
                        $holiday = 'saturday';
                    } else {
                        continue;
                    }
                    foreach (getHolidays($awal->format('Y'), $awal->format('m'), $holiday) as $tglLibur) {
                        $a = date_timestamp_get($tglLibur->modify('+1 second'));
                        $b = date_timestamp_get($tglLibur->modify('+1 day')->modify('-2 second'));
                        $tgl[] = array(
                            'start' => $a,
                            'end' => $b,
                            'title' => '~',
                            'category' => $dayLibur[0],
                            'content' => 'Libur Setiap Hari ' . $dayLibur[0],
                        );
                    }
                }

                $sql = 'SELECT KETERANGAN,TANGGAL,UNIX_TIMESTAMP(ADDTIME(`TANGGAL`,"00:00:01")) uawal' .
                    ',UNIX_TIMESTAMP(ADDTIME(`TANGGAL`,"23:59:59")) uakhir FROM libur_sistem_tgl' .
                    ' WHERE (UNIX_TIMESTAMP(`TANGGAL`) BETWEEN ' . $unix[0] . ' AND ' . $unix[1] . ')';
                $query = mysqli_query($conection, $sql);
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                    $tgl[] = array(
                        'start' => (int) $data['uawal'],
                        'end' => (int) $data['uakhir'],
                        'title' => $data['KETERANGAN'],
                        'category' => $data['KETERANGAN'],
                        'content' => $data['KETERANGAN'] .
                        '<br><button class="btn btn-default pull-right hapus" data="' . $data['TANGGAL'] . '" > Hapus</button>' .
                        '<br>&nbsp;',
                    );
                }
                die(json_encode(array('tgl' => $tgl, 'status' => true)));
                break;
            case "libur_produk_kalender":
                if (!isset($_POST['unix']) && count($_POST['unix'] == 2)) {
                    die(json_encode(array('tgl' => null, 'status' => true)));
                }
                $dt1 = mysqli_escape_string($conection, trim($_POST["kode"]));
                $query = mysqli_query($conection, 'SELECT ID_KEY,PROD_ID FROM ma2001 WHERE ID_KEY="' . $dt1 . '"');
                if (mysqli_num_rows($query) == 0) {
                    die(json_encode(array('tgl' => null, 'status' => true)));
                }
                $produk = mysqli_fetch_array($query);
                $unix = $_POST['unix'];
                $awal = date_timestamp_set(date_create(), $unix[0]);
                $tgl = array();
                function getHolidays
                ($y, $m, $s) {
                    return new DatePeriod(
                        new DateTime("first $s of $y-$m"),
                        DateInterval::createFromDateString('next ' . $s),
                        new DateTime("last day of $y-$m 23:59:59")
                    );
                }
                $sql = 'SELECT HARI FROM libur_insurance_prod_hari WHERE PROD_ID="' . $produk['PROD_ID'] . '"';
                $query = (mysqli_query($conection, $sql));
                while ($dayLibur = mysqli_fetch_row($query)) {
                    if ($dayLibur[0] == 'MINGGU') {
                        $holiday = 'sunday';
                    } else if ($dayLibur[0] == 'SENIN') {
                        $holiday = 'monday';
                    } else if ($dayLibur[0] == 'SELASA') {
                        $holiday = 'tuesday';
                    } else if ($dayLibur[0] == 'RABU') {
                        $holiday = 'wednesday';
                    } else if ($dayLibur[0] == 'KAMIS') {
                        $holiday = 'thursday';
                    } else if ($dayLibur[0] == 'JUMAT') {
                        $holiday = 'friday';
                    } else if ($dayLibur[0] == 'SABTU') {
                        $holiday = 'saturday';
                    } else {
                        continue;
                    }
                    foreach (getHolidays($awal->format('Y'), $awal->format('m'), $holiday) as $tglLibur) {
                        $a = date_timestamp_get($tglLibur->modify('+1 second'));
                        $b = date_timestamp_get($tglLibur->modify('+1 day')->modify('-2 second'));
                        $tgl[] = array(
                            'start' => $a,
                            'end' => $b,
                            'title' => '~',
                            'category' => $dayLibur[0],
                            'content' => 'Libur Setiap Hari ' . $dayLibur[0],
                        );
                    }
                }

                $sql = 'SELECT KETERANGAN,TANGGAL,UNIX_TIMESTAMP(ADDTIME(`TANGGAL`,"00:00:01")) uawal' .
                    ',UNIX_TIMESTAMP(ADDTIME(`TANGGAL`,"23:59:59")) uakhir FROM libur_insurance_prod_tgl' .
                    ' WHERE PROD_ID="' . $produk['PROD_ID'] . '" ' .
                    ' AND (UNIX_TIMESTAMP(`TANGGAL`) BETWEEN ' . $unix[0] . ' AND ' . $unix[1] . ')';
                $query = mysqli_query($conection, $sql);
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                    $tgl[] = array(
                        'start' => (int) $data['uawal'],
                        'end' => (int) $data['uakhir'],
                        'title' => $data['KETERANGAN'],
                        'category' => $data['KETERANGAN'],
                        'content' => $data['KETERANGAN'] .
                        '<br><button class="btn btn-default pull-right hapus" data="' . $data['TANGGAL'] . '" > Hapus</button>' .
                        '<br>&nbsp;',
                    );
                }
                die(json_encode(array('tgl' => $tgl, 'status' => true)));
                break;
            case 'libur_produk_hari':
                $dt1 = mysqli_escape_string($conection, trim($_POST["kode"]));
                $query = mysqli_query($conection, 'SELECT ID_KEY,PROD_ID FROM ma2001 WHERE ID_KEY="' . $dt1 . '"');
                if (mysqli_num_rows($query) == 0) {
                    die(json_encode(array('hari' => null, 'status' => false)));
                }
                $produk = mysqli_fetch_array($query);
                $sql = 'SELECT HARI FROM libur_insurance_prod_hari WHERE PROD_ID="' . $produk['PROD_ID'] . '" ';
                $query = mysqli_query($conection, $sql);
                $hari = array();
                while ($data = mysqli_fetch_array($query)) {
                    $hari[] = $data[0];
                }
                die(json_encode(array('hari' => $hari, 'status' => true)));
                break;
            
            case "produkmain":
                if (isset($_GET['ex']) && $_GET['ex'] != "") {
                    $ac = 'NOT a.PROD_ID LIKE "' . mysqli_escape_string($conection, trim($_GET['ex'])) . '" AND ';
                } else {
                    $ac = '';
                }
                $perintah = ' SELECT a.PROD_ID,a.PROD_NAMA ' .
                    ' FROM ma2001 a '.
                    ' LEFT JOIN ma2001 b ON a.PROD_ID=b.PROD_ID_PARENT ' .
                    ' WHERE ' . $ac . ' a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                    ' GROUP BY a.PROD_ID';
                $query = mysqli_query($conection, $perintah);
                $arr = array();
                while ($data = mysqli_fetch_row($query)) {
                    $arr[] = array('id' => $data[0], 'text' => $data[1]);
                }
                die(json_encode($arr));
                break;
            case "submain":
                if (!isset($_GET['kode']) || $_GET['kode'] == "") {
                    die(json_encode(array(false, 'pesan' => 'Kode Produk Tidak Ditemukan')));
                }
                // ambil sub prod, join rules
                // ambil sub prod, join main prod
                $perintah = ' SELECT a.PROD_ID,a.PROD_NAMA,a.PROD_LEGAL,a.PROD_STATUS, ' .
                ' IFNULL(GROUP_CONCAT(" ",e.ENTITY_NAMA),"") ENTITY,' .
                ' a.PROD_CURR,b.PROD_NAMA AS PARENT_NAMA,a.PROD_PREMI,a.PROD_TYPE,a.DANA_OUT_VA_NO,a.DANA_OUT_VA_BANK,a.CLAIM_TYPE, ' .
                ' IFNULL(SUM(d.SHA_RISK),0) RISK_SUM ' .
                ' FROM ma2001 a ' .
                ' LEFT JOIN ma2003 d ON a.PROD_ID=d.PROD_ID ' .
                ' LEFT JOIN ma1001 e ON e.ENTITY_ID=d.SHA_ENTITY ' .
                ' LEFT JOIN ma2001 b ON a.PROD_ID_PARENT=b.PROD_ID ' .
                ' WHERE a.PROD_ID_PARENT = "' . mysqli_escape_string($conection, trim($_GET['kode'])) . '" AND a.PROD_LEVEL=1 ' .
                    ' GROUP BY a.PROD_ID ORDER BY a.PROD_NAMA DESC';
                $query = mysqli_query($conection, $perintah);
                $arr = array();
                $parent = '';
                while ($data = mysqli_fetch_array($query)) {
                    $premi = $santunan = '';
                    //jika tipe sub 'dca eq', ambil premi dca eq dan santunan
                    switch ($data['PROD_TYPE']) {
                        case "dca eq":
                            $perintah2 = ' SELECT rate,zona FROM premi WHERE SUB_PROD_ID="' . $data['PROD_ID'] . '" ORDER BY zona';
                            $query2 = mysqli_query($conection, $perintah2);
                            while ($dataPremi = mysqli_fetch_array($query2)) {
                                $premi .= 'Zona ' . $dataPremi['zona'] . ' (' . sprintf('%.5F', $dataPremi['rate']) . ')<br>';
                            }
                            $perintah2 = ' SELECT JARAK_TERDEKAT a,JARAK_TERJAUH b,PERSEN_SANTUNAN c,SKALA_MINIMAL d,SKALA_MAKSIMAL e FROM dca001 WHERE SUB_PROD_ID="' . $data['PROD_ID'] . '" ORDER BY c DESC';
                            $query2 = mysqli_query($conection, $perintah2);
                            $santunan .= '<table><tr><td>Jarak</td><td>Magnitude</td><td>Jumlah Santunan</td></tr>';
                            while ($dataDCA = mysqli_fetch_array($query2)) {
                                $santunan .= '<tr>' .
                                '<td>' . sprintf('%.4F', $dataDCA['a']) . ' - ' . sprintf('%.4F', $dataDCA['b']) . ' KM </td>' .
                                '<td>' . sprintf('%.4F', $dataDCA['d']) . ' - ' . sprintf('%.4F', $dataDCA['e']) . ' Mg </td>' .
                                '<td class="text-right">' . sprintf('%.4F', $dataDCA['c']) . '%</td>' .
                                    '</tr>';
                            }
                            $santunan = htmlspecialchars($santunan . '</table>');
                            break;
                        case "kematian":
                            $perintah2 = ' SELECT rate,usia_awal,usia_akhir FROM premi WHERE SUB_PROD_ID="' . $data['PROD_ID'] . '" ORDER BY zona';
                            $query2 = mysqli_query($conection, $perintah2);
                            while ($dataPremi = mysqli_fetch_array($query2)) {
                                $premi .= 'Rentang Usia ' . $dataPremi['usia_awal'] .' s.d '. $dataPremi['usia_akhir'] . ' tahun (' . sprintf('%.5F', $dataPremi['rate']) . ')<br>';
                            }
                            $santunan = '100%';
                            break;
                        default:
                            $santunan = '100%';
                    }
                    $arr[] = array('id' => $data['PROD_ID'], 'nm' => $data['PROD_NAMA'], 'leg' => $data['PROD_LEGAL']
                        , 'sts' => $data['PROD_STATUS'], 'prt' => $data['ENTITY']
                        , 'cur' => $data['PROD_CURR'], 'prm' => (sprintf('%.5F', $data['PROD_PREMI']))
                        , 'prz' => $premi, 'santunan' => $santunan, 'typ' => $data['PROD_TYPE']
                        , 'dana' => $data['DANA_OUT_VA_BANK'].' '.$data['DANA_OUT_VA_NO']
                        , 'claim' => $data['CLAIM_TYPE']
                        , 'risk' => sprintf('%.5F', $data['RISK_SUM'])
                    );
                    $parent = $data['PARENT_NAMA'];
                }
                die(json_encode(array(true, 'data' => $arr, 'parent' => $parent)));
                // } KHUSUS DCA
                break;
            
            case "hitungpremi":
                //fokus untuk DCA
                if (!(isset($_GET['kode']) && $_GET['kode'] != "")) {
                    die(json_encode(array(false, 'pesan' => 'Produk Tidak Ditemukan')));
                }
                if (!(isset($_GET['nilai']) && $_GET['nilai'] != "")) {
                    die(json_encode(array(false, 'pesan' => 'Plafond/TSI harus diisi')));
                }
                if (!(isset($_GET['zona']) && $_GET['zona'] != "")) {
                    die(json_encode(array(false, 'pesan' => 'Cabang/lokasi harus dipilih/diisi')));
                }
                $dt1 = mysqli_escape_string($conection, trim($_GET["kode"]));
                $dt2 = mysqli_escape_string($conection, trim($_GET["nilai"]));
                $dt3 = mysqli_escape_string($conection, trim($_GET["zona"]));
                $dt4 = mysqli_escape_string($conection, trim($_GET["cabang"]));
                //stop jika id_produk tidak ada,
                $sql = 'SELECT a.PROD_ID,b.PROD_PREMI,a.PROD_CURR,a.PROD_AUTOP,b.PROD_ID PROD_ID_CHILD,b.PROD_TYPE ' .
                    ' FROM ma2001 a ' .
                    ' JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                    //' LEFT JOIN premi c ON b.PROD_ID=c.SUB_PROD_ID AND c.zona=' . $dt3 . ' ' .
                    ' WHERE a.PROD_ID ="' . $dt1 . '" AND (a.PROD_LEVEL = 0 OR b.PROD_LEVEL = 1)';
                $query = mysqli_query($conection, $sql);
                if (mysqli_num_rows($query) == 0) {
                    die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Main Produk tidak ditemukan')));
                }
                $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                //cek cabang
                $sql = ' SELECT LOKASI_KELURAHAN FROM ma1003 WHERE PROD_ID ="' . $dt1 . '" AND LOKASI_ID="'.$dt4.'"'.
                    ' AND LOKASI_STATUS="0" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                $query = mysqli_query($conection, $sql);
                if (mysqli_num_rows($query) == 0) {
                    die(json_encode(array(false, 'pesan' => 'Gagal!, Lokasi / Cabang tidak ditemukan')));
                }
                $dt3 = mysqli_fetch_array($query)['LOKASI_KELURAHAN'];

                $premiTotal = 0;
                foreach ($produk as $sub) {
                    if ($sub['PROD_TYPE'] == 'dca eq') {
                        $sql = 'SELECT rate,zona FROM premi b' .
                            ' JOIN daerah3 a ON a.zonasi=b.zona' .
                            ' WHERE b.SUB_PROD_ID LIKE "' . $sub['PROD_ID_CHILD'] . '" ' .
                            ' AND a.kode_wilayah_bps LIKE "' . $dt3 . '"';
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $rate = mysqli_fetch_array($query)['rate'];
                            //premi = dana * (premi sub produk/100) * (rate zona/100)
                            $premi = $dt2 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Kelurahan yang dipilih belum memiliki rate zona gempa, Silakan Hubungi Admin Biru'.$sql)));
                        }
                    } else if ($sub['PROD_TYPE'] == 'kematian') {
                        $dt4 = mysqli_escape_string($conection, trim($_GET["lahir"]));
                        $awal = date_create();
                        $akhir = date_create($dt4);
                        $diff = date_diff($awal, $akhir, true);
                        
                        $sql = 'SELECT usia_awal,usia_akhir,rate FROM premi b'.
                            ' WHERE b.SUB_PROD_ID LIKE "' . $sub['PROD_ID_CHILD'] . '" AND '.
                            ($diff->format("%a")/365) . ' BETWEEN usia_awal AND usia_akhir';
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $rate = mysqli_fetch_array($query)['rate'];
                            //premi = dana * (premi sub produk/100) * (rate usia/100)
                            $premi = $dt2 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Usia ('.round($diff->format("%a")/365).' tahun) tidak masuk cakupan sub produk asuransi kematian')));
                        }
                    } else {
                        $premi = $dt2 * ($sub['PROD_PREMI'] / 100);
                    }
                    $premiTotal += $premi;
                }
                if ($produk[0]['PROD_CURR'] == 'BRU') {
                    $premiTotal *= $_SESSION['bru_to_idr'];
                    $premiTotal = sprintf('%.6F',$premiTotal);
                } else if ($produk[0]['PROD_CURR'] == 'IDR') {
                    $premiTotal = sprintf('%.2F',$premiTotal);
                } else {

                }
                die(json_encode(array(true, 'premi' => $premiTotal, 'pesan' => 'Success')));

                break;

            default:
                die(json_encode(array(false, 'pesan' => 'Unknown Request 3')));
        }
    } else {
        die(json_encode(array(false, 'pesan' => 'Unknown Request 1')));
    }
} else if ($_POST) {
    if (isset($_POST['type']) && $_POST['type'] != "") {
        switch ($_POST['type']) {
            case 'laporan_transaksi':
                switch(@trim($_POST['kode'])){
                    case "PR002":
                        $mainProd = mysqli_escape_string($conection, $_POST["kode"]);
                        $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["awal"])));
                        $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["akhir"]) . " +1 day"));
                        //ambil data nasabah
                        $sql = 'SELECT SUM(a.TRX_PREMI)TRX_PREMI,DATE(b.PAYMENT_DATE) TGL,a.CURR_ID TRX_CURR,GROUP_CONCAT(a.PAYMENT_SYSTEM_ID,",") PAYMENT_SYSTEM_ID,a.TRX_PLAFOND TRX_DANA '.
                        ' FROM tr0001 a ';
                        if( ! empty($_SESSION['user_cabang_key'])){
                            $sql .= ' JOIN ma1003 d ON a.CABANG_ID=d.LOKASI_ID AND a.PROD_ID=d.PROD_ID AND d.ID_KEY='.$_SESSION['user_cabang_key'];
                        }
                        $sql .= ' JOIN py0001_b2c b ON a.PAYMENT_SYSTEM_ID=b.PAYMENT_SYSTEM_ID '.
                        ' WHERE a.PROD_ID="'.$mainProd.'" AND a.TRX_STATUS NOT IN (0,4) AND b.PAYMENT_DATE BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" '.
                        ' GROUP BY date(b.PAYMENT_DATE) ';
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) == 0) {
                            die(json_encode(array(true, 'data' => array())));
                        }
                        $transTerpilih = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        
                        $data = array();
                        foreach($transTerpilih as $rowTerpilih){
                            //pecah (,) kemudian hapus yg sama dan kosong
                            $PAYMENT_SYSTEM_ID = array_filter(array_unique(explode(',',$rowTerpilih['PAYMENT_SYSTEM_ID']),SORT_STRING));

                            //ambil perusahaan penerima premi
                            $sql = 'SELECT a.CLI_GROUP, SUM(a.RECEIVED_AMOUNT) NILAI, b.ENTITY_NAMA '.
                            ' FROM py0002_b2c a '.
                            ' JOIN ma1001 b ON b.ENTITY_ID=a.CLI_GROUP ' .
                            ' WHERE a.PAYMENT_SYSTEM_ID IN ("'.implode('","',$PAYMENT_SYSTEM_ID).'")'.
                            ' GROUP BY a.CLI_GROUP';
                            $query = mysqli_query($conection, $sql);
                            while($rowPembagian = mysqli_fetch_array($query)){
                                $data[] = array($rowTerpilih['TGL'], $rowPembagian['ENTITY_NAMA'], $rowTerpilih['TRX_CURR'], $rowTerpilih['TRX_DANA'], $rowTerpilih['TRX_PREMI'], $rowPembagian['NILAI']);
                            }
                        }

                        die(json_encode(array(true, 'data' => $data)));
                        break;
                    case "PR123":
                        $mainProd = mysqli_escape_string($conection, $_POST["kode"]);
                        $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["awal"])));
                        $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["akhir"]) . " +1 day"));
                        //ambil detail trans terpilih
                        $sql = ' SELECT DATE(a.TRX_DATE)TGL,a.TRX_CURR,a.TRX_SYSTEM_ID,a.TRX_PREMI,a.TRX_DANA'.
                            ',SUM(c.NILAI)NILAI,c.ENTITY_ID '.
                            ',d.ENTITY_NAMA '.
                            ' FROM tr0002_b2c b ' .
                            ' JOIN tr0001_b2c a ON b.TRX_SYSTEM_ID = a.TRX_SYSTEM_ID ' .
                            ' JOIN tr0003_b2c c ON b.TRX_DETAIL_SYSTEM_ID = c.TRX_DETAIL_SYSTEM_ID ' .
                            ' JOIN ma1001 d ON c.ENTITY_ID=d.ENTITY_ID ' .
                            ' WHERE a.TRX_STATUS NOT IN (0,4) AND ' .
                            ' a.TRX_DATE BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" '.
                            ' GROUP BY date(a.TRX_DATE),c.ENTITY_ID';
                        $query = mysqli_query($conection, $sql);
                        $transTerpilih = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        if (count($transTerpilih) == 0) {
                            die(json_encode(array(true, 'data' => array())));
                        }
                        $data = array();
                        foreach ($transTerpilih as $row) {
                            $data[] = array($row['TGL'], $row['ENTITY_NAMA'], $row['TRX_CURR'], $row['TRX_DANA'], $row['TRX_PREMI'], $row['NILAI']);
                        }
                        die(json_encode(array(true, 'data' => $data)));
                        break;
                        break;
                    default: die(json_encode(array(false, 'pesan' => 'Unknown Product')));
                }
                
                //var_dump($data);

                break;
            case 'laporan_transaksi_bk':
                if (!isset($_POST["kode"])) {
                    die(json_encode(array(false, 'pesan' => 'Unknown Request 4')));
                }
                $mainProd = mysqli_escape_string($conection, $_POST["kode"]);
                $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["awal"])));
                $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["akhir"]) . " +1 day"));
                //ambil sub produk join main
                $sql = ' SELECT a.PROD_ID,a.PROD_PREMI,a.PROD_TYPE FROM ma2001 a ' .
                    ' WHERE a.PROD_ID_PARENT = "' . $mainProd . '" AND a.PROD_LEVEL=1 ';
                $query = mysqli_query($conection, $sql);
                $subProduk = array();
                foreach (mysqli_fetch_all($query, MYSQLI_ASSOC) as $x) {
                    $subProduk[$x['PROD_ID']] = array(
                        'PROD_PREMI' => $x['PROD_PREMI'],
                        'PROD_TYPE' => $x['PROD_TYPE'],
                    );
                }
                $sql = 'SELECT a.PROD_ID,a.SHA_RISK,a.SHA_NUM,a.SHA_TAX,a.SHA_WITH,a.SHA_STATUS ' .
                ',a.SHA_ENTITY,a.SHA_NUM_BACKER,b.ID_KEY ENTITY_KEY,b.ENTITY_NAMA' .
                ' FROM ma2003 a ' .
                ' LEFT JOIN ma1001 b ON b.ENTITY_ID=a.SHA_ENTITY ' .
                ' WHERE a.PROD_ID IN ("' . implode('","', array_keys($subProduk)) . '") AND (a.SHA_STATUS=0)' .
                    ' ORDER BY a.PROD_ID,a.SHA_NUM_BACKER';
                $query = mysqli_query($conection, $sql);
                $rules = mysqli_fetch_all($query, MYSQLI_ASSOC);
                //ambil detail trans terpilih
                $sql = ' SELECT TRX_PLAFOND,TRX_UUID,CURR_ID,TRX_UUID,DATE(CREATED_ON)TGL,SUB_PROD_ID,SUB_PREMI,TRX_PREMI FROM tr0002 b ' .
                ' JOIN tr0001 a ON b.TRX_UUID_PARENT= a.TRX_UUID ' .
                ' WHERE NOT a.TRX_STATUS =0 AND ' .
                ' SUB_PROD_ID IN ("' . implode('","', array_keys($subProduk)) . '") AND ' .
                    ' a.CREATED_ON BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" ';
                //' GROUP BY date(CREATED_ON)';
                $query = mysqli_query($conection, $sql);
                $transTerpilih = mysqli_fetch_all($query, MYSQLI_ASSOC);
                //untuk masing2 premi terpilih
                //hitung pendapatan (pembagian premi) untuk tiap rules
                $tgl = array();
                foreach ($transTerpilih as $rowTerpilih) {
                    foreach ($rules as $keyRules => $rowRules) {
                        //jika elemen diterima(pendapatan) belum ada, buat dan isi nilai 0
                        if (!isset($rules[$keyRules][$rowTerpilih['TGL']])) {
                            $rules[$keyRules][$rowTerpilih['TGL']] = array(
                                'JUMLAH' => 1,
                                'SUBPREMI' => array(),
                                'TSI' => array(),
                                'DITERIMA' => 0,
                                'CURR' => $rowTerpilih['CURR_ID'],
                                'RESIKO' => 0,
                                'KOMISI' => 0,
                                'PPN' => 0,
                                'PPH23' => 0);
                        }
                        $rules[$keyRules][$rowTerpilih['TGL']]['SUBPREMI'][$rowTerpilih['TRX_UUID']] = $rowTerpilih['TRX_PREMI'];
                        $rules[$keyRules][$rowTerpilih['TGL']]['TSI'][$rowTerpilih['TRX_UUID']] = $rowTerpilih['TRX_PLAFOND'];
                        //jika produknya tidak sama lanjut row berikutnya
                        if ($rowRules['PROD_ID'] != $rowTerpilih['SUB_PROD_ID']) {
                            continue;
                        }
                        if (!array_key_exists($rowTerpilih['TGL'], $tgl)) {
                            $tgl[$rowTerpilih['TGL']] = array();
                        }

                        //risk = premi * persenRisk
                        $resiko = $rowTerpilih['SUB_PREMI'] * $rowRules['SHA_RISK'] / 100;
                        //komisi = premi * persenRisk / 1.1
                        $komisi = ($rowTerpilih['SUB_PREMI'] * $rowRules['SHA_NUM'] / 100) / 1.1;
                        $komisiDiterima = $ppn = $pph23 = 0;
                        //jika menerima komisi, hitung ppn dan pph
                        if ($komisi > 0) {
                            if ($rowRules['SHA_TAX'] == 'y') {
                                //ppn = komisi * 10 /100
                                $ppn = $komisi * 10 / 100;
                            }
                            if ($rowRules['SHA_WITH'] == 'y') {
                                //ppn = komisi * 2 /100
                                $pph23 = $komisi * 2 / 100;
                            }
                            // komisi diterima = komisi + ppn - pph
                            $komisiDiterima = $komisi + $ppn - $pph23;

                            // kurangi pendapatan rules yg menanggung komisi (produk&rules) ini
                            foreach ($rules as $keyPenanggung => $rowPenanggung) {
                                if ($rowRules['PROD_ID'] ==
                                    $rowPenanggung['PROD_ID']
                                    &&
                                    $rowRules['SHA_NUM_BACKER'] ==
                                    $rowPenanggung['SHA_ENTITY']
                                ) {
                                    $rules[$keyPenanggung][$rowTerpilih['TGL']]['DITERIMA'] -= $komisiDiterima;
                                    //keluar dari loop penanggung
                                    break;
                                }
                            }
                        }
                        $rules[$keyRules][$rowTerpilih['TGL']]['PPN'] += $ppn;
                        $rules[$keyRules][$rowTerpilih['TGL']]['PPH23'] += $pph23;
                        $rules[$keyRules][$rowTerpilih['TGL']]['RESIKO'] += $resiko;
                        $rules[$keyRules][$rowTerpilih['TGL']]['KOMISI'] += $komisi;
                        //set elemen diterima (pendapatan) = resiko + komisi
                        $rules[$keyRules][$rowTerpilih['TGL']]['DITERIMA'] += $resiko + $komisiDiterima;
                        //$rowRules[]
                    }
                }
                if (count($transTerpilih) == 0) {
                    die(json_encode(array(true, 'data' => array())));
                }
                //siapkan variabel rules gabungan
                $diterimaRules = array();
                $totalPremi = 0;
                foreach ($rules as $keyRules => $rowRules) {
                    foreach ($tgl as $keyTgl => $tglRow) {
                        //jika rules ini punya tgl ini
                        if (array_key_exists($keyTgl, $rowRules)) {
                            //jika user ini tidak ada di tgl ini, tambahkan
                            if (!array_key_exists($rowRules['SHA_ENTITY'], $tglRow)) {
                                $tgl[$keyTgl]
                                [$rowRules['SHA_ENTITY']] = array(
                                    'PLAFOND' => array_sum($rowRules[$keyTgl]['TSI']),
                                    'PREMI' => array_sum($rowRules[$keyTgl]['SUBPREMI']),
                                    'CURR' => $rowRules[$keyTgl]['CURR'],
                                    'NAMA' => $rowRules['ENTITY_NAMA'],
                                    'DITERIMA' => $rowRules[$keyTgl]['DITERIMA'],
                                );
                            } else {
                                $tgl[$keyTgl][$rowRules['SHA_ENTITY']]['DITERIMA'] += $rowRules[$keyTgl]['DITERIMA'];
                            }
                        }
                    }
                }
                //var_dump($tgl);
                $data = array();
                foreach ($tgl as $keyTgl => $tglRow) {
                    foreach ($tglRow as $keyEntity => $entityRow) {
                        $data[] = array($keyTgl, $entityRow['NAMA'], $entityRow['CURR'], $entityRow['PLAFOND'], $entityRow['PREMI'], $entityRow['DITERIMA']);
                    }
                }
                die(json_encode(array(true, 'data' => $data)));
                //var_dump($data);

                break;
            case "peserta_aktif":
                if (!isset($_POST["kode"])) {
                    die(json_encode(array(false, 'pesan' => 'Unknown Request 4')));
                }
                $kode = mysqli_escape_string($conection, $_POST["kode"]);
                $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["awal"])));
                $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["akhir"]) . " +1 day"));
                if (isset($_POST["status"]) && $_POST["status"]=='baru') {
                    $perintah = ' SELECT CREATED_ON,TRX_KTP_ID,TRX_NAMA,LOKASI_NAMA' .
                    ',TRX_PLAFOND,TRX_PREMI,CURR_ID,TRX_STATUS,TRX_NILAI_UK,NULL' .
                    ',SUSA_NAMA,TRX_TGL_LAHIR,TRX_ALAMAT,TRX_PENCAIRAN,TRX_JML_MINGG,CONCAT(TRX_START_PRO," s.d ",TRX_END_PRO)'.
                    ',PAYMENT_DATE' ;
                }else{
                    $perintah = ' SELECT PAYMENT_DATE,TRX_KTP_ID,TRX_NAMA,LOKASI_NAMA' .
                    ',TRX_PLAFOND,TRX_PREMI,CURR_ID,TRX_STATUS,TRX_NILAI_UK,NULL' .
                    ',SUSA_NAMA,TRX_TGL_LAHIR,TRX_ALAMAT,TRX_PENCAIRAN,TRX_JML_MINGG,CONCAT(TRX_START_PRO," s.d ",TRX_END_PRO)';
                }
                // ',CONCAT(a.PAYMENT_SYSTEM_ID,"|",PAYMENT_DATE)' .
                $perintah .=' FROM tr0001 a ' .
                    ' JOIN ma9002 b ON a.SUSA_ID=b.SUSA_ID ';
                if(empty($_SESSION['user_cabang_key'])){
                    $perintah .= ' LEFT JOIN ma1003 c ON a.CABANG_ID=c.LOKASI_ID AND a.PROD_ID=c.PROD_ID';
                }else{
                    $perintah .= ' JOIN ma1003 c ON a.CABANG_ID=c.LOKASI_ID AND a.PROD_ID=c.PROD_ID AND c.ID_KEY='.$_SESSION['user_cabang_key'];
                }
                $perintah .= ' JOIN ma2001 d ON d.PROD_ID_PARENT=a.PROD_ID ' .
                    // left karena ada status yg baru jadi belum ada pembayaran
                    ' LEFT JOIN py0001_b2c f ON a.PAYMENT_SYSTEM_ID=f.PAYMENT_SYSTEM_ID '.
                    ' WHERE '.
                    ' a.PROD_ID = "' . $kode . '" ';
                if (isset($_POST["status"]) && $_POST["status"]=='baru') {
                    $perintah .= ' AND a.TRX_STATUS=0 AND CREATED_ON BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" ';
                }else{
                    $perintah .= ' AND a.TRX_STATUS=1 AND PAYMENT_DATE BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" ';
                }
                $perintah .= ' GROUP BY TRX_UUID';
                $hasil2 = mysqli_query($conection, $perintah);
                $row = mysqli_fetch_all($hasil2, MYSQLI_NUM);
                die(json_encode(array(true, 'data' => $row, 'sql'=>$perintah)));
                break;
            case "peserta_terdampak":
                if (!isset($_POST["kode"])) {
                    die(json_encode(array(false, 'pesan' => 'Unknown Request 4')));
                }
                $kode = mysqli_escape_string($conection, $_POST["kode"]);
                $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["awal"])));
                $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_POST["akhir"]) . " +1 day"));
                $perintah = ' SELECT f.waktu,f.skala,e.LOKASI_NAMA,d.TRX_NAMA,a.EQ_JARAK' .
                    ',d.TRX_PLAFOND,a.CLAIM_NILAI,(a.CLAIM_NILAI * c.SHA_RISK / 100),NULL' .
                    ',f.koor1 LT1,f.koor2 BJ1,f.kedalaman,d.TRX_KTP_ID,e.lat LT2,e.lng BJ2' .
                    ',a.EQ_RESIKO,c.SHA_RISK' .
                    ' FROM tr0002_b2c a ' .
                    ' JOIN ma2001 b ON a.SUB_PROD_ID=b.PROD_ID' .
                    ' LEFT JOIN ma2003 c ON b.PROD_ID=c.PROD_ID AND SHA_ENTITY="'.$_SESSION['user_cli_group'].'"' .
                    ' JOIN tr0001 d ON a.TRX_SYSTEM_ID=d.TRX_UUID';
                if(empty($_SESSION['user_cabang_key'])){
                    $perintah .= ' LEFT JOIN ma1003 e ON d.CABANG_ID=e.LOKASI_ID AND d.PROD_ID=e.PROD_ID';
                }else{
                    $perintah .= ' JOIN ma1003 e ON d.CABANG_ID=e.LOKASI_ID AND d.PROD_ID=e.PROD_ID AND e.ID_KEY='.$_SESSION['user_cabang_key'];
                }
                $perintah .= ' JOIN gempa2 f ON a.EQ_SYSTEM_ID=f.no ' .
                    ' WHERE b.PROD_ID_PARENT="' . $kode . '" AND b.PROD_TYPE="dca eq" ' .
                    ' AND f.waktu BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" ';
                $hasil2 = mysqli_query($conection, $perintah);
                $row = mysqli_fetch_all($hasil2, MYSQLI_NUM);
                die(json_encode(array(true, 'data' => $row)));
                break;
            case "hitung_peserta_setlement":
                if (!isset($_POST["kode"]) || !isset($_POST['prod'])) {
                    die(json_encode(array(false, 'pesan' => 'Unknown Request 4')));
                }
                $trxUUID = json_decode($_POST["kode"]);
                $mainProd = mysqli_escape_string($conection, $_POST["prod"]);
                if (count($trxUUID) == 0) {
                    die(json_encode(array(false, 'pesan' => 'Tidak ada data terpilih')));
                }
                //ambil sub produk
                $sql = ' SELECT a.PROD_ID,a.PROD_PREMI,a.PROD_TYPE FROM ma2001 a ' .
                    ' WHERE a.PROD_ID_PARENT = "' . $mainProd . '" AND a.PROD_LEVEL=1 ';
                $query = mysqli_query($conection, $sql);
                $subProduk = array();
                foreach (mysqli_fetch_all($query, MYSQLI_ASSOC) as $x) {
                    $subProduk[$x['PROD_ID']] = array(
                        'PROD_PREMI' => $x['PROD_PREMI'],
                        'PROD_TYPE' => $x['PROD_TYPE'],
                    );
                }
                //hitung total masing2 sub premi detail trans terpilih
                $sql = ' SELECT SUB_PROD_ID,SUM(SUB_PREMI) TOTAL FROM tr0002_b2c WHERE ' .
                ' SUB_PROD_ID IN ("' . implode('","', array_keys($subProduk)) . '") AND ' .
                ' TRX_SYSTEM_ID IN ("' . implode('","', $trxUUID) . '")'.
                ' GROUP BY SUB_PROD_ID';
                $query = mysqli_query($conection, $sql);
                $SUB_PREMI_ASLI = array();
                while($row=mysqli_fetch_array($query)){
                    $SUB_PREMI_ASLI[$row['SUB_PROD_ID']]=$row['TOTAL'];
                }
                //ambil rules sub produk untuk pembagian premi
                $SHA_SYSTEM_ID = array();
                //KOMISI untuk FORM
                $rules = array();
                //hitung jumlah risk yg bisa ditambahkan supaya total tidak melebihi 100
                $sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK '.
                ',a.PROD_ID,a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS '.
                ',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX,b.KOMISI_WITH '.
                ' FROM ma2003 a '.
                ' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
                ' WHERE (a.PROD_ID IN ("' . implode('","', array_keys($subProduk)) . '") AND (a.SHA_STATUS=0))'.
                ' GROUP By a.PROD_ID,a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
                $query = mysqli_query($conection, $sql);
                while($row = mysqli_fetch_array($query)){
                    if(!array_key_exists($row['PROD_ID'],$rules)){
                        $rules[$row['PROD_ID']] = array('KOMISI_DITERIMA'=>array()
                                ,'KOMISI'=>array(),'KOMISI2'=>array(),'RESIKO'=>array());
                        $SHA_SYSTEM_ID[$row['PROD_ID']] = array();
                    }
                    //jika id baru hitung total num dan gabung group level
                    if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID)){
                        $SHA_SYSTEM_ID[$row['PROD_ID']][$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
                        $rules[$row['PROD_ID']]['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
                        $rules[$row['PROD_ID']]['KOMISI_DITERIMA'][$row['SHA_ENTITY']] = 0;
                    }
                    //jika ada row komisi
                    if(!is_null($row['SHA_SYSTEM_ID_GIVE'])){
                        //menerima komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$rules[$row['PROD_ID']]['KOMISI'])){
                            $rules[$row['PROD_ID']]['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] = array();
                        }
                        $rules[$row['PROD_ID']]['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']][] = array(
                            'SHA_SYSTEM_ID_GIVE' => $row['SHA_SYSTEM_ID_GIVE'],
                            'KOMISI_NUM' => $row['KOMISI_NUM'],
                            'KOMISI_TAX' => $row['KOMISI_TAX'],
                            'KOMISI_WITH' => $row['KOMISI_WITH'],
                        );
                        //memberi komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_GIVE'],$rules[$row['PROD_ID']]['KOMISI2'])){
                            $rules[$row['PROD_ID']]['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']] = array();
                        }
                        $rules[$row['PROD_ID']]['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']][] = array(
                            'SHA_SYSTEM_ID_TAKE' => $row['SHA_SYSTEM_ID_TAKE'],
                            'KOMISI_NUM' => $row['KOMISI_NUM'],
                            'KOMISI_TAX' => $row['KOMISI_TAX'],
                            'KOMISI_WITH' => $row['KOMISI_WITH'],
                        );
                    }
                }
                //proses pembagian premi untuk semua system_id, need $SUB_PREMI_ASLI[], return $rules[RESIKO] & $rules[KOMISI_DITERIMA]
                foreach($SHA_SYSTEM_ID as $prod_id=>$obj_sha){
                    foreach($obj_sha as $system_id=>$entity_id){
                        //ubah persen resiko menjadi nilai resiko berdasarkan (premi * persen resiko)
                        $rules[$prod_id]['RESIKO'][$entity_id] = $SUB_PREMI_ASLI[$prod_id] * $rules[$prod_id]['RESIKO'][$entity_id] / 100;
                        //mendapat komisi
                        if(isset($rules[$prod_id]['KOMISI'][$system_id])){
                            foreach($rules[$prod_id]['KOMISI'][$system_id] as $index => $objMendapat){
                                $komisi = ($SUB_PREMI_ASLI[$prod_id] * $objMendapat['KOMISI_NUM'] / 100) / 1.1;
                                $ppn = $pph23 = 0;
                                if ($objMendapat['KOMISI_TAX'] == 'y') {
                                    //$ppn = $komisi * 10 /100
                                    $ppn = $komisi * 10 / 100;
                                }
                                if ($objMendapat['KOMISI_WITH'] == 'y') {
                                    //$ppn = $komisi * 2 /100
                                    $pph23 = $komisi * 2 / 100;
                                }
                                $rules[$prod_id]['KOMISI_DITERIMA'][$entity_id] += $komisi + $ppn - $pph23;
                            }

                        }
                        //memberi komisi
                        if(isset($rules[$prod_id]['KOMISI2'][$system_id])){
                            foreach($rules[$prod_id]['KOMISI2'][$system_id] as $index => $objMemberi){
                                $komisi = ($SUB_PREMI_ASLI[$prod_id] * $objMemberi['KOMISI_NUM'] / 100) / 1.1;
                                $ppn = $pph23 = 0;
                                if ($objMemberi['KOMISI_TAX'] == 'y') {
                                    //$ppn = $komisi * 10 /100
                                    $ppn = $komisi * 10 / 100;
                                }
                                if ($objMemberi['KOMISI_WITH'] == 'y') {
                                    //$ppn = $komisi * 2 /100
                                    $pph23 = $komisi * 2 / 100;
                                }
                                $rules[$prod_id]['KOMISI_DITERIMA'][$entity_id] -= $komisi + $ppn - $pph23;
                            }
                        }
                    }
                }
                $pembagian = array();
                foreach($rules as $prod_id=>$row){
                    foreach($row['RESIKO'] as $entity_id=>$val){
                        $pembagian[] = array('prod'=>$prod_id, 'entity'=>$entity_id,'diterima'=>$val+$row['KOMISI_DITERIMA'][$entity_id]);
                    }
                }
                //rules harus punya PROD_ID & SHA_ENTITY
                die(json_encode(array(true, 'data' => $pembagian)));
                break;
            default:
                die(json_encode(array(false, 'pesan' => 'Unknown Request 5')));
        }
    }
} else {
    die(json_encode(array(false, 'pesan' => 'Unknown Request 2')));
}
