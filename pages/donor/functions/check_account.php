<?php

require "connections.php";

$email = $_SESSION['email'];

/* CHECK IF ACCOUNT DETAILS IS COMPLETE */
$check_account = "SELECT * FROM tbl_donor WHERE email = '$email' AND isVerified = 1 AND status = 'Active' ";
$check_res = mysqli_query($con, $check_account);

if ($check_res && mysqli_num_rows($check_res) > 0) {
    $fetch_info = mysqli_fetch_assoc($check_res);
    $donor_id = $fetch_info['donor_id'];
    $name = $fetch_info['fullname'];
    $institution = $fetch_info['institution'];
    $contact_number = $fetch_info['contact_number'];
    $address = $fetch_info['address'];
    $email = $fetch_info['email'];
    $status = $fetch_info['status'];

    if ($institution == '' && $contact_number == '' && $address === '') {
        $_SESSION['info'] = "Please complete your account details first to proceed on your donation.";
        $_SESSION['donor_id'] = $donor_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['status'] = $status;
        header("Location: account.php");
        die;
    } else {
        //set user sessions if account is valid
        $_SESSION['donor_id'] = $donor_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['institution'] = $institution;
        $_SESSION['contact'] = $contact_number;
        $_SESSION['address'] = $address;
        $_SESSION['status'] = $status;
    }

}
