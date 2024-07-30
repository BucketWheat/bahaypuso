<?php

include("connections.php");

if (isset($_POST['staff'])) {
    $staff = mysqli_real_escape_string($con, $_POST['staff']);

    $query = "SELECT * FROM tbl_staff WHERE name='" . $staff . "' WHERE status ='Active'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $response = '<div class="alert alert-success" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Name of staff matched.</div>';
        $staff_id = $row['staff_id'];

    } else {
        $response = '<div class="alert alert-danger" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">No matching data.</div>';
        $staff_id = '';
    }
    echo json_encode (array('response'=>$response, 'staff_id'=>$staff_id));
    die;
}
