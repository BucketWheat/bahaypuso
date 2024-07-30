<?php

include("connections.php");

if (isset($_POST['nurse_id'])) {
    $nurse_id = $_POST['nurse_id'];

    $query = "SELECT * FROM tbl_nurse WHERE nurse_id= $nurse_id";

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
