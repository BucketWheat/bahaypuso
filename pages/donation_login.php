<?php
require_once "functions/userdata_controller.php";
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = "";
}
if (isset($_SESSION['error-email'])) {
    $errors['email'] = $_SESSION['error-email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP PLUGINS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- FONTAWESOME ICONS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/donation_login.css">
    <link rel="shortcut icon" href="../imgs/logo.png">
    <title>Login</title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="navs">
                <div class="home">
                    <a href="index.php"><img src="../imgs/logo.png" alt="logo" width="70px" height="70px" title="Home"></a>
                </div>
                <div class="close">
                    <span><a href="index.php" title="Go Back"><i class="fas fa-times"></i></a></span>
                </div>
            </div>
            <div class="login d-flex mx-auto align-items-center">
                <div class="form-container mx-auto">
                    <h3 class="login-heading mb-3">Login</h3>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Sign In Form -->
                    <form action="donation_login.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="login_email" placeholder="johndoe123" value="<?php echo $email ?>" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="login_password" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password" required>
                            <span id="eye1" onclick="eyeToggle()"><i class="far fa-eye"></i></span>
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="d-grid mb-3 px-2">
                            <!-- <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                            <label class="form-check-label" for="rememberPasswordCheck">
                                Remember me
                            </label> -->
                            <small><a href="forgot-password.php">Forgot password?</a></small>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2" type="submit" name="login">Log in</button>
                            <div class="text-center">
                                <small>Doesn't have an account? </small><a class="small" href="donation_registration.php">Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- External JS -->
    <script src="../js/admin_js/password_toggle.js"></script>

    <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['success']) && $_SESSION['success'] == 'success') {
    ?>
        <script>
            swal({
                title: "Verification Successful!",
                icon: "success",
                button: "Confirm",
            });
        </script>
    <?php
    } elseif (isset($_SESSION['success']) && $_SESSION['success'] == 'reset success') {
    ?>
        <script>
            swal({
                title: "Change Password Successful",
                icon: "success",
                button: "Confirm",
            });
        </script>
    <?php
    }
    unset($_SESSION['success']);
    ?>
</body>

</html>