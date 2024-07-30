<?php
if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {

    $nurse_query = "select * from tbl_nurse where username = '$nurse_username' limit 1";
    $nurse_result = mysqli_query($con, $nurse_query);

    if ($nurse_result && mysqli_num_rows($nurse_result) > 0) {
        $nurse_data = mysqli_fetch_assoc($nurse_result);

            $_SESSION['nurse_fname'] = $nurse_data['fname'];
            $_SESSION['nurse_lname'] = $nurse_data['lname'];
            $_SESSION['username'] = $nurse_data['username'];
            
    }
}
