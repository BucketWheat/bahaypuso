<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['delete-video'])) {

    $video_id = $_POST['delete-video-id'];

    //get file to be deleted
    $run_get = mysqli_query($con, "SELECT recommendation_video_path FROM tbl_recommendation_video WHERE recommendation_video_id = $photo_id LIMIT 1");

    if ($run_get && mysqli_num_rows($run_get) > 0) {
        $data = mysqli_fetch_assoc($run_get);
        $del_file =$data['recommedation_video_path'];
    }

    $query = "DELETE FROM tbl_recommendation_video WHERE recommendation_video_id = '$video_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // DELETE FILE
        $del_path = '../../../uploads/photos/';
        $del_file = $del_path.$del_file;
        unlink($del_file);
        
        header("Location: ../recommendation_management.php?#datatable-video");
        $_SESSION['formSubmitted'] = 'deleted';
        die;
    }
}
