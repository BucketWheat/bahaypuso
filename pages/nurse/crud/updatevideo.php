<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-video-update'])) {

    //get values
    $video_id = $_POST['video-id'];
    $title = $_POST['title-video-update'];
    $desc = $_POST['description-video-update'];
    $file = $_FILES['file-video-update'];

    if (!empty($video_id) && !empty($title) && !empty($desc)) {

        // check if video was updated
        if (file_exists($_FILES['file-video-update']['tmp_name']) && is_uploaded_file($_FILES['file-video-update']['tmp_name'])) {
            //get posted file values
            $vid_name = $_FILES['file-video-update']['name'];
            $vid_size = $_FILES['file-video-update']['size'];
            $tmp_name = $_FILES['file-video-update']['tmp_name'];
            $error = $_FILES['file-video-update']['error'];

            if ($error === 0) {
                //check if video is greater than 1gb
                if ($vid_size > 1073741824) {
                    $_SESSION['formSubmitted'] = 'oversized_vid';
                    header("Location: ../recommendation_management.php?#datatable-video");
                    die;
                } else {
                    //check valid file extension
                    $vid_extension = pathinfo($vid_name, PATHINFO_EXTENSION);
                    $vid_extension_tolower = strtolower($vid_extension);

                    //set valid file extension
                    $allowed_extension = array('mp4', 'mov');

                    //check if extension is valid
                    if (in_array($vid_extension_tolower, $allowed_extension)) {
                        $new_vid_name = uniqid("VID-", true) . '.' . $vid_extension_tolower;
                        $vid_upload_path = '../../../uploads/videos/' . $new_vid_name;
                        move_uploaded_file($tmp_name, $vid_upload_path);

                        //get file to be deleted
                        $run_get = mysqli_query($con, "SELECT recommendation_video_path FROM tbl_recommendation_video WHERE recommendation_video_id = $photo_id LIMIT 1");

                        if ($run_get && mysqli_num_rows($run_get) > 0) {
                            $data = mysqli_fetch_assoc($run_get);
                            $del_file = $data['recommedation_video_path'];
                        }

                        //update database
                        $query = "UPDATE tbl_recommendation_video SET recommendation_video_title='$title', recommendation_video_description='$desc', recommendation_video_path='$new_vid_name' WHERE recommendation_video_id = $video_id";

                        $run = mysqli_query($con, $query);

                        if ($run) {
                            // DELETE ALL TMP FILES FIRST
                            // Folder path to be flushed
                            $folder_path = '../../../uploads/tmp/';

                            // List of name of files inside
                            // specified folder
                            $files = glob($folder_path . '/*');

                            // Deleting all the files in the list
                            foreach ($files as $file) {

                                if (is_file($file))

                                    // Delete the given file
                                    unlink($file);
                            }

                            // DELETE FILE TO BE UPDATED
                            $del_path = '../../../uploads/photos/';
                            $del_file = $del_path . $del_file;
                            unlink($del_file);
                            
                            $_SESSION['formSubmitted'] = 'updated';
                            header("Location: ../recommendation_management.php?#datatable-video");
                            die;
                        } else {
                            $_SESSION['formSubmitted'] = 'db error';
                            header("Location: ../recommendation_management.php?#datatable-video");
                            die;
                        }
                    } else {
                        $_SESSION['formSubmitted'] = 'invalid type';
                        header("Location: ../recommendation_management.php?#datatable-video");
                        die;
                    }
                }
            } else {
                $_SESSION['formSubmitted'] = 'update_failed';
                header("Location: ../recommendation_management.php?#datatable-video");
                die;
            }
        } else {
            //update database
            $query = "UPDATE tbl_recommendation_video SET recommendation_video_title='$title', recommendation_video_description='$desc' WHERE recommendation_video_id = $video_id";

            $run = mysqli_query($con, $query);

            if ($run) {
                $_SESSION['formSubmitted'] = 'updated';
                header("Location: ../recommendation_management.php?#datatable-video");
                die;
            } else {
                $_SESSION['formSubmitted'] = 'db error';
                header("Location: ../recommendation_management.php?#datatable-video");
                die;
            }
        }
    } else {
        $_SESSION['formSubmitted'] = 'failed';
        header("Location: ../recommendation_management.php?#datatable-video");
        die;
    }
}
/* echo $title . "<br/>";
echo $desc . "<br/>";
echo $vid_name . "<br/>";
echo $error . "<br/>";
 */