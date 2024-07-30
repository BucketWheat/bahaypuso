<?php
session_start();
include("../functions/connections.php");
/*     include("../functions/random_num.php"); */

$msg = '';

if (isset($_POST['updateSenior'])) {

    //getting values from the register form
    $updateID = $_POST['updateID'];
    $name = $_POST['updateFullname'];
    $address = $_POST['updateAddress'];
    $dob = $_POST['updateDOB'];
    $age = $_POST['updateAge'];
    $sex = $_POST['updateSex'];
    $weight = $_POST['updateWeight'];
    $bloodtype = $_POST['updateBlood'];
    $condition = $_POST['updateCondition'];
    $guardianID = $_POST['updateGuardianID'];

    if (!empty($name) && !empty($address) && !empty($dob) && !empty($age) && !empty($sex) && !empty($weight) && !empty($bloodtype) && !empty($condition) && !empty($guardianID)) {

        $query = "UPDATE tbl_senior SET name='$name', address='$address', dob='$dob', age='$age', sex='$sex', weight=$weight, bloodtype='$bloodtype', condition_description='$condition', guardian_id='$guardianID' WHERE senior_id='$updateID' ";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            if ($_SESSION['level'] == 2) {
                header("Location: ../nursepages/seniors.php");
                $_SESSION['formSubmitted'] = 'updated';
                die;
            }elseif ($_SESSION['level'] == 3) {
                header("Location: ../staffpages/seniors.php");
                $_SESSION['formSubmitted'] = 'updated';
                die;
            }
        } else {
            echo 'data not updated';
        }
    }
    echo 'data not updated';
}
