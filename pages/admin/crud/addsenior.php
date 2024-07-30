<?php
session_start();
include("../functions/connections.php");

$msg = '';

if (isset($_POST['addSenior'])) {

    //getting values from the register form
    $fname = trim($_POST['inputFname']);
    $lname = trim($_POST['inputLname']);
    $address = trim($_POST['inputAddress']);
    $dob = $_POST['inputDOB'];
    $age = $_POST['inputAge'];
    $sex = $_POST['inputSex'];
    $weight = $_POST['inputWeight'];
    $bloodtype = $_POST['inputBlood'];
    $medication = $_POST['inputMedication'];
    $condition = $_POST['inputCondition'];
    $guardianID = $_POST['guardianID'];
    $status = 'Active';

    //check input if not empty else echo message
    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($weight) && !empty($bloodtype) && !empty($condition) && !empty($medication) && !empty($guardianID) && !empty($status)) {

        //save to database
        $query = "INSERT INTO tbl_senior (fname, lname, address, dob, age, sex, weight, bloodtype, condition_description, medication, guardian_id, status) VALUES ('$fname', '$lname', '$address', '$dob', $age, '$sex', $weight, '$bloodtype', '$medication', '$condition',  $guardianID, '$status')";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            header("Location: ../senior_active.php");
            $_SESSION['formSubmitted'] = 'added';
            mysqli_close($con);
            die;
        } else {
            header("Location: ../senior_active.php");
            $_SESSION['formSubmitted'] = 'not added';
            echo $query;
            die;
        }
    } else {
        header("Location: ../senior_active.php");
        $_SESSION['formSubmitted'] = 'not added';
        die;
    }
}
