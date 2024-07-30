<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-photo'])) {

    //get values
    $title = $_POST['title-photo'];
    $desc = $_POST['description-photo'];
    $file = $_FILES['file-photo'];
    date_default_timezone_set("Asia/Manila");
    $date_created = date("Y-m-d");
    $created_by = $_POST['uploader-photo'];

    //get posted file values
    $img_name = $_FILES['file-photo']['name'];
    $img_size = $_FILES['file-photo']['size'];
    $tmp_name = $_FILES['file-photo']['tmp_name'];
    $error = $_FILES['file-photo']['error'];

    if (!empty($title) && !empty($desc) && !empty($file) && !empty($created_by)) {

        if ($error === 0) {
            //check if image is greater than 25mb
            if ($img_size > 26214400) {
                $_SESSION['formSubmitted'] = 'oversized';
                header("Location: ../recommendation_management.php?#datatable-photo");
                die;
            } else {
                //check valid file extension
                $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_extension_tolower = strtolower($img_extension);

                //set valid file extension
                $allowed_extension = array("jpg", "jpeg", "png");

                //check if extension is valid
                if (in_array($img_extension_tolower, $allowed_extension)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_extension_tolower;
                    $img_upload_path = '../../../uploads/photos/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    //insert into database
                    $query = "INSERT INTO tbl_recommendation_photo (recommendation_photo_title, recommendation_photo_description, recommendation_photo_path, date_created, created_by) VALUES ('$title', '$desc', '$new_img_name', '$date_created', '$created_by')";

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
                        header("Location: ../recommendation_management.php?#datatable-photo");
                        die;
                    } else {
                        $_SESSION['formSubmitted'] = 'db error';
                        header("Location: ../recommendation_management.php?#datatable-photo");
                        die;
                    }
                } else {
                    $_SESSION['formSubmitted'] = 'invalid type';
                    header("Location: ../recommendation_management.php?#datatable-photo");
                    die;
                }
            }
        } else {
            $_SESSION['formSubmitted'] = 'failed';
            header("Location: ../recommendation_management.php?#datatable-photo");
            die;
        }
    } else {
        $_SESSION['formSubmitted'] = 'failed';
        header("Location: ../recommendation_management.php?#datatable-photo");
        die;
    }
}
 /* echo $title."<br/>";
        echo $desc."<br/>";
        echo $img_name."<br/>";
        echo $created_by."<br/>"; */