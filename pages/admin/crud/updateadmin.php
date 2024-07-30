<?php
session_start();
include("../functions/connections.php");
/*     include("../functions/random_num.php"); */

$msg = '';

if (isset($_POST['updateAdmin'])) {

    //getting values from the register form
    $updateID = $_POST['updateID'];
    $name = $_POST['updateFullname'];
    $username = trim($_POST['updateUsername']);
    $password = trim($_POST['updatePassword']);

    if (!empty($name) && !empty($username)) {

        if (!empty($password)) {
            //convert password to password_hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "UPDATE tbl_admin SET name='$name', username='$username', password='$hashed_password' WHERE admin_id='$updateID' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../admins.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../admins.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        } else {
            $query = "UPDATE tbl_admin SET name='$name', username='$username' WHERE admin_id='$updateID' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../admins.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../admins.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        }
    }
    header("Location: ../admins.php");
    $_SESSION['formSubmitted'] = 'not updated';
    die;
}
