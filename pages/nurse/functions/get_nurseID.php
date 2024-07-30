<?php

include("connections.php");

if (isset($_POST['nurseName'])) {
    $nurseName = $_POST['nurseName'];

    //get name of guardian from tbl_guardian using guardian_id as foreign key
    $query = "SELECT nurse_id FROM tbl_nurse WHERE name = '$nurseName' ";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $nurseID = $row['nurse_id'];
    } else {
        $nurseID = '';
    }
    echo $nurseID;
}
