<?php
session_start();
include("../functions/connections.php");

$msg = '';

if (isset($_POST['updateSenior'])) {

    //getting values from the register form
    $updateID = $_POST['updateID'];
    $fname = $_POST['updateFname'];
    $lname = $_POST['updateLname'];
    $address = $_POST['updateAddress'];
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $weight = $_POST['updateWeight'];
    $bloodtype = $_POST['updateBlood'];
    $medication = $_POST['updateMedication'];
    $condition = $_POST['updateCondition'];
    $guardianID = $_POST['updateGuardianID'];
    $status = $_POST['updateStatus-active'];

    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($weight) && !empty($bloodtype) && !empty($medication) && !empty($condition) && !empty($guardianID) && !empty($status)) {

        $query = "UPDATE tbl_senior SET fname='$fname', lname='$lname', address='$address', dob='$dob', age='$age', sex='$sex', weight=$weight, bloodtype='$bloodtype', medication='$medication', condition_description='$condition', guardian_id='$guardianID', status='$status' WHERE senior_id='$updateID' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../senior_active.php");
            $_SESSION['formSubmitted'] = 'updated';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../senior_active.php");
            $_SESSION['formSubmitted'] = 'not updated';
            die;
        }
    } else {
        /* header("Location: ../senior_active.php");
        $_SESSION['formSubmitted'] = 'not updated';
        die; */
        echo "May kulang paren f*ck";
    }
}
