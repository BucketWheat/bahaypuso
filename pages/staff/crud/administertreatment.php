<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['administer_treatment'])) {

    //getting values from the register form
    $senior = mysqli_real_escape_string($con, $_POST['treatment_senior']);
    $description = mysqli_real_escape_string($con, $_POST['treatment_details']);
    $start = mysqli_real_escape_string($con, $_POST['date_start']);
    $end = mysqli_real_escape_string($con, $_POST['date_end']);
    $treatment_ID = mysqli_real_escape_string($con, $_POST['treatment_ID']);
    $senior_id = mysqli_real_escape_string($con, $_POST['treat_seniorID']);
    $staff_id = mysqli_real_escape_string($con, $_POST['treatment_staff']);
    date_default_timezone_set("Asia/Manila");
    $date_recorded = date("Y-m-d");
    $status = 'Ongoing';

    if (!empty($senior) && !empty($start) && !empty($end) && !empty($treatment_ID) && !empty($senior_id) && !empty($staff_id)) {

        /* $new_desc = $senior." - ".$description; */
        $query = "INSERT INTO tbl_treatment_progress (treatment_progress_description, treatment_progress_start, treatment_progress_end, senior_id, staff_id, date_recorded, status) VALUES ('$description', '$start', '$end', '$senior_id', '$staff_id', '$date_recorded', '$status')";

        $run = mysqli_query($con, $query);

        if ($run) {
            $update_run = mysqli_query($con, "UPDATE tbl_treatment SET date_administered='$date_recorded', staff_id='$staff_id', status='$status' WHERE treatment_id = $treatment_ID AND senior_id = $senior_id");

            $_SESSION['formSubmitted'] = 'administered';
            header('Location: ../treatment_progress_pending.php');
            mysqli_close($con);
            die();
        }
    } else {
        $_SESSION['formSubmitted'] = 'empty';
        header('Location: ../treatment_progress_pending.php');
        die();
        
    }
}
/* echo $description."<br/>";
        echo $start."<br/>";
        echo $end."<br/>";
        echo $senior_id."<br/>";
        echo $staff_id."<br/>"; */