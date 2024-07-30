<?php

    session_start();

    if (isset($_SESSION['username'])) {
        
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        session_destroy();
    }

    header("Location: ../guardianlogin.php");
    die;