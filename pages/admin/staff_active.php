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

    <title>Medical Staffs</title>

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
                <li class="active">
                    <a href="#staffsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-user-nurse"></span> Medical Staffs</a>
                    <ul class="collapse list-unstyled" id="staffsSubmenu">
                        <li class="activeSub">
                            <a href="#">Active Medical Staffs</a>
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
                <li>
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
                        <span>Medical Staffs</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in adding new staff -->
                <div class="modal fade bd-example-modal-lg" id="staffmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Medical Staff/Caregiver</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal add -->
                            <div class="modal-body">
                                <form action="crud/addstaff.php" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputFname">First Name*</label>
                                            <input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="Enter First Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter First Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputLname">Last Name*</label>
                                            <input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="Enter Last Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter Last Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Complete Address*</label>
                                        <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Enter complete address" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="inputDOB">Date of Birth*</label>
                                            <input type="date" class="form-control" name="inputDOB" id="inputDOB" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAge">Age</label>
                                            <input type="number" class="form-control" name="inputAge" id="inputAge" step="1" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputSex">Sex*</label>
                                            <select id="inputSex" name="inputSex" class="form-control">
                                                <option selected>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPRC">PRC License Number</label>
                                            <input type="text" class="form-control" name="inputPRC" id="inputPRC" pattern="[0-9]{7,}" title="License Number must be 7-digit" placeholder="(optional)" maxlength="7">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputContact">Contact Number*</label>
                                            <input type="text" class="form-control" name="inputContact" id="inputContact" placeholder="Enter contact number" required maxlength="11">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email*</label>
                                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="example@example.com" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputUsername">Username*</label>
                                            <input type="text" class="form-control" name="inputUsername" id="inputUsername" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter username" required>
                                            <span id="status"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword">Password*</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="inputPassword" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter password" required>
                                                <span class="input-group-text passToggle" id="eye1" onclick="eyeToggle()"><i class="far fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Add" name="addStaff" id="addStaff" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in viewing and updating staff data -->
                <div class="modal fade bd-example-modal-lg" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Medical Staff/Caregiver Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal viewing and updating -->
                            <div class="modal-body">
                                <form action="crud/updatestaff.php" method="POST">
                                    <input type="hidden" name="updateID" id="updateID">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="updateFname">First Name*</label>
                                            <input type="text" class="form-control" name="updateFname" id="updateFname" placeholder="Enter First Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter First Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="updateLname">Last Name*</label>
                                            <input type="text" class="form-control" name="updateLname" id="updateLname" placeholder="Enter Last Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter Last Name" required>
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
                                        <input type="text" class="form-control" name="updateUsername" id="updateUsername" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one uppercase and lowercase letter, and atleast 8 or more characters" placeholder="Enter username" required>
                                        <span id="updateStatus"></span>
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
                                    <div class="form-group">
                                        <label for="updateStatus_active">Status</label>
                                        <select class="form-control" name="updateStatus" id="updateStatus">
                                            <option selected>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="updateStaff" id="updateStaff" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ADD STAFF HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Active Medical Staffs Information</strong></h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staffmodal"><i class="fas fa-plus"></i> Add Staff</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_staff WHERE status != 'Inactive' ";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <!-- <th scope="col">Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records) {
                                        foreach ($records as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['staff_id'] ?></td>
                                                <td><?php echo $row['fname'] . " " . $row['lname'] ?></td>
                                                <td style="display:none;"><?php echo $row['address'] ?></td>
                                                <td style="display:none;"><?php echo $row['dob'] ?></td>
                                                <td style="display:none;"><?php echo $row['age'] ?></td>
                                                <td style="display:none;"><?php echo $row['sex'] ?></td>
                                                <td style="display:none;"><?php echo $row['license_number'] ?></td>
                                                <td style="display:none;"><?php echo $row['contact_number'] ?></td>
                                                <td style="display:none;"><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td style="display:none;"><?php echo $row['password'] ?></td>
                                                <td style="display:none;"><?php echo $row['level'] ?></td>
                                                <td><?php echo str_repeat("*", 8) ?></td>
                                                <td><?php echo $row['status'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success viewbtn"> VIEW </button>
                                                </td>
                                                <!-- <td>
                                                <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                            </td> -->
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
        <script src="../../js/admin_js/check_username_staff.js"></script>
        <script src="../../js/admin_js/update_delete_staff.js"></script>
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
                    text: "New Staff Successfully Added",
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
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Staff Information Successfully Updated",
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
                    text: "Staff Information Update failed",
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