<!-- check doctor if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/staff_pages_sessions.php");
include("functions/update_account.php");
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

    <!-- DATA TABLES CSS PLUGIN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/pages.css">
    <link rel="shortcut icon" href="../../imgs/logo.png">

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><span class="fas fa-heartbeat"></span> Healthcare</h3>
            </div>

            <ul class="list-unstyled components">
                <div style="text-align: center; margin-bottom: .5em;">
                    <h5 style="margin: 0;"><?php echo $staff_fname . " " . $staff_lname; ?></h5>
                    <small><?php echo $role ?></small>
                </div>
                <li>
                    <a href="staff_index.php"><span class="far fa-chart-bar"></span> Dashboard</a>
                </li>
                <li>
                    <a href="seniors.php"><span class="fas fa-users"></span> Seniors</a>
                </li>
                <li>
                    <a href="#hrSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-file-medical-alt"></span> Health Information</a>
                    <ul class="collapse list-unstyled" id="hrSubmenu">
                        <li>
                            <a href="healthinformation.php">Health Records</a>
                        </li>
                        <li>
                            <a href="healthinformation_administered.php">Administered Health Records</a>
                        </li>
                        <li>
                            <a href="healthinformation_cancelled.php">Cancelled Health Records</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#trSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="far fa-calendar-alt"></span> Treatment Progress</a>
                    <ul class="collapse list-unstyled" id="trSubmenu">
                        <li>
                            <a href="treatment_progress_calendar.php">Treatment Calendar</a>
                        </li>
                        <li>
                            <a href="treatment_progress.php">Treatment Progress</a>
                        </li>
                        <li>
                            <a href="treatment_progress_pending.php">Pending Treatments</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#recommendationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="far fa-thumbs-up"></span> Recommendations</a>
                    <ul class="collapse list-unstyled" id="recommendationSubmenu">
                        <li>
                            <a href="recommendation_photos.php">Photos</a>
                        </li>
                        <li>
                            <a href="recommendation_videos.php">Videos</a>
                        </li>
                        <li>
                            <a href="recommendation_articles.php">Articles</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#"><span class="far fa-user-circle"></span> Account</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="logout.php" class="download">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Account</span>
                    </button>
                </div>
            </nav>

            <main>

                <!-- ADD, SEARCH, PAGINATION HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Account Information</strong></h4>
                    </div>
                </div>
                <div class="card" style="margin-top: 1rem;">
                    <div class="card-body">
                        <div class="form-container">
                            <form action="crud/updatestaff.php" method="POST">
                                <input type="hidden" name="updateID" id="updateID">
                                <input type="hidden" name="staff_fname" id="staff_fname" value="<?php echo $_SESSION['staff_fname']; ?>">
                                <input type="hidden" name="staff_lname" id="staff_lname" value="<?php echo $_SESSION['staff_lname']; ?>">
                                <input type="hidden" name="staff_username" id="staff_username" value="<?php echo $_SESSION['staff_username']; ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="updateFname">Firstname</label>
                                        <input type="text" class="form-control" name="updateFname" id="updateFname" placeholder="Enter Firstname" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="updateLname">Lastname</label>
                                        <input type="text" class="form-control" name="updateLname" id="updateLname" placeholder="Enter Lastname" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateAddress">Complete Address</label>
                                    <input type="text" class="form-control" name="updateAddress" id="updateAddress" placeholder="Enter complete address" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="updateDOB">Date of Birth</label>
                                        <input type="date" class="form-control" name="updateDOB" id="updateDOB" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="updateAge">Age</label>
                                        <input type="number" class="form-control" name="updateAge" id="updateAge" step="1" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="updateSex">Sex</label>
                                        <select id="updateSex" name="updateSex" class="form-control">
                                            <option selected>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="updatePRC">PRC License Number</label>
                                        <input type="text" class="form-control" name="updatePRC" id="updatePRC" pattern="[0-9]{7,}" title="License Number must be 7-digit" placeholder="(optional)" maxlength="7">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="updateContact">Contact Number</label>
                                        <input type="text" class="form-control" name="updateContact" id="updateContact" placeholder="Enter contact number" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateEmail">Email</label>
                                    <input type="email" class="form-control" name="updateEmail" id="updateEmail" placeholder="example@example.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateUsername">Username</label>
                                    <input type="text" class="form-control" name="updateUsername" id="updateUsername" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter username" required autocomplete="off">
                                    <span id="status"></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" name="updateStaff" id="updateStaff" class="btn btn-primary" style="background-color: rgb(52, 160, 160); float:right;"></input>
                                </div>
                            </form>
                            <div class="card-body">
                                <a class="text" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Update Password <i class="fas fa-chevron-down"></i>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form action="crud/updatestaff_password.php" method="POST">
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
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Bootstrap and Jquery plugin -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!-- Data tables plugin -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <!-- FONTAWESOME ICONS PLUGIN -->
        <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

        <!-- External JS -->
        <script src="../../js/sidebar_active.js"></script>
        <script src="../../js/password_toggle.js"></script>
        <script src="../../js/staff_js/load_account_details_staff.js"></script>
        <script src="../../js/staff_js/check_username_staff.js"></script>
        <script src="../../js/staff_js/confirm_password.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Account Information Successfully Updated",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'not updated') {
        ?>
            <script>
                swal({
                    title: "Data not Updated",
                    text: "Nurse Information Update failed",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'password updated') {
        ?>
            <script>
                swal({
                    title: "Update password successful!",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'Incorrect') {
        ?>
            <script>
                swal({
                    title: "Update password failed!",
                    text: "Incorrect old password",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'empty') {
        ?>
            <script>
                swal({
                    title: "Update password failed!",
                    text: "Enter valid password",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        }
        unset($_SESSION['formSubmitted']);
        ?>
</body>

</html>