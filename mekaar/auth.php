<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'contact.php';
require_once "fungsi.php";
if (isLoggedIn()) {
    if (isAdmin()) {
        die(json_encode(array(true, 'redirect' => './page/biru/')));
    } elseif (isB2B()) {
        die(json_encode(array(true, 'redirect' => './page/client_b2b/')));
    } elseif (isB2C()) {
        die(json_encode(array(true, 'redirect' => './page/client_b2c/')));
    } else {
        session_destroy();
        die(json_encode(array(false)));
    }
}
if ($_POST) {
    if (isset($_POST['type']) && $_POST['type'] != "") {
        switch ($_POST['type']) {
            case "login":
                //cek token crsf
                if (@hash_equals($_SESSION['token_login'], $_POST['token'])) {
                    $nm = strtolower(mysqli_escape_string($conection, trim($_POST['email'])));
                    $ps = strtolower(mysqli_escape_string($conection, trim($_POST['pass']))); // md5
                    //load user
                    //left join company if company (is biru if a.CLI_GROUP=EN000)
                    //join profil (KELURAHAN_ID = KELURAHAN = WILAYAH_CABANG_PERUSAHAAAN)
                    $sql = 'SELECT a.CLI_USER_ID id,a.CLI_EMAIL email,a.CLI_GROUP,a.CLI_PHONE,a.CLI_SYSTEM_ID,a.CABANG_KEY' .
                        ',b.ENTITY_NAMA,b.ENTITY_ALAMAT,b.ENTITY_PIC,b.ENTITY_PIC_PHONE,b.ENTITY_EMAIL,b.ENTITY_JOINT,b.ENTITY_EXPIRY,b.ENTITY_STATUS,b.ENTITY_BANK,b.ENTITY_BANK_NO,b.ENTITY_MOU,b.ENTITY_NPWP,b.ENTITY_BLOCK_ADDR,b.ENTITY_BLOCK_PKEY' .
                        ',c.CLI_NAME,c.CLI_KTP_NO,c.CLI_ADDRESS,c.CLI_KODE_POS,c.KELURAHAN_ID,c.CLI_NPWP,c.CLI_BIRTH_PLACE,c.CLI_BIRTH_DATE,c.CLI_SUMBER_DANA,c.CLI_STATUS,c.CLI_REKENING_NO,c.CLI_REKENING_BANK,c.CLI_REKENING_NAMA,c.CLI_BLOCK_ADDR,c.CLI_BLOCK_PKEY' .
                        ' FROM ma0001 a ' .
                        ' LEFT JOIN ma0003 c ON a.CLI_SYSTEM_ID=c.CLI_SYSTEM_ID ' .
                        ' LEFT JOIN ma1001 b ON a.CLI_GROUP=b.ENTITY_ID ' .
                        ' WHERE (a.CLI_EMAIL LIKE "' . $nm . '" OR a.CLI_PHONE LIKE "' . $nm . '" OR a.CLI_USER_ID LIKE "' . $nm . '") ' .
                        ' AND a.CLI_PASSWORD LIKE "' . $ps . '"';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $user = mysqli_fetch_array($query);
                        //lower key, upper val
                        foreach ($user as $key => $val) {
                            $_SESSION['user_' . strtolower($key)] = strtoupper($val); //convert null to empty string
                        }
                        $sqlPermission = "SELECT b.title FROM users_permissions a JOIN permissions b ON a.permission_id = b.id where a.user_id=".$_SESSION['user_cli_system_id'];
                        $queryPermission = mysqli_query($conection, $sqlPermission);
                        $_SESSION['permissions'] = array();
                        while($row = mysqli_fetch_array($queryPermission))
                        {
                            $_SESSION['permissions'][] = $row['title'];
                        }
                        setConversiBruToIdr();
                        // 1 admin, 
                        // 2 client b2b/perusahaan, 3 client b2c
                        if (!empty($_SESSION['user_entity_nama'])) {
                            $_SESSION['user_tipe'] = 2;
                            die(json_encode(array(true, 'pesan' => 'Berhasil Login', 'redirect' => getUrlServer() . '/page/client_b2b/')));
                        } else {
                            //jika user belum aktif
                            if ($_SESSION['user_cli_status'] == 0) {
                                session_unset();
                                $_SESSION['token_login'] = $_POST['token'];
                                die(json_encode(array(false, 'pesan' => "Akun Anda Belum Aktif, Silakan lakukan aktivasi akun anda dengan mengakses link yang dikirimkan ke email anda!")));
                            }
                            $_SESSION['user_tipe'] = 3;
                            if(isset($_COOKIE['produk']) && isset($_COOKIE['dana'])){
                                die(json_encode(array(true, 'pesan' => 'Berhasil Login', 'redirect' => getUrlServer() . '/page/client_b2c/?p=beli_produk&id='.$_COOKIE['produk'])));
                            }else{
                                die(json_encode(array(true, 'pesan' => 'Berhasil Login', 'redirect' => getUrlServer() . '/page/client_b2c/')));
                            }
                        }
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Email/No Hp/Password salah')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case 'daftar':
                //cek token crsf
                if (@hash_equals($_SESSION['token_daftar'], $_POST['token'])) {
                    $em = strtolower(mysqli_escape_string($conection, trim($_POST['email'])));
                    $email = filter_var($em, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }
                    $un = strtolower(mysqli_escape_string($conection, trim($_POST['username'])));
                    $ps = strtolower(mysqli_escape_string($conection, trim($_POST['pass']))); // md5
                    $ad = strtolower(mysqli_escape_string($conection, trim($_POST['addr']))); 
                    $pk = strtolower(mysqli_escape_string($conection, trim($_POST['pkey']))); 
                    $sql = '(SELECT CLI_USER_ID id,CLI_EMAIL email ' .
                        ' FROM ma0001 ' .
                        ' WHERE (CLI_EMAIL LIKE "' . $em . '" OR CLI_USER_ID LIKE "' . $un . '") ' .
                        ' ) UNION (' .
                        ' SELECT ENTITY_ID id,ENTITY_EMAIL email' .
                        ' FROM ma1001 ' .
                        ' WHERE (ENTITY_EMAIL LIKE "' . $em . '" OR ENTITY_ID LIKE "' . $un . '") ' .
                        ' )';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        mysqli_autocommit($conection, false);
                        $all_query_ok = true;

                        $sql1 = 'INSERT INTO ma0001 (CLI_SYSTEM_ID,CLI_USER_ID,CLI_GROUP,CLI_EMAIL,CLI_PASSWORD,CLI_PHONE,CLI_ERROR) '.
                        ' VALUES (NULL,"'.$un.'","'.$un.'","'.strtolower($em).'","'.$ps.'","",0)';
                        mysqli_query($conection, $sql1) ? null : $all_query_ok = false;
                        $id = mysqli_insert_id($conection);
                        $validasi = md5($id);
                        $sql = 'INSERT INTO ma0003 (CLI_SYSTEM_ID,CLI_VALIDASI_AKUN,CLI_BLOCK_ADDR,CLI_BLOCK_PKEY) VALUES ('.$id.',"'.$validasi.'","'.$ad.'","'.$pk.'")';
                        mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                        if($all_query_ok){
                            mysqli_commit($conection);
                            require './page/vendor/autoload.php';
                            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                            $email_terkirim = false;
                            $url = getUrlServer() . '/page/client_b2c/?p=validasi&key='.$validasi;
                            try {
                                //Server settings
                                //        $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                //$mail->isSMTP();                                            // Send using SMTP
                                //        $mail->Host       = 'localhost';                    // Set the SMTP server to send through
                                //        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                //        $mail->Username   = 'noreply@biru.io';                     // SMTP username
                                //        $mail->Password   = '';                               // SMTP password
                                //        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                                //        $mail->Port       = 25;//587;                                    // TCP port to connect to
                    
                                //Recipients
                                $mail->setFrom('noreply@biru.io', 'Biru Risk');
                                //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                                $mail->addAddress($em); // Name is optional
                                $mail->addReplyTo('no-reply@birurisk.com', 'no-reply');
                                //$mail->addCC('cc@example.com');
                                //$mail->addBCC('bcc@example.com');
                    
                                // Content
                                $mail->isHTML(true); // Set email format to HTML
                                $mail->Subject = 'Validasi email';
                                $output = '<p>Dear user,</p>';
                                $output .= '<p>Please click on the following link to validate your email.</p>';
                                $output .= '<p>-------------------------------------------------------------</p>';
                                $output .= '<p><a href="' . $url . '" target="_blank">' . $url . '</a></p>';
                                $output .= '<p>-------------------------------------------------------------</p>';
                                $output .= '<p>Please be sure to copy the entire link into your browser..</p>';
                                $output .= '<p>Thanks,</p>';
                                $output .= '<p>Birurisk Team</p>';
                    
                                $mail->Body = $output;
                                $mail->AltBody = 'Untuk melakukan validasi email, silakan mengakses alamat website berikut : ' . $url;
                    
                                if ($mail->send()) {
                                    $email_terkirim = true;
                                }
                            } catch (\PHPMailer\PHPMailer\Exception $e) {
                            die(json_encode(array(false, 'err' => 1, 'btnText' => "Pergi ke alamat", 'url' => $url,'pesan' => 'Berhasil melakukan pendaftaran, '."Tidak bisa mengirim email. Mailer Error: {$mail->ErrorInfo}\n"
                                .'Silakan melakukan validasi dengan mengakses alamat berikut '.$url)));
                            }
                            die(json_encode(array(true, 'pesan' => 'Berhasil melakukan pendaftaran, silahkan lakukan validasi email')));
                        }else{
                            mysqli_rollback($conection);
                            die(json_encode(array(false, 'pesan' => 'Gagal melakukan pendaftaran')));
                        }
                    } else {
                        die(json_encode(array(false, 'pesan' => 'Username / Email sudah terdaftar')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case 'reset_password':
                if (@hash_equals($_SESSION['token_reset'], $_POST['token'])) {
                    $email = strtolower(mysqli_escape_string($conection, trim($_POST['email'])));
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }
                    $sql = 'SELECT CLI_EMAIL email,`key` ' .
                        ' FROM ma0001 ' .
                        ' LEFT JOIN password_reset_temp a ON CLI_EMAIL=a.email ' .
                        ' WHERE (CLI_EMAIL LIKE "' . $email . '")';
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 1) {
                        $data = mysqli_fetch_array($query);
                        $expFormat = mktime(
                            date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
                        );
                        $expDate = date("Y-m-d H:i:s", $expFormat);
                        $key = md5((2418 * 2) . $email);
                        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                        $key = $key . $addKey;
                        if ($data['key'] == "NULL" || is_null($data['key'])) {
                            mysqli_query($conection, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");
                        } else {
                            mysqli_query($conection, "UPDATE `password_reset_temp` SET `key`='" . $key . "', `expDate`='" . $expDate . "' WHERE email='" . $email . "';");
                        }
                        require './page/vendor/autoload.php';
                        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                        $email_terkirim = false;
                        $url = getUrlServer() . '/page/client_b2c/?p=reset_password&email='.$email.'&key='.$key;
                        try {
                            //Server settings
                            //        $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                            //$mail->isSMTP();                                            // Send using SMTP
                            //        $mail->Host       = 'localhost';                    // Set the SMTP server to send through
                            //        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            //        $mail->Username   = 'noreply@biru.io';                     // SMTP username
                            //        $mail->Password   = '';                               // SMTP password
                            //        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                            //        $mail->Port       = 25;//587;                                    // TCP port to connect to
                
                            //Recipients
                            $mail->setFrom('noreply@biru.io', 'Biru Risk');
                            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                            $mail->addAddress($email); // Name is optional
                            $mail->addReplyTo('no-reply@birurisk.com', 'no-reply');
                            //$mail->addCC('cc@example.com');
                            //$mail->addBCC('bcc@example.com');
                
                            // Content
                            $mail->isHTML(true); // Set email format to HTML
                            $mail->Subject = 'Reset password akun';
                            $output = '<p>Dear user,</p>';
                            $output .= '<p>Please click on the following link to reset your password.</p>';
                            $output .= '<p>-------------------------------------------------------------</p>';
                            $output .= '<p><a href="' . $url . '" target="_blank">' . $url . '</a></p>';
                            $output .= '<p>-------------------------------------------------------------</p>';
                            $output .= '<p>Please be sure to copy the entire link into your browser. The link will expire after 1 day for security reason.</p>';
                            $output .= '<p>If you did not request this forgotten password email, no action
                                is needed, your password will not be reset. However, you may want to log into
                                your account and change your security password as someone may have guessed it.</p>';
                            $output .= '<p>Thanks,</p>';
                            $output .= '<p>Birurisk Team</p>';
                
                            $mail->Body = $output;
                            $mail->AltBody = 'Untuk mengubah password, silakan akses url berikut : ' . $url;
                
                            if ($mail->send()) {
                                $email_terkirim = true;
                            }
                        } catch (\PHPMailer\PHPMailer\Exception $e) {
                            die(json_encode(array(false, 'err' => 1, 'btnText' => "Pergi ke alamat", 'url' => $url,'pesan' => "Tidak bisa mengirim email. Mailer Error: {$mail->ErrorInfo}\n"
                            .'Silakan melakukan reset password dengan mengakses alamat web berikut '.$url)));
                        }
                        die(json_encode(array(true, 'pesan' => 'Email terkirim, Silahkan lakukan reset password dengan mengakses "alamat web" yang diterima email anda')));
                    }else{
                        die(json_encode(array(false, 'pesan' => 'Email tidak ditemukan')));
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
                break;
            case 'password_baru':
                if (@hash_equals($_SESSION['token_password'], $_POST['token'])) {
                    $email = strtolower(mysqli_escape_string($conection, trim($_POST['email'])));
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                    if (!$email) {
                        die(json_encode(array(false, 'pesan' => 'Alamat email tidak valid, harap menulis alamat email yg valid')));
                    }
                    $pass1 = mysqli_real_escape_string($conection, trim($_POST["pass"]));
                    $key = mysqli_escape_string($conection, trim($_POST['key']));
                    $curDate = date("Y-m-d H:i:s");
                    $sql = "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';";
                    $query = mysqli_query($conection, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        die(json_encode(array(false, 'pesan' => '<h2 style="margin-top:0">Invalid Link</h2><p>The link to Reset Password is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated.</p>')));
                    } else {
                    $row = mysqli_fetch_assoc($query);
                        $expDate = $row['expDate'];
                        if ($expDate >= $curDate) {
                            mysqli_autocommit($conection,false);
                            $all_query_ok = true;
                            $sql = "UPDATE `ma0001` SET `CLI_PASSWORD`='" . $pass1 . "' WHERE `CLI_EMAIL`='" . $email . "';";
                            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                            $sql = "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';";
                            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
                            if($all_query_ok){
                                mysqli_commit($conection);
                                die(json_encode(array(true, 'pesan' =>'Password baru berhasil disimpan')));
                            }else{
                                mysqli_rollback($conection);
                                die(json_encode(array(false, 'pesan' =>'Password baru gagal disimpan')));
                            }
                        }else{
                            die(json_encode(array(false, 'pesan' =>'<h2 style="margin-top:0">Link Expired</h2><p>The link is expired. You are trying to Reset Password use the expired link which as valid only 24 hours (1 days after request).<br /><br /></p>')));
                        }
                    }
                } else {
                    die(json_encode(array(false, 'pesan' => 'Token tidak cocok, silakan muat ulang halaman')));
                    // Log this as a warning and keep an eye on these attempts
                }
            break;
            default:
                die(json_encode(array(false, 'pesan' => '--- Unauthorized ---')));
        }
    } else {
        die(json_encode(array(false, 'pesan' => '-- Unauthorized --')));
    }
} else {
    die(json_encode(array(false, 'pesan' => '- Unauthorized -')));
}