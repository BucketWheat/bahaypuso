<?php

session_start();
include("../functions/connections.php");
if (isset($_POST['updatePass'])) {

    //get values
    $staff_id = $_SESSION['staff_id'];
    $old_password = trim($_POST['oldPassword']);
    $new_password = trim($_POST['updatePassword']);

    if (!empty($old_password) && !empty($new_password)) {
        $getPass_query = "SELECT * FROM tbl_staff WHERE staff_id = $staff_id";
        $result = mysqli_query($con, $getPass_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $staff_data = mysqli_fetch_assoc($result);
            $password_checker = $staff_data['password'];
        }
        if (password_verify($old_password, $password_checker)) {

            //convert password to password_hash
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_query = "UPDATE tbl_staff SET password='$hashed_password' WHERE staff_id='$staff_id'";
            $query_run = mysqli_query($con, $update_query);
            if ($query_run) {
                $_SESSION['formSubmitted'] = 'password updated';
                header("Location: ../account.php");
                die;
            }
        } else {
            $_SESSION['formSubmitted'] = 'Incorrect';
            header("Location: ../account.php");
            die;
        }
    } else {
        $_SESSION['formSubmitted'] = 'empty';
        header("Location: ../account.php");
        die;
    }
}
