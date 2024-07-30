<?php
include("../functions/connections.php");

if (isset($_POST['staffFname']) && isset($_POST['staffLname'])) {
    $staff_fname = trim($_POST['staffFname']);
    $staff_lname = trim($_POST['staffLname']);

    //get account information
    $query = "SELECT * FROM tbl_staff WHERE fname = '$staff_fname' AND lname = '$staff_lname'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $staffID = $row['staff_id'];
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
    echo json_encode(array('staffID' => $staffID, 'fname' => $fname, 'lname' => $lname, 'address' => $address, 'dob' => $dob, 'age' => $age, 'sex' => $sex, 'prc' => $prc, 'contact' => $contact, 'email' => $email, 'username' => $username, 'password' => $password, 'status' => $status));
    die;
}
