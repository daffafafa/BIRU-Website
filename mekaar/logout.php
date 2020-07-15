<?php
if (!isset($_SESSION)) {
    session_start();
}
session_unset();
session_destroy();
header("Location: index.php");
if (isset($_COOKIE["user_login"])) {
    setcookie("user_login", "", time() - 3600);
}
if (isset($_COOKIE["random_password"])) {
    setcookie("random_password", "", time() - 3600);
}
if (isset($_COOKIE["random_selector"])) {
    setcookie("random_selector", "", time() - 3600);
}
