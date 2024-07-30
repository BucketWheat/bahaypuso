<?php

    session_start();

    include("functions/connections.php");

    //initial value of err-message
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //getting values from the login form
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if (!empty($user) && !empty($pass) && !is_numeric($user)) {

            //read from the database
            $query = "select * from tbl_guardian where username = '$user' limit 1";
            $result = mysqli_query($con, $query);

            //check for user account
            if ($result) {
                if ($result && mysqli_num_rows($result) > 0) {
                    
                    $user_data = mysqli_fetch_assoc($result);
            
                    if (password_verify($pass, $user_data['password'])) {

                        //set session data
                        $_SESSION['username'] = $user_data['username'];
                        $_SESSION['level'] = $user_data['level'];
                        $_SESSION['guardian_id'] = $user_data['guardian_id'];

                        //set cookie for keeping userdata on the input fields
                        if (!empty($_POST['remember'])) {
                            setcookie("username", $user, time() + (10 * 365 * 24 * 60 * 60));
                           /*  setcookie("password", $pass, time() + (10 * 365 * 24 * 60 * 60)); */
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
                        header("Location: guardian/guardian_index.php");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="shortcut icon" href="../imgs/logo.png">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="title">
            <div class="arrow"><a href="index.php"><i class="fas fa-home" title="Home" style="font-size:30px; color:rgb(90, 139, 141);"></i></a></div>
            <div class="head"><h1>Login</h1></div>
        </div>
        <form method="post">
            <div class="text-field">
                <input type="text" name="username" id="userlogin" required autofocus="true" value="<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>">
                <span></span>
                <label>Username</label>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="userpass" required value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>">
                <span></span>
                <label>Password</label>
                <i class="far fa-eye" id="eye1" onclick="eyeToggle()"></i>
            </div>
            <div class="err-message"><?php echo $msg;?></div>
            <div class="remember_check">
                <input type="checkbox" name="remember" id="rememberMe" <?php if (isset($_COOKIE['username'])) {?> checked <?php }?>>
                <label for="remember" class="text-keep">Remember me</label>
            </div>
            <input type="submit" value="Login" style="margin-bottom: 2rem;">
        </form>
    </div>
    <script>
        var state = false;
        function eyeToggle (eyes){
            if (state) {
                document.getElementById("userpass").setAttribute("type", "password");
                document.getElementById("eye1").style.color='#666666';
                state = false;
            }
            else {
                document.getElementById("userpass").setAttribute("type", "text");
                document.getElementById("eye1").style.color='rgb(90, 139, 141)';
                state = true;
            }
        }
    </script>
</body>
</html>