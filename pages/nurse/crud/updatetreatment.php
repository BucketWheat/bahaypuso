<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateTreatment'])) {

    //get values from post
    $updateID = $_POST['updateID'];
    $healthinfo_id = $_POST['healthinfoID'];
    $seniorName = $_POST['updateSenior'];
    $description = $_POST['updateCondition'];
    $treatment_name = $_POST['updateTreatmentName'];
    $treatment_details = $_POST['updateTreatmentDetails'];
    $date_recorded = $_POST['updateDate'];
    $status = $_POST['updateStatus'];

   /*  //get healthinfo_id
    $get_healthinfoID_query = "SELECT tbl_healthinfo.healthinfo_id FROM tbl_healthinfo INNER JOIN tbl_senior ON tbl_healthinfo.senior_id=tbl_senior.senior_id WHERE tbl_senior.name = '$seniorName' AND tbl_healthinfo.description = '$description'";
    $get_healthinfoID_result = mysqli_query($con, $get_healthinfoID_query);
    $row = mysqli_fetch_assoc($get_healthinfoID_result);

    //fetched healthinfo_id
    $healthinfo_id = $row['healthinfo_id']; */

    if ($status == 'Pending') {

        //query update 
        $update_query = "UPDATE tbl_treatment SET treatment_name='$treatment_name', treatment_description='$treatment_details', date_recorded='$date_recorded', status='$status' WHERE treatment_id = $updateID";

        $update_query_run = mysqli_query($con, $update_query);

        if ($update_query_run) {
            $_SESSION['formSubmitted'] = 'updated';
            header("Location: ../nursepages/treatments.php");
            die;
        } else {
            $_SESSION['formSubmitted'] = 'failed';
            header("Location: ../nursepages/treatments.php");
            die;
        }
    } else {
        //query update cancelled
        $update_query_cancelled = "UPDATE tbl_treatment SET treatment_name='$treatment_name', treatment_description='$treatment_details', date_recorded='$date_recorded', status='$status' WHERE treatment_id = $updateID";

        $update_query_cancelled_run = mysqli_query($con, $update_query_cancelled);

        if ($update_query_cancelled_run) {

            $update_healthinfo_query = "UPDATE tbl_healthinfo SET date_administered=NULL, status='Pending' WHERE healthinfo_id = $healthinfo_id";
            $update_healthinfo_run = mysqli_query($con, $update_healthinfo_query);

            if ($update_healthinfo_run) {
                $_SESSION['formSubmitted'] = 'updated';
                header("Location: ../nursepages/health_information.php");
                die;
            } else {
                $_SESSION['formSubmitted'] = 'failed';
                header("Location: ../nursepages/health_information.php");
                die;
            }
        } else {
            $_SESSION['formSubmitted'] = 'failed';
            header("Location: ../nursepages/treatments.php");
            die;
        }
    }
} else {
    $_SESSION['formSubmitted'] = 'failed';
    header("Location: ../nursepages/treatments.php");
    die;
}
