<?php

session_start();
include "connections.php";

$filename = "senior_list.csv";
$fp = fopen('php://output', 'w');

$header = array('ID', 'Name of Senior', 'Address', 'Date of Birth', 'Age', 'Sex', 'Weight', 'Bloodtype', 'Medication', 'Condition Description', 'Name of Guardian');

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT tbl_senior.senior_id, CONCAT(tbl_senior.fname,' ',tbl_senior.lname) AS Seniorfullname, tbl_senior.address, tbl_senior.dob, tbl_senior.age, tbl_senior.sex, tbl_senior.weight, tbl_senior.bloodtype, tbl_senior.medication, tbl_senior.condition_description, CONCAT(tbl_guardian.fname,' ',tbl_guardian.lname) AS Guardianfullname FROM tbl_senior INNER JOIN tbl_guardian ON tbl_senior.guardian_id = tbl_guardian.guardian_id WHERE tbl_senior.status !='Inactive'";

$result = mysqli_query($con, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
fclose($fp);

exit;
?>