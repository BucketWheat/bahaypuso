<?php

include("connections.php");

if (isset($_POST['staff_id'])) {
    $staff_id = $_POST['staff_id'];

    $query = "SELECT * FROM tbl_staff WHERE staff_id= $staff_id";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $fname = $row['fname'];
        $lname = $row['lname'];

    } else {
        $fname = 'Not found';
        $lname = 'Not Found';
    }
    mysqli_close($con);
    echo json_encode (array('fname'=>$fname, 'lname'=>$lname));
    die;
}
