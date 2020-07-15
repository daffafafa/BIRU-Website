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
            case "company_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["alamat"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["pic"]));
                    $dt5 = mysqli_escape_string($conection, purifier($_POST["phone"]));
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["email"]));
                    $dt7 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["join"]));
                    $dt9 = mysqli_escape_string($conection, purifier($_POST["expiry"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["mou"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["npwp"]));
                    $dt12 = mysqli_escape_string($conection, purifier($_POST["addr"]));
                    $dt13 = mysqli_escape_string($conection, purifier($_POST["pvk"]));
                    //stop jika ENTITY_ID sudah ada
                    $perintah = ' SELECT ENTITY_EMAIL as email FROM ma1001 WHERE ENTITY_ID ="' . $dt1 . '" OR ENTITY_EMAIL="' . $dt6 . '" ' .
                        ' UNION SELECT email FROM mmt WHERE email="' . $dt6 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 1) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Perusahaan/Email sudah digunakan')));
                    }
                    $perintah = 'INSERT INTO ma1001 (ENTITY_ID, ENTITY_NAMA, ENTITY_ALAMAT, ENTITY_PIC, ' .
                        ' ENTITY_PIC_PHONE, ENTITY_EMAIL, ENTITY_JOINT, ENTITY_EXPIRY, ENTITY_STATUS, ' .
                        ' ENTITY_MOU, ENTITY_NPWP,`ENTITY_BLOCK_ADDR`,ENTITY_BLOCK_PKEY) VALUES ("' . $dt1 . '","' . $dt2 . '","' . $dt3 . '","' . $dt4 .
                        '","' . $dt5 . '","' . $dt6 . '","' . $dt8 . '","' . $dt9 . '",' . $dt7 . ',"' . $dt10 .
                        '","' . $dt11 . '","' . $dt12 . '","' . $dt13 . '")';
                    if (mysqli_query($conection, $perintah)) {
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["alamat"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["pic"]));
                    $dt5 = mysqli_escape_string($conection, purifier($_POST["phone"]));
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["email"]));
                    $dt7 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["join"]));
                    $dt9 = mysqli_escape_string($conection, purifier($_POST["expiry"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["mou"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["npwp"]));
                    //stop jika ENTITY_ID belum ada
                    $perintah = 'SELECT ENTITY_ID FROM ma1001 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Perusahaan tidak ditemukan')));
                    }
                    $perintah = ' UPDATE ma1001 SET ENTITY_NAMA="' . $dt2 . '", ENTITY_ALAMAT="' . $dt3 . '", ' .
                        ' ENTITY_PIC="' . $dt4 . '", ENTITY_PIC_PHONE="' . $dt5 . '", ENTITY_EMAIL="' . $dt6 . '", ' .
                        ' ENTITY_JOINT="' . $dt8 . '", ENTITY_EXPIRY="' . $dt9 . '", ENTITY_STATUS=' . $dt7 . ', ' .
                        ' ENTITY_MOU="' . $dt10 . '", ENTITY_NPWP="' . $dt11 . '" WHERE ENTITY_ID="' . $dt1 . '"';

                    if (mysqli_query($conection, $perintah)) {
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di ubah ')));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di ubah')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));

                    // stop jika ENTITY_ID tidak ada dan
                    // memiliki data produk,cabang,sha,parameter,sektor usaha, nasabah

                    $perintah = 'SELECT ENTITY_ID FROM ma1001 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Perusahaan tidak ditemukan')));
                    }
                    $perintah = 'SELECT ENTITY_ID FROM ma2003 WHERE SHA_ENTITY ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan masih memiliki data Business Rules')));
                    }
                    $perintah = 'SELECT ENTITY_ID FROM ma1003 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan masih memiliki data cabang dan lokasi')));
                    }
                    $perintah = 'SELECT ENTITY_ID FROM ma9001 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan masih memiliki data parameter')));
                    }
                    $perintah = 'SELECT ENTITY_ID FROM ma9002 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan masih memiliki data sektor usaha')));
                    }
                    $perintah = 'SELECT ENTITY_ID FROM tr0001 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan masih memiliki data nasabah')));
                    }

                    $perintah = 'DELETE FROM ma1001 WHERE ENTITY_ID ="' . $dt1 . '"';
                    if (mysqli_query($conection, $perintah)) {
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_user_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $em = strtolower(mysqli_escape_string($conection, purifier($_POST['email'])));
                    $email = filter_var($em, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }

                    $dt = mysqli_escape_string($conection, purifier($_POST["company"]));
                    $un = strtolower(mysqli_escape_string($conection, purifier($_POST["username"])));
                    $ps = strtolower(mysqli_escape_string($conection, purifier($_POST["password"])));


                    $sql = 'SELECT ID_KEY FROM ma1001 WHERE ENTITY_ID="' . $dt . '"';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Perusahaan tidak ditemukan')));
                    }

                    $sql = '(SELECT CLI_USER_ID id,CLI_EMAIL email ' .
                        ' FROM ma0001 ' .
                        ' WHERE (CLI_EMAIL LIKE "' . $em . '" OR CLI_USER_ID LIKE "' . $un . '") ' .
                        ' ) UNION (' .
                        ' SELECT ENTITY_ID id,ENTITY_EMAIL email' .
                        ' FROM ma1001 ' .
                        ' WHERE (ENTITY_ID LIKE "' . $un . '") ' .
                        ' )';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        mysqli_autocommit($conection, false);
                        $all_query_ok = true;

                        //tambah user
                        $perintah = 'INSERT INTO ma0001 (CLI_SYSTEM_ID,CLI_USER_ID,CLI_GROUP,CLI_EMAIL,CLI_PASSWORD,CLI_PHONE,CLI_ERROR)  VALUES (NULL,"'.$un.'","'. $dt .'","'.strtolower($em).'","'.$ps.'","",0)';
                        mysqli_query($conection, $perintah)?null:$all_query_ok=false;
                        $cli_system_id = mysqli_insert_id($conection);

                        //tambah/hubungkan user permission
                        if(has_permission('update_right_management_user_perusahaan')){
                            $permission = null;
                            if( ! empty($_POST["permission"])){

                                $query = mysqli_query($conection, 'SELECT id FROM permissions WHERE id NOT IN (16,17,18,19) AND dinamis != 1 ');
                                $dataPermissions = array_map(function($c){return $c['id'];},mysqli_fetch_all($query, MYSQLI_ASSOC));
                                
                                foreach($_POST["permission"] as $index => $val){
                                    if( ! in_array($val, $dataPermissions)){
                                        unset($_POST["permission"][$index]);
                                    }
                                }
                                $awal = '('.$cli_system_id.',';
                                $akhir = '),';
                                $permission = $awal . implode($akhir . $awal, $_POST["permission"]) . $akhir;
                                $permission = substr($permission, 0, -1);
                                $perintah = 'INSERT INTO users_permissions (user_id,permission_id) VALUES ' . $permission;
                                mysqli_query($conection, $perintah)?null:$all_query_ok=false;
                            }
                        }
                        
                        if ($all_query_ok) {
                            mysqli_commit($conection);
                            //kalau true sesi dihapus
                            unset($_SESSION['token']);
                            die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                        } else {
                            mysqli_rollback($conection);
                            die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan-')));
                        }
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Username / Email sudah terdaftar')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_user_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    //belum selesai
                    $em = strtolower(mysqli_escape_string($conection, purifier($_POST['email'])));
                    $email = filter_var($em, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }
                    $dt = mysqli_escape_string($conection, purifier($_POST["company"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["id2"]));

                    $sql = 'SELECT CLI_EMAIL FROM ma0001 WHERE CLI_SYSTEM_ID='.$dt1.' AND CLI_GROUP="' . $dt . '"';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, User Perusahaan tidak ditemukan')));
                    }
                    $dataLama = mysqli_fetch_array($query);

                    mysqli_autocommit($conection, false);
                    $all_query_ok = true;

                    //jika email diganti dan email tidak duplikat, simpan
                    if($email != $dataLama['CLI_EMAIL']){
                        $sql = '(SELECT CLI_USER_ID id,CLI_EMAIL email ' .
                        ' FROM ma0001 ' .
                        ' WHERE (CLI_EMAIL LIKE "' . $em . '") ' .
                        ' ) UNION (' .
                        ' SELECT ENTITY_ID id,ENTITY_EMAIL email' .
                        ' FROM ma1001 ' .
                        ' WHERE (ENTITY_ID LIKE "' . $un . '") ' .
                        ' )';
                        $query = mysqli_query($conection, $sql);
                        if (mysqli_num_rows($query) == 1) {
                            die(json_encode(array(false, 'pesan' => 'Username / Email sudah terdaftar')));
                        }

                        $sql = 'UPDATE ma0001 SET CLI_EMAIL = "'.$em.'" WHERE CLI_SYSTEM_ID=' . $dt1 .' AND CLI_GROUP="' . $dt . '"';
                        mysqli_query($conection, $sql)?null:$all_query_ok=false;
                    }

                    //hapus kemudian tambah/hubungkan user permission
                    if(has_permission('update_right_management_user_perusahaan')){
                        $permission = null;
                        if( ! empty($_POST["permission"])){
                            $perintah = 'DELETE FROM users_permissions WHERE user_id=' . $dt1;
                            mysqli_query($conection, $perintah)?null:$all_query_ok=false;

                            $query = mysqli_query($conection, 'SELECT id FROM permissions WHERE id NOT IN (16,17,18,19) AND dinamis != 1 '); 
                            $dataPermissions = array_map(function($c){return $c['id'];},mysqli_fetch_all($query, MYSQLI_ASSOC));
                            
                            foreach($_POST["permission"] as $index => $val){
                                if( ! in_array($val, $dataPermissions)){
                                    unset($_POST["permission"][$index]);
                                }
                            }
                            $awal = '('.$dt1.',';
                            $akhir = '),';
                            $permission = $awal . implode($akhir . $awal, $_POST["permission"]) . $akhir;
                            $permission = substr($permission, 0, -1);
                            $perintah = 'INSERT INTO users_permissions (user_id,permission_id) VALUES ' . $permission;
                            mysqli_query($conection, $perintah)?null:$all_query_ok=false;
                        }
                    }

                    if ($all_query_ok) {
                        mysqli_commit($conection);
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Ubah')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Ubah-')));
                    }

                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_user_ubah_pass":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["company"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["id2"]));
                    $ps = strtolower(mysqli_escape_string($conection, purifier($_POST["password"])));

                    $sql = 'SELECT CLI_EMAIL FROM ma0001 WHERE CLI_SYSTEM_ID='.$dt1.' AND CLI_GROUP="' . $dt . '"';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, User Perusahaan tidak ditemukan')));
                    }
                    
                    $perintah = 'UPDATE ma0001 SET CLI_PASSWORD = "'.$ps.'" WHERE CLI_SYSTEM_ID='.$dt1.' AND CLI_GROUP="' . $dt . '"';
                    $query = mysqli_query($conection, $perintah);
                    if($query){
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Ubah')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Ubah-')));
                    }

                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "company_user_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["company"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["id2"]));
                    
                    $sql = 'DELETE FROM ma0001 WHERE CLI_SYSTEM_ID='.$dt1.' AND CLI_GROUP="' . $dt . '"';
                    $query = mysqli_query($conection, $sql);
                    if($query){
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus-')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "produk_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["mou"]));
                    $dt5 = '"' . mysqli_escape_string($conection, purifier($_POST["mata_uang"])) . '"';
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["premi"]));
                    $dt7 = mysqli_escape_string($conection, purifier($_POST["tingkat"]));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt15 = mysqli_escape_string($conection, purifier($_POST["b2c"]));
                    //tipe,dana_in_no,dana_in_nama,dana_in_bank,dana_out_no,dana_out_nama,dana_out_bank
                    $dt16=$dt17=$dt18=$dt19=$dt20=$dt21=$dt22 = "NULL"; 
                    
                    //stop jika PROD_ID sudah ada
                    $perintah = 'SELECT PROD_ID FROM ma2001 WHERE PROD_ID ="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 1) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk sudah ada')));
                    }

                    mysqli_autocommit($conection, false);
                    $all_query_ok = true; // our control variable

                    $mainProd = $maxP = $minP = $kelipatan = 'NULL';
                    if ($dt7 == 1) {
                        // jika tingkat adalah sup produk
                        $dt9 = mysqli_escape_string($conection, purifier($_POST["parent"]));
                        $dt16 = '"'.mysqli_escape_string($conection, purifier($_POST["tipe"])).'"';
                        $perintah = 'SELECT PROD_ID,PROD_CURR FROM ma2001 WHERE PROD_ID ="' . $dt9 . '"';
                        $query = mysqli_query($conection, $perintah);
                        if (mysqli_num_rows($query) == 0) {
                            die(json_encode(array(false, 'pesan' => 'Gagal!, Main Produk sudah tidak ditemukan')));
                        }
                        $mainProdArr = mysqli_fetch_array($query);
                        $mainProd = '"' . $dt9 . '"';
                        $dt5 = '"' . $mainProdArr['PROD_CURR'] . '"';
                        if ($dt16 == '"dca eq"') {
                            //jika tipe sub = dca eq, tambahkan premi dca eq
                            $dt10 = mysqli_escape_string($conection, purifier($_POST["premi1"]));
                            $dt11 = mysqli_escape_string($conection, purifier($_POST["premi2"]));
                            $dt12 = mysqli_escape_string($conection, purifier($_POST["premi3"]));
                            $dt13 = mysqli_escape_string($conection, purifier($_POST["premi4"]));
                            $dt14 = mysqli_escape_string($conection, purifier($_POST["premi5"]));
                            mysqli_query($conection, ' INSERT INTO premi (SUB_PROD_ID,zona,rate) VALUES ' .
                                ' ("' . $dt1 . '",1,"' . $dt10 . '"), ' .
                                ' ("' . $dt1 . '",2,"' . $dt11 . '"), ' .
                                ' ("' . $dt1 . '",3,"' . $dt12 . '"), ' .
                                ' ("' . $dt1 . '",4,"' . $dt13 . '"), ' .
                                ' ("' . $dt1 . '",5,"' . $dt14 . '") '
                            ) ? null : $all_query_ok = false;
                        }else if ($dt16 == '"kematian"') {
                            $valPremiUsia='';
                            $usia1=$usia2=$usiapremi=array();
                            //untuk semua kiriman usiakecil
                            foreach($_POST["usiakecil"] as $index=>$val){
                                if(isset($_POST['usiakecil'][$index]) && isset($_POST['usiabesar'][$index]) && 
                                    isset($_POST['usiapremi'][$index]) && $_POST['usiapremi'][$index]>0 &&
                                    $_POST['usiakecil'][$index]>0 && $_POST['usiabesar'][$index]>0){
                                    
                                    if($_POST['usiakecil'][$index] <= $_POST['usiabesar'][$index]){
                                        $usiakecil = mysqli_escape_string($conection, purifier($_POST['usiakecil'][$index]));
                                        $usiabesar = mysqli_escape_string($conection, purifier($_POST['usiabesar'][$index]));
                                        $usiapremi = mysqli_escape_string($conection, purifier($_POST['usiapremi'][$index]));
                                        $valPremiUsia .= '("' . $dt1 . '",'.$usiakecil.','.$usiabesar.','.$usiapremi.'),';
                                    }else if($_POST['usiakecil'][$index] > $_POST['usiabesar'][$index]){
                                        $usiakecil = mysqli_escape_string($conection, purifier($_POST['usiakecil'][$index]));
                                        $usiabesar = mysqli_escape_string($conection, purifier($_POST['usiabesar'][$index]));
                                        $usiapremi = mysqli_escape_string($conection, purifier($_POST['usiapremi'][$index]));
                                        $valPremiUsia .= '("' . $dt1 . '",'.$usiabesar.','.$usiakecil.','.$usiapremi.'),';
                                    }
                                }
                            }
                            if($valPremiUsia != ''){
                                $valPremiUsia = substr($valPremiUsia,0,-1);
                                $sqlPremiUsia = 'INSERT INTO premi (SUB_PROD_ID,usia_awal,usia_akhir,rate) VALUES '.$valPremiUsia;
                                if(!mysqli_query($conection,$sqlPremiUsia)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal menambah Premi Rentang Usia.')));
                                }
                            }else{
                                die(json_encode(array(false, 'pesan' => 'Gagal menambah Premi Rentang Usia..')));
                            }
                        }
                        $dt20 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_out_no"])).'"';
                        $dt21 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_out_bank"])).'"';
                        $dt22 = '"'.mysqli_escape_string($conection, purifier($_POST["claim"])).'"';
                    } else {
                        //jika tingkat main produk
                        if($dt15==1){ //kalau b2c
                            $cek = mysqli_escape_string($conection, purifier($_POST["maxp"]));
                            $cek2 = mysqli_escape_string($conection, purifier($_POST["minp"]));
                            $cek3 = mysqli_escape_string($conection, purifier($_POST["kelipatan"]));
                            if ($cek >= $cek2) {
                                if($cek3 > ($cek - $cek2)){
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Kelipatan Pertanggungan harus lebih kecil dari rentang nilai antara Min dan Max')));
                                }
                                $maxP = '"' . $cek . '"';
                                $minP = '"' . $cek2 . '"';
                                $kelipatan = '"' . $cek3 . '"';
                            } else {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Pertanggungan Mak harus lebih besar atau sama dengan Min')));
                            }
                        }
                        $dt6 = 0;
                        $dt17 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_in_no"])).'"';
                        $dt18 = '"'.mysqli_escape_string($conection, purifier(implode(', ',$_POST["dana_in_nama"]))).'"';
                        $dt19 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_in_bank"])).'"';
                    }

                    $sql = ' INSERT INTO ma2001 (PROD_PREMI,PROD_ID,PROD_NAMA,PROD_LEGAL,PROD_B2C,PROD_STEP_TSI, ' .
                        ' PROD_STATUS,PROD_LEVEL,PROD_ID_PARENT,PROD_MIN_TSI,PROD_MAX_TSI,PROD_CURR,PROD_AUTOP,PROD_TYPE, '.
                        ' DANA_IN_VA_NO,DANA_IN_VA_BANK,DANA_OUT_VA_NO,DANA_OUT_VA_BANK,CLAIM_TYPE,DANA_IN_VA_NAMA) ' .
                        ' VALUES (' . $dt6 . ',"' . $dt1 . '","' . $dt2 . '","' . $dt4 . '", ' . $dt15 . ',' . $kelipatan . 
                        ' , ' . $dt8 . ',"' . $dt7 . '",' . $mainProd . ',' . $minP . ',' . $maxP . ',' . $dt5 . ',1,' . $dt16 .
                        ' , ' . $dt17 . ', ' . $dt19 . ', ' . $dt20 . ', ' . $dt21 . ', ' . $dt22 . ',' . $dt18 . ')';
                    mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                    if ($all_query_ok) {
                        //kalau true sesi dihapus
                        mysqli_commit($conection);
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan', 'level' => $dt7)));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "produk_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $kode_baru = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode2"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["mou"]));
                    $dt5 = '"' . mysqli_escape_string($conection, purifier($_POST["mata_uang"])) . '"';
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["premi"]));
                    $dt7 = mysqli_escape_string($conection, purifier($_POST["tingkat"]));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt15 = mysqli_escape_string($conection, purifier($_POST["b2c"]));
                    //tipe,dana_in_no,dana_in_nama,dana_in_bank,dana_out_no,dana_out_nama,dana_out_bank
                    $dt16=$dt17=$dt18=$dt19=$dt20=$dt21=$dt22 = "NULL"; 

                    $perintah = 'SELECT PROD_ID,PROD_LEVEL,PROD_TYPE FROM ma2001 WHERE PROD_ID ="' . $dt1 . '"';
                    $query = mysqli_query($conection, $perintah);
                    //stop jika (produk tidak ada) atau
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                    }
                    $produk = mysqli_fetch_array($query);

                    mysqli_autocommit($conection, false);
                    $all_query_ok = true; // our control variable

                    //jika level produk berubah
                    if ($produk['PROD_LEVEL'] != $dt7) {
                        if ($produk['PROD_LEVEL'] == 0) {
                            //jika pada awalnya level produk adalah MAIN
                            //cek apakah sudah ada data transaksi
                            $sql = 'SELECT ID_KEY FROM tr0001 WHERE PROD_ID="' . $dt1 . '"';
                            $query = myqli_query($conection, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Main Prod sudah memiliki transaksi')));
                            }
                        } else {
                            //jika pada awalnya level produk adalah SUB
                            //hapus semua rules sub
                            $sql = 'DELETE FROM ma2003 WHERE PROD_ID="' . $dt1 . '"';
                            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                        }
                    }
                    //jika pada awalnya tipe sub produk = 'dca eq'/'kematian'
                    //hapus semua premi dca eq/kematian sub
                    if ($produk['PROD_TYPE'] == 'dca eq' || $produk['PROD_TYPE'] == 'kematian') {
                        $sql = 'DELETE FROM premi WHERE SUB_PROD_ID="' . $dt1 . '"';
                        mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                    }
                    $mainProd = $maxP = $minP = $kelipatan = 'NULL';
                    if ($dt7 == 1) {
                        //jika tingkat sub produk
                        $dt9 = mysqli_escape_string($conection, purifier($_POST["parent"]));
                        $dt16 = '"'.mysqli_escape_string($conection, purifier($_POST["tipe"])).'"';
                        $perintah = 'SELECT PROD_ID,PROD_CURR FROM ma2001 WHERE PROD_ID ="' . $dt9 . '"';
                        $query = mysqli_query($conection, $perintah);
                        if (mysqli_num_rows($query) == 0) {
                            die(json_encode(array(false, 'pesan' => 'Gagal!, Main Produk sudah tidak ditemukan')));
                        }
                        $mainProdArr = mysqli_fetch_array($query);
                        $mainProd = '"' . $dt9 . '"';
                        $dt5 = '"' . $mainProdArr['PROD_CURR'] . '"';
                        //jika tipe sub prod = 'dca eq', tambahkan premi dca eq
                        if ($dt16 == '"dca eq"') {
                            $dt10 = mysqli_escape_string($conection, purifier($_POST["premi1"]));
                            $dt11 = mysqli_escape_string($conection, purifier($_POST["premi2"]));
                            $dt12 = mysqli_escape_string($conection, purifier($_POST["premi3"]));
                            $dt13 = mysqli_escape_string($conection, purifier($_POST["premi4"]));
                            $dt14 = mysqli_escape_string($conection, purifier($_POST["premi5"]));
                            mysqli_query($conection, ' INSERT INTO premi (SUB_PROD_ID,zona,rate) VALUES ' .
                                ' ("' . $kode_baru . '",1,' . $dt10 . '), ' .
                                ' ("' . $kode_baru . '",2,' . $dt11 . '), ' .
                                ' ("' . $kode_baru . '",3,' . $dt12 . '), ' .
                                ' ("' . $kode_baru . '",4,' . $dt13 . '), ' .
                                ' ("' . $kode_baru . '",5,' . $dt14 . ') '
                            ) ? null : $all_query_ok = false;
                        }else if ($dt16 == '"kematian"') {
                            $valPremiUsia='';
                            $usia1=$usia2=$usiapremi=array();
                            //untuk semua kiriman usiakecil
                            foreach($_POST["usiakecil"] as $index=>$val){
                                if(isset($_POST['usiakecil'][$index]) && isset($_POST['usiabesar'][$index]) && 
                                    isset($_POST['usiapremi'][$index]) && $_POST['usiapremi'][$index]>0 &&
                                    $_POST['usiakecil'][$index]>0 && $_POST['usiabesar'][$index]>0){
                                    
                                    if($_POST['usiakecil'][$index] <= $_POST['usiabesar'][$index]){
                                        $usiakecil = mysqli_escape_string($conection, purifier($_POST['usiakecil'][$index]));
                                        $usiabesar = mysqli_escape_string($conection, purifier($_POST['usiabesar'][$index]));
                                        $usiapremi = mysqli_escape_string($conection, purifier($_POST['usiapremi'][$index]));
                                        $valPremiUsia .= '("' . $kode_baru . '",'.$usiakecil.','.$usiabesar.','.$usiapremi.'),';
                                    }else if($_POST['usiakecil'][$index] > $_POST['usiabesar'][$index]){
                                        $usiakecil = mysqli_escape_string($conection, purifier($_POST['usiakecil'][$index]));
                                        $usiabesar = mysqli_escape_string($conection, purifier($_POST['usiabesar'][$index]));
                                        $usiapremi = mysqli_escape_string($conection, purifier($_POST['usiapremi'][$index]));
                                        $valPremiUsia .= '("' . $kode_baru . '",'.$usiabesar.','.$usiakecil.','.$usiapremi.'),';
                                    }
                                }
                            }
                            if($valPremiUsia != ''){
                                $valPremiUsia = substr($valPremiUsia,0,-1);
                                $sqlPremiUsia = 'INSERT INTO premi (SUB_PROD_ID,usia_awal,usia_akhir,rate) VALUES '.$valPremiUsia;
                                if(!mysqli_query($conection,$sqlPremiUsia)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal menambah Premi Rentang Usia.')));
                                }
                            }else{
                                die(json_encode(array(false, 'pesan' => 'Gagal menambah Premi Rentang Usia..')));
                            }
                        }
                        $dt20 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_out_no"])).'"';
                        $dt21 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_out_bank"])).'"';
                        $dt22 = '"'.mysqli_escape_string($conection, purifier($_POST["claim"])).'"';
                    } else {
                        //jika tingkat main produk
                        if($dt15==1){ //kalau b2c
                            $cek = mysqli_escape_string($conection, purifier($_POST["maxp"]));
                            $cek2 = mysqli_escape_string($conection, purifier($_POST["minp"]));
                            $cek3 = mysqli_escape_string($conection, purifier($_POST["kelipatan"]));
                            if ($cek >= $cek2) {
                                if($cek3 > ($cek - $cek2)){
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Kelipatan Pertanggungan harus lebih kecil dari rentang nilai antara Min dan Max')));
                                }
                                $maxP = '"' . $cek . '"';
                                $minP = '"' . $cek2 . '"';
                                $kelipatan = '"' . $cek3 . '"';
                            } else {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Pertanggungan Mak harus lebih besar atau sama dengan Min')));
                            }
                        }
                        $dt6 = 0;
                        $dt17 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_in_no"])).'"';
                        $dt18 = '"'.mysqli_escape_string($conection, purifier(implode(', ',$_POST["dana_in_nama"]))).'"';
                        $dt19 = '"'.mysqli_escape_string($conection, purifier($_POST["dana_in_bank"])).'"';
                        //ubah semua curr sub prod
                        $perintah = 'UPDATE  ma2001 a JOIN ma2001 b ON a.PROD_ID_PARENT=b.PROD_ID ' .
                            ' SET a.PROD_CURR=b.PROD_CURR, a.PROD_ID_PARENT="'.$kode_baru.'" ' .
                            ' WHERE b.PROD_ID ="' . $dt1 . '"';
                        mysqli_query($conection, $perintah) ? null : $all_query_ok = false;
                    }
                    $sql = ' UPDATE ma2001 SET PROD_ID="' . $kode_baru . '",PROD_NAMA="' . $dt2 . '",PROD_STEP_TSI=' . $kelipatan .
                    ',PROD_LEGAL="' . $dt4 . '",PROD_STATUS="' . $dt8 . '",PROD_LEVEL="' . $dt7 . '",PROD_B2C=' . $dt15 .
                    ',PROD_CURR=' . $dt5 . ',PROD_PREMI="' . $dt6 . '",PROD_AUTOP=1,PROD_TYPE=' . $dt16 . ' ' .
                    ',PROD_ID_PARENT=' . $mainProd . ',PROD_MIN_TSI=' . $minP . ',PROD_MAX_TSI=' . $maxP . ' ' .
                    ',DANA_IN_VA_NO=' . $dt17 . ',DANA_IN_VA_NAMA=' . $dt18 . ',DANA_IN_VA_BANK=' . $dt19 . 
                    ',DANA_OUT_VA_NO=' . $dt20 . ',DANA_OUT_VA_BANK=' . $dt21 . ',CLAIM_TYPE=' . $dt22 .
                    ' WHERE PROD_ID="' . $dt1 . '"';
                    mysqli_query($conection, $sql) ? null : $all_query_ok = false;

                    if ($all_query_ok) {
                        mysqli_commit($conection);
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di ubah')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di ubah')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "produk_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    // stop jika PROD_ID tidak ada dan
                    // memiliki data detail,cabang,nasabah

                    $query = mysqli_query($conection, 'SELECT PROD_ID,PROD_LEVEL,PROD_TYPE FROM ma2001 WHERE PROD_ID="' . $dt1 . '"');
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                    }
                    $produk = mysqli_fetch_array($query);
                    if ($produk['PROD_LEVEL'] == 1) {
                        $perintah = 'SELECT PROD_ID FROM ma2003 WHERE PROD_ID ="' . $dt1 . '"';
                        if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                            die(json_encode(array(false, 'pesan' => 'Gagal!, Produk masih memiliki data rules')));
                        }
                        $perintah = 'SELECT PROD_ID FROM ma2001 WHERE PROD_ID_PARENT ="' . $dt1 . '" ';
                        if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                            die(json_encode(array(false, 'pesan' => 'Gagal!, Produk masih memiliki sub produk', )));
                        }
                    }
                    $perintah = 'SELECT PROD_ID FROM tr0001 WHERE PROD_ID="' . $dt1 . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Produk masih memiliki hubungan dengan data peserta')));
                    }
                    mysqli_autocommit($conection, false);
                    $all_query_ok = true;
                    if ($produk['PROD_LEVEL'] == 'dca eq') {
                        //jika tipe sub produk = dca eq, hapus premi dca eq dan santunan dca eq
                        mysqli_query($conection, 'DELETE FROM dca001 WHERE SUB_PROD_ID="' . $dt1 . '"') ? null : $all_query_ok = false;
                        mysqli_query($conection, 'DELETE FROM premi WHERE SUB_PROD_ID ="' . $dt1 . '"') ? null : $all_query_ok = false;
                    }else if ($produk['PROD_LEVEL'] == 'kematian') {
                        mysqli_query($conection, 'DELETE FROM premi WHERE SUB_PROD_ID ="' . $dt1 . '"') ? null : $all_query_ok = false;
                    }
                    mysqli_query($conection, 'DELETE FROM ma2001 WHERE PROD_ID ="' . $dt1 . '"') ? null : $all_query_ok = false;
                    if ($all_query_ok) {
                        mysqli_commit($conection);
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            
            case "holiday_tanggal_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $tgl = new DateTime($_POST['tgl']);
                    $ket = mysqli_escape_string($conection, purifier($_POST['ket']));

                    $jum = mysqli_num_rows(mysqli_query($conection, 'SELECT TANGGAL FROM libur_sistem_tgl WHERE TANGGAL="' . $tgl->format('Y-m-d') . '"'));
                    if ($jum == 0) {
                        if (mysqli_query($conection, 'INSERT INTO libur_sistem_tgl (TANGGAL,KETERANGAN) VALUES ("' . $tgl->format('Y-m-d') . '","' . $ket . '")')) {
                            die(json_encode(array(true, 'pesan' => 'Berhasil menambah tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal menambah tanggal libur')));
                        }

                    } else {
                        if (mysqli_query($conection, 'UPDATE libur_sistem_tgl SET KETERANGAN="' . $ket . '" WHERE TANGGAL="' . $tgl->format('Y-m-d') . '"')) {
                            die(json_encode(array(true, 'pesan' => 'Berhasil mengubah keterangan tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal mengubah keterangan tanggal libur')));
                        }

                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "holiday_tanggal_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $tgl = new DateTime($_POST['kode']);
                    if (mysqli_query($conection, 'DELETE FROM libur_sistem_tgl WHERE TANGGAL="' . $tgl->format('Y-m-d') . '"')) {
                        die(json_encode(array(true, 'pesan' => 'Berhasil menghapus tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal menghapus tanggal libur')));
                    }

                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "holiday_hari":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    mysqli_autocommit($conection, false);
                    mysqli_query($conection, 'TRUNCATE libur_sistem_hari');
                    if (isset($_POST['hari'])) {
                        foreach ($_POST['hari'] as $key => $v) {
                            if ($key >= 0 && $key <= 6) {
                                if ($key == 0) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("SENIN")';}
                                if ($key == 1) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("SELASA")';}
                                if ($key == 2) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("RABU")';}
                                if ($key == 3) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("KAMIS")';}
                                if ($key == 4) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("JUMAT")';}
                                if ($key == 5) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("SABTU")';}
                                if ($key == 6) {$sql = 'INSERT INTO libur_sistem_hari (HARI) VALUES ("MINGGU")';}
                                mysqli_query($conection, $sql);
                            } else {
                                break;
                            }

                        }
                    }

                    if (mysqli_commit($conection)) {
                        die(json_encode(array(true, 'pesan' => 'Hari Libur Berhasil Disimpan', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                    } else {
                        mysqli_roolback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal menyimpan hari libur')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "holiday_produk_tanggal_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $tgl = new DateTime($_POST['tgl']);
                    $ket = mysqli_escape_string($conection, purifier($_POST['ket']));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $query = mysqli_query($conection, 'SELECT ID_KEY,PROD_ID,ENTITY_ID FROM ma2001 WHERE ID_KEY="' . $dt1 . '"');
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Produk Tidak Ditemukan', 'status' => false)));
                    }
                    $produk = mysqli_fetch_array($query);
                    $jum = mysqli_num_rows(mysqli_query($conection, 'SELECT TANGGAL FROM libur_insurance_prod_tgl  WHERE PROD_ID="' . $produk['PROD_ID'] . '" AND ENTITY_ID="' . $produk['ENTITY_ID'] . '" AND TANGGAL="' . $tgl->format('Y-m-d') . '"'));
                    if ($jum == 0) {
                        if (mysqli_query($conection, 'INSERT INTO libur_insurance_prod_tgl (TANGGAL,KETERANGAN,PROD_ID,ENTITY_ID) VALUES ("' . $tgl->format('Y-m-d') . '","' . $ket . '","' . $produk['PROD_ID'] . '","' . $produk['ENTITY_ID'] . '")')) {
                            die(json_encode(array(true, 'pesan' => 'Berhasil menambah tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal menambah tanggal libur')));
                        }

                    } else {
                        if (mysqli_query($conection, 'UPDATE libur_insurance_prod_tgl SET KETERANGAN="' . $ket . '"  WHERE PROD_ID="' . $produk['PROD_ID'] . '" AND ENTITY_ID="' . $produk['ENTITY_ID'] . '" AND TANGGAL="' . $tgl->format('Y-m-d') . '"')) {
                            die(json_encode(array(true, 'pesan' => 'Berhasil mengubah keterangan tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal mengubah keterangan tanggal libur')));
                        }

                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "holiday_produk_tanggal_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $tgl = new DateTime($_POST['kode']);
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode2"]));
                    $query = mysqli_query($conection, 'SELECT ID_KEY,PROD_ID,ENTITY_ID FROM ma2001 WHERE ID_KEY="' . $dt1 . '"');
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Produk Tidak Ditemukan', 'status' => false)));
                    }
                    $produk = mysqli_fetch_array($query);
                    if (mysqli_query($conection, 'DELETE FROM libur_insurance_prod_tgl WHERE PROD_ID="' . $produk['PROD_ID'] . '" AND ENTITY_ID="' . $produk['ENTITY_ID'] . '" AND TANGGAL="' . $tgl->format('Y-m-d') . '"')) {
                        die(json_encode(array(true, 'pesan' => 'Berhasil menghapus tanggal libur', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal menghapus tanggal libur')));
                    }

                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "holiday_produk_hari":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $query = mysqli_query($conection, 'SELECT ID_KEY,PROD_ID FROM ma2001 WHERE ID_KEY="' . $dt1 . '"');
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Produk Tidak Ditemukan', 'status' => false)));
                    }
                    $produk = mysqli_fetch_array($query);
                    mysqli_autocommit($conection, false);
                    mysqli_query($conection, 'DELETE FROM libur_insurance_prod_hari WHERE PROD_ID="' . $produk['PROD_ID'] . '"');
                    if (isset($_POST['hari'])) {
                        foreach ($_POST['hari'] as $key => $v) {
                            if ($key >= 0 && $key <= 6) {
                                if ($key == 0) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("SENIN","' . $produk['PROD_ID'] . '")';}
                                if ($key == 1) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("SELASA","' . $produk['PROD_ID'] . '")';}
                                if ($key == 2) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("RABU","' . $produk['PROD_ID'] . '")';}
                                if ($key == 3) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("KAMIS","' . $produk['PROD_ID'] . '")';}
                                if ($key == 4) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("JUMAT","' . $produk['PROD_ID'] . '")';}
                                if ($key == 5) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("SABTU","' . $produk['PROD_ID'] . '")';}
                                if ($key == 6) {$sql = 'INSERT INTO libur_insurance_prod_hari (HARI,PROD_ID) VALUES ("MINGGU","' . $produk['PROD_ID'] . '")';}
                                mysqli_query($conection, $sql);
                            } else {
                                break;
                            }

                        }
                    }

                    if (mysqli_commit($conection)) {
                        die(json_encode(array(true, 'pesan' => 'Hari Libur Berhasil Disimpan', 'tk' => (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'])));
                    } else {
                        mysqli_roolback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal menyimpan hari libur')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            
            case "my_profile_ganti_pass":
                //cek token crsf
                if (!empty($_POST['token'])) {
                    if (hash_equals($_SESSION['token'], $_POST['token'])) {
                        $dt1 = mysqli_escape_string($conection, purifier($_POST["pw"]));
                        $dt2 = mysqli_escape_string($conection, purifier($_POST["pw2"]));
                        //stop jika ENTITY_ID belum ada
                        if ($dt1 != $dt2) {
                            die(json_encode(array(false, 'pesan' => 'Gagal!, New Password dan Confirm Password tidak sama')));
                        }
                        $perintah = ' UPDATE ma1001 SET `PASSWORD`="' . $dt1 . '" WHERE ENTITY_EMAIL="' . $_SESSION['user_email'] . '"';
                        if (mysqli_query($conection, $perintah)) {
                            die(json_encode(array(true, 'pesan' => 'Password berhasil di ubah')));
                            unset($_SESSION['token']);
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Password gagal di ubah')));
                        }
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                        // Log this as a warning and keep an eye on these attempts
                    }
                }
                break;
            case "my_profile_ubah":
                //cek token crsf
                if (!empty($_POST['token'])) {
                    if (hash_equals($_SESSION['token'], $_POST['token'])) {
                        $dt6 = mysqli_escape_string($conection, purifier($_POST["email"]));
                        $dt2 = mysqli_escape_string($conection, purifier($_POST["name"]));
                        $dt3 = mysqli_escape_string($conection, purifier($_POST["alamat"]));
                        $dt4 = mysqli_escape_string($conection, purifier($_POST["pic"]));
                        $dt5 = mysqli_escape_string($conection, purifier($_POST["telp"]));
                        $dt7 = mysqli_escape_string($conection, purifier($_POST["npwp"]));
                        $dt8 = mysqli_escape_string($conection, purifier($_POST["mou"]));

                        $perintah = ' UPDATE ma1001 SET `ENTITY_NAMA`="' . $dt2 . '",`ENTITY_ALAMAT`="' . $dt3 . '"' .
                            ',`ENTITY_PIC`="' . $dt4 . '",`ENTITY_PIC_PHONE`="' . $dt5 . '",`ENTITY_EMAIL`="' . $dt6 . '"' .
                            ',`ENTITY_MOU`="' . $dt8 . '",`ENTITY_NPWP`="' . $dt7 . '" WHERE ENTITY_ID="' . $_SESSION['user_id'] . '"';
                        $_SESSION['user_email'] = $dt6;
                        if (mysqli_query($conection, $perintah)) {
                            die(json_encode(array(true, 'pesan' => 'Berhasil di ubah')));
                            unset($_SESSION['token']);
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal di ubah')));
                        }
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                        // Log this as a warning and keep an eye on these attempts
                    }
                }
                break;

            case "peserta_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["produk"]));
                    switch($dt1){
                        case "PR002":
                            $dt2 = mysqli_escape_string($conection, purifier($_POST["ktp"]));
                            $dt3 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                            $dt4 = mysqli_escape_string($conection, purifier($_POST["lahir"]));
                            $dt5 = mysqli_escape_string($conection, purifier($_POST["alamat"]));
                            $dt6 = mysqli_escape_string($conection, purifier($_POST["usaha"]));
                            $dt7 = mysqli_escape_string($conection, purifier($_POST["cabang"]));
                            $dt8 = mysqli_escape_string($conection, str_replace(',', '', purifier($_POST["plafond"])));
                            $dt9 = mysqli_escape_string($conection, purifier($_POST["pencairan"]));
                            $dt10 = mysqli_escape_string($conection, purifier($_POST["tanggal_pencairan"]));
                            $dt11 = mysqli_escape_string($conection, purifier($_POST["minggu"]));
                            $dt12 = mysqli_escape_string($conection, purifier($_POST["awal_periode"]));
                            $dt13 = mysqli_escape_string($conection, purifier($_POST["akhir_periode"]));
                            $dt14 = mysqli_escape_string($conection, str_replace(',', '', purifier($_POST["uk"])));
    
                            //stop jika entity sektor usaha tidak ada
                            $perintah = 'SELECT ENTITY_ID FROM ma9002 WHERE SUSA_ID ="' . $dt6 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="' . $dt1 . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Sektor Usaha tidak ditemukan')));
                            }
                            
                            //stop jika kode cabang tidak ada,
                            $perintah = ' SELECT ID_KEY,LOKASI_KELURAHAN,lat,lng,BANK_REKENING,NO_REKENING,NAMA_REKENING FROM ma1003 WHERE LOKASI_ID="'.$dt7.'"'.
                                ' AND LOKASI_STATUS=0 AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" '.
                                ' AND PROD_ID="' . $dt1 . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Lokasi / Cabang tidak ditemukan')));
                            }
                            $cabang = mysqli_fetch_array($query);
                            //jika yg input adalah cabang
                            if( ! empty($_SESSION['user_cabang_key'])){
                                //jika cabang tidak sesuai
                                if( $cabang['ID_KEY'] != $_SESSION['user_cabang_key']){
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Lokasi / Cabang tidak sesuai dengan cabang anda')));
                                }
                            }
                            $koorObj = array('lat'=>$cabang['lat'],'lng'=>$cabang['lng']);
                            //jika tgl awal dan tgl akhir
                            try{
                                $awal = date_create($dt12);
                                $akhir = date_create($dt13);
                                $diff = date_diff($awal, $akhir, false);
                                if ($diff->invert == 1) {
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Jangka Waktu Salah')));
                                }
                            }catch(Exception $x){
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Jangka Waktu Salah-')));
                            }
                            //ambil semua sub produk, stop jika tidak ada produk
                            $perintah = 'SELECT a.PROD_ID,b.PROD_PREMI,a.PROD_CURR,a.PROD_AUTOP,b.PROD_ID SUB_PROD_ID ' .
                                ',b.PROD_TYPE,b.CLAIM_TYPE ' .
                                ' FROM ma2001 a ' .
                                ' JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                                ' WHERE a.PROD_ID ="' . $dt1 . '" AND (a.PROD_LEVEL = 0 OR b.PROD_LEVEL = 1)';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                            }
                            $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
                            //start transaksi
                            mysqli_autocommit($conection, false);
                            $all_query_ok = true;
                            //insert transaksi
                            $TRX_CURR = $produk[0]['PROD_CURR'];
                            //$TRX_CURR_RATE_IDR
                            switch($produk[0]['PROD_CURR']){
                                case 'BRU':
                                    $TRX_CURR_RATE_IDR = $_SESSION['bru_to_idr'];
                                break;
                                case 'IDR':
                                default :
                                    $TRX_CURR_RATE_IDR = 1;
                            }
                            $datetime = new DateTime();
                            $datetime1d = $datetime->modify('+1 day');

                            $transUUID = generateUUID();
                            
                            $premiTotalSub = 0;
                            $valPembagianPremi = '';
                            foreach ($produk as $sub) {
                                if ($sub['PROD_TYPE'] == 'dca eq') {
                                    $sql = 'SELECT rate,zona FROM premi b' .
                                        ' JOIN daerah3 a ON a.zonasi=b.zona' .
                                        ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '" ' .
                                        ' AND a.kode_wilayah_bps LIKE "' . $cabang['LOKASI_KELURAHAN'] . '"';
                                    $query = mysqli_query($conection, $sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        $rate = mysqli_fetch_array($query)['rate'];
                                        //premi = plafond * (premi sub produk/100) * (rate zona/100)
                                        $premi = $dt8 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                                    } else {
                                        die(json_encode(array(false, 'pesan' => 'Gagal Menambah, Cabang yg dipilih belum memiliki rate zona gempa atau Produk gempa belum memiliki rate zona, Silakan Hubungi Admin Biru')));
                                    }
                                } else if ($sub['PROD_TYPE'] == 'kematian') {
                                    try{
                                        $awal = date_create();
                                        $akhir = date_create($dt4); //lahir
                                        $diff = date_diff($awal, $akhir, true);
                                    }catch(Exception $x){
                                        die(json_encode(array(false, 'pesan' => 'Gagal!, Tanggal lahir salah-')));
                                    }
                                    $sql = 'SELECT usia_awal,usia_akhir,rate FROM premi b'.
                                        ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '" AND '.
                                        ($diff->format("%a")/365) . ' BETWEEN usia_awal AND usia_akhir';
                                    $query = mysqli_query($conection, $sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        $rate = mysqli_fetch_array($query)['rate'];
                                        //premi = plafond * (premi sub produk/100) * (rate usia/100)
                                        $premi = $dt8 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                                    } else {
                                        die(json_encode(array(false, 'pesan' => 'Rentang usia ('.($diff->format("%a")/365).' tahun) belum di atur untuk sub produk asuransi kematian')));
                                    }
                                } else {
                                    $premi = $dt8 * ($sub['PROD_PREMI'] / 100);
                                }
                                $SUB_PROD_ID = $sub['SUB_PROD_ID'];
                                $CLAIM_TYPE  = $sub['CLAIM_TYPE'];
                                $SUB_PREMI = sprintf($produk[0]['PROD_CURR']=='BRU'?'%.6F':'%.2F', $premi);
                                
                                $TRX_DETAIL_SYSTEM_ID = generateUUID();
                                
                                //insert detail trans
                                if($sub['PROD_TYPE'] == 'dca eq'){
                                    $strDetailTrans = '("'.$TRX_DETAIL_SYSTEM_ID.'",'.$koorObj['lat'].','.$koorObj['lng'].',"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.')';
                                    $sqlDetailTrans = 'INSERT INTO tr0002_b2c (TRX_DETAIL_SYSTEM_ID,KOOR_LAT,KOOR_LANG,TRX_PARENT,TRX_SYSTEM_ID,SUB_PROD_ID,SUB_PREMI,TRX_CURR,TRX_CURR_RATE_IDR,CLAIM_TYPE) VALUES '.$strDetailTrans;
                                }else{
                                    $strDetailTrans = '("'.$TRX_DETAIL_SYSTEM_ID.'",NULL,NULL,"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.')';
                                    $sqlDetailTrans = 'INSERT INTO tr0002_b2c (TRX_DETAIL_SYSTEM_ID,KOOR_LAT,KOOR_LANG,TRX_PARENT,TRX_SYSTEM_ID,SUB_PROD_ID,SUB_PREMI,TRX_CURR,TRX_CURR_RATE_IDR,CLAIM_TYPE) VALUES '.$strDetailTrans;
                                }
                                mysqli_query($conection, $sqlDetailTrans) ? null : $all_query_ok = false;
                                
                                //pembagian premi, tidak berhubugnan dengan trans
                                //ambil rules sub produk untuk pembagian premi
                                {
                                    $SHA_SYSTEM_ID = array();
                                    $data = array('KOMISI'=>array(),'KOMISI2'=>array(),'KOMISI_DITERIMA'=>array(),'RESIKO'=>array());
                                    $sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK'.
                                    ',a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS'.
                                    ',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX,b.KOMISI_WITH '.
                                    ' FROM ma2003 a '.
                                    ' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
                                    ' WHERE (a.PROD_ID="' .  $SUB_PROD_ID  . '") AND a.SHA_STATUS = 0'.
                                    ' GROUP By a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
                                    $query = mysqli_query($conection, $sql);
                                    while($row = mysqli_fetch_array($query)){
                                        //jika id baru dan gabung group level
                                        if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID)){
                                            $SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
                                            $data['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
                                            $data['KOMISI_DITERIMA'][$row['SHA_ENTITY']] = 0;
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
                                        }
                                    }
                                    //pembagian selalu dalam IDR
                                    $SUB_PREMI_ASLI = $premi * $TRX_CURR_RATE_IDR;
                                    //proses pembagian premi untuk semua system_id, return $data[RESIKO] & $data[KOMISI_DITERIMA]
                                    foreach($SHA_SYSTEM_ID as $system_id=>$entity_id){
                                        //ubah persen resiko menjadi nilai resiko berdasarkan (premi * persen resiko)
                                        $data['RESIKO'][$entity_id] = $SUB_PREMI_ASLI * $data['RESIKO'][$entity_id] / 100;
                                        //mendapat komisi
                                        if(isset($data['KOMISI'][$system_id])){
                                            foreach($data['KOMISI'][$system_id] as $index => $objMendapat){
                                                $komisi = ($SUB_PREMI_ASLI * $objMendapat['KOMISI_NUM'] / 100) / 1.1;
                                                $ppn = $pph23 = 0;
                                                if ($objMendapat['KOMISI_TAX'] == 'y') {
                                                    //$ppn = $komisi * 10 /100
                                                    // $ppn = $objMendapat['KOMISI_NUM'] * 10 / 100;
                                                    $ppn = $komisi * 10 / 100;
                                                }
                                                if ($objMendapat['KOMISI_WITH'] == 'y') {
                                                    //ppn = $komisi * 2 /100
                                                    // $pph23 = $objMendapat['KOMISI_NUM'] * 2 / 100;
                                                    $pph23 = $komisi * 2 / 100;
                                                }
                                                // $data['KOMISI_DITERIMA'][$entity_id] += $objMendapat['KOMISI_NUM'] + $ppn - $pph23;
                                                $data['KOMISI_DITERIMA'][$entity_id] += $komisi + $ppn - $pph23;
                                            }
                                        }
                                        //memberi komisi
                                        if(isset($data['KOMISI2'][$system_id])){
                                            foreach($data['KOMISI2'][$system_id] as $index => $objMemberi){
                                                $komisi = ($SUB_PREMI_ASLI * $objMemberi['KOMISI_NUM'] / 100) / 1.1;
                                                $ppn = $pph23 = 0;
                                                if ($objMemberi['KOMISI_TAX'] == 'y') {
                                                    //$ppn = $komisi * 10 /100
                                                    // $ppn = $objMemberi['KOMISI_NUM'] * 10 / 100;
                                                    $ppn = $komisi * 10 / 100;
                                                }
                                                if ($objMemberi['KOMISI_WITH'] == 'y') {
                                                    //$ppn = $komisi * 2 /100
                                                    // $pph23 = $objMemberi['KOMISI_NUM'] * 2 / 100;
                                                    $pph23 = $komisi * 2 / 100;
                                                }
                                                // $data['KOMISI_DITERIMA'][$entity_id] -= $objMemberi['KOMISI_NUM'] + $ppn - $pph23;
                                                $data['KOMISI_DITERIMA'][$entity_id] -= $komisi + $ppn - $pph23;
                                            }
                                        }
                                    }
                                    //proses pembuatan query pembagian premi
                                    foreach($SHA_SYSTEM_ID as $system_id=>$entity_id){
                                        $valPembagianPremi .= '(NULL,"'.$TRX_DETAIL_SYSTEM_ID.'","'.$entity_id.'",'. ($data['RESIKO'][$entity_id] + $data['KOMISI_DITERIMA'][$entity_id]) . '),';
                                    }
                                }

                                $premiTotalSub += $premi;
                            }
                            //jika mata uang BRU, BRU = Gold, konversi pembagian ke IDR
                            switch($produk[0]['PROD_CURR']){
                                case 'BRU':
                                    $premiTotalSub = sprintf('%.6F',$premiTotalSub);
                                break;
                                case 'IDR':
                                    default :
                                    $premiTotalSub = sprintf('%.2F',$premiTotalSub);
                            }
                            //Jika Nilai UK =< Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='2'
                            //Jika Nilai UK > Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='1'
                            //Jika PROD_AUTOP = 1, maka TRX_STATUS='0'
                            if ($produk[0]['PROD_AUTOP'] == 1) {
                                $status = 0;
                            } else {
                                $status = 0;
                            }
    
                            $created_by = $_SESSION['user_cli_system_id'];
    
                            $perintah = ' INSERT INTO tr0001 ' .
                                '(TRX_UUID,ENTITY_ID,PROD_ID,TRX_KTP_ID,TRX_NAMA,TRX_TGL_LAHIR,TRX_ALAMAT ' .
                                ',SUSA_ID,CABANG_ID,CURR_ID,TRX_PLAFOND,TRX_PENCAIRAN' .
                                ',TRX_TGL_CAIR,TRX_JML_MINGG,TRX_START_PRO,TRX_END_PRO,TRX_NILAI_UK ' .
                                ',TRX_PREMI,CREATED_ON,CREATED_BY,TRX_CURR_RATE,TRX_NMFILE ' .
                                ',TRX_STATUS,BANK_REKENING,NO_REKENING,NAMA_REKENING) ' .
                                'VALUES ("' . $transUUID . '","' . $_SESSION['user_cli_group'] . '","' . $dt1 . '","' . $dt2 . '","' . $dt3 . '","' . $dt4 . '","' . $dt5 . '"' .
                                ',"' . $dt6 . '","' . $dt7 . '","' . $TRX_CURR . '","' . $dt8 . '","' . $dt9 . '"' .
                                ',"' . $dt10 . '","' . $dt11 . '","' . $dt12 . '","' . $dt13 . '","' . $dt14 . '"' .
                                ',"' . $premiTotalSub . '",NULL,"' . $created_by . '",'.$TRX_CURR_RATE_IDR.',""' .
                                ',"' . $status . '","'.$cabang['BANK_REKENING'].'","'.$cabang['NO_REKENING'].'","'.$cabang['NAMA_REKENING'].'")';
                            if (mysqli_query($conection, $perintah)) {
                                //insert pembagian premi
                                $valPembagianPremi = substr($valPembagianPremi,0,-1);    
                                $sqlPembagianPremi = 'INSERT INTO tr0003_b2c (PEMBAGIAN_SYSTEM_ID,TRX_DETAIL_SYSTEM_ID,ENTITY_ID,`NILAI`) VALUES ' . $valPembagianPremi;
                                mysqli_query($conection, $sqlPembagianPremi) ? null : $all_query_ok = false;
                                
                                if ($all_query_ok) {
                                    mysqli_commit($conection);
                                    //kalau true sesi dihapus
                                    unset($_SESSION['token']);
                                    die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                                } else {
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan-')));
                                }
                            } else {
                                $all_query_ok = false;
                                die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan--')));
                            }
                            break;
                        case "PR123":
                            break;
                        default: 
                            die(json_encode(array(false, 'pesan' => 'Produk tidak ditemukan-')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "peserta_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["produk"]));
                    //belum selesai, belum ada pengecekan untuk si pengubah, apakah harus user yg upload atau bisa user dalam satu cabang yg sama
                    switch($dt1){
                        case "PR002":
                            $dt0 = mysqli_escape_string($conection, purifier($_POST["id"]));
                            //curr_id, premi produk, entity produk, prod_id
                            $dt2 = mysqli_escape_string($conection, purifier($_POST["ktp"]));
                            $dt15 = mysqli_escape_string($conection, purifier($_POST["ktp2"]));
                            $dt3 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                            $dt4 = mysqli_escape_string($conection, purifier($_POST["lahir"]));
                            $dt5 = mysqli_escape_string($conection, purifier($_POST["alamat"]));
                            $dt6 = mysqli_escape_string($conection, purifier($_POST["usaha"]));
                            $dt7 = mysqli_escape_string($conection, purifier($_POST["cabang"]));
                            //mata uang
                            $dt8 = mysqli_escape_string($conection, str_replace(',', '', purifier($_POST["plafond"])));
                            $dt9 = mysqli_escape_string($conection, purifier($_POST["pencairan"]));
                            $dt10 = mysqli_escape_string($conection, purifier($_POST["tanggal_pencairan"]));
                            $dt11 = mysqli_escape_string($conection, purifier($_POST["minggu"]));
                            $dt12 = mysqli_escape_string($conection, purifier($_POST["awal_periode"]));
                            $dt13 = mysqli_escape_string($conection, purifier($_POST["akhir_periode"]));
                            $dt14 = mysqli_escape_string($conection, str_replace(',', '', purifier($_POST["uk"])));
                            //cari curr rate, hitung status, if namafile
    
                            //stop jika trx tidak ada,
                            $perintah = 'SELECT ID_KEY,TRX_PREMI,TRX_UUID FROM tr0001 WHERE ID_KEY ="' . $dt0 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Data Peserta tidak ditemukan')));
                            }
                            $dataLama = mysqli_fetch_array($query);
                            //stop jika kode cabang tidak ada,
                            $perintah = ' SELECT LOKASI_KELURAHAN,lat,lng,BANK_REKENING,NO_REKENING,NAMA_REKENING FROM ma1003 WHERE LOKASI_ID="'.$dt7.'"'.
                                ' AND LOKASI_STATUS=0 AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Lokasi / Cabang tidak ditemukan')));
                            }
                            $cabang = mysqli_fetch_array($query);
                            $koorObj = array('lat'=>$cabang['lat'],'lng'=>$cabang['lng']);
                            //jika entity sektor usaha tidak sama dengan entity produk
                            $perintah = 'SELECT ENTITY_ID FROM ma9002 WHERE SUSA_ID ="' . $dt6 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Sektor Usaha tidak ditemukan')));
                            }
                            //jika tgl awal dan tgl akhir
                            try{
                                $awal = date_create($dt12);
                                $akhir = date_create($dt13);
                                $diff = date_diff($awal, $akhir, false);
                                if ($diff->invert == 1) {
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Jangka Waktu Salah')));
                                }
                            }catch(Exception $x){
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Jangka Waktu Salah-')));
                            }
                            //ambil semua sub produk, stop jika tidak ada produk
                            $perintah = 'SELECT a.PROD_ID,b.PROD_PREMI,a.PROD_CURR,a.PROD_AUTOP,b.PROD_ID SUB_PROD_ID ' .
                                ',b.PROD_TYPE,b.CLAIM_TYPE ' .
                                ' FROM ma2001 a ' .
                                ' JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                                ' WHERE a.PROD_ID ="' . $dt1 . '" AND (a.PROD_LEVEL = 0 OR b.PROD_LEVEL = 1)';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                            }
                            $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
                            require '../vendor/autoload.php';
                            //start transaksi
                            mysqli_autocommit($conection, false);
                            $all_query_ok = true;
                            //insert transaksi
                            $TRX_CURR = $produk[0]['PROD_CURR'];
                            //$TRX_CURR_RATE_IDR
                            switch($produk[0]['PROD_CURR']){
                                case 'BRU':
                                    $TRX_CURR_RATE_IDR = $_SESSION['bru_to_idr'];
                                break;
                                case 'IDR':
                                default :
                                    $TRX_CURR_RATE_IDR = 1;
                            }
                            $datetime = new DateTime();
                            $datetime1d = $datetime->modify('+1 day');

                            $transUUID = $dataLama['TRX_UUID'];

                            $premiTotalSub = 0;
                            $valPembagianPremi = '';
                            //tr0003_b2c delete detail & pembagian premi (reference) 
                            mysqli_query($conection, 'DELETE FROM tr0002_b2c WHERE TRX_PARENT="tr0001" AND TRX_SYSTEM_ID="' . $transUUID . '"') ? null : $all_query_ok = false;
                            foreach ($produk as $sub) {
                                if ($sub['PROD_TYPE'] == 'dca eq') {
                                    $sql = 'SELECT rate,zona FROM premi b' .
                                        ' JOIN daerah3 a ON a.zonasi=b.zona' .
                                        ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '" ' .
                                        ' AND a.kode_wilayah_bps LIKE "' . $cabang['LOKASI_KELURAHAN'] . '"';
                                    $query = mysqli_query($conection, $sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        $rate = mysqli_fetch_array($query)['rate'];
                                        //premi = plafond * (premi sub produk/100) * (rate zona/100)
                                        $premi = $dt8 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                                    } else {
                                        die(json_encode(array(false, 'pesan' => 'Gagal Menambah, Cabang yg dipilih belum memiliki rate zona gempa atau Produk gempa belum memiliki rate zona, Silakan Hubungi Admin Biru')));
                                    }
                                } else if ($sub['PROD_TYPE'] == 'kematian') {
                                    try{
                                        $awal = date_create();
                                        $akhir = date_create($dt4); //lahir
                                        $diff = date_diff($awal, $akhir, true);
                                    }catch(Exception $x){
                                        die(json_encode(array(false, 'pesan' => 'Gagal!, Tanggal lahir salah-')));
                                    }
                                    $sql = 'SELECT usia_awal,usia_akhir,rate FROM premi b'.
                                        ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '" AND '.
                                        ($diff->format("%a")/365) . ' BETWEEN usia_awal AND usia_akhir';
                                    $query = mysqli_query($conection, $sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        $rate = mysqli_fetch_array($query)['rate'];
                                        //premi = plafond * (premi sub produk/100) * (rate usia/100)
                                        $premi = $dt8 * ($sub['PROD_PREMI'] / 100) * ($rate / 100);
                                    } else {
                                        die(json_encode(array(false, 'pesan' => 'Rentang usia ('.($diff->format("%a")/365).' tahun) belum di atur untuk sub produk asuransi kematian')));
                                    }
                                } else {
                                    $premi = $dt8 * ($sub['PROD_PREMI'] / 100);
                                }
                                $SUB_PROD_ID = $sub['SUB_PROD_ID'];
                                $CLAIM_TYPE  = $sub['CLAIM_TYPE'];
                                $SUB_PREMI = sprintf($produk[0]['PROD_CURR']=='BRU'?'%.6F':'%.2F', $premi);
                                
                                $TRX_DETAIL_SYSTEM_ID = generateUUID();

                                //insert detail trans
                                if($sub['PROD_TYPE'] == 'dca eq'){
                                    $strDetailTrans = '("'.$TRX_DETAIL_SYSTEM_ID.'",'.$koorObj['lat'].','.$koorObj['lng'].',"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.')';
                                    $sqlDetailTrans = 'INSERT INTO tr0002_b2c (TRX_DETAIL_SYSTEM_ID,KOOR_LAT,KOOR_LANG,TRX_PARENT,TRX_SYSTEM_ID,SUB_PROD_ID,SUB_PREMI,TRX_CURR,TRX_CURR_RATE_IDR,CLAIM_TYPE) VALUES '.$strDetailTrans;
                                }else{
                                    $strDetailTrans = '("'.$TRX_DETAIL_SYSTEM_ID.'",NULL,NULL,"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.')';
                                    $sqlDetailTrans = 'INSERT INTO tr0002_b2c (TRX_DETAIL_SYSTEM_ID,KOOR_LAT,KOOR_LANG,TRX_PARENT,TRX_SYSTEM_ID,SUB_PROD_ID,SUB_PREMI,TRX_CURR,TRX_CURR_RATE_IDR,CLAIM_TYPE) VALUES '.$strDetailTrans;
                                }
                                mysqli_query($conection, $sqlDetailTrans) ? null : $all_query_ok = false;
                                //pembagian premi, tidak berhubugnan dengan trans
                                //ambil rules sub produk untuk pembagian premi
                                {
                                    $SHA_SYSTEM_ID = array();
                                    $data = array('KOMISI'=>array(),'KOMISI2'=>array(),'KOMISI_DITERIMA'=>array(),'RESIKO'=>array());
                                    $sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK'.
                                    ',a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS'.
                                    ',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX,b.KOMISI_WITH '.
                                    ' FROM ma2003 a '.
                                    ' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
                                    ' WHERE (a.PROD_ID="' .  $SUB_PROD_ID  . '") AND a.SHA_STATUS = 0'.
                                    ' GROUP By a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
                                    $query = mysqli_query($conection, $sql);
                                    while($row = mysqli_fetch_array($query)){
                                        //jika id baru dan gabung group level
                                        if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID)){
                                            $SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
                                            $data['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
                                            $data['KOMISI_DITERIMA'][$row['SHA_ENTITY']] = 0;
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
                                        }
                                    }
                                    //pembagian selalu dalam IDR
                                    $SUB_PREMI_ASLI = $premi * $TRX_CURR_RATE_IDR;
                                    //proses pembagian premi untuk semua system_id, return $data[RESIKO] & $data[KOMISI_DITERIMA]
                                    foreach($SHA_SYSTEM_ID as $system_id=>$entity_id){
                                        //ubah persen resiko menjadi nilai resiko berdasarkan (premi * persen resiko)
                                        $data['RESIKO'][$entity_id] = $SUB_PREMI_ASLI * $data['RESIKO'][$entity_id] / 100;
                                        //mendapat komisi
                                        if(isset($data['KOMISI'][$system_id])){
                                            foreach($data['KOMISI'][$system_id] as $index => $objMendapat){
                                                $komisi = ($SUB_PREMI_ASLI * $objMendapat['KOMISI_NUM'] / 100) / 1.1;
                                                $ppn = $pph23 = 0;
                                                if ($objMendapat['KOMISI_TAX'] == 'y') {
                                                    //$ppn = $komisi * 10 /100
                                                    // $ppn = $objMendapat['KOMISI_NUM'] * 10 / 100;
                                                    $ppn = $komisi * 10 / 100;
                                                }
                                                if ($objMendapat['KOMISI_WITH'] == 'y') {
                                                    //ppn = $komisi * 2 /100
                                                    // $pph23 = $objMendapat['KOMISI_NUM'] * 2 / 100;
                                                    $pph23 = $komisi * 2 / 100;
                                                }
                                                // $data['KOMISI_DITERIMA'][$entity_id] += $objMendapat['KOMISI_NUM'] + $ppn - $pph23;
                                                $data['KOMISI_DITERIMA'][$entity_id] += $komisi + $ppn - $pph23;
                                            }
                                        }
                                        //memberi komisi
                                        if(isset($data['KOMISI2'][$system_id])){
                                            foreach($data['KOMISI2'][$system_id] as $index => $objMemberi){
                                                $komisi = ($SUB_PREMI_ASLI * $objMemberi['KOMISI_NUM'] / 100) / 1.1;
                                                $ppn = $pph23 = 0;
                                                if ($objMemberi['KOMISI_TAX'] == 'y') {
                                                    //$ppn = $komisi * 10 /100
                                                    // $ppn = $objMemberi['KOMISI_NUM'] * 10 / 100;
                                                    $ppn = $komisi * 10 / 100;
                                                }
                                                if ($objMemberi['KOMISI_WITH'] == 'y') {
                                                    //$ppn = $komisi * 2 /100
                                                    // $pph23 = $objMemberi['KOMISI_NUM'] * 2 / 100;
                                                    $pph23 = $komisi * 2 / 100;
                                                }
                                                // $data['KOMISI_DITERIMA'][$entity_id] -= $objMemberi['KOMISI_NUM'] + $ppn - $pph23;
                                                $data['KOMISI_DITERIMA'][$entity_id] -= $komisi + $ppn - $pph23;
                                            }
                                        }
                                    }
                                    //proses pembuatan query pembagian premi
                                    foreach($SHA_SYSTEM_ID as $system_id=>$entity_id){
                                        $valPembagianPremi .= '(NULL,"'.$TRX_DETAIL_SYSTEM_ID.'","'.$entity_id.'",'. ($data['RESIKO'][$entity_id] + $data['KOMISI_DITERIMA'][$entity_id]) . '),';
                                    }
                                }

                                $premiTotalSub += $premi;
                            }
                                
                            //jika mata uang BRU, BRU = Gold, konversi pembagian ke IDR
                            switch($produk[0]['PROD_CURR']){
                                case 'BRU':
                                    $premiTotalSub = sprintf('%.6F',$premiTotalSub);
                                break;
                                case 'IDR':
                                    default :
                                    $premiTotalSub = sprintf('%.2F',$premiTotalSub);
                            }
                            //Jika Nilai UK =< Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='2'
                            //Jika Nilai UK > Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='1'
                            //Jika PROD_AUTOP = 1, maka TRX_STATUS='0'
                            if ($produk[0]['PROD_AUTOP'] == 1) {
                                $status = 0;
                            } else {
                                $status = 0;
                            }
    
                            $created_by = $_SESSION['user_cli_system_id'];
    
                            $perintah = ' UPDATE tr0001 SET ' .
                                'ENTITY_ID="' . $_SESSION['user_cli_group'] . '",PROD_ID="' . $dt1 . '",TRX_KTP_ID="' . $dt2 . '"' .
                                ',TRX_NAMA="' . $dt3 . '",TRX_TGL_LAHIR="' . $dt4 . '",TRX_ALAMAT="' . $dt5 . '" ' .
                                ',SUSA_ID="' . $dt6 . '",CABANG_ID="' . $dt7 . '",CURR_ID="' . $TRX_CURR . '"' .
                                ',TRX_PLAFOND="' . $dt8 . '",TRX_PENCAIRAN="' . $dt9 . '",TRX_TGL_CAIR="' . $dt10 . '"' .
                                ',TRX_JML_MINGG="' . $dt11 . '",TRX_START_PRO="' . $dt12 . '",TRX_END_PRO="' . $dt13 . '"' .
                                ',TRX_NILAI_UK="' . $dt14 . '",TRX_PREMI="' . $premiTotalSub . '",CREATED_ON=NULL' .
                                ',BANK_REKENING="'.$cabang['BANK_REKENING'].'",NO_REKENING="'.$cabang['NO_REKENING'].'",NAMA_REKENING="'.$cabang['NAMA_REKENING'].'"' .
                                ',CREATED_BY="' . $created_by . '",TRX_CURR_RATE=0,TRX_STATUS="' . $status . '" WHERE ID_KEY=' . $dt0;
                            if (mysqli_query($conection, $perintah)) {
                                //insert pembagian premi
                                $valPembagianPremi = substr($valPembagianPremi,0,-1);    
                                $sqlPembagianPremi = 'INSERT INTO tr0003_b2c (PEMBAGIAN_SYSTEM_ID,TRX_DETAIL_SYSTEM_ID,ENTITY_ID,`NILAI`) VALUES ' . $valPembagianPremi;
                                mysqli_query($conection, $sqlPembagianPremi) ? null : $all_query_ok = false;
                                
                                if ($all_query_ok) {
                                    mysqli_commit($conection);
                                    //kalau true sesi dihapus
                                    unset($_SESSION['token']);
                                    die(json_encode(array(true, 'pesan' => 'Berhasil di Ubah')));
                                } else {
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal di Ubah-')));
                                }
                            } else {
                                die(json_encode(array(false, 'pesan' => 'Gagal di Ubah')));
                            }
                            break;
                        case "PR123":
                            break;
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "peserta_unggah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    //load vendor
                    require '../vendor/autoload.php';
                    if (isset($_FILES['fileSpreadsheet']) && isset($_POST['produk'])) {
                        $dt1 = mysqli_escape_string($conection, purifier($_POST["produk"]));
                        switch($dt1){
                            case "PR002":
                                //ambil semua sub produk, stop jika tidak ada produk
                                $perintah = 'SELECT a.PROD_ID,b.PROD_PREMI,a.PROD_CURR,a.PROD_AUTOP,b.PROD_ID SUB_PROD_ID ' .
                                    ',b.PROD_TYPE,b.CLAIM_TYPE ' .
                                    ' FROM ma2001 a ' .
                                    ' JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                                    ' WHERE a.PROD_ID ="' . $dt1 . '" AND (a.PROD_LEVEL = 0 OR b.PROD_LEVEL = 1)';
                                $query = mysqli_query($conection, $perintah);
                                if (mysqli_num_rows($query) == 0) {
                                    die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                                }
                                $produk = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                //curr
                                $TRX_CURR = $produk[0]['PROD_CURR'];
                                //$TRX_CURR_RATE_IDR
                                switch($produk[0]['PROD_CURR']){
                                    case 'BRU':
                                        $TRX_CURR_RATE_IDR = $_SESSION['bru_to_idr'];
                                    break;
                                    case 'IDR':
                                    default :
                                        $TRX_CURR_RATE_IDR = 1;
                                }
                                //ambil semua cabang
                                $perintah = ' SELECT ID_KEY,LOKASI_KELURAHAN,LOKASI_ID,LOKASI_NAMA,zonasi,nama,a.lat,a.lng,a.BANK_REKENING,a.NO_REKENING,a.NAMA_REKENING FROM ma1003 a '.
                                    ' JOIN daerah3 ON LOKASI_KELURAHAN=kode_wilayah_bps ' .
                                    ' WHERE LOKASI_STATUS=0 AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="' . $dt1 . '"';
                                $query = mysqli_query($conection, $perintah);
                                $cabang = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $cabang_nama = array_map(function ($row) {return strtoupper($row['LOKASI_NAMA']);}, $cabang);
                                //jika dca eq/kematian ambil premi rate
                                $subProduk = $rateGempa = $rateKematian = array();
                                foreach ($produk as $sub) {
                                    if ($sub['PROD_TYPE'] == 'dca eq') {
                                        $sql = 'SELECT rate,zona FROM premi b' .
                                            ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '" ';
                                            $query = mysqli_query($conection, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            while($row = mysqli_fetch_array($query)){
                                                $rateGempa[$sub['SUB_PROD_ID']][$row['zona']] = $row['rate'];
                                            }
                                        } else {
                                            die(json_encode(array(false, 'pesan' => 'Gagal, Produk gempa belum memiliki premi rate zona, Silakan Hubungi Admin Biru')));
                                        }
                                    } else if ($sub['PROD_TYPE'] == 'kematian') {
                                        $sql = 'SELECT usia_awal,usia_akhir,rate FROM premi b'.
                                            ' WHERE b.SUB_PROD_ID LIKE "' . $sub['SUB_PROD_ID'] . '"'.
                                            ' ORDER BY usia_awal';
                                        $query = mysqli_query($conection, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            while($row = mysqli_fetch_array($query)){
                                                $rateKematian[$sub['SUB_PROD_ID']] = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                            }
                                        } else {
                                            die(json_encode(array(false, 'pesan' => 'Gagal, Produk kematian belum memiliki premi rate usia, Silakan Hubungi Admin Biru')));
                                        }
                                    }
                                    $subProduk[] = $sub['SUB_PROD_ID'];
                                }
                                //ambil semua sektor usaha
                                $perintah = 'SELECT ENTITY_ID,SUSA_ID,SUSA_NAMA FROM ma9002 WHERE ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="' . $dt1 . '"';
                                $query = mysqli_query($conection, $perintah);
                                $susa = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $susa_nama = array_map(function ($row) {return $row['SUSA_NAMA'];}, $susa);
                                $susa_id_last_no = str_replace('SU', '', $susa[count($susa) - 1]['SUSA_ID']);
                                
                                //ambil rules sub produk untuk pembagian premi
                                $SHA_SYSTEM_ID = array();
                                $rules = array();
                                $sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK '.
                                ',a.PROD_ID,a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS '.
                                ',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX,b.KOMISI_WITH '.
                                ' FROM ma2003 a '.
                                ' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
                                ' WHERE (a.PROD_ID IN ("' . implode('","', $subProduk) . '") AND (a.SHA_STATUS=0))'.
                                ' GROUP By a.PROD_ID,a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
                                $query = mysqli_query($conection, $sql);
                                while($row = mysqli_fetch_array($query)){
                                    if(!array_key_exists($row['PROD_ID'],$rules)){
                                        $rules[$row['PROD_ID']] = array('KOMISI_DITERIMA'=>array()
                                                ,'NILAI_RESIKO'=>array()
                                                ,'KOMISI'=>array(),'KOMISI2'=>array(),'RESIKO'=>array());
                                        $SHA_SYSTEM_ID[$row['PROD_ID']] = array();
                                    }
                                    //jika id baru hitung total num dan gabung group level
                                    if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID[$row['PROD_ID']])){
                                        $SHA_SYSTEM_ID[$row['PROD_ID']][$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
                                        $rules[$row['PROD_ID']]['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
                                        $rules[$row['PROD_ID']]['KOMISI_DITERIMA'][$row['SHA_ENTITY']] = 0;
                                        $rules[$row['PROD_ID']]['NILAI_RESIKO'][$row['SHA_ENTITY']] = 0;
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
                                if (!empty($_FILES['fileSpreadsheet']['name'])) {
                                    $path = '../unggah/b2b/PR002/' . $_SESSION['user_cli_system_id'];
                                    if (!is_dir($path)) {
                                        if (!is_dir('../unggah/b2b/PR002')) {
                                            if (!is_dir('../unggah/b2b')) {
                                                mkdir('../unggah/b2b/');
                                            }
                                            mkdir('../unggah/b2b/PR002/');
                                        }
                                        mkdir('../unggah/b2b/PR002/' . $_SESSION['user_cli_system_id']);
                                    }
    
                                    $nama = $_FILES['fileSpreadsheet']['name'];
                                    $fullPathFile = $path . '/' . $nama;
                                    if (!file_exists($fullPathFile)) {
                                        //move file to folder unggah
                                        move_uploaded_file($_FILES['fileSpreadsheet']['tmp_name'], $fullPathFile);
                                    } else {
                                        die(json_encode(array(false, 'pesan' => 'Gagal Upload, File sudah ada')));
                                    }
    
                                    try {
                                        /**  This can be particularly useful for conserving memory,
                                         *   by allowing you to read and process a large workbook in "chunks":
                                         *   an example of this usage might be when transferring data
                                         *   from an Excel worksheet to a database. */
                                        /**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
                                        class ChunkReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
                                        {
                                            private $startRow = 0;
                                            private $endRow = 0;
    
                                            /**  Set the list of rows that we want to read  */
                                            public function setRows($startRow, $chunkSize)
                                        {
                                                $this->startRow = $startRow;
                                                $this->endRow = $startRow + $chunkSize;
                                            }
    
                                            public function readCell($column, $row, $worksheetName = '')
                                        {
                                                //  Only read the heading row, and the configured rows
                                                if (($row == 1) || ($row >= $this->startRow && $row < $this->endRow)) {
                                                    return true;
                                                }
                                                return false;
                                            }
                                        }
                                        //set read & write permission
                                        chmod($fullPathFile, 0777);
    
                                        /**  Identify the type of $inputFileName  **/
                                        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($fullPathFile);
                                        // Xlxs var_dump($inputFileType);
                                        /**  Create a new Reader of the type that has been identified  **/
                                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    
                                        /**  Define how many rows we want to read for each "chunk"  **/
                                        $chunkSize = 2048;
                                        $chunkFilter = new ChunkReadFilter();
    
                                        /**  Tell the Reader that we want to use the Read Filter  **/
                                        $reader->setReadFilter($chunkFilter);
                                        //$reader->setLoadSheetsOnly('SOURCE DATA');
                                        /**   Define how many chunk is empty before the loop is stoped  **/
                                        $emptyCellOnChunkAttemp = 2;
                                        /**   Define the row header is_exist **/
                                        $rowHeader = false;
                                        /**   Define Rejected row **/
                                        $rowRejected = array();
                                        //start transaksi
                                        mysqli_autocommit($conection, false);
                                        $all_query_ok = true;
    
                                        /**  Loop to read our worksheet in "chunk size" blocks  **/
                                        for ($startRow = 1; $startRow <= 65536; $startRow += $chunkSize) {
    
                                            /**  Tell the Read Filter which rows we want this iteration  **/
                                            $chunkFilter->setRows($startRow, $chunkSize);
                                            /**  Load only the rows that match our filter  **/
                                            $spreadsheet = $reader->load($fullPathFile);
                                            //    Do some processing here
    
                                            //jika Cell chunk ini kosong
                                            $cellData = $spreadsheet->getActiveSheet()->getHighestRowAndColumn();
                                            if ($cellData['row'] == 1 && $cellData['column'] == "A") {
                                                //jika chunk kedua kosong perulangan for chunk dihentikan
                                                if ($emptyCellOnChunkAttemp == 0) {
                                                    break;
                                                }
                                                $emptyCellOnChunkAttemp--;
                                                continue;
                                            }
                                            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
                                            //jika tidak ada row yg di load (sudah terakhir),
                                            //akhiri looping chunk
                                            if (!isset($sheetData[$startRow])) {
                                                break;
                                            }
                                            //var_dump($sheetData);
                                            //define query
                                            $queryTrans = 'INSERT INTO tr0001 ' .
                                                '(TRX_UUID,ENTITY_ID,PROD_ID,TRX_KTP_ID,TRX_NAMA,TRX_TGL_LAHIR,TRX_ALAMAT ' .
                                                ',SUSA_ID,CABANG_ID,CURR_ID,TRX_PLAFOND,TRX_PENCAIRAN' .
                                                ',TRX_TGL_CAIR,TRX_JML_MINGG,TRX_START_PRO,TRX_END_PRO,TRX_NILAI_UK ' .
                                                ',TRX_PREMI,CREATED_ON,CREATED_BY,TRX_CURR_RATE,TRX_NMFILE ' .
                                                ',TRX_STATUS,BANK_REKENING,NO_REKENING,NAMA_REKENING) ' .
                                                'VALUES ';
                                            $valueTrans = array();
                                            $valueSusa = array();
                                            $valDetailTrans = $valPembagianPremi = '';
                                            $premiTotalMain = 0;
                                            //proses looping tiap row pada chunk
                                            for ($i = $startRow; $i <= ($startRow + $chunkSize); $i++) {
                                                //jika tidak ada row yg di load (sudah terakhir),
                                                //akhiri looping row
                                                if (!isset($sheetData[$i])) {
                                                    break;
                                                }
                                                $row = $sheetData[$i];
                                                $transUUID = generateUUID();

                                                //var_dump($row);
                                                //var_dump($rowHeader);
                                                //jika posisi rowHeader belum ketemu
                                                if (!$rowHeader) {
                                                    if ((strtolower($row['A']) == strtolower("No Urut")) &&
                                                        (strtolower($row['B']) == strtolower("NO KTP/NO LOAN")) &&
                                                        (strtolower($row['C']) == strtolower("NAMA")) &&
                                                        (strtolower($row['D']) == strtolower("NAMA CABANG PNM")) &&
                                                        (strtolower($row['E']) == strtolower("TANGGAL LAHIR")) &&
                                                        (strtolower($row['F']) == strtolower("INFORMASI PENCAIRAN")) &&
                                                        (strtolower($sheetData[$i + 1]['F']) == strtolower("NO ID")) &&
                                                        (strtolower($sheetData[$i + 1]['G']) == strtolower("TANGGAL PENCAIRAN")) &&
                                                        (strtolower($row['H']) == strtolower("NILAI KAFALAH/PLAFOND")) &&
                                                        (strtolower($row['I']) == strtolower("JANGKA WAKTU")) &&
                                                        (strtolower($sheetData[$i + 1]['I']) == strtolower("AWAL")) &&
                                                        (strtolower($sheetData[$i + 1]['J']) == strtolower("AKHIR")) &&
                                                        (strtolower($row['K']) == strtolower("JUMLAH MINGGU")) &&
                                                        (strtolower($row['L']) == strtolower("SEKTOR USAHA")) &&
                                                        (strtolower($row['M']) == strtolower("NILAI UK"))
                                                    ) {
                                                        $rowHeader = true;
                                                        //supaya tidak memproses header baris ke-2, karena pada header ada 2 row yg di merge
                                                        $i++;
                                                    }
                                                    //langsung ke perulangan row berikutnya
                                                    continue;
                                                } // end if ! rowHeader
    
                                                /** WARNING : Posisi penulisan kode antar $strValueTrans jangan digeser,
                                                 *            posisi $strValueTrans sudah sesuai dengan kolom query $queryTrans **/
    
                                                $strValueTrans = '("' . $transUUID . '","' . $_SESSION['user_cli_group'] . '","' . $dt1 . '",';
                                                $strValueTrans .= '"' . $row['B'] . '",'; //TRX_KTP_ID
                                                $strValueTrans .= '"' . $row['C'] . '",'; //TRX_NAMA
                                                $lahir = strtotime($row['E']);
                                                $strValueTrans .= '"' . date('Y-m-d', $lahir) . '",'; //TRX_TGL_LAHIR
                                                $strValueTrans .= '"",'; //TRX_ALAMAT
    
                                                //SUSA_ID
                                                //$row['L']='Bengkel Mobil';
                                                $keySusa = array_search($row['L'], $susa_nama);
                                                //jika susa sudah ada
                                                if (is_numeric($keySusa)) {
                                                    $strValueTrans .= '"' . $susa[$keySusa]['SUSA_ID'] . '",'; //SUSA_ID
                                                } else {
                                                    //values (ENTITY_ID,SUSA_ID,SUSA_NAMA)
                                                    $valueSusa[] = '("' . $_SESSION['user_cli_group'] . '","SU' . sprintf('%03s', (++$susa_id_last_no)) . '","' . $row['L'] . '")';
                                                    $susa[] = array('ENTITY_ID' => $_SESSION['user_cli_group'], 'SUSA_ID' => 'SU' . sprintf('%03s', $susa_id_last_no), 'SUSA_NAMA' => $row['L']);
                                                    $susa_nama[] = $row['L'];
                                                    $strValueTrans .= '"SU' . sprintf('%03s', $susa_id_last_no) . '",'; //SUSA_ID
                                                }
    
                                                //CABANG_ID
                                                $keyCabang = array_search(strtoupper($row['D']), $cabang_nama);

                                                //jika cabang tidak ditemukan, row ini = rejected
                                                if (!is_numeric($keyCabang)) {
                                                    $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'],
                                                        'N' => 'Cabang Tidak Ditemukan');
                                                    continue;
                                                } else {

                                                    //jika yg mengupload adalah cabang
                                                    if( ! empty($_SESSION['user_cabang_key'])){
                                                        //jika cabang tidak sesuai
                                                        if( $cabang[$keyCabang]['ID_KEY'] != $_SESSION['user_cabang_key']){
                                                            $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'], 'N' => $cabang[$keyCabang]['nama'] . ' tidak sesuai dengan cabang anda');
                                                            continue;
                                                        }
                                                    }

                                                    //jika ada sub produk tipe gempa
                                                    if (count($rateGempa) > 0) {
                                                        //cek zonasi
                                                        if (is_null($cabang[$keyCabang]['zonasi'])) {
                                                            $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'],
                                                                'N' => $cabang[$keyCabang]['LOKASI_ID'] . ' berada di wilayah ' . $cabang[$keyCabang]['nama'] . ' dan wilayah ini belum terdaftar zona gempa, Silakan Hubungi Admin Biru');
                                                            continue;
                                                        }
                                                    }
                                                    $strValueTrans .= '"' . $cabang[$keyCabang]['LOKASI_ID'] . '",'; //CABANG_ID
                                                }
    
                                                $strValueTrans .= '"' . $produk[0]['PROD_CURR'] . '",'; //CURR_ID
                                                $strValueTrans .= '"' . $row['H'] . '",'; //TRX_PLAFOND
                                                $strValueTrans .= '"' . $row['F'] . '",'; //TRX_PENCAIRAN
                                                $strValueTrans .= '"' . date('Y-m-d', strtotime($row['G'])) . '",'; //TRX_TGL_CAIR
                                                $strValueTrans .= '"' . $row['K'] . '",'; //TRX_JML_MINGG
    
                                                //TRX_START_PRO
                                                //TRX_END_PRO
                                                try{
                                                    $awal = date_create(date('Y-m-d', strtotime($row['I'])));
                                                    $akhir = date_create(date('Y-m-d', strtotime($row['J'])));
                                                    $diff = date_diff($awal, $akhir, false);
                                                    if ($diff->invert == 1) {
                                                        $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'], 'N' => 'Jangka Waktu Salah');
                                                        continue;
                                                    } else {
                                                        $strValueTrans .= '"' . $awal->format('Y-m-d') . '",'; //TRX_START_PRO
                                                        $strValueTrans .= '"' . $akhir->format('Y-m-d') . '",'; //TRX_END_PRO
                                                    }
                                                }catch(Exception $x){
                                                    $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'], 'N' => 'Jangka Waktu Salah');
                                                        continue;
                                                }
                                                //TRX_NILAI_UK
                                                $strValueTrans .= '"' . $row['M'] . '",'; //TRX_NILAI_UK
    
                                                //untuk semua sub produk
                                                $premiTotalSub = 0;
                                                foreach ($produk as $sub) {
                                                    //cek tipe sub produk
                                                    if ($sub['PROD_TYPE'] == 'dca eq') {
                                                        //cek rate, jika tidak ada rate zona, row rejected
                                                        if (!array_key_exists($cabang[$keyCabang]['zonasi'],$rateGempa[$sub['SUB_PROD_ID']])) {
                                                            $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'],
                                                                'N' => 'Antara Sub Produk Gempa berikut ' . implode(',', array_keys($rateGempa)) . ' belum memiliki rate untuk zona (' . $cabang[$keyCabang]['zonasi'] . '), Silakan Hubungi Admin Biru');
                                                            continue 2;
                                                        }
                                                        $rate = $rateGempa[$sub['SUB_PROD_ID']][$cabang[$keyCabang]['zonasi']];
                                                        //TRX_PREMI  //premi = plafond * (premi sub produk/100) * (rate zona/100)
                                                        $premi = ($row['H'] * ($sub['PROD_PREMI'] / 100) * ($rate / 100));
                                                    } else if ($sub['PROD_TYPE'] == 'kematian') {
                                                        try{
                                                            $awal = date_create();
                                                            $akhir = date_create(date('Y-m-d', $lahir)); //lahir
                                                            $diff = date_diff($awal, $akhir, true);
                                                        }catch(Exception $x){
                                                            $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'], 'N' => 'Tanggal Lahir Salah');
                                                            continue 2;
                                                        }
                                                        $usia = ($diff->format("%a")/365);
                                                        $ada = false;
                                                        //usia_awal,usia_akhir,rate
                                                        foreach($rateKematian[$sub['SUB_PROD_ID']] as $rowRate){
                                                            if($rowRate['usia_awal'] >= $usia 
                                                            || $rowRate['usia_akhir'] <= $usia){
                                                                $rate = $rowRate['rate'];
                                                                $premi = ($row['H'] * ($sub['PROD_PREMI'] / 100) * ($rate / 100));
                                                                $ada = true;
                                                                break;
                                                            }
                                                        }
                                                        //cek rate, jika tidak ada rate/usia salah, row rejected
                                                        if(!$ada){
                                                            $rowRejected[] = array('A' => $row['A'], 'B' => $row['B'], 'C' => $row['C'], 'D' => $row['D'], 'E' => date('Y-m-d', $lahir), 'F' => $row['F'], 'G' => date('Y-m-d', strtotime($row['G'])), 'H' => $row['H'], 'I' => date('Y-m-d', strtotime($row['I'])), 'J' => date('Y-m-d', strtotime($row['J'])), 'K' => $row['K'], 'L' => $row['L'], 'M' => $row['M'],
                                                                'N' => 'Rentang usia ('.$usia.' tahun) belum di atur untuk sub produk asuransi kematian');
                                                            continue 2;
                                                        }
                                                    } else {
                                                        $premi = $row['H'] * ($sub['PROD_PREMI'] / 100);
                                                    }

                                                    $SUB_PROD_ID = $sub['SUB_PROD_ID'];
                                                    $CLAIM_TYPE  = $sub['CLAIM_TYPE'];
                                                    $SUB_PREMI = sprintf($produk[0]['PROD_CURR']=='BRU'?'%.6F':'%.2F', $premi);
                                                    
                                                    $TRX_DETAIL_SYSTEM_ID = generateUUID();
                                                    
                                                    //insert detail trans
                                                    if($sub['PROD_TYPE'] == 'dca eq'){
                                                        $valDetailTrans .= '("'.$TRX_DETAIL_SYSTEM_ID.'",'.$cabang[$keyCabang]['lat'].','.$cabang[$keyCabang]['lng'].',"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.'),';
                                                    }else{
                                                        $valDetailTrans .= '("'.$TRX_DETAIL_SYSTEM_ID.'",NULL,NULL,"tr0001","'.$transUUID.'","'.$SUB_PROD_ID.'",'.$SUB_PREMI.',"'.$TRX_CURR.'",'.$TRX_CURR_RATE_IDR.','.$CLAIM_TYPE.'),';
                                                    }
                                                    //pembagian selalu dalam IDR
                                                    $SUB_PREMI_ASLI = $premi * $TRX_CURR_RATE_IDR;
                                                    //proses pembagian premi untuk semua system_id, return $rules[RESIKO] & $rules[KOMISI_DITERIMA]
                                                    foreach($SHA_SYSTEM_ID[$SUB_PROD_ID] as $system_id=>$entity_id){
                                                        //ubah persen resiko menjadi nilai resiko berdasarkan (premi * persen resiko)
                                                        $rules[$SUB_PROD_ID]['NILAI_RESIKO'][$entity_id] = $SUB_PREMI_ASLI * $rules[$SUB_PROD_ID]['RESIKO'][$entity_id] / 100;
                                                        //mendapat komisi
                                                        if(isset($rules[$SUB_PROD_ID]['KOMISI'][$system_id])){
                                                            foreach($rules[$SUB_PROD_ID]['KOMISI'][$system_id] as $index => $objMendapat){
                                                                $komisi = ($SUB_PREMI_ASLI * $objMendapat['KOMISI_NUM'] / 100) / 1.1;
                                                                $ppn = $pph23 = 0;
                                                                if ($objMendapat['KOMISI_TAX'] == 'y') {
                                                                    //$ppn = $komisi * 10 /100
                                                                    // $ppn = $objMendapat['KOMISI_NUM'] * 10 / 100;
                                                                    $ppn = $komisi * 10 / 100;
                                                                }
                                                                if ($objMendapat['KOMISI_WITH'] == 'y') {
                                                                    //ppn = $komisi * 2 /100
                                                                    // $pph23 = $objMendapat['KOMISI_NUM'] * 2 / 100;
                                                                    $pph23 = $komisi * 2 / 100;
                                                                }
                                                                // $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id] += $objMendapat['KOMISI_NUM'] + $ppn - $pph23;
                                                                $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id] += $komisi + $ppn - $pph23;
                                                            }
                                                        }
                                                        //memberi komisi
                                                        if(isset($rules[$SUB_PROD_ID]['KOMISI2'][$system_id])){
                                                            foreach($rules[$SUB_PROD_ID]['KOMISI2'][$system_id] as $index => $objMemberi){
                                                                $komisi = ($SUB_PREMI_ASLI * $objMemberi['KOMISI_NUM'] / 100) / 1.1;
                                                                $ppn = $pph23 = 0;
                                                                if ($objMemberi['KOMISI_TAX'] == 'y') {
                                                                    //$ppn = $komisi * 10 /100
                                                                    // $ppn = $objMemberi['KOMISI_NUM'] * 10 / 100;
                                                                    $ppn = $komisi * 10 / 100;
                                                                }
                                                                if ($objMemberi['KOMISI_WITH'] == 'y') {
                                                                    //$ppn = $komisi * 2 /100
                                                                    // $pph23 = $objMemberi['KOMISI_NUM'] * 2 / 100;
                                                                    $pph23 = $komisi * 2 / 100;
                                                                }
                                                                // $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id] -= $objMemberi['KOMISI_NUM'] + $ppn - $pph23;
                                                                $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id] -= $komisi + $ppn - $pph23;
                                                            }
                                                        }
                                                    }
                                                    //proses pembuatan query pembagian premi
                                                    foreach($SHA_SYSTEM_ID[$SUB_PROD_ID] as $system_id=>$entity_id){
                                                        $valPembagianPremi .= '(NULL,"'.$TRX_DETAIL_SYSTEM_ID.'","'.$entity_id.'",'. ($rules[$SUB_PROD_ID]['NILAI_RESIKO'][$entity_id] + $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id]) . '),';
                                                        //reset komisi diterima
                                                        $rules[$SUB_PROD_ID]['KOMISI_DITERIMA'][$entity_id] = 0;
                                                    }
                                                    $premiTotalSub += $premi;
                                                }
                                                //cek mata uang
                                                if ($produk[0]['PROD_CURR'] == 'BRU') {
                                                    $premi *= $_SESSION['bru_to_idr'];
                                                } else if ($produk[0]['PROD_CURR'] == 'IDR') {

                                                } else {

                                                }
                                                $premiTotalMain += $premiTotalSub;
                                                $strValueTrans .= '"' . $premiTotalSub . '",'; //TRX_PREMI
                                                $strValueTrans .= 'NULL,'; //CREATED_ON //default timestamp dari database
                                                $strValueTrans .= '"' . $_SESSION['user_cli_system_id'] . '",'; //CREATED_BY
                                                $strValueTrans .= '0,'; //TRX_CURR_RATE
                                                $strValueTrans .= '"' . $nama . '",'; //TRX_NMFILE
    
                                                //TRX_STATUS
                                                //Jika Nilai UK =< Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='2'
                                                //Jika Nilai UK > Parameter 'Limit_TRX' dan PROD_AUTOP = 0 , maka TRX_STATUS='1'
                                                //Jika PROD_AUTOP = 1, maka TRX_STATUS='0'
                                                if ($produk[0]['PROD_AUTOP'] == 1) {
                                                    $status = 0;
                                                } else {
                                                    $status = 0;
                                                }
                                                $strValueTrans .= '"' . $status . '",'; //TRX_STATUS
                                                //BANK_REKENING,NO_REKENING,NAMA_REKENING
                                                $strValueTrans .= '"' . $cabang[$keyCabang]['BANK_REKENING'] . '",';
                                                $strValueTrans .= '"' . $cabang[$keyCabang]['NO_REKENING'] . '",'; 
                                                $strValueTrans .= '"' . $cabang[$keyCabang]['NAMA_REKENING'] . '"';

                                                //tambahkan ke array $valueTrans
                                                $valueTrans[] = $strValueTrans . ')';
                                            } // end for row in chunk
    
                                            //pada chunk pertama sebanyak $chunkSize baris (tidak ada/salah), perulangan for chunk dihentikan
                                            if (!$rowHeader) {
                                                die(json_encode(array(false, 'pesan' => 'Header tidak ditemukan, silakan sesuaikan template file untuk mengunggah')));
                                                break;
                                            }
                                            //jika jumlah $valueSusa lebih dari 0 (ada Sektor Usaha Baru)
                                            if (count($valueSusa) > 0) {
                                                $valueSusa = implode(',', $valueSusa); //substr(, 0, -1);
                                                $perintah = 'INSERT INTO ma9002 (ENTITY_ID,SUSA_ID,SUSA_NAMA) VALUES ' . $valueSusa;
                                                if (!mysqli_query($conection, $perintah)) {
                                                    mysqli_rollback($conection);
                                                    // gagal upload (hapus file)
                                                    if (file_exists($fullPathFile)) {
                                                        unlink($fullPathFile);
                                                    }
                                                    die(json_encode(array(false, 'pesan' => 'Gagal Mengunggah Sektor Usaha')));
                                                }
                                            }
                                            
                                            //insert transaksi tiap chunk
                                            $perintah = $queryTrans . implode(',', $valueTrans);
                                            if (!mysqli_query($conection, $perintah)) {
                                                mysqli_rollback($conection);
                                                // create rejected file
                                                if (count($rowRejected) > 0) {
                                                    //Clearing a Workbook from memory
                                                    $spreadsheet->disconnectWorksheets();
                                                    unset($spreadsheet);
                                                    //Load template Rejected
                                                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../unggah/templateRejected.xlsx');
                                                    $worksheet = $spreadsheet->getActiveSheet();
                                                    $indexRow = 3;
                                                    foreach ($rowRejected as $row) {
                                                        foreach ($row as $col => $value) {
                                                            $worksheet->getCell($col . $indexRow)->setValue($value);
                                                        }
                                                        $indexRow++;
                                                    }
                                                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                                                    $writer->setPreCalculateFormulas(false);
                                                    $writer->setOffice2003Compatibility(true);
                                                    $writer->save($path . '/Rejected_' . $nama);
                                                    //Clearing a Workbook from memory
                                                    $spreadsheet->disconnectWorksheets();
    
                                                    unset($spreadsheet);
                                                }
                                                // gagal upload (hapus file)
                                                if (file_exists($fullPathFile)) {
                                                    unlink($fullPathFile);
                                                }
                                                if (count($valueTrans) == 0) {
                                                    die(json_encode(array(false, 'newWindow' => './oneFile.php?p=download&a=file_rejected&nmF=' . $nama,
                                                        'pesan' => 'Gagal Mengunggah Data Peserta data diterima 0, data ditolak ' . count($rowRejected))));
                                                } else {
                                                    die(json_encode(array(false, 'pesan' => 'Gagal Mengunggah Data Peserta')));
                                                }
                                            }
                                            //insert detail transaksi, untuk tiap sub prod
                                            $valDetailTrans = substr($valDetailTrans,0,-1);    
                                            $sqlDetailTrans = 'INSERT INTO tr0002_b2c (TRX_DETAIL_SYSTEM_ID,KOOR_LAT,KOOR_LANG,TRX_PARENT,TRX_SYSTEM_ID,SUB_PROD_ID,SUB_PREMI,TRX_CURR,TRX_CURR_RATE_IDR,CLAIM_TYPE) VALUES '.$valDetailTrans;
                                            
                                            $valPembagianPremi = substr($valPembagianPremi,0,-1);    
                                            $sqlPembagianPremi = 'INSERT INTO tr0003_b2c (PEMBAGIAN_SYSTEM_ID,TRX_DETAIL_SYSTEM_ID,ENTITY_ID,`NILAI`) VALUES ' . $valPembagianPremi;
                                            
                                            mysqli_query($conection, $sqlDetailTrans) ? null : $all_query_ok = false;
                                            
                                            mysqli_query($conection, $sqlPembagianPremi) ? null : $all_query_ok = false;
                                        } // end loopin chunk
    
                                        //Clearing a Workbook from memory
                                        $spreadsheet->disconnectWorksheets();
                                        unset($spreadsheet);

                                        $perintah = 'INSERT INTO up001 (CREATED_BY, TRX_NMFILE,TANGGAL, DATA_TOTAL,DATA_DELETED,DATA_SUCCESS,DATA_REJECTED) ' .
                                        ' VALUES ("' . $_SESSION['user_cli_system_id'] . '","' . $nama . '","' . date('Y-m-d') . '"' .
                                        ',' . (count($valueTrans) + count($rowRejected)) . ',0,' . count($valueTrans) . ',' . count($rowRejected) . ')';
                                        if (!mysqli_query($conection, $perintah)) {
                                            mysqli_rollback($conection);
                                            // gagal upload (hapus file, dan hapus data transaksi file ini)
                                            if (file_exists($fullPathFile)) {
                                                unlink($fullPathFile);
                                            }
    
                                            die(json_encode(array(false, 'pesan' => 'Gagal Mengunggah Data Peserta')));
                                        }
                                        
                                        if ($all_query_ok) {
                                            mysqli_commit($conection);
                                        } else {
                                            mysqli_rollback($conection);
                                        }
    
                                        if (count($rowRejected) > 0) {
                                            //Load template Rejected
                                            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../unggah/templateRejected.xlsx');
                                            $worksheet = $spreadsheet->getActiveSheet();
                                            $indexRow = 3;
                                            foreach ($rowRejected as $row) {
                                                foreach ($row as $col => $value) {
                                                    $worksheet->getCell($col . $indexRow)->setValue($value);
                                                }
                                                $indexRow++;
                                            }
                                            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                                            $writer->setPreCalculateFormulas(false);
                                            $writer->setOffice2003Compatibility(true);
                                            $writer->save($path . '/Rejected_' . $nama);
                                            //Clearing a Workbook from memory
                                            $spreadsheet->disconnectWorksheets();
                                            unset($spreadsheet);
                                        }
                                        die(json_encode(array(true, 'pesan' => 'Berhasil Mengunggah Data Peserta')));
                                    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                                        die(json_encode(array(false, 'pesan' => 'Error : ' . $e->getMessage())));
                                    } // end try catch
                                } else { // else isset name file
                                    die(json_encode(array(false, 'pesan' => 'File tidak terunggah')));
                                } // end if isset name file
                                break;
                            case "PR123":
                                break;
                        }
                    } else { // else isset file and id_produk
                        die(json_encode(array(false, 'pesan' => 'Produk tidak ada')));
                    } // end if isset file and id_produk
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }

                break;
            case "peserta_hapus_file":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["id"]));
                    switch($dt2){
                        case "PR002":
                            // stop jika ID_KEY tidak ada dan
                            $perintah = 'SELECT ID_KEY,TRX_NMFILE,CREATED_BY FROM up001 WHERE ID_KEY=' . $dt1 . ' AND CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, File tidak ditemukan')));
                            }
                            $data = mysqli_fetch_array($query);
                            //cek semua data trans dimana status aktif 
                            $sql = 'SELECT COUNT(TRX_UUID) FROM tr0001 WHERE TRX_STATUS=1 AND TRX_NMFILE="'.$data['TRX_NMFILE'].'" AND CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
                            $query=mysqli_query($conection,$sql);
                            if(mysqli_fetch_row($query)[0] > 0){
                                die(json_encode(array(false, 'pesan' => 'File tidak dapat dihapus, ada data transaksi yg sedang aktif')));
                            }
                            $fullPathFile = '../unggah/b2b/PR002/' . $data['CREATED_BY'] . '/' . $data['TRX_NMFILE'];
                            $fullPathRejectedFile = '../unggah/b2b/PR002/' . $data['CREATED_BY'] . '/Rejected_' . $data['TRX_NMFILE'];
                            //hapus file
                            if (file_exists($fullPathFile)) {
                                unlink($fullPathFile);
                            }

                            if (file_exists($fullPathRejectedFile)) {
                                unlink($fullPathRejectedFile);
                            }

                            // Turn autocommit off
                            $all_query_ok = true;
                            mysqli_autocommit($conection, false);

                            $perintah1 = 'DELETE a,b FROM tr0001 a INNER JOIN tr0002_b2c b ON a.TRX_UUID = b.TRX_SYSTEM_ID AND b.TRX_PARENT="tr0001" ' .
                                ' WHERE TRX_NMFILE LIKE "' . $data['TRX_NMFILE'] . '" AND a.CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
                            $perintah2 = 'DELETE FROM up001 WHERE ID_KEY = ' . $dt1 . ' AND CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
                            mysqli_query($conection, $perintah1)?null:$all_query_ok=false;
                            mysqli_query($conection, $perintah2)?null:$all_query_ok=false;
                            // Commit transaction
                            if (!$all_query_ok) {
                                mysqli_rollback($conection);
                                die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                            } else {
                                mysqli_commit($conection);
                                //kalau true sesi dihapus
                                unset($_SESSION['token']);
                                die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                            }
                            break;
                        case "PR123":
                            break;
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "peserta_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["id"]));
                    switch($dt2){
                        case "PR002":
                            // stop jika ID_KEY tidak ada dan
                            $dt3 = (bool) $_POST["force"];

                            $perintah = 'SELECT ID_KEY,TRX_NMFILE,CREATED_BY,TRX_UUID FROM tr0001 WHERE ID_KEY=' . $dt1 . ' AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            $query = mysqli_query($conection, $perintah);
                            if (mysqli_num_rows($query) == 0) {
                                die(json_encode(array(false, 'pesan' => 'Gagal!, Transaksi tidak ditemukan')));
                            }
                            $data = mysqli_fetch_row($query);
                            if(!$dt3){
                                if ($data[1] != "") {
                                    die(json_encode(array(false, 'pesan' => 'Transaksi terhubung dengan file. Tetap hapus?', 'force'=>true)));
                                }
                            }
                            $all_query_ok = true;
                            mysqli_autocommit($conection,false);
                            //jika data upload file
                            if($data[1] != ""){
                                $sql = 'SELECT COUNT(TRX_NMFILE) FROM tr0001 WHERE CREATED_BY='.$data[2].' AND TRX_NMFILE = "'.$data[1].'"';
                                $query = mysqli_query($conection,$sql);
                                $data2 = mysqli_fetch_row($query);
                                //jika sisa data trans = 1, hapus file
                                if($data2[0]==1){
                                    $sql = 'DELETE FROM up001 WHERE CREATED_BY='.$data[2].' AND TRX_NMFILE = "'.$data[1].'"';
                                    mysqli_query($conection, $sql)?null:$all_query_ok=false;
                                    $fullPathFile = '../unggah/b2b/PR002/' . $data[2] . '/' . $data[1];
                                    $fullPathRejectedFile = '../unggah/b2b/PR002/' . $data[2] . '/Rejected_' . $data[1];
                                    //hapus file
                                    if (file_exists($fullPathFile)) {
                                        unlink($fullPathFile);
                                    }            
                                    if (file_exists($fullPathRejectedFile)) {
                                        unlink($fullPathRejectedFile);
                                    }
                                }else{
                                    $sql = 'UPDATE up001 SET DATA_DELETED=DATA_DELETED+1 WHERE CREATED_BY='.$data[2].' AND TRX_NMFILE = "'.$data[1].'"';
                                    mysqli_query($conection, $sql)?null:$all_query_ok=false;
                                }
                            }
                            //hapus trans
                            $perintah2 = 'DELETE FROM tr0001 WHERE ID_KEY = ' . $dt1 . ' AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                            mysqli_query($conection, $perintah2)?null:$all_query_ok=false;
                            //hapus detail trans
                            $perintah2 = 'DELETE FROM tr0002_b2c WHERE TRX_SYSTEM_ID = "' . $data[3] . '" AND TRX_PARENT="tr0001"';
                            mysqli_query($conection, $perintah2)?null:$all_query_ok=false;
                            if (!$all_query_ok) {
                                mysqli_rollback($conection);
                                die(json_encode(array(false, 'pesan' => 'Gagal di Hapus'.$perintah2)));
                            } else {
                                mysqli_commit($conection);
                                //kalau true sesi dihapus
                                unset($_SESSION['token']);
                                die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                            }
                            break;
                        case "PR123":
                            break;
                        default: die(json_encode(array(true, 'pesan' => 'Unknown Product')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "peserta_hapus_terpilih":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    switch(@$_POST['id']){
                        case "PR002":
                            $arr = json_decode($_POST["kode"]);
                            // stop jika ID_KEY tidak ada dan
                            $pesan = '';
                            $deleted = 0;
                            $all_query_ok = true;
                            mysqli_autocommit($conection,false);
                            for ($i=0;$i<count($arr);$i++){
                                $data = $arr[$i];
                                $dt1 = mysqli_escape_string($conection, purifier($data));
                                $perintah = 'SELECT ID_KEY,TRX_NMFILE,TRX_STATUS,CREATED_BY,TRX_UUID,TRX_KTP_ID FROM tr0001 WHERE TRX_UUID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                                $query = mysqli_query($conection, $perintah);
                                if (mysqli_num_rows($query) == 0) {
                                    continue;
                                }
                                $data = mysqli_fetch_row($query);
                                //jika data upload file
                                if($data[1] != ""){
                                    $sql = 'SELECT COUNT(TRX_NMFILE) FROM tr0001 WHERE CREATED_BY='.$data[3].' AND TRX_NMFILE = "'.$data[1].'"';
                                    $query = mysqli_query($conection,$sql);
                                    $data2 = mysqli_fetch_row($query);
                                    //jika sisa data trans = 1, hapus file
                                    if($data2[0] == 1){
                                        $sql = 'DELETE FROM up001 WHERE CREATED_BY='.$data[3].' AND TRX_NMFILE = "'.$data[1].'"';
                                        mysqli_query($conection, $sql)?null:$all_query_ok=false;
                                        $fullPathFile = '../unggah/b2b/PR002/' . $data[3] . '/' . $data[1];
                                        $fullPathRejectedFile = '../unggah/b2b/PR002/' . $data[3] . '/Rejected_' . $data[1];
                                        //hapus file
                                        if (file_exists($fullPathFile)) {
                                            unlink($fullPathFile);
                                        }            
                                        if (file_exists($fullPathRejectedFile)) {
                                            unlink($fullPathRejectedFile);
                                        }
                                    }else{
                                        $sql = 'UPDATE up001 SET DATA_DELETED=DATA_DELETED+1 WHERE CREATED_BY='.$data[3].' AND TRX_NMFILE = "'.$data[1].'"';
                                        mysqli_query($conection, $sql)?null:$all_query_ok=false;
                                    }
                                }
                                $perintah2 = 'DELETE FROM tr0001 WHERE TRX_UUID = "' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                                $perintah3 = 'DELETE FROM tr0002_b2c WHERE TRX_SYSTEM_ID = "' . $dt1 . '" AND TRX_PARENT="tr0001"';
                                mysqli_query($conection, $perintah2)?null:$all_query_ok=false;
                                mysqli_query($conection, $perintah3)?null:$all_query_ok=false;
                                if (!$all_query_ok) {
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => $deleted.' data berhasil dihapus.'.EOL.' Data dengan ktp '.$data[5].', Gagal di Hapus')));
                                }
                                $deleted++;
                            }
                            $pesan = (count($arr) - $deleted) . ' data gagal dihapus!! ';
                            if (!$all_query_ok) {
                                mysqli_rollback($conection);
                                die(json_encode(array(false, 'pesan' => 'Semua data gagal di Hapus')));
                            } else {
                                mysqli_commit($conection);
                                //kalau true sesi dihapus
                                unset($_SESSION['token']);
                                die(json_encode(array(true, 'pesan' => 'Dari '.count($arr).' data '. $deleted . ' berhasil di hapus' . "\n" . $pesan)));
                            }
                            break;
                        case "PR123":
                            break;
                        default: die(json_encode(array(false, 'pesan' => 'Unknown Product')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "peserta_bayar_terpilih":
                //cek token crsf
                if (@hash_equals($_SESSION['tokenBayar'], $_POST['token'])) {
                    // stop jika ID_KEY tidak ada dan
                    /*
                    $pesan='';
                    $perintah2=array();
                    $arr = json_decode($_POST["kode"]);
                    foreach($arr as $index=>$data){
                    $dt1 = mysqli_escape_string($conection, purifier($data));
                    $perintah = 'SELECT ID_KEY,TRX_NMFILE,TRX_STATUS FROM tr0001 WHERE ID_KEY=' . $dt1 . ' AND TRX_STATUS=0';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 0) {
                    unset($arr[$index]);
                    continue;
                    }
                    $arr[$index] = mysqli_escape_string($conection, purifier($data));
                    }
                    $harga_emas = mysqli_escape_string($conection,trim($_POST['harga_emas']));
                    $id = mysqli_escape_string($conection,trim($_POST['id']));
                    $premi = mysqli_escape_string($conection,trim($_POST['premi']));
                    $bru = mysqli_escape_string($conection,trim($_POST['bru']));
                    $txh2 = mysqli_escape_string($conection,trim($_POST['txh2']));
                    $perintah = 'SELECT PROD_CURR FROM ma2001 WHERE PROD_STATUS=0 AND PROD_LEVEL=0 AND PROD_ID = "' . $id . '"';
                    $query = mysqli_query($conection, $perintah);
                    $produk = array('PROD_CURR'=>'BRU');
                    if (mysqli_num_rows($query) == 1) {
                    $produk = mysqli_fetch_array($query);
                    }
                    $memo = '';
                    if($produk['PROD_CURR']=='IDR'){
                    //cek konversi bru to idr
                    if($bru != $premi / $harga_emas || $premi != $bru * $harga_emas){
                    $memo .= 'Premi dan biru pada saat transaksi tidak sesuai, bru->idr = '.$harga_emas;
                    }else{
                    $memo .= 'Premi dan biru pada saat transaksi sudah sesuai';
                    }
                    }

                    mysqli_autocommit($conection,FALSE);
                    mysqli_query($conection,'INSERT INTO py0001 '.
                    ' (TRX_PR_DATE,TRX_PR_TYPE,TRX_PR_CLIENT_ID,TRX_PR_DARI,TRX_PR_TUJUAN '.
                    ' ,TRX_PR_TXHASH,TRX_PR_CURR_ID,TRX_PR_VALUE,TRX_PR_VALUE_BRU,TRX_PR_MEMO) VALUES '.
                    ' ("'.date('Y-m-d').'","PY","'.$_SESSION['user_id'].'","'.$_SESSION['prkey'].'","0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45"'.
                    ' ,"'.$txh2.'","'.$produk['PROD_CURR'].'",'.$premi.','.$bru.',"'.$memo.'")');
                    echo $idTRX = mysqli_insert_id($conection);
                    var_dump($arr);
                    foreach($arr as $dt1){
                    $sql='UPDATE tr0001 SET TRX_PAYMENT_ID='.$idTRX.', TRX_STATUS=1 WHERE ID_KEY = ' . $dt1 . '';
                        mysqli_query($conection, $sql);
                    }

                    if(!mysqli_commit($conection)){
                    mysqli_rollback($conection);
                    }else {
                    //kalau true sesi dihapus
                    unset($_SESSION['token']);
                    die(json_encode(array(true, 'pesan' => 'Transaksi berhasil disimpan')));
                    }
                        */
                    die(json_encode(array(false, 'pesan' => 'Transaksi gagal disimpan')));
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;

            case "business_rules_detail_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["id"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["partner"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["porsi"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["level"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["dana_in_no"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["dana_in_bank"]));
                    $dt12 = mysqli_escape_string($conection, purifier($_POST["dana_in_nama"]));
                    
                    if( ! in_array($dt4,array(0,1)))
                    {
                        $dt4 = "NULL";
                    }

                    //stop jika sub id_produk tidak ada,
                    $perintah = 'SELECT PROD_ID FROM ma2001 WHERE PROD_ID ="' . $dt . '"';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                    }
                    $produk = mysqli_fetch_row($query);

                    //ambil semua rules sub produk ini
                    //hitung jumlah risk kecuali perusahaan ini supaya total tidak melebihi 100
                    $perintah = 'SELECT SHA_ENTITY,SHA_SYSTEM_ID,SHA_RISK,SHA_ENTITY FROM ma2003 WHERE PROD_ID ="' . $produk[0] . '"';
                    //$perintah = 'SELECT SHA_ENTITY,SHA_SYSTEM_ID FROM ma2003 WHERE PROD_ID ="' . $produk[0] . '"';
                    $query = mysqli_query($conection, $perintah);
                    $rules = array();
                    $totalRisk = 0;
                    while($row=mysqli_fetch_array($query)){
                        $rules[$row['SHA_ENTITY']] = $row['SHA_SYSTEM_ID'];
                        $totalRisk += $row['SHA_RISK'];
                    }
                    if (array_key_exists($dt1, $rules)) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Partner pada Produk ini sudah memiliki Business Rules')));
                    }
                    if ($dt2 > (100 - $totalRisk)) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Total Porsi Resiko Keseluruhan Lebih Besar dari 100%')));
                    }
                    
                    //ambil data perusahaan
                    $sql = 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001';
                    $query = mysqli_query($conection, $sql);
                    $entity = array();
                    while($row=mysqli_fetch_array($query)){
                        $entity[$row['ENTITY_ID']] = $row['ENTITY_NAMA'];
                    }
                    if(!array_key_exists($dt1,$entity)){
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Partner tidak ditemukan')));
                    }

                    mysqli_autocommit($conection,false);
                    $all_query_ok = true;

                    $sql = 'INSERT INTO ma2003 (BANK_REKENING,NO_REKENING,NAMA_REKENING,PROD_ID,SHA_ENTITY,SHA_ENTITY_LEVEL,SHA_RISK,SHA_STATUS)'.
                    ' VALUES ("'.$dt11.'","'.$dt10.'","'.$dt12.'","' . $produk[0] . '","' . $dt1 . '",'.$dt4.',' . $dt2 . ',' . $dt3 . ')';
                    if(!mysqli_query($conection, $sql)){
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal menambah bussiness rules.-')));
                    }
                    $system_id_take = mysqli_insert_id($conection);

                    $valKomisi = '';
                    //Menerima komisi
                    if(isset($_POST["ppn"]) && isset($_POST["pph23"]) && isset($_POST["komisi"]) && isset($_POST["penanggung"])){
                        //untuk semua kiriman penanggung, cek dengan data perusahaan
                        foreach($_POST["penanggung"] as $index=>$penanggung){
                            //jika ada perusahaan (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX),
                            if(array_key_exists($penanggung,$rules)){
                                $valKomisi .= '('.$system_id_take.','.$rules[$penanggung].','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi"][$index])).','.
                                    '"'.(($_POST["ppn"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph23"][$index]=='n')?'n':'y').'"),';
                            }else{
                                //jika belum punya rules maka buat rules
                                $sql = 'INSERT INTO ma2003 (PROD_ID,SHA_ENTITY,SHA_RISK,SHA_STATUS)'.
                                ' VALUES ("' . $produk[0] . '","' . $penanggung . '",0,0)';
                                if(!mysqli_query($conection, $sql)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal membuat bussiness rules.')));
                                }
                                $system_id_give = mysqli_insert_id($conection);
                                //tambahkan ke variable rules
                                $rules[$penanggung] = $system_id_give;
                                $valKomisi .= '('.$system_id_take.','.$system_id_give.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi"][$index])).','.
                                    '"'.(($_POST["ppn"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph23"][$index]=='n')?'n':'y').'"),';
                            }
                        }
                    }
                    //Memberi komisi
                    if(isset($_POST["ppn2"]) && isset($_POST["pph232"]) && isset($_POST["komisi2"]) && isset($_POST["penanggung2"])){
                        //untuk semua kiriman penanggung, cek dengan data perusahaan
                        foreach($_POST["penanggung2"] as $index=>$penanggung){
                            //jika ada perusahaan (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX),
                            if(array_key_exists($penanggung,$rules)){
                                $valKomisi .= '('.$rules[$penanggung].','.$system_id_take.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi2"][$index])).','.
                                    '"'.(($_POST["ppn2"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph232"][$index]=='n')?'n':'y').'"),';
                            }else{
                                //jika belum punya rules maka buat rules
                                $sql = 'INSERT INTO ma2003 (PROD_ID,SHA_ENTITY,SHA_RISK,SHA_STATUS)'.
                                ' VALUES ("' . $produk[0] . '","' . $penanggung . '",0,0)';
                                if(!mysqli_query($conection, $sql)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal membuat bussiness rules..')));
                                }
                                $system_id_give = mysqli_insert_id($conection);
                                //tambahkan ke variable rules
                                $rules[$penanggung] = $system_id_give;
                                $valKomisi .= '('.$system_id_give.','.$system_id_take.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi2"][$index])).','.
                                    '"'.(($_POST["ppn2"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph232"][$index]=='n')?'n':'y').'"),';
                            }
                        }
                    }
                    
                    if($valKomisi != ''){
                        $valKomisi = substr($valKomisi,0,-1);
                        $sqlKomisi = 'INSERT INTO ma2004 (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX) '.
                            ' VALUES '.$valKomisi;
                        if(!mysqli_query($conection,$sqlKomisi)){
                            mysqli_rollback($conection);
                            die(json_encode(array(false, 'pesan' => 'Gagal menambah komisi.')));
                        }
                    }
                    //simpan
                    mysqli_commit($conection);
                    unset($_SESSION['token']);
                    die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "business_rules_detail_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["id"]));
                    $dt0 = mysqli_escape_string($conection, purifier($_POST["id2"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["partner"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["porsi"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["status"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["level"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["dana_in_no"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["dana_in_bank"]));
                    $dt12 = mysqli_escape_string($conection, purifier($_POST["dana_in_nama"]));

                    if( ! in_array($dt4,array(0,1)))
                    {
                        $dt4 = "NULL";
                    }

                    //stop jika sub id_produk tidak ada,
                    $perintah = 'SELECT PROD_ID FROM ma2001 WHERE PROD_ID ="' . $dt . '"';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Produk tidak ditemukan')));
                    }
                    $produk = mysqli_fetch_row($query);
                    
                    //ambil semua rules sub produk ini
                    //hitung jumlah risk kecuali perusahaan ini supaya total tidak melebihi 100
                    $perintah = 'SELECT SHA_ENTITY,SHA_SYSTEM_ID,SHA_RISK,SHA_ENTITY FROM ma2003 WHERE PROD_ID ="' . $produk[0] . '"';
                    $query = mysqli_query($conection, $perintah);
                    $totalRisk = 0;
                    $system_id_take = null;
                    $rules = array();
                    while($row=mysqli_fetch_array($query)){
                        $rules[$row['SHA_ENTITY']] = $row['SHA_SYSTEM_ID'];
                        if($row['SHA_ENTITY']==$dt0 && $dt0==$dt1){
                            $system_id_take = $row['SHA_SYSTEM_ID'];
                        }else{
                            $totalRisk += $row['SHA_RISK'];
                        }
                    }
                    if ($dt2 > (100 - $totalRisk)) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Total Porsi Resiko Keseluruhan Lebih Besar dari 100%')));
                    }
                    if(is_null($system_id_take)){
                        die(json_encode(array(false, 'pesan' => 'Rules Partner tidak ditemukan')));
                    }

                    //ambil data perusahaan
                    $sql = 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001';
                    $query = mysqli_query($conection, $sql);
                    $entity = array();
                    while($row=mysqli_fetch_array($query)){
                        $entity[$row['ENTITY_ID']] = $row['ENTITY_NAMA'];
                    }
                    if(!array_key_exists($dt1,$entity)){
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Partner tidak ditemukan')));
                    }
                    
                    mysqli_autocommit($conection,false);
                    $all_query_ok = true;

                    $sql = ' UPDATE ma2003 SET BANK_REKENING="'.$dt11.'",NO_REKENING="'.$dt10.'",NAMA_REKENING="'.$dt12.'",SHA_RISK=' . $dt2 . ',SHA_STATUS=' . $dt3 . ',SHA_ENTITY_LEVEL=' . $dt4 . ' WHERE SHA_SYSTEM_ID='.$system_id_take.' AND SHA_ENTITY="' . $dt0 . '" AND PROD_ID="' . $produk[0] . '"';
                    if(!mysqli_query($conection, $sql)){
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal mengubah bussiness rules.-')));
                    }
                    //hapus menerima dan memberi untuk perusahaan ini
                    $sql = ' DELETE FROM ma2004 WHERE SHA_SYSTEM_ID_TAKE='.$system_id_take.' OR SHA_SYSTEM_ID_GIVE='.$system_id_take;
                    if(!mysqli_query($conection, $sql)){
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal mengubah bussiness rules.')));
                    }
                    $valKomisi = ''; // var untuk menerima dan memberi komisi
                    //Menerima komisi
                    if(isset($_POST["ppn"]) && isset($_POST["pph23"]) && isset($_POST["komisi"]) && isset($_POST["penanggung"])){
                        //untuk semua kiriman penanggung, cek dengan data perusahaan
                        foreach($_POST["penanggung"] as $index=>$penanggung){
                            //jika ada perusahaan (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX),
                            if(array_key_exists($penanggung,$rules)){
                                $valKomisi .= '('.$system_id_take.','.$rules[$penanggung].','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi"][$index])).','.
                                    '"'.(($_POST["ppn"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph23"][$index]=='n')?'n':'y').'"),';
                            }else{
                                //jika belum punya rules maka buat rules
                                $sql = 'INSERT INTO ma2003 (PROD_ID,SHA_ENTITY,SHA_RISK,SHA_STATUS)'.
                                ' VALUES ("' . $produk[0] . '","' . $penanggung . '",0,0)';
                                if(!mysqli_query($conection, $sql)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal membuat bussiness rules ')));
                                }
                                $system_id_give = mysqli_insert_id($conection);
                                //tambahkan ke variable rules
                                $rules[$penanggung] = $system_id_give;
                                $valKomisi .= '('.$system_id_take.','.$system_id_give.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi"][$index])).','.
                                    '"'.(($_POST["ppn"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph23"][$index]=='n')?'n':'y').'"),';
                            }
                        }
                    }
                    //Memberi komisi
                    if(isset($_POST["ppn2"]) && isset($_POST["pph232"]) && isset($_POST["komisi2"]) && isset($_POST["penanggung2"])){
                        //untuk semua kiriman penanggung, cek dengan data perusahaan
                        foreach($_POST["penanggung2"] as $index=>$penanggung){
                            //jika ada perusahaan (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX),
                            if(array_key_exists($penanggung,$rules)){
                                $valKomisi .= '('.$rules[$penanggung].','.$system_id_take.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi2"][$index])).','.
                                    '"'.(($_POST["ppn2"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph232"][$index]=='n')?'n':'y').'"),';
                            }else{
                                //jika belum punya rules maka buat rules
                                $sql = 'INSERT INTO ma2003 (PROD_ID,SHA_ENTITY,SHA_RISK,SHA_STATUS)'.
                                ' VALUES ("' . $produk[0] . '","' . $penanggung . '",0,0)';
                                if(!mysqli_query($conection, $sql)){
                                    mysqli_rollback($conection);
                                    die(json_encode(array(false, 'pesan' => 'Gagal membuat bussiness rules ')));
                                }
                                $system_id_give = mysqli_insert_id($conection);
                                //tambahkan ke variable rules
                                $rules[$penanggung] = $system_id_give;
                                $valKomisi .= '('.$system_id_give.','.$system_id_take.','.
                                    mysqli_escape_string($conection, purifier($_POST["komisi2"][$index])).','.
                                    '"'.(($_POST["ppn2"][$index]=='n')?'n':'y').'",'.
                                    '"'.(($_POST["pph232"][$index]=='n')?'n':'y').'"),';
                            }
                        }
                    }
                    
                    if($valKomisi != ''){
                        $valKomisi = substr($valKomisi,0,-1);
                        $sqlKomisi = 'INSERT INTO ma2004 (SHA_SYSTEM_ID_TAKE,SHA_SYSTEM_ID_GIVE,KOMISI_NUM,KOMISI_WITH,KOMISI_TAX) '.
                            ' VALUES '.$valKomisi;
                        if(!mysqli_query($conection,$sqlKomisi)){
                            mysqli_rollback($conection);
                            die(json_encode(array(false, 'pesan' => 'Gagal mengubah komisi.')));
                        }
                    }
                    //simpan
                    mysqli_commit($conection);
                    unset($_SESSION['token']);
                    die(json_encode(array(true, 'pesan' => 'Berhasil di ubah')));
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;

            case "business_rules_detail_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["id"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    //stop jika id_produk tidak ada,
                    $perintah = 'SELECT SHA_SYSTEM_ID FROM ma2003 WHERE PROD_ID ="' . $dt1 . '" AND SHA_ENTITY="' . $dt2 . '"';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Bussiness Rules tidak ditemukan')));
                    }
                    $id = mysqli_fetch_row($query)[0];
                    mysqli_autocommit($conection,false);
                    $perintah2 = 'DELETE FROM ma2004 WHERE SHA_SYSTEM_ID_GIVE=' . $id . ' OR SHA_SYSTEM_ID_TAKE=' . $id;
                    $perintah = 'DELETE FROM ma2003 WHERE PROD_ID="' . $dt1 . '" AND SHA_ENTITY="' . $dt2 . '"';
                    if (mysqli_query($conection, $perintah) && mysqli_query($conection, $perintah2)) {
                        //kalau true sesi dihapus
                        mysqli_commit($conection);
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;    

            case "sektor_usaha_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    //stop jika SUSA_ID = ENTITY_ID sudah ada
                    $perintah = 'SELECT SUSA_ID FROM ma9002 WHERE SUSA_ID ="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="'.$dt.'"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 1) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Sektor Usaha sudah ada')));
                    }

                    $perintah = 'INSERT INTO ma9002 (ENTITY_ID, SUSA_ID, SUSA_NAMA, PROD_ID) ' .
                        ' VALUES ("' . $_SESSION['user_cli_group'] . '","' . $dt1 . '","' . $dt2 . '", "'.$dt.'")';
                    if (mysqli_query($conection, $perintah)) {
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan---')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "sektor_usaha_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));

                    //stop jika (susa tidak ada)==0 atau
                    $perintah = 'SELECT SUSA_ID,ENTITY_ID FROM ma9002 WHERE SUSA_ID ="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="'.$dt.'"';
                    $query = mysqli_query($conection, $perintah);
                    $jumlah = mysqli_num_rows($query);
                    if ($jumlah == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Sektor Usaha tidak ditemukan')));
                    }

                    $perintah = ' UPDATE ma9002 SET SUSA_NAMA="' . $dt2 . '"' .
                        ' WHERE SUSA_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND PROD_ID="' . $dt . '"';

                    if (mysqli_query($conection, $perintah)) {
                        die(json_encode(array(true, 'pesan' => 'Berhasil di ubah')));
                        unset($_SESSION['token']);
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di ubah')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                    }
                break;

            case "sektor_usaha_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));

                    // stop jika SUSA_ID tidak ada dan
                    // memiliki data nasabah

                    $perintah = 'SELECT SUSA_ID FROM ma9002 WHERE PROD_ID="'.$dt.'" AND SUSA_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Sektor Usaha tidak ditemukan')));
                    }

                    $perintah = 'SELECT SUSA_ID FROM tr0001 WHERE SUSA_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Sektor Usaha masih memiliki hubungan dengan data nasabah')));
                    }

                    $perintah = 'DELETE FROM ma9002 WHERE PROD_ID="'.$dt.'" AND SUSA_ID ="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_query($conection, $perintah)) {
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;

            case "cabang_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["provinsi"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["kabupaten"]));
                    $dt5 = mysqli_escape_string($conection, purifier($_POST["kecamatan"]));
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["kelurahan"]));
                    $dt7 = explode(',', mysqli_escape_string($conection, purifier($_POST["koord"])));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["status"]));

                    $dt9 = mysqli_escape_string($conection, purifier($_POST["bank_rekening"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["no_rekening"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["nama_rekening"]));

                    $perintah = 'SELECT a.`no` FROM daerah3 a ' .
                        ' JOIN `daerah3` b ON b.kode_wilayah_bps=a.mst_kode_wilayah_bps ' .
                        ' JOIN `daerah3` c ON c.kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' JOIN `daerah3` d ON d.kode_wilayah_bps=c.mst_kode_wilayah_bps ' .
                        ' WHERE d.kode_wilayah_bps="' . $dt3 . '" AND c.kode_wilayah_bps="' . $dt4 . '" AND b.kode_wilayah_bps="' . $dt5 . '" AND a.kode_wilayah_bps="' . $dt6 . '" ' .
                        ' AND a.level=4 AND b.level=3 AND c.level=2 AND d.level=1';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Wilayah tidak ditemukan')));
                    }
                    $perintah = 'SELECT ID_KEY FROM ma1003 WHERE PROD_ID="'.$dt.'" AND LOKASI_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 1) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Cabang sudah digunakan')));
                    }
                    if (count($dt7) != 2) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Koordinat Salah')));
                    }
                    mysqli_autocommit($conection, false);
                    $all_query_ok = true;
                    //tambah cabang
                    $perintah = 'INSERT INTO ma1003 (PROD_ID,ENTITY_ID,LOKASI_ID,LOKASI_PROVINSI ' .
                        ', LOKASI_KABUPATEN,LOKASI_KECAMATAN,LOKASI_KELURAHAN,LOKASI_NAMA,LOKASI_STATUS ' .
                        ', lat,lng,BANK_REKENING,NO_REKENING,NAMA_REKENING ) VALUES ("'.$dt.'","' . $_SESSION['user_cli_group'] . '", ' .
                        ' "' . $dt1 . '","' . $dt3 . '","' . $dt4 . '","' . $dt5 . '","' . $dt6 . '",' .
                        ' "' . $dt2 . '",' . $dt8 . ',"' . $dt7[0] . '","' . $dt7[1] . '","'.$dt9.'","'.$dt10.'","'.$dt11.'")';
                    mysqli_query($conection, $perintah)? null : $all_query_ok = false;
                    $id_key = mysqli_insert_id($conection);
                    //tambah permission untuk input/upload/delete nasabah cabang
                    $sql = 'INSERT INTO permissions (title) VALUES '.
                    '("input_data_cabang_mekaar_'.$id_key.'")'.
                    ',("upload_data_cabang_mekaar_'.$id_key.'")'.
                    ',("delete_input_data_cabang_mekaar_'.$id_key.'")'.
                    ',("delete_upload_data_cabang_mekaar_'.$id_key.'")'.
                    ',("paid_data_cabang_mekaar_'.$id_key.'")'.
                    ';';
                    mysqli_query($conection, $sql)? null : $all_query_ok = false;
                    if ($all_query_ok) {
                        //kalau true sesi dihapus
                        mysqli_commit($conection);
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan----')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "cabang_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt0 = mysqli_escape_string($conection, purifier($_POST["id2"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));
                    $dt2 = mysqli_escape_string($conection, purifier($_POST["nama"]));
                    $dt3 = mysqli_escape_string($conection, purifier($_POST["provinsi"]));
                    $dt4 = mysqli_escape_string($conection, purifier($_POST["kabupaten"]));
                    $dt5 = mysqli_escape_string($conection, purifier($_POST["kecamatan"]));
                    $dt6 = mysqli_escape_string($conection, purifier($_POST["kelurahan"]));
                    $dt7 = explode(',', mysqli_escape_string($conection, purifier($_POST["koord"])));
                    $dt8 = mysqli_escape_string($conection, purifier($_POST["status"]));

                    $dt9 = mysqli_escape_string($conection, purifier($_POST["bank_rekening"]));
                    $dt10 = mysqli_escape_string($conection, purifier($_POST["no_rekening"]));
                    $dt11 = mysqli_escape_string($conection, purifier($_POST["nama_rekening"]));

                    $perintah = 'SELECT a.`no` FROM daerah3 a ' .
                        ' JOIN `daerah3` b ON b.kode_wilayah_bps=a.mst_kode_wilayah_bps ' .
                        ' JOIN `daerah3` c ON c.kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
                        ' JOIN `daerah3` d ON d.kode_wilayah_bps=c.mst_kode_wilayah_bps ' .
                        ' WHERE d.kode_wilayah_bps="' . $dt3 . '" AND c.kode_wilayah_bps="' . $dt4 . '" AND b.kode_wilayah_bps="' . $dt5 . '" AND a.kode_wilayah_bps="' . $dt6 . '" ' .
                        ' AND a.level=4 AND b.level=3 AND c.level=2 AND d.level=1';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Wilayah tidak ditemukan')));
                    }
                    $perintah = 'SELECT * FROM ma1003 WHERE PROD_ID="'.$dt.'" AND LOKASI_ID="' . $dt0 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Cabang pada Produk ini tidak ditemukan')));
                    }
                    if (count($dt7) != 2) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Koordinat Salah')));
                    }
                    $perintah = ' UPDATE ma1003 SET PROD_ID="'.$dt.'", LOKASI_PROVINSI="' . $dt3 . '", LOKASI_KABUPATEN="' . $dt4 . '"' .
                        ', LOKASI_KECAMATAN="' . $dt5 . '", LOKASI_KELURAHAN="' . $dt6 . '", LOKASI_NAMA="' . $dt2 . '", LOKASI_ID="'.$dt1.'"' .
                        ', LOKASI_STATUS="' . $dt8 . '", lat="' . $dt7[0] . '",lng="' . $dt7[1] . '"' .
                        ', BANK_REKENING="'.$dt9.'", NO_REKENING="'.$dt10.'", BANK_REKENING="'.$dt11.'" '.
                        ' WHERE LOKASI_ID="' . $dt0 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';

                    if (mysqli_query($conection, $perintah)) {
                        die(json_encode(array(true, 'pesan' => 'Berhasil di ubah')));
                        unset($_SESSION['token']);
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Gagal di ubah')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;

            case "cabang_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $dt = mysqli_escape_string($conection, purifier($_POST["prod"]));
                    $dt1 = mysqli_escape_string($conection, purifier($_POST["kode"]));

                    // stop jika LOKASI_ID tidak ada dan
                    // memiliki data detail,cabang,nasabah

                    $perintah = 'SELECT ID_KEY FROM ma1003 WHERE PROD_ID="'.$dt.'" AND LOKASI_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    $query = mysqli_query($conection, $perintah);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Kode Cabang tidak ditemukan')));
                    }
                    $data = mysqli_fetch_array($query);

                    $perintah = 'SELECT CABANG_ID FROM tr0001 WHERE CABANG_ID="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    if (mysqli_num_rows(mysqli_query($conection, $perintah)) > 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Cabang masih memiliki hubungan dengan data nasabah')));
                    }

                    mysqli_autocommit($conection, false);
                    $all_query_ok = true;

                    //hapus cabang
                    $perintah = 'DELETE FROM ma1003 WHERE PROD_ID="'.$dt.'" AND LOKASI_ID ="' . $dt1 . '" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    mysqli_query($conection, $perintah) ? null : $all_query_ok = false;
                    
                    //hapus permission input/upload/delete nasabah cabang
                    $perintah = 'DELETE FROM permissions WHERE '.
                        ' title LIKE "input_data_cabang_mekaar_'.$data['ID_KEY'].'" OR '.
                        ' title LIKE "upload_data_cabang_mekaar_'.$data['ID_KEY'].'" OR '.
                        ' title LIKE "delete_input_data_cabang_mekaar_'.$data['ID_KEY'].'" OR '.
                        ' title LIKE "delete_upload_data_cabang_mekaar_'.$data['ID_KEY'].'" OR '.
                        ' title LIKE "paid_data_cabang_mekaar_'.$data['ID_KEY'].'"';
                    mysqli_query($conection, $perintah) ? null : $all_query_ok = false;

                    //hapus user cabang
                    $perintah = 'DELETE FROM ma0001 WHERE CABANG_KEY='.$data['ID_KEY'];
                    mysqli_query($conection, $perintah) ? null : $all_query_ok = false;

                    if ($all_query_ok) {
                        mysqli_commit($conection);
                        //kalau true sesi dihapus
                        unset($_SESSION['token']);
                        die(json_encode(array(true, 'pesan' => 'Berhasil di Hapus')));
                    } else {
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal di Hapus')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "cabang_user_tambah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $em = strtolower(mysqli_escape_string($conection, purifier($_POST['email'])));
                    $email = filter_var($em, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }

                    $dt = mysqli_escape_string($conection, purifier($_POST["cabang"]));
                    $un = strtolower(mysqli_escape_string($conection, purifier($_POST["username"])));
                    $ps = strtolower(mysqli_escape_string($conection, purifier($_POST["password"])));

                    $sql = 'SELECT PROD_ID,LOKASI_ID,LOKASI_NAMA FROM ma1003 WHERE ID_KEY='.$dt.' AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Cabang tidak ditemukan')));
                    }

                    //cari id permissions input/upload/delete nasabah cabang
                    $sql = 'SELECT id FROM permissions WHERE title IN ('.
                        '"input_data_cabang_mekaar_'.$dt.'"'.
                        ',"upload_data_cabang_mekaar_'.$dt.'"'.
                        ',"delete_input_data_cabang_mekaar_'.$dt.'"'.
                        ',"delete_upload_data_cabang_mekaar_'.$dt.'"'.
                        ',"paid_data_cabang_mekaar_'.$dt.'"'.
                        ',"access_produk_mekaar"'.
                        ',"access_data_baru_mekaar"'.
                        ',"access_data_aktif_mekaar"'.
                    ')';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Gagal!, Permission Cabang tidak ditemukan')));
                    }
                    $permission = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    
                    $sql = '(SELECT CLI_USER_ID id,CLI_EMAIL email ' .
                        ' FROM ma0001 ' .
                        ' WHERE (CLI_EMAIL LIKE "' . $em . '" OR CLI_USER_ID LIKE "' . $un . '") ' .
                        ' ) UNION (' .
                        ' SELECT ENTITY_ID id,ENTITY_EMAIL email' .
                        ' FROM ma1001 ' .
                        ' WHERE (ENTITY_ID LIKE "' . $un . '") ' .
                        ' )';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        mysqli_autocommit($conection, false);
                        $all_query_ok = true;

                        //tambah user
                        $perintah = 'INSERT INTO ma0001 (CLI_SYSTEM_ID,CLI_USER_ID,CLI_GROUP,CLI_EMAIL,CLI_PASSWORD,CLI_PHONE,CLI_ERROR,CABANG_KEY)  VALUES (NULL,"'.$un.'","'. $_SESSION['user_cli_group'] .'","'.strtolower($em).'","'.$ps.'","",0,'.$dt.')';
                        mysqli_query($conection, $perintah)?null:$all_query_ok=false;
                        $cli_system_id = mysqli_insert_id($conection);

                        //tambah/hubungkan user permission untuk input/upload/delete nasabah cabang
                        $permission = array_map(function($x) use($cli_system_id) {return '('.$cli_system_id.','.$x['id'].')';}, $permission);
                        $perintah = 'INSERT INTO users_permissions (user_id,permission_id) VALUES '.implode(',',$permission);
                        mysqli_query($conection, $perintah)?null:$all_query_ok=false;

                        if ($all_query_ok) {
                            mysqli_commit($conection);
                            //kalau true sesi dihapus
                            unset($_SESSION['token']);
                            die(json_encode(array(true, 'pesan' => 'Berhasil di Tambahkan')));
                        } else {
                            die(json_encode(array(false, 'pesan' => 'Gagal di Tambahkan-')));
                        }
                        mysqli_query($conection, $sql1) ? null : $all_query_ok = false;
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Username / Email sudah terdaftar')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "cabang_user_ubah":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    //belum selesai
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "cabang_user_hapus":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    //belum selesai
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case "dibayar_klaim":
                //cek token crsf
                if (@hash_equals($_SESSION['token'], $_POST['token'])) {
                    $id_kewajiban = json_decode($_POST["kode"]);
                    if (count($id_kewajiban) == 0) {
                        die(json_encode(array(false, 'pesan' => 'Tidak ada data terpilih')));
                    }
                    $id_kewajiban = array_filter($id_kewajiban, function($x){return is_numeric($x);});
                    //ambil semua kewajiban resiko yg dipilih
                    $sql = 'SELECT a.is_reas,a.is_from_reas,a.BANK_REKENING BANKREK_TUJUAN,a.NO_REKENING NOREK_TUJUAN,a.NAMA_REKENING NAMAREK_TUJUAN '.
                        ' ,a.KEWAJIBAN_SYSTEM_ID,a.TRX_DETAIL_SYSTEM_ID,a.KEWAJIBAN_STATUS,a.ENTITY_ID,a.NILAI,a.PAYMENT_SYSTEM_ID '.
                        ' ,b.SUB_PROD_ID'.
                        ' ,c.BANK_REKENING BANKREK_CABANG,c.NO_REKENING NOREK_CABANG,c.NAMA_REKENING NAMAREK_CABANG '.
                        ' FROM tr0004_b2c a '.
                        ' JOIN tr0002_b2c b ON b.TRX_DETAIL_SYSTEM_ID=a.TRX_DETAIL_SYSTEM_ID AND b.TRX_PARENT="tr0001" ' . 
                        ' JOIN tr0001 c ON c.TRX_UUID=b.TRX_SYSTEM_ID ' . 
                        ' WHERE a.KEWAJIBAN_STATUS=0 AND a.KEWAJIBAN_SYSTEM_ID IN ("' . implode('","', $id_kewajiban) . '") AND a.ENTITY_ID="'.$_SESSION['user_cli_group'].'"'.
                        '';
                    $query = mysqli_query($conection, $sql);
                    if(mysqli_num_rows($query)==0){
                        die(json_encode(array(false, 'pesan' => 'Kewajiban tidak ditemukan')));
                    }
                    $kewajiban = array();
                    $arrDetail = array();
                    $arrSudahBayarSemua = array();
                    $arrReasBayarKeAsuransi = array();
                    //-----
                    mysqli_autocommit($conection, FALSE);
                    $all_query_ok = true;

                    $datetime = new DateTime();
                    $paymentUUID = generateUUID();

                    $perusahaanAsuransiSub = array();
                    $tagihanAsuransiFromReas = array();
                    $asuransi = array();
                    $receivedAsuransiFromReas = array();
                    $rekening = null;
                    $totalBayar = 0;
                    while($row = mysqli_fetch_array($query)){
                        $kewajiban[] = $row['KEWAJIBAN_SYSTEM_ID'];
                        if( ! in_array($row['TRX_DETAIL_SYSTEM_ID'],$arrDetail))
                        {
                            $arrDetail[] = $row['TRX_DETAIL_SYSTEM_ID'];
                        }
                        $totalBayar += $row['NILAI'];
                        if(is_null($rekening)) $rekening = array('no'=>$row['NOREK_TUJUAN'],'bank'=>$row['BANKREK_TUJUAN'],'nama'=>$row['NAMAREK_TUJUAN']);

                        //jika reas bayar ke asuransi
                        if($row['is_reas'] == 1)
                        {
                            if( ! array_key_exists($row['SUB_PROD_ID'],$asuransi))
                            {
                                $sql = 'SELECT SHA_ENTITY FROM ma2003 WHERE PROD_ID="'.$row['SUB_PROD_ID'].'" AND SHA_ENTITY_LEVEL=0 ';
                                $query = mysqli_query($conection,$sql);
                                if(mysqli_num_rows($query)==0){
                                    die(json_encode(array(false, 'pesan' => 'Sub Prod tidak punya asuransi')));
                                }
                                $asuransi[$row['SUB_PROD_ID']] = mysqli_fetch_array($query);
                            }
                            //tambahkan rekening cabang ke target pembayaran asuransi
                            $tagihanAsuransiFromReas[] = '("' . $row['TRX_DETAIL_SYSTEM_ID'] . '"' .
                                ',"' . $asuransi[$row['SUB_PROD_ID']]['SHA_ENTITY'] . '"' .
                                ',' . $row['NILAI'] .
                                ',"'.$row['BANKREK_CABANG'].'","'.$row['NOREK_CABANG'].'","'.$row['NAMAREK_CABANG'].'"' .
                                ',' .$row['KEWAJIBAN_SYSTEM_ID'] .  //relasi KEWAJIBAN_SYSTEM_ID_REASURANSI
                                ',0,0,1)';//kewajiban status = new, is_reas, is_from_reas

                            if( ! array_key_exists($asuransi[$row['SUB_PROD_ID']]['SHA_ENTITY'], $receivedAsuransiFromReas)){
                                $receivedAsuransiFromReas[ $asuransi[$row['SUB_PROD_ID']]['SHA_ENTITY'] ] = array(
                                    'NILAI' => 0,
                                    //received_from_rekening, kosong karena rekening asal tidak diketahui 
                                    'REKENING_BANK' => '','REKENING_NO' => '','REKENING_NAMA' => '',
                                );
                            }

                            $receivedAsuransiFromReas[ $asuransi[$row['SUB_PROD_ID']]['SHA_ENTITY'] ]['NILAI'] += $row['NILAI'];
                        }
                        else
                        {

                        }
                    }
                    //insert payment
                    $sqlPayment = 'INSERT INTO py0001_b2c (PAYMENT_SYSTEM_ID,PAYMENT_DATE,CLI_GROUP,PAYMENT_AMOUNT,VA_BANK,VA_NO,VA_NAMA,`STATUS`,PAYMENT_TYPE) '.
                        'VALUES ("'.$paymentUUID.'","'.$datetime->format('Y-m-d H:i:s').'","'.$_SESSION['user_cli_group'].'",'.$totalBayar.',"'.$rekening['bank'].'","'.$rekening['no'].'","'.$rekening['nama'].'",0,1)';
                    mysqli_query($conection,$sqlPayment)? null : $all_query_ok=false;

                    //update untuk semua kewajiban yg dipilih
                    $sqlUpdateKewajiban = 'UPDATE tr0004_b2c SET KEWAJIBAN_STATUS=1,PAYMENT_SYSTEM_ID="'.$paymentUUID.'"'.
                        ' WHERE KEWAJIBAN_SYSTEM_ID IN ("'.implode('","', $kewajiban).'")';
                    mysqli_query($conection,$sqlUpdateKewajiban)? null : $all_query_ok=false;

                    //jika re asuransi yg membayar, 
                    //tambahkan kewajiban baru untuk asuransi supaya meneruskan pembayaran ke pnm
                    if(count($tagihanAsuransiFromReas)>0)
                    {
                        $sql = 'INSERT INTO tr0004_b2c (TRX_DETAIL_SYSTEM_ID,ENTITY_ID,NILAI,BANK_REKENING,NO_REKENING,NAMA_REKENING,KEWAJIBAN_SYSTEM_ID_REASURANSI,KEWAJIBAN_STATUS,is_reas,is_from_reas) VALUES ' . implode(',',$tagihanAsuransiFromReas);
                        $query = mysqli_query($conection,$sql)? null : $all_query_ok=false;
                        //tambahkan asuransi penerima
                        $datetime = new DateTime();

                        foreach($receivedAsuransiFromReas as $entity => $obj)
                        {
                            $receivedUUID = generateUUID();
                            $sqlPenyaluranDana = 'INSERT INTO py0002_b2c (RECEIVED_SYSTEM_ID,PAYMENT_SYSTEM_ID,RECEIVED_DATE,CLI_GROUP,RECEIVED_AMOUNT,REKENING_BANK,REKENING_NO,REKENING_NAMA) VALUES '.
                                '("'.$receivedUUID.'","'.$paymentUUID.'","'.$datetime->format('Y-m-d H:i:s').'","'.$entity.'"'.
                                ','.$obj['NILAI'].',"'.$obj['REKENING_BANK'].'","'.$obj['REKENING_NO'].'","'.$obj['REKENING_NAMA'].'")';
                            $query = mysqli_query($conection, $sqlPenyaluranDana)? null : $all_query_ok=false;
                        }
                    }
                    //jika asuransi yg membayar
                    else
                    {
                        //update status perubahan diatas kemudian cek lanjutan
                        mysqli_commit($conection);
                        //cek apakah kewajiban semua perusahaan sudah dibayar semua
                        $sql = 'SELECT is_reas,KEWAJIBAN_SYSTEM_ID,PAYMENT_SYSTEM_ID,TRX_DETAIL_SYSTEM_ID,ENTITY_ID,KEWAJIBAN_STATUS,NILAI FROM tr0004_b2c '.
                            ' WHERE TRX_DETAIL_SYSTEM_ID IN ("'.implode('","', $arrDetail).'")';
                        $query = mysqli_query($conection, $sql);
                        $arrSudahBayarSemua = array();
                        $arrKewajiban = array();
                        $detail = array();
                        while($row = mysqli_fetch_array($query))
                        {
                            if(!array_key_exists($row['TRX_DETAIL_SYSTEM_ID'], $arrKewajiban)){
                                $arrSudahBayarSemua[$row['TRX_DETAIL_SYSTEM_ID']] = true;
                                $arrKewajiban[$row['TRX_DETAIL_SYSTEM_ID']] = array();
                            }
                            $arrKewajiban[$row['TRX_DETAIL_SYSTEM_ID']][$row['KEWAJIBAN_SYSTEM_ID']] = array(
                                    'KEWAJIBAN_STATUS'  => $row['KEWAJIBAN_STATUS'],
                                    'NILAI'             => $row['NILAI'],
                                    'ENTITY_ID'         => $row['ENTITY_ID'],
                                    'PAYMENT_SYSTEM_ID' => $paymentUUID,
                                    'is_reas'           => $row['is_reas']
                                );
                            //jika ada perusahaan lain belum memenuhi kewajiban, reas maupun as
                            if($row['KEWAJIBAN_STATUS']==0 && $row['ENTITY_ID'] != $_SESSION['user_cli_group']){
                                $arrSudahBayarSemua[$row['TRX_DETAIL_SYSTEM_ID']] = false;
                            }
                        }
                        //salurkan dana untuk semua perusahaan yg sudah memenuhi kewajiban sub prod 
                        foreach($arrSudahBayarSemua as $TRX_DETAIL_SYSTEM_ID => $sudahBayarSemua){
                            if($sudahBayarSemua){

                                $receivedUUID = generateUUID();

                                $datetime = new DateTime();
                                $totalNilai = 0;
                                $arrPaymentUUID = array();
                                //untuk semua kewajiban kecuali kewajiban reas
                                foreach($arrKewajiban[$TRX_DETAIL_SYSTEM_ID] as $row)
                                {
                                    if($row['is_reas'] == 0){
                                        $arrPaymentUUID[] = $row['PAYMENT_SYSTEM_ID'];
                                        $totalNilai += $row['NILAI'];
                                    }
                                }
                                //belum selesai, harusnya ada rekening pengirim, dan cli_group penerima
                                //ambil rekening penerima dana cabang
                                $sql = 'SELECT c.BANK_REKENING,c.NO_REKENING,c.NAMA_REKENING FROM tr0002_b2c a'.
                                    ' JOIN tr0001 b ON a.TRX_SYSTEM_ID=b.TRX_UUID '.
                                    ' JOIN ma1003 c ON c.LOKASI_ID=b.CABANG_ID '.
                                    ' WHERE a.TRX_DETAIL_SYSTEM_ID = "'.$TRX_DETAIL_SYSTEM_ID.'"';
                                $query = mysqli_query($conection,$sql);
                                $rekening = array('BANK_REKENING'=>'','NO_REKENING'=>'','NAMA_REKENING'=>'');
                                if(mysqli_num_rows($query)>0)
                                {
                                    $rekening = mysqli_fetch_array($query);
                                }
                                //salurkan dana
                                $sqlPenyaluranDana = 'INSERT INTO py0002_b2c (RECEIVED_SYSTEM_ID,RECEIVED_DATE,CLI_GROUP,RECEIVED_AMOUNT,REKENING_BANK'.
                                    ',REKENING_NO,REKENING_NAMA) VALUES '.
                                    '("'.$receivedUUID.'","'.$datetime->format('Y-m-d H:i:s').'","'.$_SESSION['user_cli_group'].'"'.
                                    ','.$totalNilai.',"'.$rekening['BANK_REKENING'].'"'.
                                    ',"'.$rekening['NO_REKENING'].'","'.$rekening['NAMA_REKENING'].'")';
                                mysqli_query($conection,$sqlPenyaluranDana)? null : $all_query_ok=false;
                                //update payment bahwa sudah disalurkan
                                $sqlUpdatePaymentStatus = 'UPDATE py0001_b2c SET `STATUS`=1,RECEIVED_SYSTEM_ID="'.$receivedUUID.'" '.
                                    ' WHERE PAYMENT_SYSTEM_ID IN ("'.implode('","',$arrPaymentUUID).'")';
                                mysqli_query($conection,$sqlUpdatePaymentStatus)?null : $all_query_ok=false;
                                //update status transaksi=claim_paid
                                $sql = 'UPDATE tr0002_b2c SET CLAIM_STATUS=2,RECEIVED_SYSTEM_ID="'.$receivedUUID.'" WHERE TRX_DETAIL_SYSTEM_ID="'.$TRX_DETAIL_SYSTEM_ID.'"';
                                mysqli_query($conection,$sql)? null : $all_query_ok=false;
                            }
                        }
                    }   
                    if($all_query_ok){
                        mysqli_commit($conection);
                        die(json_encode(array(true, 'pesan' => 'Berhasil dibayar klaim')));
                    }else{
                        mysqli_rollback($conection);
                        die(json_encode(array(false, 'pesan' => 'Gagal dibayar klaim')));
                    }
                }else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            
        }
    }else{
        die(json_encode(array(false, 'pesan' => 'Unknown Request-')));
    }
}else{
    die(json_encode(array(false, 'pesan' => 'Unknown Request--')));
}
