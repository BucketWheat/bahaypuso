<?php
session_start();
if (isset($_SESSION['nurse_fname']) && isset($_SESSION['nurse_lname']) && isset($_SESSION['nurse_username']) && isset($_SESSION['nurse_level'])) {

    $nurse_username = $_SESSION['nurse_username'];

    /* CHECK IF NURSE ACCOUNT IS VALID */
    $nurse_query = "select * from tbl_nurse where username = '$nurse_username' limit 1";
    $nurse_result = mysqli_query($con, $nurse_query);

    if ($nurse_result && mysqli_num_rows($nurse_result) > 0) {
        $nurse_data = mysqli_fetch_assoc($nurse_result);

        if ($nurse_data['username'] === $nurse_username) {
            //get name and level
            $nurse_fname = $nurse_data['fname'];
            $nurse_lname = $nurse_data['lname'];
            $level = $nurse_data['level'];
            mysqli_close($con);
            if ($level == 2) {
                $role = 'Nurse';
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
