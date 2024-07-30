<?php
session_start();
include("../functions/connections.php");

$msg = '';

if (isset($_POST['updateSenior_inactive'])) {

    //getting values from the register form
    $updateID = $_POST['updateID_inactive'];
    $status = $_POST['updateStatus_inactive'];

    if (!empty($status)) {

        $query = "UPDATE tbl_senior SET status='$status' WHERE senior_id='$updateID' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../senior_other.php");
            $_SESSION['formSubmitted'] = 'updated';
            die;
        } else {
            header("Location: ../senior_other.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    } else {
        header("Location: ../senior_other.php");
        $_SESSION['formSubmitted'] = 'not updated';
        die;
    }
}
