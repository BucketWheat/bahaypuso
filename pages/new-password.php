<?php
require_once "functions/userdata_controller.php";
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: donation_login.php');
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
    <title>Create New Password</title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="navs" style="margin-bottom: 20vh;">
                <!-- <div class="home">
                    <a href="index.php" style="display: none;"><img src="../imgs/logo.png" alt="logo" width="70px" height="70px" title="Home"></a>
                </div>
                <div class="close">
                    <span><a href="donation_login.php" title="Go Back"><i class="fas fa-times"></i></a></span>
                </div> -->
            </div>
            <div class="login d-flex mx-auto align-items-center">
                <div class="form-container mx-auto">
                    <h3 class="login-heading mb-3">Forgot Password</h3>
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
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
                    <form action="new-password.php" method="post" autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="updatePassword" id="updatePassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password" required>
                        <span id="eyeUpdate" onclick="eyeToggleUpdate()"><i class="far fa-eye"></i></span>
                        <label for="updatePassword">Enter New Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Password" required>
                        <label for="passwordConfirm">Confirm New Password</label>
                    </div>
                    <div class="status mb-3"></div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2" type="submit" id="change-password" name="change-password">Change</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- EXTERNAL JS -->
    <script src="../js/password_toggle.js"></script>
</body>

</html>