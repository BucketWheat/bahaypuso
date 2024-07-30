<?php
session_start();

if (isset($_SESSION['name']) || isset($_SESSION['email'])) {
    unset($_SESSION['name']);
    unset($_SESSION['email']);

    $name = "";
    $email = "";
    $info = "";
}
session_destroy();

header("Location: ../donation_login.php");
die();
