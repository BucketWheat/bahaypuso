<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['editHealthinfo_cancelled'])) {

    //getting update values
    $updateID = $_POST['updateID_cancelled'];
    /* $seniorID = $_POST['updateseniorID_cancelled'];
    $bloodpressure = $_POST['updateBP_cancelled'];
    $oxygen = $_POST['updateOxygen_cancelled'];
    $temperature = $_POST['updateTemp_cancelled'];
    $pulse = $_POST['updatePulse_cancelled'];

    //check weight if empty then set as null
    $initial_weight = $_POST['updateWeight_cancelled'];
    if ($initial_weight != '') {
        $weight = $initial_weight;
    } else {
        $weight = NULL;
    }

    $description = $_POST['updateDescription_cancelled'];
    $date_recorded = $_POST['updateDate_cancelled'];
    $staffID = $_POST['updateStaffID_cancelled'];

    //convert status from string to int */
    $status = $_POST['updateStatus_cancelled'];

    //get check if level is == to nurse or staff
    if (isset($_SESSION['nurse_level'])) {
        $nurse_level = $_SESSION['nurse_level'];
    } else {
        $nurse_level ='';
    }

    if (isset($_SESSION['staff_level'])) {
        $staff_level = $_SESSION['staff_level'];
    } else {
        $staff_level ='';
    }
   
    if (!empty($nurse_level) && empty($staff_level)) {
        $level = 2;
    } elseif (!empty($staff_level) && empty($nurse_level)) {
        $level = 3;
    }

    if (!empty($updateID) && !empty($status)) {

        $query = "UPDATE tbl_healthinfo SET status='$status' WHERE healthinfo_id =$updateID";

        $query_run = mysqli_query($con, $query);

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            if ($level == 2) {
                header("Location: ../nursepages/health_information.php");
                $_SESSION['formSubmitted'] = 'updated';
                die;
            } elseif ($level == 3) {
                header("Location: ../staffpages/health_information.php");
                $_SESSION['formSubmitted'] = 'updated';
                die;
            }
        } else {
            echo 'data not updated';
        }
    }
    echo 'data not updated';
}
