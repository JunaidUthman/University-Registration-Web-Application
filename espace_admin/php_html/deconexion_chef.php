<?php
session_start();
if (!isset($_SESSION["id_chef"])) {
    header("Location: login_chef.php");
}

session_destroy();
header("Location: login_chef.php");
?>