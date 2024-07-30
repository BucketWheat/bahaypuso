<!-- check doctor if logged in -->
<?php
require_once "functions/checklogin.php";
require_once "functions/user_sessions.php"
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Account</title>

    <!-- MODAL BOOTSTRAP PLUGINS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/donation_account.css">
    <link rel="shortcut icon" href="../../imgs/logo.png">

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- BOOTSTRAP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(52, 160, 160);">
        <a class="navbar-brand" href="donation_index.php">
            <img src="../../imgs/logo.png" width="50" height="50" class="d-inline-block align-bottom" alt="Senior Care Logo">
            <span>Health Care</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="donation_index.php">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donations.php">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="account.php">Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <?php
        if (isset($_SESSION['info']) && $_SESSION['info'] == "account updated") {
        ?>
            <div class="alert alert-success text-center">
                <?php
                echo "You're all set! Now you can start donating.";
                ?>
            </div>
        <?php
        } else if (isset($_SESSION['info'])) {
        ?>
            <div class="alert alert-danger text-center">
                <?php echo $_SESSION['info']; ?>
            </div>
        <?php
        }
        ?>
        <div class="mainContent">
            <!-- ADD, SEARCH, PAGINATION HEADER -->
            <div class="card">
                <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                    <h4>Account Information</h4>
                </div>
                <div class="donateMain" id="donate">
                    <div class="card-body">
                        <div class="form-container">
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
                            <form action="crud/update_account.php" method="POST">
                                <div class="form-group">
                                    <label for="fullname">Fullname*</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your fullname" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" value="<?php echo $name ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="institution">Institution (<small>type n/a if none</small>)*</label>
                                    <input type="text" class="form-control" name="institution" id="institution" placeholder="Your institution" value="<?php echo $institution ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact Number*</label>
                                    <input type="text" class="form-control" name="contact" id="contact" placeholder="09123456789" title="Enter valid contact number" min="0" max="9" minlength="11" maxlength="11" value="<?php echo $contact ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Complete Address*</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter your complete address" value="<?php echo $address ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" value="<?php echo $email ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <span style="float:right;">
                                        <!-- <input type="submit" value="Edit" id="edit" name="edit" class="btn btn-secondary" ></input> -->
                                        <button type="submit" name="Save" class="btn btn-primary" style="background-color: rgb(52, 160, 160);">Save Changes</button>
                                    </span>
                                </div>
                            </form>
                            <!-- <div class="card-body">
                                <a class="text" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Update Password <i class="fas fa-chevron-down"></i>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form action="crud/updatenurse_password.php" method="POST">
                                            <div class="form-group">
                                                <label for="oldPassword">Old Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="oldPassword" id="oldPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter old password" required>
                                                    <span class="input-group-text passToggle" id="eyeOld" onclick="eyeToggleOld()"><i class="far fa-eye"></i></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="updatePassword">New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="updatePassword" id="updatePassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter new password" required>
                                                    <span class="input-group-text passToggle" id="eyeUpdate" onclick="eyeToggleUpdate()"><i class="far fa-eye"></i></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="passwordConfirm">Confirm New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Confirm new password" required>
                                                    <span class="input-group-text passToggle" id="eyeConfirm" onclick="eyeToggleConfirm()"><i class="far fa-eye"></i></span>
                                                </div>
                                                <div id="check_confirm"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Update" name="updatePass" id="updatePass" class="btn btn-primary" style="background-color: rgb(52, 160, 160); float:right;"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="message">
                <p><em>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi dolorem iste, officia et ratione ea? Qui officiis numquam doloremque reprehenderit, consectetur ratione, cumque quis sit harum optio corrupti asperiores autem accusantium dolores ab et. Ipsa ipsam aliquid recusandae fuga natus!</em></p>
            </div> -->
        </div>
    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>