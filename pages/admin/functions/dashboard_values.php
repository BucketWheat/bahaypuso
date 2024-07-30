<?php

include("connections.php");

$query = "SELECT COUNT(*) as cntNurse FROM tbl_nurse WHERE status = 'Active'";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $nurseCount = $row['cntNurse'];

    if ($nurseCount > 0) {
        $totalNurses = $nurseCount;
    }else {
        $totalNurses = 0;
    }
}

$query2 = "SELECT COUNT(*) as cntStaff FROM tbl_staff WHERE status ='Active'";

$result2 = mysqli_query($con, $query2);

if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_array($result2);

    $staffCount = $row2['cntStaff'];

    if ($staffCount > 0) {
        $totalStaff = $staffCount;
    }else {
        $totalStaff = 0;
    }
}

$query3 = "SELECT COUNT(*) as cntGuardian FROM tbl_guardian WHERE status ='Active'";

$result3 = mysqli_query($con, $query3);

if (mysqli_num_rows($result3) > 0) {
    $row3 = mysqli_fetch_array($result3);

    $guardianCount = $row3['cntGuardian'];

    if ($guardianCount > 0) {
        $totalGuardians = $guardianCount;
    }else {
        $totalGuardians = 0;
    }
}

$query4 = "SELECT COUNT(*) as cntSenior FROM tbl_senior WHERE status ='Active'";

$result4 = mysqli_query($con, $query4);

if (mysqli_num_rows($result4) > 0) {
    $row4 = mysqli_fetch_array($result4);

    $seniorCount = $row4['cntSenior'];

    if ($seniorCount > 0) {
        $totalSeniors = $seniorCount;
    }else {
        $totalSeniors = 0;
    }
}

$query5 = "SELECT COUNT(*) as cntPending FROM tbl_donation WHERE status = 'Pending' ";

$result5 = mysqli_query($con, $query5);

if (mysqli_num_rows($result5) > 0) {
    $row5 = mysqli_fetch_array($result5);

    $pendingCount = $row5['cntPending'];

    if ($pendingCount > 0) {
        $pendingTotal = $pendingCount;
    }else {
        $pendingTotal = 0;
    }
}

$query6 = "SELECT COUNT(*) as cntReceived FROM tbl_donation WHERE MONTH(date_received) = MONTH(NOW()) AND YEAR(date_received) = YEAR(NOW()) AND status = 'Received'";

$result6 = mysqli_query($con, $query6);

if (mysqli_num_rows($result6) > 0) {
    $row6 = mysqli_fetch_array($result6);

    $receivedCount = $row6['cntReceived'];

    if ($receivedCount > 0) {
        $receivedDonation = $receivedCount;
    }else {
        $receivedDonation = 0;
    }
}

$query7 = "SELECT COUNT(*) as cntAdmin FROM tbl_admin";

$result7 = mysqli_query($con, $query7);

if (mysqli_num_rows($result7) > 0) {
    $row7 = mysqli_fetch_array($result7);

    $adminCount = $row7['cntAdmin'];

    if ($adminCount > 0) {
        $totalAdmin = $adminCount;
    }else {
        $totalAdmin = 0;
    }
}
