<?php
session_start();
require "../functions/connections.php";
/* IF USER CLICK SAVE IN ACCOUNT */
if (isset($_POST['Save'])) {
    $email = $_SESSION['email'];
    $save_name = mysqli_real_escape_string($con, $_POST['fullname']);
    $save_institution = mysqli_real_escape_string($con, $_POST['institution']);
    $save_contact = mysqli_real_escape_string($con, $_POST['contact']);
    $save_address = mysqli_real_escape_string($con, $_POST['address']);
    $save_email = mysqli_real_escape_string($con, $_POST['email']);

    //UPDATE ACCOUNT DETAILS
    $query_save = "UPDATE tbl_donor SET fullname = '$save_name', institution = '$save_institution', contact_number = '$save_contact', address = '$save_address', email = '$save_email' WHERE email = '$email'";
    $run_save = mysqli_query($con, $query_save);

    if ($run_save) {
        $_SESSION['info'] = "account updated";
        header("Location: ../donation_index.php");
        exit;
    } else {
        $errors['db-error'] = "Database Error!";
        header("Location: ../account.php");
        exit;
    }
} else {
    $errors['fatal'] = "Something went wrong!";
    header("Location: ../account.php");
    die;
}