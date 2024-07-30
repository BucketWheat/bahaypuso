<?php

include("connections.php");

if (isset($_POST['senior'])) {
    $senior = ($_POST['senior']);

    $query = "SELECT senior_id, CONCAT(fname, ' ', lname) as Fullname FROM tbl_senior WHERE status = 'Active'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            if ($row['Fullname'] == $senior) {

                $response = '<div class="alert alert-success" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Name of senior matched.</div>';
                $senior_id = $row['senior_id'];
                break;
            } else {

                $response = '<div class="alert alert-danger" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">No matching data.</div>';
                $senior_id = '';
            }
        }
    }
    echo json_encode(array("response" => $response, "senior_id" => $senior_id));
    die;
}
