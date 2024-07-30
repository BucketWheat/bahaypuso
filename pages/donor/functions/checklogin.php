<?php
session_start();
require "connections.php";

$errors = array();

/* CHECK LOGIN CREDENTIALS */
$email = $_SESSION['email'];
if ($email != false) {
    $sql = "SELECT * FROM tbl_donor WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $isVerified = $fetch_info['isVerified'];
        $code = $fetch_info['code'];
        $status = $fetch_info['status'];
        if ($status == 'Active') {
            if ($isVerified == 1) {
                if ($code != 0) {
                    $_SESSION['err-header'] = "OTP Verification";
                    $_SESSION['info'] = "Seems like you're not verified correctly. Please enter the OTP code previously sent to - " . $email;
                    header('Location: ../reset-code.php');
                    exit();
                }
            } else {
                $_SESSION['err-header'] = "OTP Verification";
                $_SESSION['info'] = "Seems like you're not verified correctly. Please enter the OTP code previously sent to - " . $email;
                header('Location: ../user-otp.php');
                exit();
            }
        } else {
            $_SESSION['error-email'] = "It's look like you're not yet a member or your account has been disabled. Click the link below to signup.";
            header('Location: ../donation_login.php');
            exit();
        }
    }
} else {
    header('Location: ../donation_login.php');
    exit();
}
