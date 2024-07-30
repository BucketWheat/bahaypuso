<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateGuardian_inactive'])) {

    //getting values from the register form
    $guardian_id = $_POST['updateID_inactive'];
    $status = $_POST['updateStatus_inactive'];

    //check input if not empty else echo message
    if (!empty($status)) {

        $level = 4;
        //save to database
        $query = "UPDATE tbl_guardian SET status='$status' WHERE guardian_id='$guardian_id' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../guardian_other.php");
            $_SESSION['formSubmitted'] = 'updated';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../guardian_other.php");
            $_SESSION['formSubmitted'] = ' not updated';
            die;
        }
    }
}
