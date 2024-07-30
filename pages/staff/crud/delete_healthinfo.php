<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['deletedata'])) {

    $healthinfo_id = $_POST['delete-id'];

    //get check if level is == to nurse or staff
    $nurse_level = $_SESSION['nurse_level'];
    $staff_level = $_SESSION['staff_level'];

    if (!empty($nurse_level) && empty($staff_level)) {
        $level = 2;
    } elseif (!empty($staff_level) && empty($nurse_level)) {
        $level = 3;
    }

    $query = "DELETE FROM tbl_healthinfo WHERE healthinfo_id = '$healthinfo_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if ($level == 2) {
            header("Location: ../nursepages/health_information.php");
            $_SESSION['formSubmitted'] = 'deleted';
            die;
        } elseif ($level == 3) {
            header("Location: ../staffpages/health_information.php");
            $_SESSION['formSubmitted'] = 'deleted';
            die;
        }
    }
}
