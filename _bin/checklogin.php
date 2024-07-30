<?php
    session_start();

    if (isset($_SESSION['level'])) {
        //check if someone is logged in by its level
        if ($_SESSION['level'] == 1) {
            //redirect to admin index
            header("Location: ../adminlogin/admin_index.php");
            die;
        }elseif ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
            header("Location: ../doctorlogin/doctor_index.php");
            die;
        }elseif ($_SESSION['level'] == 4) {
            header("Location: ../userlogin/user_index.php");
            die;
        }
    }
?>