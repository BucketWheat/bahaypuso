<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['addtreatment'])) {

    //getting values from the register form
    $seniorID = $_POST['administer_seniorID'];
    $healthinfoID = $_POST['healthinfoID'];
    $treatment_name = $_POST['treatmentName'];
    $treatment_details = $_POST['treatmentDetails'];
    $nurseID = $_POST['administer_nurseID'];

    date_default_timezone_set("Asia/Manila");
    $date_recorded = date("Y-m-d");

    $date_administered_healthinfo = date("Y-m-d");
    $status = 'Pending';

    if (!empty($seniorID) && !empty($healthinfoID) && !empty($treatment_name) && !empty($treatment_details) && !empty($nurseID) && !empty($date_recorded)) {

        //update healthinfo status to administered
        $update_query = "UPDATE tbl_healthinfo SET date_administered = '$date_administered_healthinfo', status = 'Administered' WHERE healthinfo_id = $healthinfoID";
        $update_run = mysqli_query($con, $update_query);

        //save new treatment to database
        $query_add = "INSERT INTO tbl_treatment (senior_id, healthinfo_id, treatment_name, treatment_description, nurse_id, date_recorded, date_administered, status) VALUES ($seniorID, $healthinfoID, '$treatment_name', '$treatment_details', $nurseID, '$date_recorded', NULL, '$status')";

        $add_run = mysqli_query($con, $query_add);

        if ($add_run) {
            header("Location: ../nursepages/treatments.php");
            $_SESSION['formSubmitted'] = 'administered';
            die;
        } else {
            echo 'data not inserted';
        }
    } else {
        echo 'data not inserted';
    }
}
