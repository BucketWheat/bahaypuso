<?php
if (isset($_SESSION['staff_fname']) && isset($_SESSION['staff_lname']) && isset($_SESSION['staff_username']) && isset($_SESSION['staff_level'])) {

    $staff_username = $_SESSION['staff_username'];

    /* CHECK IF STAFF ACCOUNT IS VALID */
    $staff_query = "select * from tbl_staff where username = '$staff_username' limit 1";
    $staff_result = mysqli_query($con, $staff_query);

    if ($staff_result && mysqli_num_rows($staff_result) > 0) {
        $staff_data = mysqli_fetch_assoc($staff_result);

        if ($staff_data['username'] === $staff_username) {
            //get name and level
            $_SESSION['staff_id'] = $staff_data['staff_id'];
            $staff_fname = $staff_data['fname'];
            $staff_lname = $staff_data['lname'];
            $level = $staff_data['level'];
            if ($level == 3) {
                $role = 'Medical Staff';
            }
        } else {
            //redirect to login
            header("Location: ../stafflogin.php");
            die;
        }
    } else {
        //redirect to login
        header("Location: ../stafflogin.php");
        die;
    }
} else {
    //redirect to login
    header("Location: ../stafflogin.php");
    die;
}
