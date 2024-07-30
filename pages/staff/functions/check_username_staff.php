<?php
session_start();
include("connections.php");

if (isset($_POST['username']) && isset($_POST['updateID'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $staff_id = $_POST['updateID'];

    //check username if no changes made
    $query_ID = "SELECT * FROM tbl_staff WHERE staff_id = $staff_id AND status ='Active'";
    $result_ID = mysqli_query($con, $query_ID);

    if (mysqli_num_rows($result_ID) > 0) {
        $row_ID = mysqli_fetch_assoc($result_ID);
        $check_username = $row_ID['username'];
    }

    //check username if it exists already
    $query_check_staff = "SELECT COUNT(*) AS cntStaff FROM tbl_staff WHERE username='". $username ."' AND status = 'Active'";
    $result_check_staff = mysqli_query($con, $query_check_staff);

    if (mysqli_num_rows($result_check_staff)) {
        $row_check_staff = mysqli_fetch_array($result_check_staff);
        $count_check_staff = $row_check_staff['cntStaff'];

        if ($count_check_staff > 0) {
            $username_exists = 'true';
        } else {
            $username_exists = 'false';
        }
    }

    //check username if it exist in nurse
    $query = "SELECT COUNT(*) AS cntNurse FROM tbl_nurse WHERE username='" . $username . "' AND status ='Active'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);

        $count = $row['cntNurse'];

        if ($count > 0) {
            $username_exists = 'true';
        } else {
            $username_exists = 'false';
        }
    }

    if ($_SESSION['staff_username'] == $username && $_SESSION['staff_username'] == $check_username) {
        $response = '1';
    } elseif ($check_username != $_SESSION['staff_username'] || $username_exists == 'true') {
        $response = '2';
    } else {
        $response = '3';
    }
    echo $response;
    die;
}
