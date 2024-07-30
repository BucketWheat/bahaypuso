<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateDonate_cancelled'])) {

    //getting values from the register form
    $donation_id = $_POST['updateID_cancelled'];
    $name = $_POST['updateFullname_cancelled'];
    $contactNum = $_POST['updateContact_cancelled'];
    $email = $_POST['updateEmail_cancelled'];
    $donation_category = $_POST['updateCategory_cancelled'];
    $description = $_POST['updateDescription_cancelled'];
    $date = $_POST['updateDate_cancelled'];
    $status = $_POST['updateStatus_cancelled'];

    //check input if not empty else echo message
    if (!empty($name) && !empty($contactNum) && !empty($email) && !empty($donation_category) && !empty($description) && !empty($date) && !empty($status)) {

        if ($status == 'Pending') {

            //save to database
            $query = "UPDATE tbl_donation SET name='$name', contact_number='$contactNum', email='$email', donation_category='$donation_category', description='$description', date_recorded='$date', date_received=NULL, status='$status' WHERE donation_id='$donation_id' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../adminpages/donations.php");
                $_SESSION['formSubmitted'] = 'updated';
                die;
            } else {
                echo 'data not updated';
            }
        } 
        
        elseif ($status == 'Received') {

            //set received date
            $date_received = date('Y-m-d');

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
}
