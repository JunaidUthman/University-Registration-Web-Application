<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login_sudo.php");
}

session_destroy();
header("Location: login_sudo.php");
?>