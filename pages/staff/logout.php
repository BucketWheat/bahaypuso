<?php

    session_start();

    if (isset($_SESSION['nurse_username']) || isset($_SESSION['staff_username'])) {
        
        unset($_SESSION['staff_fname']);
        unset($_SESSION['staff_lname']);
        unset($_SESSION['staff_username']);
        unset($_SESSION['staff_level']);
        session_destroy();
    }

    header("Location: ../stafflogin.php");
    die;