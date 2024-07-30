<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['editHealthinfo'])) {

    //getting update values
    $updateID = $_POST['updateID'];
    $seniorID = $_POST['updateseniorID'];
    $bloodpressure = $_POST['updateBP'];
    $oxygen = $_POST['updateOxygen'];
    $temperature = $_POST['updateTemp'];
    $pulse = $_POST['updatePulse'];

    //check weight if empty then set as null
    $initial_weight = $_POST['updateWeight'];
    if ($initial_weight != '') {
        $weight = $initial_weight;
    } else {
        $weight = NULL;
    }

    $description = $_POST['updateDescription'];
    $date_recorded = $_POST['updateDate'];
    $staffID = $_POST['updateStaffID'];

    //convert status from string to int
    $status = $_POST['updateStatus'];

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

    if (!empty($updateID) && !empty($seniorID) && !empty($bloodpressure) && !empty($oxygen) && !empty($temperature) && !empty($pulse) && !empty($description) && !empty($date_recorded) && !empty($staffID) && !empty($status)) {

        $query = "UPDATE tbl_healthinfo SET senior_id=$seniorID, bloodpressure='$bloodpressure', oxygen_level='$oxygen', temperature='$temperature', pulserate='$pulse', weight='$weight', description='$description', date_recorded='$date_recorded', staff_id=$staffID, status='$status' WHERE healthinfo_id =$updateID";

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
