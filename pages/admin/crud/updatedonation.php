<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateDonate'])) {

    //getting values from the register form
    $donation_id = $_POST['updateID'];
    $name = $_POST['updateFullname'];
    $contactNum = $_POST['updateContact'];
    $email = $_POST['updateEmail'];
    $donation_category = $_POST['updateCategory'];
    $description = $_POST['updateDescription'];
    $date = $_POST['updateDate'];
    $status = $_POST['updateStatus'];
    $date_received = date('Y-m-d');

    //check input if not empty else echo message
    if (!empty($name) && !empty($contactNum) && !empty($email) && !empty($donation_category) && !empty($description) && !empty($date) && !empty($status)) {

        //save to database
        $query = "UPDATE tbl_donation SET name='$name', contact_number='$contactNum', email='$email', donation_category='$donation_category', description='$description', date_recorded='$date', date_received='$date_received', status='$status' WHERE donation_id='$donation_id' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../adminpages/donations.php");
            $_SESSION['formSubmitted'] = 'updated';
            die;
        } else {
            echo 'data not updated';
        }
    }
}
