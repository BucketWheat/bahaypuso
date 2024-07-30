<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['deleteReceived'])) {

    $donation_id = $_POST['deleteReceived-id'];

    $query = "DELETE FROM tbl_donation WHERE donation_id = '$donation_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        header("Location: ../adminpages/donations.php");
        $_SESSION['formSubmitted'] = 'deleted';
        die;
    }
}
