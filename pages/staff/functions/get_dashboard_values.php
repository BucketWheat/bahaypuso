<?php

include("connections.php");

//get senior count
$get_seniors = mysqli_query($con, "SELECT COUNT(*) as cntSenior FROM tbl_senior WHERE status ='Active'");
if ($get_seniors && mysqli_num_rows($get_seniors) > 0) {
    $senior_data = mysqli_fetch_assoc($get_seniors);
    $senior_count = $senior_data['cntSenior'];
} else {
    $senior_count = 0;
}

//get pending health records count
$get_pending_healthinfo = mysqli_query($con, "SELECT COUNT(*) as cntHealthinfo FROM tbl_healthinfo WHERE status = 'Pending'");
if ($get_pending_healthinfo && mysqli_num_rows($get_pending_healthinfo) > 0) {
    $healthinfo_data = mysqli_fetch_assoc($get_pending_healthinfo);
    $healthinfo_count = $healthinfo_data['cntHealthinfo'];
} else {
    $healthinfo_count = 0;
}

//get pending treatment count
$get_pending_treatment = mysqli_query($con, "SELECT COUNT(*) as cntTreatment FROM tbl_treatment WHERE status = 'Pending'");
if ($get_pending_treatment && mysqli_num_rows($get_pending_treatment) > 0) {
    $treatment_data = mysqli_fetch_assoc($get_pending_treatment);
    $treatment_count = $treatment_data['cntTreatment'];
} else {
    $treatment_count = 0;
}

//get treatments in progress count
$treatment_progress = mysqli_query($con, "SELECT COUNT(*) as cntProgress FROM tbl_treatment_progress WHERE status ='Active'");
if ($treatment_progress && mysqli_num_rows($treatment_progress) > 0) {
    $treatment_progress_data = mysqli_fetch_assoc($treatment_progress);
    $treatment_progress_count = $treatment_progress_data['cntProgress'];
} else {
    $treatment_progress_count = 0;
}