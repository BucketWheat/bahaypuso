<?php

include("connections.php");

if (isset($_POST['guardian'])) {
    $guardian = mysqli_real_escape_string($con, $_POST['guardian']);

    $query = "SELECT * FROM tbl_guardian WHERE name='" . $guardian . "' AND status ='Active'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $response = '<div class="alert alert-success" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Guardian fullname matched.</div>';
        /* $response = 'Guardian fullname matched.'; */
        $guardian_id = $row['guardian_id'];

    } else {
        $response = '<div class="alert alert-danger" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">Guardian not found.</div>';
        /* $response = 'Guardian fullname not found.'; */
        $guardian_id = '';
    }
    echo json_encode (array('response'=>$response, 'guardian_id'=>$guardian_id));
    die;
}
