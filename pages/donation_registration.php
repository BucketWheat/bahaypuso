<?php
require_once "functions/userdata_controller.php";
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
    <title>Sign Up</title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="navs">
                <div class="home">
                    <a href="index.php"><img src="../imgs/logo.png" alt="logo" width="70px" height="70px" title="Home"></a>
                </div>
                <div class="close">
                    <span><a href="donation_login.php" title="Go Back"><i class="fas fa-times"></i></a></span>
                </div>
            </div>
            <div class="login d-flex mx-auto align-items-center">
                <div class="form-container mx-auto">
                    <h3 class="login-heading mb-3">Sign Up</h3>
                    <?php
                    if (count($errors) == 1) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    } elseif (count($errors) > 1) {
                    ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                            ?>
                                <li><?php echo $showerror; ?></li>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Sign In Form -->
                    <form action="donation_registration.php" method="post" autocomplete="off">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="johndoe123" value="<?php echo $name ?>" required>
                            <label for="fullname">Full name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@email.com" value="<?php echo $email ?>" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="inputPassword" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password" required>
                            <span id="eye1" onclick="eyeToggle()"><i class="far fa-eye"></i></span>
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Password" required>
                            <label for="passwordConfirm">Confirm Password</label>
                        </div>
                        <div class="status mb-3"></div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2" type="submit" id="SignUp" name="SignUp">Sign Up</button>
                            <div class="text-center">
                                <small>Already have an account? </small><a class="small" href="donation_login.php">Login</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="../js/donor_js/confirmpassword.js"></script>

    <!-- External JS -->
    <script src="../js/admin_js/password_toggle.js"></script>
</body>

</html>