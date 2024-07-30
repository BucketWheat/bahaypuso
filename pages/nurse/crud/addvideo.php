<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-video'])) {

    //get values
    $title = $_POST['title-video'];
    $desc = $_POST['description-video'];
    $file = $_FILES['file-video'];
    date_default_timezone_set("Asia/Manila");
    $date_created = date("Y-m-d");
    $created_by = $_POST['uploader-video'];

    //get posted file values
    $vid_name = $_FILES['file-video']['name'];
    $vid_size = $_FILES['file-video']['size'];
    $tmp_name = $_FILES['file-video']['tmp_name'];
    $error = $_FILES['file-video']['error'];

    if (!empty($title) && !empty($desc) && !empty($file) && !empty($created_by)) {

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

                    //insert into database
                    $query = "INSERT INTO tbl_recommendation_video (recommendation_video_title, recommendation_video_description, recommendation_video_path, date_created, created_by) VALUES ('$title', '$desc', '$new_vid_name', '$date_created', '$created_by')";

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
                        $_SESSION['formSubmitted'] = 'added';
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
            $_SESSION['formSubmitted'] = 'failed';
            header("Location: ../recommendation_management.php?#datatable-video");
            die;
        }
    } else {
        $_SESSION['formSubmitted'] = 'failed';
        header("Location: ../recommendation_management.php?#datatable-video");
        die;
    }
}
 /* echo $title."<br/>";
        echo $desc."<br/>";
        echo $vid_name."<br/>";
        echo $created_by."<br/>"; */