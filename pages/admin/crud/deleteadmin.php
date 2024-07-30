<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['deletedata'])) {

    $admin_id = $_POST['delete-id'];

    $query = "DELETE FROM tbl_admin WHERE admin_id = '$admin_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        header("Location: ../adminpages/admins.php");
        $_SESSION['formSubmitted'] = 'deleted';
        die;
    }
}
