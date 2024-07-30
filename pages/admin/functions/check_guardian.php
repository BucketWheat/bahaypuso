<?php

include("connections.php");

if (isset($_POST['guardian'])) {
    $guardian_trim = trim($_POST['guardian']);
    $guardian = mysqli_real_escape_string($con, $guardian_trim);

    $query = "SELECT guardian_id, CONCAT(`fname`, ' ', `lname`) as name from tbl_guardian WHERE status = 'Active'";

    $result = mysqli_query($con, $query);

    //get results
    while ($row = mysqli_fetch_array($result)) {

        //check if fullname matched
        if ($row['name'] == $guardian) {

            //set values
            $response = '<div class="alert alert-success" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Guardian fullname matched.</div>';

            $guardian_id = $row['guardian_id'];

            //if fullname matched break the loop
            break;
        } else {
            $response = '<div class="alert alert-danger" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">Guardian not found.</div>';

            $guardian_id = '';
        }
    }
    echo json_encode(array('response' => $response, 'guardian_id' => $guardian_id));
    die;
}
