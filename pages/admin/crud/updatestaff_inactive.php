<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateStaff_inactive'])) {

    //getting values from the register form
    $staff_id = $_POST['updateID_inactive'];
    $status = $_POST['updateStatus_inactive'];

    //check input if not empty else echo message
    if (!empty($status)) {

        $level = 3;
        //save to database
        $query = "UPDATE tbl_staff SET status='$status' WHERE staff_id='$staff_id' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../staff_other.php");
            $_SESSION['formSubmitted'] = 'updated';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../staff_other.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    }
}
