<?php

session_start();

include("functions/connections.php");

//initial value err-message
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //getting values from the login form
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    //check if input is not empty
    if (!empty($inputUsername) && !empty($inputPassword)) {

        //read from the tbl_nurse
        $query_nurse = "select * from tbl_nurse where username = '$inputUsername' limit 1";
        $result_nurse = mysqli_query($con, $query_nurse);

        //read from the tbl_staff
        $query_staff = "select * from tbl_staff where username = '$inputUsername' limit 1";
        $result_staff = mysqli_query($con, $query_staff);

        //check if account exists
        if ($result_nurse && mysqli_num_rows($result_nurse) > 0 && mysqli_num_rows($result_staff) == 0) {

            /* FETCH DATA DATA OF NURSE ACCOUNT */
            $nurse_data = mysqli_fetch_assoc($result_nurse);
            $nurse_fname = $nurse_data['fname'];
            $nurse_lname = $nurse_data['lname'];
            $nurse_username = $nurse_data['username'];
            $nurse_password = $nurse_data['password'];
            $nurse_level = $nurse_data['level'];

            //check if password match
            if (password_verify($inputPassword, $nurse_password)) {

                //set nurse session data
                $_SESSION['nurse_id'] = $nurse_data['nurse_id'];
                $_SESSION['nurse_fname'] = $nurse_fname;
                $_SESSION['nurse_lname'] = $nurse_lname;
                $_SESSION['nurse_username'] = $nurse_username;
                $_SESSION['nurse_level'] = $nurse_level;

                //set cookie for keeping nursedata on the input fields if remember me is checked
                if (!empty($_POST['remember'])) {
                    if (isset($_COOKIE['username_staff'])) {
                        setcookie('username_staff', '');
                    }
                    setcookie("username_nurse", $nurse_username, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE['username_nurse'])) {
                        setcookie('username_nurse', '');
                    }
                }
                //go to nurse index page
                header("Location: nurse/nurse_index.php");
                die;
            } else {
                $msg = "Incorrect password!";
                $_SESSION['formSubmitted'] = 'Incorrect';
                if (isset($_COOKIE['username_nurse'])) {
                    setcookie('username_nurse', '');
                }
                header("Location: stafflogin.php");
                die;
            }
        }

        //check if account exists
        elseif ($result_staff && mysqli_num_rows($result_staff) > 0 && mysqli_num_rows($result_nurse) == 0) {

            /* FETCH DATA DATA OF STAFF ACCOUNT */
            $staff_data = mysqli_fetch_assoc($result_staff);
            $staff_fname = $staff_data['fname'];
            $staff_lname = $staff_data['lname'];
            $staff_username = $staff_data['username'];
            $staff_password = $staff_data['password'];
            $staff_level = $staff_data['level'];

            //check if password match
            if (password_verify($inputPassword, $staff_password)) {

                //set staff session data
                $_SESSION['staff_id'] = $staff_data['staff_id'];
                $_SESSION['staff_fname'] = $staff_fname;
                $_SESSION['staff_lname'] = $staff_lname;
                $_SESSION['staff_username'] = $staff_username;
                $_SESSION['staff_level'] = $staff_level;

                //set cookie for keeping nursedata on the input fields if remember me is checked
                if (!empty($_POST['remember'])) {
                    if (isset($_COOKIE['username_nurse'])) {
                        setcookie('username_nurse', '');
                    }
                    setcookie("username_staff", $staff_username, time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE['username_staff'])) {
                        setcookie('username_staff', '');
                    }
                }
                //go to nurse index page
                header("Location: staff/staff_index.php");
                die;
            } else {
                $msg = "Incorrect password!";
                $_SESSION['formSubmitted'] = 'Incorrect';
                if (isset($_COOKIE['username_staff'])) {
                    setcookie('username_staff', '');
                }
                header("Location: stafflogin.php");
                die;
            }
        } else {
            $msg = "User not found!";
            $_SESSION['formSubmitted'] = 'User not found';
            header("Location: stafflogin.php");
            die;
        }
    } else {
        $msg = 'Input valid account details';
    }
}
