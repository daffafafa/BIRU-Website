<?php
include "contact.php";
$error = "";
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
    && ($_GET["action"] == "reset")) {
    $key = $_GET["key"];
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $curDate = date("Y-m-d H:i:s");
    $query = mysqli_query($conection,
        "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';"
    );
    $row = mysqli_num_rows($query);
    if ($row == 0) {
        $error .= '<h2>Invalid Link</h2>
        <p>The link is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated.</p>
        <p><a href="' . ((isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? 'https' : 'http') .
        '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, (strripos($_SERVER['SCRIPT_NAME'], '/'))) .
            '/index.php' . '">Click here</a> to reset password.</p>';
    } else {
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate) {
            ?>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<div class="col-md-4 col-md-offset-4" style="height:100%;color:#fff;text-align:center;background: -webkit-linear-gradient(#0957c3, #1a2eb0);">
    <div style="margin-top:20px;">
        <img src="assets/img/logo.png" alt="logo" >
        <span style="line-height: 50px;vertical-align: sub;">BIRU</span>
    </div>
    <h3>Reset Password</h3>
    <?php
$success = false;
            if (isset($_POST["email"]) && isset($_POST["action"]) &&
                ($_POST["action"] == "update")) {
                $error = "";
                $pass1 = mysqli_real_escape_string($conection, $_POST["pass1"]);
                $pass2 = mysqli_real_escape_string($conection, $_POST["pass2"]);
                $email = $_POST["email"];
                $curDate = date("Y-m-d H:i:s");
                if ($pass1 != $pass2) {
                    $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
                }
                if ($error != "") {
                    echo "<div class='error'>" . $error . "</div><br />";
                } else {
                    $pass1 = ($pass1);
                    if ($row['tb'] == 'a') {
                        $d = "UPDATE `ma1001` SET `PASSWORD`='" . $pass1 . "' WHERE `ENTITY_EMAIL`='" . $email . "';";
                        mysqli_query($conection, $d);
                    } else {
                        mysqli_query($conection,
                            "UPDATE `ma0001` SET `CLI_PASSWORD`='" . $pass1 . "' WHERE `CLI_EMAIL`='" . $email . "';"
                        );
                    }
                    mysqli_query($conection, "DELETE FROM `password_reset_temp` WHERE `email`='" . $email . "';");

                    $success = true;
                    echo '<div class="success"><p>Congratulations! Your password has been updated successfully.</p>
                        <p><a style="color:#fff" href="' . ((isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? 'https' : 'http') .
                    '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, (strripos($_SERVER['SCRIPT_NAME'], '/'))) .
                        '/index.php' . '">
                        Click here</a> to Login.</p></div><br />';
                }
            }
            if (!$success) {
                ?>
    <form method="post" class="form-vertical login-form" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <br /><br />
        <div class="form-group">
            <label for="pass1">New Password</label>
            <input type="password" style="width:100%" name="pass1" id ="pass1"  class="form-control" maxlength="15" required />
        </div>
        <div class="form-group">
            <label for="pass2"><strong>Re-Enter New Password:</strong></label>
            <input type="password" style="width:100%" name="pass2" maxlength="15" class="form-control" required/>
        </div>
        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
        <input type="submit" class="btn btn-default" value="Reset Password" />
    </form>
    <?php
}
            ?>
</div>

            <?php
} else {
            $error .= "<h2>Link Expired</h2>
            <p>The link is expired. You are trying to use the expired link which
            as valid only 24 hours (1 days after request).<br /><br /></p>";
        }
    }
    if ($error != "") {
        echo "<div class='error'>" . $error . "</div><br />";
    }
} // isset email key validate end

echo '<style>body {
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    color: #555555;
    font-size: 15px;
}
h3{font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;}
.error p {
	color:#FF0000;
	font-size:20px;
	font-weight:bold;
	margin:50px;
    }

.success p {
	color:#00FF00;
	font-size:20px;
	font-weight:bold;
	margin:50px;
    }
    </style>';