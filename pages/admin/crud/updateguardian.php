<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateGuardian'])) {

    //getting values from the register form
    $guardian_id = $_POST['updateID'];
    $fname = $_POST['updateFname'];
    $lname = $_POST['updateLname'];
    $address = $_POST['updateAddress'];
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $contactNum = $_POST['updateContact'];
    $email = $_POST['updateEmail'];
    $username = trim($_POST['updateUsername']);
    $password = trim($_POST['updatePassword']);
    $status = $_POST['updateStatus-active'];

    //check input if not empty else echo message
    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($contactNum) && !empty($email) && !empty($username) && !empty($status)) {

        $level = 4;

        /* IF PASSWORD WAS SET TO DEFAULT */
        if (!empty($password)) {
            //convert password to password_hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //save to database
            $query = "UPDATE tbl_guardian SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', contact_number='$contactNum', email='$email', username='$username',  password='$hashed_password', status='$status' WHERE guardian_id='$guardian_id' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../guardian_active.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../guardian_active.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        } else {
            //save to database
            $query = "UPDATE tbl_guardian SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', contact_number='$contactNum', email='$email', username='$username', status='$status' WHERE guardian_id='$guardian_id' ";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                header("Location: ../guardian_active.php");
                $_SESSION['formSubmitted'] = 'updated';
                mysqli_close($con);
                die;
            } else {
                header("Location: ../guardian_active.php");
                $_SESSION['formSubmitted'] = 'not updated';
                die;
            }
        }
    }
}
