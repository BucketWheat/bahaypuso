<?php

include("connections.php");

if (isset($_POST['seniorName'])) {
    $seniorName = $_POST['seniorName'];

    $query = "SELECT tbl_senior.senior_id, CONCAT(tbl_senior.fname, ' ', tbl_senior.lname) AS Fullname FROM tbl_healthinfo INNER JOIN tbl_senior ON tbl_healthinfo.senior_id = tbl_senior.senior_id WHERE tbl_healthinfo.status = 'Pending' AND tbl_senior.status = 'Active'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            if ($seniorName == $row['Fullname']) {
                $seniorID = $row['senior_id'];
                break;
            }
        }
    } else {
        $seniorID = '';
    }
    echo $seniorID;
}
