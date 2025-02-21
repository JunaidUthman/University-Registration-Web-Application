<?php
    session_start();
    if(!isset($_SESSION["email_verified"])){
        header("location:login.php");
    }
    session_destroy();
    header("location:login.php");
?>