<?php
//initial value of err-message
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //getting values from the login form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (!empty($user) && !empty($pass) && !is_numeric($user)) {

        //read from the database
        $query = "select * from tbl_admin where username = '$user' limit 1";
        $result = mysqli_query($con, $query);

        //check for user account
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                
                $user_data = mysqli_fetch_assoc($result);
        
                if (password_verify($pass, $user_data['password'])) {

                    //set session data
                    $_SESSION['username'] = $user_data['username'];
                    $_SESSION['level'] = $user_data['level'];

                    //set cookie for keeping userdata on the input fields
                    if (!empty($_POST['remember'])) {
                        setcookie("username", $user, time() + (10 * 365 * 24 * 60 * 60));
                        /* setcookie("password", $pass, time() + (10 * 365 * 24 * 60 * 60)); */
                    }
                    else {
                        if (isset($_COOKIE['username'])) {
                            setcookie('username', '');
                        }
                        /* if (isset($_COOKIE['password'])) {
                            setcookie('password', '');
                        } */
                    }
                    //go to user index page
                    header("Location: admin_index.php");
                    die;
                }
                else {
                    $msg = "Incorrect username or password!";
                }
            }
            else {
                $msg = "User not found!";
            }
        }
    }
}