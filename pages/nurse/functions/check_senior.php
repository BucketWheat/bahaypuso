<?php

include("connections.php");

if (isset($_POST['senior'])) {
    $senior = mysqli_real_escape_string($con, $_POST['senior']);

    $query = "SELECT * FROM tbl_senior WHERE name='" . $senior . "' AND status='Active'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $response = '<div class="alert alert-success" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Name of senior matched.</div>';
        $senior_id = $row['senior_id'];

    } else {
        $response = '<div class="alert alert-danger" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">No matching data.</div>';
        $senior_id = '';
    }
    echo json_encode (array('response'=>$response, 'senior_id'=>$senior_id));
    die;
}
