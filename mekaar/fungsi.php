<?php
if (!function_exists('tulisNotif')) {
    function tulisNotif(string $teks, bool $is_new=true, bool $is_noty=true,string $type='alert',int $timeout=5000)
    {
        if($is_new){
            if($is_noty){
                $_SESSION['pesanNoty']="<script>new Noty({
                    text   : '$teks',
                    type   : '$type',
                    timeout: '$timeout'
                }).show()</script>";
            }else{
                $_SESSION['pesan']=$teks;
            }
        }else{
            if($is_noty){
                $_SESSION['pesanNoty']="<script>new Noty({
                    text   : '$teks',
                    type   : '$type',
                    timeout: '$timeout'
                }).show()</script>";
            }else{
                $_SESSION['pesan'] .= EOL . $teks;
            }
        }
    }
    function tulisNotyError(string $teks, string $teksBtn, string $urlBtn){
        $_SESSION['pesanNoty']="<script>let ex=new Noty({
            text   : '$teks',
            type   : 'warning',
            timeout: false,
            buttons: [
                Noty.button('$teksBtn', 'btn btn-success', function () {
                    window.location = '$urlBtn'
                }, {id: 'button1', 'data-status': 'ok'}),
                Noty.button('CLose', 'btn btn-error', function () {
                    ex.close();
                })
            ]
        }).show()</script>";
    }
}
if (!function_exists('getUrlServer')) {
    function getUrlServer()
    {
        return ((isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? 'https' : 'http') .
            '://' . $_SERVER['HTTP_HOST'] . ''; //.
        //substr($_SERVER['SCRIPT_NAME'], 0, (strripos($_SERVER['SCRIPT_NAME'], '/')));
    }
}
if (!function_exists('getOtherServerContent')) {
    function getOtherServerContent($url)
    {
        $ch = curl_init();
        $user_agent = "Googlebot/2.1 (http://www.googlebot.com/bot.html)";
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        $content = curl_exec($ch);
        curl_close($ch);
        return false; //$content;
    }
}
if (!function_exists('formatMoney')) {
    function formatMoney($amount, $decimalCount = 2, $decimal = ",", $thousands = ".") {
        return str_replace(array('.',','),array($decimal,$thousands),sprintf('%.'.$decimalCount.'F', $amount));
    }
}
if (!function_exists('purifier')) {
    function purifier($row){
        require_once 'page/vendor/htmlpurifier-4.12.0-lite/library/HTMLPurifier.auto.php';

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($row);

        return $clean_html;
    }
}
if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        // include "contact.php";

        // Get Current date, time
        $current_time = time();
        $current_date = date("Y-m-d H:i:s", $current_time);

        // Set Cookie expiration for 1 month
        $cookie_expiration_time = $current_time + (30 * 24 * 60 * 60); // for 1 month

        $isLoggedIn = false;

        // Check if loggedin session and redirect if session exists
        if (isset($_SESSION['user_email']) && isset($_SESSION['user_id'])) {
            $isLoggedIn = true;
        }
        // Check if loggedin session exists
        else if (isset($_COOKIE["user_login"]) && isset($_COOKIE["random_password"]) && isset($_COOKIE["random_selector"])) {
            // Initiate auth token verification diirective to false
            $isPasswordVerified = false;
            $isSelectorVerified = false;
            $isExpiryDateVerified = false;

            // Get token for username
            $query = mysqli_query($conection, 'Select * from tbl_token_auth where email = "' . $_COOKIE["user_login"] . '" and is_expired = 0');
            if (mysqli_num_rows($query) != 1) {return false;}
            $userToken = mysqli_fetch_array($query);
            // Validate random password cookie with database
            if (password_verify($_COOKIE["random_password"], $userToken["password_hash"])) {
                $isPasswordVerified = true;
            }

            // Validate random selector cookie with database
            if (password_verify($_COOKIE["random_selector"], $userToken["selector_hash"])) {
                $isSelectorVerified = true;
            }

            // check cookie expiration by date
            if ($userToken[0]["expiry_date"] >= $current_date) {
                $isExpiryDareVerified = true;
            }

            // Redirect if all cookie based validation retuens true
            // Else, mark the token as expired and clear cookies
            if (!empty($userToken[0]["id"]) && $isPasswordVerified && $isSelectorVerified && $isExpiryDareVerified) {
                $isLoggedIn = true;
            } else {
                if (!empty($userToken[0]["id"])) {
                    // $auth->markAsExpired();
                    $query = 'UPDATE tbl_token_auth SET is_expired = 1 WHERE id = ' . $userToken[0]["id"];
                }
                // clear cookies
                //$util->clearAuthCookie();
                if (isset($_COOKIE["user_login"])) {
                    setcookie("user_login", "", time() - 3600);
                }
                if (isset($_COOKIE["random_password"])) {
                    setcookie("random_password", "", time() - 3600);
                }
                if (isset($_COOKIE["random_selector"])) {
                    setcookie("random_selector", "", time() - 3600);
                }
            }
        }
        return $isLoggedIn;
    }
}
if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (isset($_SESSION['user_tipe']) && $_SESSION['user_tipe'] === 1) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('isB2B')) {
    function isB2B()
    {
        if (isset($_SESSION['user_tipe']) && $_SESSION['user_tipe'] === 2) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('isB2C')) {
    function isB2C()
    {
        if (isset($_SESSION['user_tipe']) && $_SESSION['user_tipe'] === 3) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('has_permission')){
    function has_permission($permission){
        if (isset($_SESSION['permissions']) && in_array($permission, $_SESSION['permissions'])) {
            return true;
        }
        return false;
    }
}
if (!function_exists('has_permission_array')){
    function has_permission_array(array $permission){
        if (isset($_SESSION['permissions']) && count(array_intersect($permission, $_SESSION['permissions']))>0) {
            return true;
        }
        return false;
    }
}
if (!function_exists('has_permission_like')){
    function has_permission_like($permission){
        if (isset($_SESSION['permissions']) && count(array_filter($_SESSION['permissions'], function($var) use($permission) { return strlen(strchr($var, $permission)) > 0; })) > 0) {
            return true;
        }
        return false;
    }
}
if (!function_exists('getToken')) {
    function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->cryptoRandSecure(0, $max)];
        }
        return $token;
    }
}
if (!function_exists('generateUUID')){
    function generateUUID(){
        require_once '../vendor/autoload.php';
        try {
            // Generate a version 4 (random) UUID object
            $uuid4 = \Ramsey\Uuid\Uuid::uuid4();
            return $uuid4->toString(); // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
        } catch (\Ramsey\Uuid\Exception\UnsatisfiedDependencyException $e) {
            // Some dependency was not met. Either the method cannot be called on a
            // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
            //echo 'Caught exception: ' . $e->getMessage();
            return random_bytes(36);
        }
    }
}
if (!function_exists('bulanindo')) {
    function bulanindo(int $nilai)
    {
        $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', "Mei", 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        if ($nilai <= 12 && $nilai > 0) {
            return $bulan[$nilai];
        } else {
            return false;
        }

    }
}
if (!function_exists('setConversiBruToIdr')) {
    function setConversiBruToIdr()
    {
        $str = @file_get_contents('http://dinarworld.com/rsgold/index.php/api/gold/emas?igrow=03edde974362db42832b85a7144ca7d0');
        if (!$str) {
            $str = json_encode(array(array('pergram' => 600000)));
        }
        $characters = json_decode($str);
        $_SESSION['bru_to_idr'] = floatval($characters[0]->pergram);
    }
}
if (!function_exists('getConversiBruToIdr')) {
    function getConversiBruToIdr($type = false)
    {
        if ($type) {
            return $_SESSION['bru_to_idr'];
        } else {
            return round($_SESSION['bru_to_idr'], 2);
        }
    }
}
if (!function_exists('session_of')) {
    function session_of($type)
    {
        return (isset($_SESSION[$type])) ? $_SESSION[$type] : '';
    }
}
//fungsi syncPiutang dipanggil ketika user perusahaan membuka
//tab wallet untuk mengurangi beban server
if (!function_exists('syncPiutang')) {
    function syncPiutang()
    {
        include "contact.php";
        $totalPiutang = array();
        //ambil rules yg berkaitan dengan user
        //join trans dimana plafond belum bayar
        //(user mendapat bagian dari trans ketika pembayaran)
        $sql = 'SELECT a.SHA_RISK,a.SHA_NUM,a.SHA_TAX,a.SHA_WITH,b.SUB_PREMI,c.CURR_ID ' .
            ' FROM ma2003 a ' .
            ' JOIN tr0002 b ON a.PROD_ID=b.SUB_PROD_ID ' .
            ' JOIN tr0001 c ON b.TRX_UUID_PARENT=c.TRX_UUID ' .
            ' WHERE a.SHA_ENTITY="' . $_SESSION['user_id'] . '"' .
            ' AND c.TRX_STATUS=0 AND c.CREATED_BY NOT LIKE "' . $_SESSION['user_id'] . '"';
        $query = mysqli_query($conection, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $ppn = $row['SHA_TAX'] == 'y' ? $row['SUB_PREMI'] * 10 / 100 : 0;
                $pph23 = $row['SHA_WITH'] == 'y' ? $row['SUB_PREMI'] * 2 / 100 : 0;
                if (array_key_exists($row['CURR_ID'], $totalPiutang)) {
                    $totalPiutang[$row['CURR_ID']] += ($row['SUB_PREMI'] + $ppn - $pph23);
                } else {
                    $totalPiutang[$row['CURR_ID']] = ($row['SUB_PREMI'] + $ppn - $pph23);
                }
            }
        }
        //ambil rules yg berkaitan dengan user
        //join trans dimana dia mendapat bayaran asuransi (SHA_RISK)
        //(jika asuransi belum membayar ketika klaim)
        $sql = 'SELECT a.KEWAJIBAN,c.CURR_ID ' .
            ' FROM tr1001 a ' .
            ' JOIN tr0002 b ON b.ID_KEY=a.ID_KEY_TRX_DETAIL ' .
            ' JOIN tr0001 c ON c.TRX_UUID=b.TRX_UUID_PARENT ' .
            ' WHERE a.ENTITY_ID NOT LIKE "' . $_SESSION['user_id'] . '"' .
            ' AND a.STATUS=0 AND c.CREATED_BY="' . $_SESSION['user_id'] . '"';
        $query = mysqli_query($conection, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                if (array_key_exists($row['CURR_ID'], $totalPiutang)) {
                    $totalPiutang[$row['CURR_ID']] += ($row['KEWAJIBAN']);
                } else {
                    $totalPiutang[$row['CURR_ID']] = ($row['KEWAJIBAN']);
                }
            }
        }
        //update
        $all_query_ok = true;
        foreach ($totalPiutang as $curr => $val) {
            $sql = 'UPDATE ma0002 SET piutang=' . $val .
                ' WHERE CLI_SYSTEM_ID=' . $_SESSION['user_key'] . ' AND BAL_CURR_ID="' . $curr . '"';
            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
        }
        if ($all_query_ok) {
            return $totalPiutang;
        } else {
            return $totalPiutang;
        }
    }
}
//fungsi syncUtang dipanggil ketika user perusahaan membuka
//tab wallet untuk mengurangi beban server
if (!function_exists('syncUtang')) {
    function syncUtang()
    {
        include "contact.php";
        $totalUtang = array();
        //trans user dimana plafond belum bayar
        //ambil kewajiban yg belum user bayaran kewajiban
        $sql = 'SELECT TRX_PREMI UTANG,CURR_ID FROM tr0001 a ' .
            ' WHERE a.CREATED_BY="' . $_SESSION['user_id'] . '"' .
            ' AND a.TRX_STATUS=0 ' .
            ' UNION ' .
            ' SELECT KEWAJIBAN UTANG,CURR_ID FROM tr1001 a ' .
            ' WHERE a.ENTITY_ID="' . $_SESSION['user_id'] . '"' .
            ' AND a.STATUS=0 ';
        $query = mysqli_query($conection, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                if (array_key_exists($row['CURR_ID'], $totalUtang)) {
                    $totalUtang[$row['CURR_ID']] += ($row['UTANG']);
                } else {
                    $totalUtang[$row['CURR_ID']] = ($row['UTANG']);
                }
            }
        }
        //update
        $all_query_ok = true;
        foreach ($totalUtang as $curr => $val) {
            $sql = 'UPDATE ma0002 SET utang=' . $val .
                ' WHERE CLI_SYSTEM_ID=' . $_SESSION['user_key'] . ' AND BAL_CURR_ID="' . $curr . '"';
            mysqli_query($conection, $sql) ? null : $all_query_ok = false;
        }
        if ($all_query_ok) {
            return $totalUtang;
        } else {
            return $totalUtang;
        }
    }
}
