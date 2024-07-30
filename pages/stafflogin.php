<?php
include("functions/checklogin.php");
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
            <div class="head">
                <h1>Login</h1>
            </div>
        </div>
        <form method="post">
            <div class="text-field">
                <input type="text" name="username" id="userlogin" required autofocus="true" value="<?php if (isset($_COOKIE['username_nurse']) && $_COOKIE['username_nurse'] != '') {echo $_COOKIE['username_nurse'];} elseif (isset($_COOKIE['username_staff']) && $_COOKIE['username_staff'] != '') {echo $_COOKIE['username_staff'];} else {echo '';}?>">
                <span></span>
                <label>Username</label>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="userpass" required value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>">
                <span></span>
                <label>Password</label>
                <i class="far fa-eye" id="eye1" onclick="eyeToggle()"></i>
            </div>
            <div class="err-message"><?php echo $msg; ?></div>
            <div class="remember_check">
                <input type="checkbox" name="remember" id="rememberMe" <?php if (isset($_COOKIE['username_nurse']) && $_COOKIE['username_nurse'] != '') { ?> checked <?php } elseif (isset($_COOKIE['username_staff']) && $_COOKIE['username_staff'] != '') {?> checked <?php } ?>>
            <label for="remember" class="text-keep">Remember me</label>
            </div>
            <input type="submit" value="Login" style="margin-bottom: 2rem;">
        </form>
    </div>
    <script>
        var state = false;

        function eyeToggle(eyes) {
            if (state) {
                document.getElementById("userpass").setAttribute("type", "password");
                document.getElementById("eye1").style.color = '#666666';
                state = false;
            } else {
                document.getElementById("userpass").setAttribute("type", "text");
                document.getElementById("eye1").style.color = 'rgb(90, 139, 141)';
                state = true;
            }
        }
    </script>
    <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'Incorrect') {
    ?>
        <script>
            swal({
                title: "Error Logging In",
                text: "Password is incorrect",
                icon: "warning",
                button: "Ok",
            });
        </script>
    <?php
    } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'User not found') {
    ?>
        <script>
            swal({
                title: "Error Logging In",
                text: "User not found",
                icon: "warning",
                button: "Ok",
            });
        </script>
    <?php
    }
    unset($_SESSION['formSubmitted']);
    ?>
</body>

</html>