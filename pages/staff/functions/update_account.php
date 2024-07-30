<?php
if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {

    $staff_query = "select * from tbl_staff where username = '$staff_username' limit 1";
    $staff_result = mysqli_query($con, $staff_query);

    if ($staff_result && mysqli_num_rows($staff_result) > 0) {
        $staff_data = mysqli_fetch_assoc($staff_result);

            $_SESSION['staff_fname'] = $staff_data['fname'];
            $_SESSION['staff_lname'] = $staff_data['lname'];
            $_SESSION['username'] = $staff_data['username'];
            
    }
}
