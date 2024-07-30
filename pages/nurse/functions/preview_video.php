<?php
/* UPLOAD NEW FILES TO TMP FOLDER */
// filename
$filename = $_FILES['file']['name'];

// location
$location = '../../../uploads/tmp/'.$filename;

// valid file extensions
$file_extenstion = pathinfo($location, PATHINFO_EXTENSION);
$file_extenstion = strtolower($file_extenstion);

$img_extension = array('mp4', 'mov');

$response = 0;

if (in_array($file_extenstion, $img_extension)) {
    // upload file to tmp folder
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        $response = $filename;
    }
}
echo $response;
exit;
