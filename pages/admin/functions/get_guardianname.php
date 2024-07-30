<?php

include("../functions/connections.php");

if (isset($_POST['guardianID'])) {
    $guardianID = $_POST['guardianID'];

    //get name of guardian from tbl_guardian using guardian_id as foreign key
    $query = "SELECT tbl_senior.senior_id, tbl_guardian.* FROM tbl_senior, tbl_guardian WHERE tbl_senior.guardian_id = tbl_guardian.guardian_id AND tbl_senior.guardian_id = '$guardianID'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $guardianName = $row['fname'] . " " . $row['lname'];
    }else {
        $guardianName = '';
    }
    echo $guardianName;
    mysqli_close($con);
}