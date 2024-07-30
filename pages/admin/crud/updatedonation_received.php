<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['receivedDonate'])) {

    //getting values from the register form
    $donation_id = $_POST['receivedID'];
    $name = $_POST['receivedFullname'];
    $contactNum = $_POST['receivedContact'];
    $email = $_POST['receivedEmail'];
    $donation_category = $_POST['receivedCategory'];
    $description = $_POST['receivedDescription'];
    $date = $_POST['receivedDate'];
    $status = $_POST['receivedStatus'];

    //check input if not empty else echo message
    if (!empty($name) && !empty($contactNum) && !empty($email) && !empty($donation_category) && !empty($description) && !empty($date) && !empty($status)) {

        //save to database
        $query = "UPDATE tbl_donation SET name='$name', contact_number='$contactNum', email='$email', donation_category='$donation_category', description='$description', date_received=NULL, status='$status' WHERE donation_id='$donation_id' ";

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
