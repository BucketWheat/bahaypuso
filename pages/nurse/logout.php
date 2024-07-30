<?php

    session_start();

    if (isset($_SESSION['nurse_username']) || isset($_SESSION['staff_username'])) {
        
        unset($_SESSION['nurse_fname']);
        unset($_SESSION['nurse_lname']);
        unset($_SESSION['nurse_username']);
        unset($_SESSION['nurse_level']);
        session_destroy();
    }

    header("Location: ../stafflogin.php");
    die;