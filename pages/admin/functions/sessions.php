<?php

if(isset($_SESSION['username_admin'])) {

    $user = $_SESSION['username_admin'];
    $query = "select * from tbl_admin where username = '$user' limit 1";

    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $name = $user_data['name'];
    }
}
else {
    //redirect to login
    header("Location: ../adminlogin.php");
    die;
}


    