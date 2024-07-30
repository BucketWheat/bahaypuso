<?php

include("connections.php");

$query = "SELECT tbl_treatment_progress.treatment_progress_id, tbl_treatment_progress.treatment_progress_description, tbl_treatment_progress.treatment_progress_start, tbl_treatment_progress.treatment_progress_end, CONCAT(tbl_senior.fname,' ',tbl_senior.lname) AS senior FROM tbl_treatment_progress INNER JOIN tbl_senior ON tbl_treatment_progress.senior_id = tbl_senior.senior_id WHERE tbl_treatment_progress.status != 'Cancelled' ORDER BY treatment_progress_id";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    foreach ($result as $row) {
        $data[] = array(
            'id'=>$row['treatment_progress_id'],
            'title'=>$row['treatment_progress_description'],
            'description'=>$row['senior'],
            'start'=>$row['treatment_progress_start'],
            'end'=>$row['treatment_progress_end']
        );
    }
    echo json_encode($data);
}
