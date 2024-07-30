<?php
session_start();

include "../functions/connections.php";

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d");

/* IF USER CLICKED UPDATE BUTTON ON CASH DONATIONS */
if (isset($_POST['update-cash'])) {

    //get values
    $donation_id = mysqli_real_escape_string($con, $_POST['donationID-cash']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    if ($status == "Pending") {

        //update status
        $query = "UPDATE tbl_donation SET date_received = NULL, status = '$status' WHERE donation_id = $donation_id";
        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = "updated";
            header('Location: ../donation_received.php');
            die;
        } else {
            $_SESSION['formSubmitted'] = "failed";
            header('Location: ../donation_received.php');
            die;
        }
        
    } elseif ($status == "Cancelled") {

        //update status
        $query = "UPDATE tbl_donation SET status = '$status' WHERE donation_id = $donation_id";
        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = "updated";
            header('Location: ../donation_received.php');
            die;
        } else {
            $_SESSION['formSubmitted'] = "failed";
            header('Location: ../donation_received.php');
            die;
        }

    } else {
        $_SESSION['formSubmitted'] = 'no changes';
        header('Location: ../donation_received.php');
        die;
    }
}

/* IF USER CLICKED UPDATE BUTTON ON MISC DONATIONS */
if (isset($_POST['update-misc'])) {

    //get values
    $donation_id_misc = mysqli_real_escape_string($con, $_POST['donationID-misc']);
    $status_misc = mysqli_real_escape_string($con, $_POST['status-misc']);

    if ($status_misc == "Pending") {

        //update status
        $query = "UPDATE tbl_donation SET date_received = NULL, status = '$status_misc' WHERE donation_id = $donation_id_misc";
        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = "updated";
            header('Location: ../donation_received.php');
            die;
        } else {
            $_SESSION['formSubmitted'] = "failed";
            header('Location: ../donation_received.php');
            die;
        }

    } elseif ($status_misc == "Cancelled") {

        //update status
        $query = "UPDATE tbl_donation SET status = '$status_misc' WHERE donation_id = $donation_id_misc";
        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = "updated";
            header('Location: ../donation_received.php');
            die;
        } else {
            $_SESSION['formSubmitted'] = "failed";
            header('Location: ../donation_received.php');
            die;
        }
        
    } else {
        $_SESSION['formSubmitted'] = 'no changes';
        header('Location: ../donation_received.php');
        die;
    }
}
