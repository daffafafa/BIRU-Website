<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once "../../contact.php";
require_once "../../fungsi.php";
//jika belum login && bukan admin&b2b
if ( ! isLoggedIn() && ! ( isB2B() || isAdmin())) {
    header("Location: ../../logout.php");
}

$page = 'dashboard.php';
$id = mysqli_escape_string($conection, trim(@$_GET['id']));
if($id=="PR002"){ //produk mekaar
    switch (@$_GET['p']) {
        case "cabang":
            $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                ',b.PROD_PREMI,a.PROD_CURR ' .
                ' FROM ma2001 a' .
                ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                ' AND a.PROD_ID = "' . $id . '"' .
                ' ORDER BY a.PROD_NAMA';
            $query = mysqli_query($conection, $perintah);
            if (mysqli_num_rows($query) > 0) {
                $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                switch (@$_GET['a']) {
                    case "tambah":
                        $page = "Produk/PR002/cabang/sd_cabang_tambah.php";
                        break;
                    case "ubah":
                        $id2 = @mysqli_escape_string($conection, trim($_GET['id2']));
                        $sql = 'SELECT * FROM ma1003 WHERE PROD_ID="'.$id.'" AND LOKASI_ID="' . $id2 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) == 1) {
                            $data = mysqli_fetch_array($query);
                            //ambil semua data wilayah semua provinsi, semua kab di prov terpilih, semua kec di kab terpilih, semua kel di kab terpilih
                            $sql = 'SELECT `level`,kode_wilayah_bps,nama,zonasi,pos,lat,lng FROM daerah3 WHERE `level`=1 OR ( `level`=2 AND mst_kode_wilayah_bps="'.$data['LOKASI_PROVINSI'].'") OR ( `level`=3 AND mst_kode_wilayah_bps="'.$data['LOKASI_KABUPATEN'].'") OR ( `level`=4 AND mst_kode_wilayah_bps="'.$data['LOKASI_KECAMATAN'].'") ORDER BY `level` ASC';
                            $query = mysqli_query($conection, $sql);
                            $arrWilayah = mysqli_fetch_all($query, MYSQLI_ASSOC);

                            $page = "Produk/PR002/cabang/sd_cabang_ubah.php";
                        } else {
                            $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                            $page = "Produk/PR002/cabang/sd_cabang.php";
                        }
                        break;
                    default:
                        $page = "Produk/PR002/cabang/sd_cabang.php";
                }
            } else {
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = "dashboard.php";
            }
            break;
        case "user_cabang":
            $key = mysqli_escape_string($conection, trim(@$_GET['key']));
            $sql = 'SELECT PROD_ID,LOKASI_ID,LOKASI_NAMA FROM ma1003 WHERE ID_KEY='.$key.' AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
            $query = mysqli_query($conection, $sql);
            if (mysqli_num_rows($query) == 1) {
                $cabang = mysqli_fetch_array($query);
                switch (@$_GET['a']) {
                    case "tambah":
                        $page = "Produk/PR002/cabang/sd_cabang_user_tambah.php";
                        break;
                    case "ubah":
                        // belum selesai 
                        $page = "Produk/PR002/cabang/sd_cabang_user.php";
                        break;
                    default:
                        $page = "Produk/PR002/cabang/sd_cabang_user.php";
                }
            }else{
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = 'dashboard.php';
            }
            break;
        case "sektor_usaha":
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "Produk/PR002/sektor_usaha/sd_sektor_usaha_tambah.php";
                    break;
                case "ubah":
                    $kode = @mysqli_escape_string($conection, trim($_GET['kode']));
                    $query = mysqli_query($conection, 'SELECT * FROM ma9002 WHERE SUSA_ID="' . $kode . '"');
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);
                        $page = "Produk/PR002/sektor_usaha/sd_sektor_usaha_ubah.php";
                    } else {
                        $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    }
                    break;
                default: $page = "Produk/PR002/sektor_usaha/sd_sektor_usaha.php";
            }
            break;
        case "laporan":
            switch (@$_GET['a']) {
                case 'gempa':
                    if (isset($_GET['id'])) {
                        $id = mysqli_escape_string($conection, trim($_GET['id']));
                        $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                            ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                            ',b.PROD_PREMI,a.PROD_CURR ' .
                            ' FROM ma2001 a' .
                            ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                            ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                            ' AND a.PROD_ID = "' . $id . '"' .
                            ' ORDER BY a.PROD_NAMA';
                        $query = mysqli_query($conection, $perintah);

                        if (mysqli_num_rows($query) > 0) {
                            $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            $page = "su_laporan_gempa.php";
                        } else {
                            $_SESSION['pesan'] = "Maaf data produk ini tidak ditemukan";
                            $page = "dashboard.php";
                        }
                    }else{
                        $_SESSION['pesan'] = "Maaf produk tidak ditemukan";
                        $page = "dashboard.php";
                    }
                    break;
                case 'transaksi':
                    if (isset($_GET['id'])) {
                        $id = mysqli_escape_string($conection, trim($_GET['id']));
                        $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                            ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                            ',b.PROD_PREMI,a.PROD_CURR ' .
                            ' FROM ma2001 a' .
                            ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                            ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                            ' AND a.PROD_ID = "' . $id . '"' .
                            ' ORDER BY a.PROD_NAMA';
                        $query = mysqli_query($conection, $perintah);

                        if (mysqli_num_rows($query) > 0) {
                            $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            $page = "su_laporan_transaksi.php";
                        } else {
                            $_SESSION['pesan'] = "Maaf data produk ini tidak ditemukan";
                            $page = "dashboard.php";
                        }
                    }else{
                        $_SESSION['pesan'] = "Maaf produk tidak ditemukan";
                        $page = "dashboard.php";
                    }
                    break;
                default:
                    $_SESSION['pesan'] = "Maaf halaman gagal dimuat";
                    $page = "dashboard.php";
            }
            break;
        case "peserta":
            $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                ',b.PROD_PREMI,a.PROD_CURR'.
                ',a.DANA_IN_VA_NAMA,a.DANA_IN_VA_NO,a.DANA_IN_VA_BANK ' .
                ' FROM ma2001 a' .
                ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                ' AND a.PROD_ID = "' . $id . '"' .
                ' ORDER BY a.PROD_NAMA';
            $query = mysqli_query($conection, $perintah);
            if (mysqli_num_rows($query) > 0) {
                $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                switch (@$_GET['a']) {
                    case 'settlement':
                        $page = "Produk/PR002/peserta/su_peserta_settlement.php";
                        break;
                    case "tambah":
                        $page = "Produk/PR002/peserta/su_peserta_input_v2.php";
                        break;
                    case "terdampak":
                        $page = "Produk/PR002/peserta/su_peserta_terdampak.php";
                        break;
                    case "upload":
                        $page = "Produk/PR002/peserta/su_peserta_upload_v2.php";
                        break;
                    case "ubah":
                        if (isset($_GET['kode'])) {
                            $id = mysqli_escape_string($conection, trim($_GET['kode']));
                            $sql = 'SELECT * FROM tr0001 WHERE ID_KEY="' . $id . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            $query = mysqli_query($conection, $sql);
                            if (mysqli_num_rows($query) == 1) {
                                $data = mysqli_fetch_array($query);
                                $page = "Produk/PR002/peserta/su_peserta_ubah.php";
                            } else {
                                $page = "dashboard.php";
                                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                            }
                        } else {
                            $page = "dashboard.php";
                            $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                        }
                        break;
                    case "baru":
                        $page = "Produk/PR002/peserta/su_peserta_baru.php";
                        break;
                    default:
                        $page = "Produk/PR002/peserta/su_peserta_aktif.php";
                }
            } else {
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = "dashboard.php";
            }
            break;
        case "list_kewajiban":
            if (isset($_GET['id'])) {
                $id = mysqli_escape_string($conection, trim($_GET['id']));
                $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                    ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                    ',b.PROD_PREMI,a.PROD_CURR ' .
                    ' FROM ma2001 a' .
                    ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                    ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                    ' AND a.PROD_ID = "' . $id . '"' .
                    ' ORDER BY a.PROD_NAMA';
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) > 0) {
                    $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    //menyesuaikan dengan produk
                    switch($id){
                        case "PR002": //mekaarr
                            $page = "Produk/PR002/list_kewajiban.php";
                        break;
                        case "PR123":
                        break;
                        default:
                            $page = "dashboard.php";
                    }
                } else {
                    $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    $page = "dashboard.php";
                }
                //----------------------------------------------------------
            } else {
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = "dashboard.php";
            }
            break;
        case "list_klaim":
            if (isset($_GET['id'])) {
                $id = mysqli_escape_string($conection, trim($_GET['id']));
                $perintah = 'SELECT b.PROD_ID PROD_ID_CHILD,b.PROD_NAMA PROD_NAMA_CHILD' .
                    ',a.PROD_NAMA,a.PROD_ID,a.PROD_STATUS,a.PROD_LEGAL' .
                    ',b.PROD_PREMI,a.PROD_CURR ' .
                    ' FROM ma2001 a' .
                    ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                    ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                    ' AND a.PROD_ID = "' . $id . '"' .
                    ' ORDER BY a.PROD_NAMA';
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) > 0) {
                    $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    //menyesuaikan dengan produk
                    switch($id){
                        case "PR002": //mekaarr
                            $page = "Produk/PR002/list_klaim.php";
                        break;
                        case "PR123":
                        break;
                        default:
                            $page = "dashboard.php";
                    }
                } else {
                    $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    $page = "dashboard.php";
                }
                //----------------------------------------------------------
            } else {
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = "dashboard.php";
            }
            break;
        case "progres_klaim":
            if (isset($_GET['id'])) {
                $id = mysqli_escape_string($conection, trim($_GET['id']));
                $kode = mysqli_escape_string($conection, trim($_GET['kode']));
                $perintah = 'SELECT b.ENTITY_NAMA,a.NILAI,a.KEWAJIBAN_STATUS,a.PAYMENT_SYSTEM_ID,a.NO_REKENING,a.BANK_REKENING,a.NAMA_REKENING,a.is_from_reas,a.is_reas '.
                ' FROM tr0004_b2c a'.
                ' JOIN ma1001 b ON a.ENTITY_ID=b.ENTITY_ID '.
                ' WHERE a.TRX_DETAIL_SYSTEM_ID = "' . $kode . '"'.
                ''
                ;
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) > 0) {
                    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    $page = "progres_klaim.php";
                } else {
                    $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    $page = "dashboard.php";
                }
                //----------------------------------------------------------
            } else {
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = "dashboard.php";
            }
            break;
        case "detailTrans":
            //dari history transaksi di navigasi profil
            if (isset($_GET['id'])) {
                $dt1 = mysqli_escape_string($conection, trim($_GET['id']));

                $perintah = 'SELECT NOPOLICY,TRX_PR_CLIENT_ID,TRX_PR_ID,TRX_PR_DATE,TRX_PR_TYPE' .
                    ',TRX_PR_CURR_ID,TRX_PR_VALUE,ENTITY_NAMA,ENTITY_PR_VALUE FROM py0001 ' .
                    ' LEFT JOIN ma1001 ON TRX_PR_CLIENT_ID=ENTITY_ID ' .
                    ' LEFT JOIN py0002 ON TRX_PR_ID_PARENT=TRX_PR_ID AND ' .
                    ' SHA_ENTITY = "' . $_SESSION['user_id'] . '"' .
                    ' WHERE TRX_PR_ID=' . $dt1
                ;
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) == 0) {
                    $page = 'dashboard.php';
                } else {
                    //menyesuaikan dengan produk
                    switch($id){
                        case "PR002": //mekaarr
                            $transaksi = mysqli_fetch_array($query);
                            $page = 'Produk/PR002/su_peserta_transaksi.php';
                        break;
                        case "PR123":
                        break;
                        default:
                            $page = "dashboard.php";
                    }
                }
            } else {
                $page = "dashboard.php";
            }
            break;
        
        default: $page = "dashboard.php";
    }
}else{
    switch (@$_GET['p']) {
        case "download":
            switch (@$_GET['a']) {
                case 'file_rejected':
                switch(@$_GET['prod']){
                    case "PR002":
                        if (isset($_GET['id'])) {
                            $dt1 = mysqli_escape_string($conection, trim($_GET['id']));
        
                            $perintah = 'SELECT ID_KEY,TRX_NMFILE,CREATED_BY FROM up001 WHERE ID_KEY=' . $dt1 . ' AND CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die('File not found-');
                            }
                            $data = mysqli_fetch_array($query);
                            header('location: ../unggah/b2b/PR002/' . $data['CREATED_BY'] . '/Rejected_' . $data['TRX_NMFILE']);
                        } else {
                            die('File not found--');
                        }
                    break;
                    default:
                    die('File not found--');
                }
                break;
            case 'template_upload':
                header('location: ../unggah/templateUpload.xlsx');
                die();
                break;
            default:
                die('File not found---');
            }
            break;
        case "company":
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "pengaturan/company/sd_company_tambah.php";
                    break;
                case "ubah":
                    $id = @mysqli_escape_string($conection, trim($_GET['kode']));
                    $query = mysqli_query($conection, 'SELECT * FROM ma1001 WHERE ENTITY_ID="' . $id . '"');
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);
                        $page = "pengaturan/company/sd_company_ubah.php";
                    } else {
                        $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    }
                    break;
                default:
                    $page = "pengaturan/company/sd_company.php";
            }
            break;
        case "user_company":
            $key = mysqli_escape_string($conection, trim($_GET['key']));
            $sql = 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001 WHERE ENTITY_ID="'.$key.'"';
            $query = mysqli_query($conection, $sql);
            if (mysqli_num_rows($query) == 1) {
                $perusahaan = mysqli_fetch_array($query);
                switch (@$_GET['a']) {
                    case "tambah":
                        $page = "pengaturan/company/sd_company_user_tambah.php";
                        break;
                    case "ubah":
                        $id2 = mysqli_escape_string($conection, trim($_GET['id2']));
                        $sql = 'SELECT CLI_USER_ID,CLI_EMAIL,GROUP_CONCAT(permission_id) permission_id FROM ma0001 LEFT JOIN users_permissions ON CLI_SYSTEM_ID=user_id WHERE CLI_GROUP="'.$key.'" AND CLI_SYSTEM_ID='.$id2;
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) == 1) {
                            $user = mysqli_fetch_array($query);
                            $page = "pengaturan/company/sd_company_user_ubah.php";
                        }else{
                            $page = "pengaturan/company/sd_company_user.php";
                        }
                        break;
                    default:
                        $page = "pengaturan/company/sd_company_user.php";
                }
            }else{
                $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                $page = 'dashboard.php';
            }
            break;
        case "user_management":
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "pengaturan/st_user_management_tambah.php";
                    break;
                case "ubah":
                    $id = @mysqli_escape_string($conection, trim($_GET['kode']));
                    $query = mysqli_query($conection, 'SELECT * FROM ma1001 WHERE ENTITY_ID="' . $id . '"');
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);
                        $page = "pengaturan/st_user_management_ubah.php";
                    } else {
                        $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    }
                    break;
                default:
                    $page = "pengaturan/st_user_management.php";
            }
            break;
        case "zona":
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "pengaturan/zona/sd_zona_tambah.php";
                    break;
                case "ubah":
                    $id = @mysqli_escape_string($conection, trim($_GET['id']));
                    $perintah = ' SELECT a.`no`,a.kode_wilayah_bps Kel,b.kode_wilayah_bps Kec,c.kode_wilayah_bps Kab,d.kode_wilayah_bps Prov,a.zonasi,a.pos FROM daerah3 a ' .
                        ' JOIN daerah3 b ON b.kode_wilayah_bps=a.mst_kode_wilayah_bps ' .
                        ' JOIN daerah3 c ON c.kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' JOIN daerah3 d ON d.kode_wilayah_bps=c.mst_kode_wilayah_bps ' .
                        ' WHERE a.`no`="' . $id . '"';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);
                        $page = "pengaturan/zona/sd_zona_ubah.php";
                    } else {
                        $page = "pengaturan/zona/sd_zona.php";
                        $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                    }
                    break;
                default:
                    $page = "pengaturan/zona/sd_zona.php";
            }
            break;
        case "holiday":
            $page = "pengaturan/st_holiday.php";
            break;
        case "produk":
            //----------------------------------------------------------
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "pengaturan/produk/sd_produk_tambah_v2.php";
                    break;
                case "ubah":
                    $id = @mysqli_escape_string($conection, trim($_GET['kode']));
                    $query = mysqli_query($conection, 'SELECT a.PROD_ID,PROD_NAMA' .
                        ',PROD_LEGAL,PROD_STATUS,PROD_LEVEL,PROD_ID_PARENT' .
                        ',PROD_MIN_TSI,PROD_MAX_TSI,PROD_CURR,PROD_AUTOP,PROD_B2C ' .
                        ',PROD_STEP_TSI,DANA_IN_VA_NAMA,DANA_IN_VA_NO,DANA_IN_VA_BANK,DANA_OUT_VA_NO,DANA_OUT_VA_BANK' .
                        ',PROD_PREMI,PROD_TYPE,CLAIM_TYPE FROM ma2001 a ' .
                        ' WHERE a.PROD_ID="' . $id . '"');
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);

                        $premiArr = array();
                        switch ($data['PROD_TYPE']) {
                            case "dca eq":
                                $perintah2 = 'SELECT rate,zona FROM premi WHERE SUB_PROD_ID="' . $data['PROD_ID'] . '" ORDER BY zona';
                                $query2 = mysqli_query($conection, $perintah2);
                                while ($dataPremi = mysqli_fetch_array($query2)) {
                                    $premiArr[$dataPremi['zona']] = $dataPremi['rate'];
                                }
                                break;
                            case "kematian":
                                echo $perintah2 = ' SELECT rate,usia_awal,usia_akhir FROM premi WHERE SUB_PROD_ID="' . $data['PROD_ID'] . '" ORDER BY usia_awal';
                                $query2 = mysqli_query($conection, $perintah2);
                                while ($dataPremi = mysqli_fetch_array($query2)) {
                                    $premiArr[] = array('usia_awal'=>$dataPremi['usia_awal'],'usia_akhir'=>$dataPremi['usia_akhir'],'rate'=>$dataPremi['rate']);
                                }
                                break;
                        }
                        if ($data['PROD_LEVEL'] == 0) {
                            $link_kembali = './?p=produk';
                        } else {
                            $link_kembali = './?p=produk&type=sub&kode=' . $data['PROD_ID_PARENT'];
                        }
                        $page = "pengaturan/produk/sd_produk_ubah_v2.php";
                    } else {
                        $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                        switch (@$_GET['type']) {
                            case 'sub':
                                $page = "pengaturan/produk/sd_produk_sub.php";
                                break;
                            default:
                                $page = "pengaturan/produk/sd_produk.php";
                        }
                    }
                    break;
                default:
                    switch (@$_GET['type']) {
                        case 'sub':
                            $page = "pengaturan/produk/sd_produk_sub.php";
                            break;
                        default:
                            $page = "pengaturan/produk/sd_produk.php";
                    }
            }
            //----------------------------------------------------------
            break;
        case "holiday_produk":
            $page = "pengaturan/produk/sd_produk_holiday.php";
            break;
        case "gempa":
            switch (@$_GET['a']) {
                case "tambah":
                    $page = "pengaturan/gempa/df_gempa_test.php";
                    break;
    
                default:
                    $page = "pengaturan/gempa/df_gempa.php";
            }
            break;
        case "my_profile":
            $company = mysqli_fetch_array(mysqli_query($conection, 'SELECT * FROM ma1001 WHERE ENTITY_ID="' . $_SESSION['user_cli_group'] . '" LIMIT 0,1'));
            $page = "my_profile.php";
            break;
        case "business_rules_detail":
            $id = @mysqli_escape_string($conection, trim($_GET['id']));
            $sql = 'SELECT PROD_ID,PROD_NAMA,PROD_ID_PARENT ' .
                'FROM ma2001 WHERE ma2001.PROD_ID="' . $id . '" AND PROD_LEVEL=1';
            $query = mysqli_query($conection, $sql);
            if (mysqli_num_rows($query) == 1) {
                $produk = mysqli_fetch_array($query);
                //----------------------------------------------------------
                //ambil nama perusahaan
                $sql = 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001';
                $query = mysqli_query($conection, $sql);
                $entity = array();
                while($row = mysqli_fetch_array($query)){
                    $entity[$row['ENTITY_ID']] = $row['ENTITY_NAMA'];
                }
                $SHA_SYSTEM_ID = array();
                //KOMISI untuk FORM
                $data = array('KOMISI_NUM'=>0
                    ,'KOMISI'=>array(),'KOMISI2'=>array(),'RESIKO'=>array(),'STATUS'=>array()
                    ,'MENERIMA_KOMISI'=>array(),'MEMBERI_KOMISI'=>array(),'BANK'=>array(),'SHA_ENTITY_LEVEL'=>array());

                //hitung jumlah risk yg bisa ditambahkan supaya total tidak melebihi 100
                $sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK'.
                ',a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS,a.SHA_ENTITY_LEVEL'.
                ',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX '.
                ',b.KOMISI_WITH,CONCAT(NAMA_REKENING) NAMA,CONCAT(BANK_REKENING) BANK,CONCAT(NO_REKENING) BANK_NO '.
                ' FROM ma2003 a '.
                ' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
                ' WHERE (a.PROD_ID="' .  $produk['PROD_ID']  . '")'.
                ' GROUP By a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
                $query = mysqli_query($conection, $sql);
                while($row = mysqli_fetch_array($query)){
                    //jika id baru hitung total num dan gabung group level
                    if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID)){
                        $SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
                        $data['STATUS'][$row['SHA_ENTITY']] = $row['SHA_STATUS'];
                        $data['SHA_ENTITY_NAMA'][$row['SHA_ENTITY']] = $entity[$row['SHA_ENTITY']];
                        $data['SHA_ENTITY_LEVEL'][$row['SHA_ENTITY']] = $row['SHA_ENTITY_LEVEL'];
                        $data['KOMISI_NUM'] += $row['KOMISI_NUM'];
                        $data['BANK'][$row['SHA_ENTITY']] = array('nama'=>$row['NAMA'],'bank'=>$row['BANK'],'no'=>$row['BANK_NO']);
                        $data['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
                    }
                    //jika ada row komisi
                    if(!is_null($row['SHA_SYSTEM_ID_GIVE'])){
                        //menerima komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$data['KOMISI'])){
                            $data['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] = array();
                        }
                        $data['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']][] = array(
                            'SHA_SYSTEM_ID_GIVE' => $row['SHA_SYSTEM_ID_GIVE'],
                            'KOMISI_NUM' => $row['KOMISI_NUM'],
                            'KOMISI_TAX' => $row['KOMISI_TAX'],
                            'KOMISI_WITH' => $row['KOMISI_WITH'],
                        );
                        //memberi komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_GIVE'],$data['KOMISI2'])){
                            $data['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']] = array();
                        }
                        $data['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']][] = array(
                            'SHA_SYSTEM_ID_TAKE' => $row['SHA_SYSTEM_ID_TAKE'],
                            'KOMISI_NUM' => $row['KOMISI_NUM'],
                            'KOMISI_TAX' => $row['KOMISI_TAX'],
                            'KOMISI_WITH' => $row['KOMISI_WITH'],
                        );
                        //total menerima komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_TAKE'], $data['MENERIMA_KOMISI'])){
                            $data['MENERIMA_KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] = 0;
                        }
                        $data['MENERIMA_KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] += $row['KOMISI_NUM'];
                        //total memberi komisi
                        if( ! array_key_exists($row['SHA_SYSTEM_ID_GIVE'],$data['MEMBERI_KOMISI'])){
                            $data['MEMBERI_KOMISI'][$row['SHA_SYSTEM_ID_GIVE']] = 0;
                        }
                        $data['MEMBERI_KOMISI'][$row['SHA_SYSTEM_ID_GIVE']] += $row['KOMISI_NUM'];
                    }
                }
                switch (@$_GET['a']) {
                    case "tambah":
                        //pilih perusahaan yg belum berpartner di sub prod ini
                        $partner = array();
                        foreach($entity as $e_id => $e_nama){
                            if(!in_array($e_id, array_keys($data['RESIKO']))){
                                $partner[] = array('ENTITY_ID'=>$e_id,'ENTITY_NAMA'=>$e_nama);
                            }
                        }
                        $totalResiko = array_sum($data['RESIKO']);
                        $page = "pengaturan/bussiness_rules/sd_business_rules_detail_tambah.php";
                        break;
                    case "ubah":
                        if (isset($_GET['id2'])) {
                            $partner = null;
                            foreach($entity as $e_id => $e_nama){
                                if($e_id == $_GET['id2']){
                                    $partner = array('ENTITY_ID'=>$e_id,'ENTITY_NAMA'=>$e_nama);
                                    break;
                                }
                            }
                            //hitung jumlah risk kecuali perusahaan ini supaya total tidak melebihi 100
                            $totalResiko = array_sum(array_diff_key($data['RESIKO'],array($_GET['id2']=>0)));
                            $page = "pengaturan/bussiness_rules/sd_business_rules_detail_ubah.php";
                        } else {
                            $_SESSION['pesan'] = "Maaf data yang anda cari tidak ada";
                            $page = "pengaturan/bussiness_rules/sd_business_rules_detail.php";
                        }
                    break;
                    default:
                    $page = "pengaturan/bussiness_rules/sd_business_rules_detail.php";
                }
                
                //----------------------------------------------------------
            } else {
                $_SESSION['pesan'] = "Maaf data produk yang anda cari tidak ada";
                $page = 'dashboard.php';
            }
            break;
        default:
        $page = "dashboard.php";
}
}

?>
<!DOCTYPE html>
<html lang="en">

<?php 
// include "../biru/head.php";
include "head_v2.php";

?>

<?php include $page;?>

</html>
