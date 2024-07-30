<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateNurse_inactive'])) {

    //getting values from the register form
    $nurse_id = $_POST['updateID_inactive'];
    $status = $_POST['updateStatus_inactive'];

    //check input if not empty else echo message
    if (!empty($status)) {

        $level = 2;
        //save to database
        $query = "UPDATE tbl_nurse SET status='$status' WHERE nurse_id='$nurse_id' ";

        $query_run = mysqli_query($con, $query);
        mysqli_close($con);

        if ($query_run) {
            header("Location: ../nurse_other.php");
            $_SESSION['formSubmitted'] = 'updated';
            die;
        } else {
            header("Location: ../nurse_other.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    }
}
