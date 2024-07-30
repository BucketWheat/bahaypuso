<?php
require "connections.php";

// set name and email sessions
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
}
//set other informations
if (isset($_SESSION['institution']) && isset($_SESSION['contact']) && isset($_SESSION['address'])) {
    $institution = $_SESSION['institution'];
    $contact = $_SESSION['contact'];
    $address = $_SESSION['address'];
} else {
    $institution = "";
    $contact = "";
    $address = "";
}
if (isset($_SESSION['donor_id'])) {
    $donor_id = $_SESSION['donor_id'];
}
//set total donations
$query_cash = "SELECT SUM(amount) AS totalCash FROM tbl_donation WHERE donor_id = $donor_id AND status = 'Received'";
$run = mysqli_query($con, $query_cash);
if ($run && mysqli_num_rows($run) > 0) {
    $res = mysqli_fetch_assoc($run);
    $totalCash = $res['totalCash'];
}
$query_misc = "SELECT SUM(donor_id) AS donationsMade FROM tbl_donation WHERE donor_id = 1 AND donation_category != 'Cash' AND status = 'Received'";
$run_misc = mysqli_query($con, $query_misc);
if ($run_misc && mysqli_num_rows($run_misc) > 0) {
    $res_misc = mysqli_fetch_assoc($run_misc);
    $totalDonations = $res_misc['donationsMade'];
}
