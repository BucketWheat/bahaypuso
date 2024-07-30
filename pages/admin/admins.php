<!-- check user if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/sessions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admins</title>

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
                    <h5 style="margin: 0;"><?php echo ucwords($name) ?></h5>
                    <small>Admin</small>
                </div>
                <li>
                    <a href="admin_index.php"><span class="far fa-chart-bar"></span> Dashboard</a>
                </li>
                <li>
                    <a href="#nurseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-user-md"></span> Nurses</a>
                    <ul class="collapse list-unstyled" id="nurseSubmenu">
                        <li>
                            <a href="nurse_active.php">Active Nurses</a>
                        </li>
                        <li>
                            <a href="nurse_other.php">Other Nurses</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#staffsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-user-nurse"></span> Medical Staffs</a>
                    <ul class="collapse list-unstyled" id="staffsSubmenu">
                        <li>
                            <a href="staff_active.php">Active Medical Staffs</a>
                        </li>
                        <li>
                            <a href="staff_other.php">Other Medical Staffs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#guardianSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-users"></span> Guardians</a>
                    <ul class="collapse list-unstyled" id="guardianSubmenu">
                        <li>
                            <a href="guardian_active.php">Active Guardians</a>
                        </li>
                        <li>
                            <a href="guardian_other.php">Other Guardians</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#seniorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-users"></span> Seniors</a>
                    <ul class="collapse list-unstyled" id="seniorSubmenu">
                        <li>
                            <a href="senior_active.php">Seniors list</a>
                        </li>
                        <li>
                            <a href="senior_other.php">Other Seniors</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#donationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-donate"></span> Donations</a>
                    <ul class="collapse list-unstyled" id="donationSubmenu">
                        <li>
                            <a href="donation_pending.php">Pending</a>
                        </li>
                        <li>
                            <a href="donation_received.php">Received</a>
                        </li>
                        <li>
                            <a href="donation_cancelled.php">Cancelled</a>
                        </li>
                        <li>
                            <a href="donation_messages.php">Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="admins.php"><span class="far fa-user-circle"></span> Admins</a>
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

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Admins</span>
                    </button>
                </div>
            </nav>
            <main>
                <!-- MODAL FOR ADDING NEW ADMIN -->
                <div class="modal fade" id="adminmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Admin Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/addadmin.php" method="POST">
                                    <div class="form-group">
                                        <label for="inputFullname">Fullname*</label>
                                        <input type="text" class="form-control" name="inputFullname" id="inputFullname" placeholder="Enter fullname" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid Fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUsername">Username*</label>
                                        <input type="text" class="form-control" name="inputUsername" id="inputUsername" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter Username" maxlength="50" required>
                                        <div id="status"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Password*</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="inputPassword" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password" required>
                                            <span class="input-group-text passToggle" id="eye1" onclick="eyeToggle()"><i class="far fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Add" name="addAdmin" id="addAdmin" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in viewing and updating staff data -->
                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Admin Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updateadmin.php" method="POST">
                                    <input type="hidden" name="updateID" id="updateID">
                                    <div class="form-group">
                                        <label for="updateFullname">Fullname*</label>
                                        <input type="text" class="form-control" name="updateFullname" id="updateFullname" placeholder="Enter fullname" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid Fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateUsername">Username*</label>
                                        <input type="text" class="form-control" name="updateUsername" id="updateUsername" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter Username" maxlength="50" required>
                                        <div id="updateStatus"></div>
                                    </div>
                                    <div class="form-group">
                                        <a class="text" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Set Password to Default <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <div class="form-group">
                                                    <label for="updatePassword">Default Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="updatePassword" id="updatePassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password">
                                                        <span class="input-group-text passToggle" id="eyeUpdate" onclick="eyeToggleUpdate()"><i class="far fa-eye"></i></span>
                                                    </div>
                                                    <small><em>Setting the password to default means changing it, inform the user immediately of his/her default password.</em></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="updateAdmin" id="updateAdmin" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL IN DELETING DATA -->
                <div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Admin Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal delete -->
                            <div class="modal-body">
                                <form action="../crud/deleteadmin.php" method="POST">
                                    <input type="hidden" name="delete-id" id="delete-id">
                                    <h4 id="delName"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary clear" data-dismiss="modal">No</button>
                                <input type="submit" value="Delete" name="deletedata" id="delete-submit" class="btn btn-primary"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ADD ADMIN HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Admin List</strong></h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#adminmodal"><i class="fas fa-plus"></i> Add Admin</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "select * from tbl_admin";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records) {
                                        foreach ($records as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['admin_id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td style="display:none;"><?php echo $row['password'] ?></td>
                                                <td><?php echo '********'; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo 'No Records Found';
                                    }
                                    ?>
                                </tbody>
                            </table>
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

        <!-- External JS -->
        <script src="../../js/sidebar_active.js"></script>
        <script src="../../js/admin_js/check_username_admin.js"></script>
        <script src="../../js/admin_js/update_delete_admin.js"></script>
        <script src="../../js/admin_js/password_toggle.js"></script>
        <script src="../../js/admin_js/compute_age.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'added') {
        ?>
            <script>
                swal({
                    title: "Data Inserted",
                    text: "New Admin Successfully Added",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'not added') {
        ?>
            <script>
                swal({
                    title: "Data not Inserted",
                    text: "Unknown error occur",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'deleted') {
        ?>
            <script>
                swal({
                    title: "Data Deleted",
                    text: "Admin Information Successfully Deleted",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Admin Information Successfully Updated",
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
                    text: "Admin Information Update Failed",
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