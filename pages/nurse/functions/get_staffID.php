<?php

include("connections.php");

if (isset($_POST['staffName'])) {
    $staffName = trim($_POST['staffName']);

    $query = "SELECT staff_id, CONCAT(fname, ' ', lname) AS Fullname FROM tbl_staff";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            if ($staffName == $row['Fullname']) {
                $staffID = $row['staff_id'];
                break;
            }
        }
    } else {
        $staffID = '';
    }
    echo $staffID;
}
