<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['delete-photo'])) {

    $photo_id = $_POST['delete-photo-id'];

    //get file to be deleted
    $run_get = mysqli_query($con, "SELECT recommendation_photo_path FROM tbl_recommendation_photo WHERE recommendation_photo_id = $photo_id LIMIT 1");

    if ($run_get && mysqli_num_rows($run_get) > 0) {
        $data = mysqli_fetch_assoc($run_get);
        $del_file =$data['recommedation_photo_path'];
    }

    $query = "DELETE FROM tbl_recommendation_photo WHERE recommendation_photo_id = '$photo_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // DELETE FILE
        $del_path = '../../../uploads/photos/';
        $del_file = $del_path.$del_file;
        unlink($del_file);
        header("Location: ../recommendation_management.php?#datatable-photo");
        $_SESSION['formSubmitted'] = 'deleted';
        die;
    }
}
