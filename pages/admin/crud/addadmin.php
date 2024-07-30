<?php
session_start();
include("../functions/connections.php"); 

$msg = '';

if (isset($_POST['addAdmin'])) {

    //getting values from the register form
    $name = $_POST['inputFullname'];
    $username = trim($_POST['inputUsername']);
    $password = trim($_POST['inputPassword']);

    //check input if not empty else echo message
    if (!empty($name) && !empty($username) && !empty($password)) {

        //convert password to password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $level = 1;
        //save to database
        $query = "INSERT INTO tbl_admin (name, username, password, level) VALUES ('$name', '$username', '$hashed_password', $level)";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../admins.php");
            $_SESSION['formSubmitted'] = 'added';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../admins.php");
            $_SESSION['formSubmitted'] = 'not added';
            die;
        }
    }
}
