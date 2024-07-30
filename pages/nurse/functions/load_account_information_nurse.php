<?php
include("../functions/connections.php");

if (isset($_POST['nurseFname']) && isset($_POST['nurseLname'])) {
    $nurse_fname = trim($_POST['nurseFname']);
    $nurse_lname = trim($_POST['nurseLname']);

    //get account information
    $query = "SELECT * FROM tbl_nurse WHERE fname = '$nurse_fname' AND lname = '$nurse_lname'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $nurseID = $row['nurse_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $address = $row['address'];
        $dob = $row['dob'];
        $age = $row['age'];
        $sex = $row['sex'];
        $prc = $row['license_number'];
        $contact = $row['contact_number'];
        $email = $row['email'];
        $username = $row['username'];
        $password = $row['password'];
        $status = $row['status'];
    }
    echo json_encode(array('nurseID' => $nurseID, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'dob' => $dob, 'age' => $age, 'sex' => $sex, 'prc' => $prc, 'contact' => $contact, 'email' => $email, 'username' => $username, 'password' => $password, 'status' => $status));
    die;
}
