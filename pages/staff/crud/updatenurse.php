<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['updateNurse'])) {

    //getting values from the register form
    $nurse_id = $_POST['updateID'];
    $name = $_POST['updateFullname'];
    $address = $_POST['updateAddress'];
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $licenseNum = $_POST['updatePRC'];
    $contactNum = $_POST['updateContact'];
    $email = $_POST['updateEmail'];
    $username = trim($_POST['updateUsername']);
/*     $password = $_POST['updatePassword']; */
/*     $status = $_POST['updateStatus']; */

    //check input if not empty else echo message
    if (!empty($name) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($licenseNum) && !empty($contactNum) && !empty($email) && !empty($username)) {

        $level = 2;
        //save to database
        $query = "UPDATE tbl_nurse SET name='$name', address='$address', dob='$dob', age='$age', sex='$sex', license_number='$licenseNum', contact_number='$contactNum', email='$email', username='$username' WHERE nurse_id='$nurse_id' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../nursepages/account.php");
            $_SESSION['formSubmitted'] = 'updated';
            die;
        } else {
            header("Location: ../nursepages/account.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    }
}
