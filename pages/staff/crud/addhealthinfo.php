<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['addHealthinfo'])) {

    //getting values from the register form
    $senior_id = $_POST['seniorID'];
    $bloodpressure = $_POST['inputBP'];
    $oxygen = $_POST['inputOxygen'];
    $temperature = $_POST['inputTemp'];
    $pulse = $_POST['inputPulse'];

    //check if weight is empty
    $initial_weight = $_POST['inputWeight'];

    if ($initial_weight != '') {
        $weight = $initial_weight;
    } else {
        $weight = NULL;
    }

    $description = $_POST['inputDescription'];
    date_default_timezone_set("Asia/Manila");
    $date_recorded = date("Y-m-d");
    $staff_fname = trim($_POST['staff_fname']);
    $staff_lname = trim($_POST['staff_lname']);
    $status = 'Pending';

    //check input if not empty else echo message
    if (!empty($senior_id) && !empty($bloodpressure) && !empty($oxygen) && !empty($temperature) && !empty($pulse) && !empty($description) && !empty($staff_fname) && !empty($staff_lname)) {

        //get id of staff
        $query_select = "SELECT * FROM tbl_staff WHERE fname = '$staff_fname' AND lname = '$staff_lname' AND status = 'Active'";
        $result = mysqli_query($con, $query_select);

        if ($result && mysqli_num_rows($result) > 0) {
            //get all staff data
            $data = mysqli_fetch_assoc($result);
            //set id of staff
            $staff_id = $data['staff_id'];
        }

        //save to database
        $query_add = "INSERT INTO tbl_healthinfo (senior_id, bloodpressure, oxygen_level, temperature, pulserate, weight, description, date_recorded, staff_id, status) VALUES ($senior_id, '$bloodpressure', '$oxygen', '$temperature', '$pulse', '$weight', '$description', '$date_recorded', $staff_id, '$status')";

        $query_run = mysqli_query($con, $query_add);

        if ($query_run) {
            header("Location: ../healthinformation.php");
            $_SESSION['formSubmitted'] = 'added';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../healthinformation.php");
            $_SESSION['formSubmitted'] = 'not added';
            die;
        }
    } else {
        header("Location: ../healthinformation.php");
        $_SESSION['formSubmitted'] = 'not added';
        die;
    }
}
