<?php
session_start();
include("../functions/connections.php");
/*     include("../functions/random_num.php"); */

$msg = '';

if (isset($_POST['addStaff'])) {

    //getting values from the register form
    $fname = trim($_POST['inputFname']);
    $lname = trim($_POST['inputLname']);
    $address = trim($_POST['inputAddress']);
    $dob = $_POST['inputDOB'];
    $age = $_POST['inputAge'];
    $sex = $_POST['inputSex'];
    $licenseNum = $_POST['inputPRC'];
    $contactNum = $_POST['inputContact'];
    $email = $_POST['inputEmail'];
    $username = trim($_POST['inputUsername']);
    $password = trim($_POST['inputPassword']);
    $status = 'Active';

    //check input if not empty else echo message
    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($contactNum) && !empty($email) && !empty($username) && !empty($password) && !empty($status)) {

        //convert password to password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $level = 3;
        //save to database
        $query = "INSERT INTO tbl_staff (fname, lname, address, dob, age, sex, license_number, contact_number, email, username, password, level, status) VALUES ('$fname', '$lname', '$address', '$dob', $age, '$sex', '$licenseNum', '$contactNum', '$email', '$username', '$hashed_password', $level, '$status')";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../staff_active.php");
            $_SESSION['formSubmitted'] = 'added';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../staff_active.php");
            $_SESSION['formSubmitted'] = 'not added';
            die;
        }
    } else {
        header("Location: ../staff_active.php");
        $_SESSION['formSubmitted'] = 'not added';
        die;
    }
}
