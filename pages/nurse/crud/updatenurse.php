<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateNurse'])) {

    $nurse_id = $_POST['updateID'];
    $fname = trim($_POST['updateFname']);
    $lname = trim($_POST['updateLname']);
    $address = trim($_POST['updateAddress']);
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $licenseNum = $_POST['updatePRC'];
    $contactNum = $_POST['updateContact'];
    $email = trim($_POST['updateEmail']);
    $username = trim($_POST['updateUsername']);

    //check input if not empty else echo message
    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($licenseNum) && !empty($contactNum) && !empty($email) && !empty($username)) {

        $level = 2;
        //save to database
        $query = "UPDATE tbl_nurse SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', license_number='$licenseNum', contact_number='$contactNum', email='$email', username='$username' WHERE nurse_id='$nurse_id' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../account.php");
            $_SESSION['formSubmitted'] = 'updated';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../account.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    } else {
        header("Location: ../account.php");
        $_SESSION['formSubmitted'] = 'not updated';
        die;
    }
}
