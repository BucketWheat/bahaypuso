<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-photo-update'])) {

    //get values
    $photo_id = $_POST['photo-id'];
    $title = $_POST['title-photo-update'];
    $desc = $_POST['description-photo-update'];
    $file = $_FILES['file-photo-update'];

    if (!empty($photo_id) && !empty($title) && !empty($desc)) {

        // check if photo was updated
        if (file_exists($_FILES['file-photo-update']['tmp_name']) && is_uploaded_file($_FILES['file-photo-update']['tmp_name'])) {
            //get posted file values
            $img_name = $_FILES['file-photo-update']['name'];
            $img_size = $_FILES['file-photo-update']['size'];
            $tmp_name = $_FILES['file-photo-update']['tmp_name'];
            $error = $_FILES['file-photo-update']['error'];

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

                        //get file to be updated
                        $run_get = mysqli_query($con, "SELECT recommendation_photo_path FROM tbl_recommendation_photo WHERE recommendation_photo_id = $photo_id LIMIT 1");

                        if ($run_get && mysqli_num_rows($run_get) > 0) {
                            $data = mysqli_fetch_assoc($run_get);
                            $del_file = $data['recommedation_photo_path'];
                        }

                        //update database
                        $query = "UPDATE tbl_recommendation_photo SET recommendation_photo_title='$title', recommendation_photo_description='$desc', recommendation_photo_path='$new_img_name' WHERE recommendation_photo_id = $photo_id";

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
                $_SESSION['formSubmitted'] = 'update_failed';
                header("Location: ../recommendation_management.php?#datatable-photo");
                die;
            }
        } else {
            //update database
            $query = "UPDATE tbl_recommendation_photo SET recommendation_photo_title='$title', recommendation_photo_description='$desc' WHERE recommendation_photo_id = $photo_id";

            $run = mysqli_query($con, $query);

            if ($run) {
                $_SESSION['formSubmitted'] = 'updated';
                header("Location: ../recommendation_management.php?#datatable-photo");
                die;
            } else {
                $_SESSION['formSubmitted'] = 'db error';
                header("Location: ../recommendation_management.php?#datatable-photo");
                die;
            }
        }
    } else {
        $_SESSION['formSubmitted'] = 'failed';
        header("Location: ../recommendation_management.php?#datatable-photo");
        die;
    }
}
/* echo $title . "<br/>";
echo $desc . "<br/>";
echo $img_name . "<br/>";
echo $error . "<br/>";
 */