<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateNurse'])) {

    //getting values from the register form
    $nurse_id = $_POST['updateID'];
    $fname = $_POST['updateFname'];
    $lname = $_POST['updateLname'];
    $address = $_POST['updateAddress'];
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $licenseNum = $_POST['updatePRC'];
    $contactNum = $_POST['updateContact'];
    $email = $_POST['updateEmail'];
    $username = trim($_POST['updateUsername']);
    $password = trim($_POST['updatePassword']);
    $status = $_POST['updateStatus'];

    //check input if not empty else echo message
    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($licenseNum) && !empty($contactNum) && !empty($email) && !empty($username) && !empty($status)) {

        $level = 2;

        /* IF PASSWORD WAS SET TO DEFAULT */
        if (!empty($password)) {
            //convert password to password_hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //save to database
            $query = "UPDATE tbl_nurse SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', license_number='$licenseNum', contact_number='$contactNum', email='$email', username='$username', password='$hashed_password', status='$status' WHERE nurse_id='$nurse_id' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../nurse_active.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../nurse_active.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        /* IF PASSWORD IS EMPTY */
        } else {
            //save to database
            $query = "UPDATE tbl_nurse SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', license_number='$licenseNum', contact_number='$contactNum', email='$email', username='$username', status='$status' WHERE nurse_id='$nurse_id' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../nurse_active.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../nurse_active.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        }
    }
}
