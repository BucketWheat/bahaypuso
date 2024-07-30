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

    <title>Seniors</title>

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
                <li class="active">
                    <a href="#seniorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-users"></span> Seniors</a>
                    <ul class="collapse list-unstyled" id="seniorSubmenu">
                        <li>
                            <a href="senior_active.php">Seniors list</a>
                        </li>
                        <li class="activeSub">
                            <a href="#">Other Seniors</a>
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
                        <span>Seniors</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in viewing and updating inactive senior data -->
                <div class="modal fade bd-example-modal-lg" id="viewmodal-inactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Senior's Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updatesenior_inactive.php" method="POST">
                                    <input type="hidden" name="updateID_inactive" id="updateID_inactive">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="updateFname_inactive">First Name</label>
                                            <input type="text" class="form-control" name="updateFname_inactive" id="updateFname_inactive" placeholder="Enter First Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter First Name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="updateLname_inactive">Last Name</label>
                                            <input type="text" class="form-control" name="updateLname_inactive" id="updateLname_inactive" placeholder="Enter Last Name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter Last Name" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateGuardian_inactive">Guardian</label>
                                        <input type="text" class="form-control" name="updateGuardian_inactive" id="updateGuardian_inactive" placeholder="Enter guardian's name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid guardian name" readonly>
                                        <input type="hidden" name="updateGuardianID_inactive" id="updateGuardianID_inactive">
                                        <div id="check_guardian_update"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateAddress_inactive">Complete Address</label>
                                        <input type="text" class="form-control" name="updateAddress_inactive" id="updateAddress_inactive" placeholder="Enter complete address" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="updateDOB_inactive">Date of Birth</label>
                                            <input type="date" class="form-control" name="updateDOB_inactive" id="updateDOB_inactive" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="updateAge_inactive">Age</label>
                                            <input type="number" class="form-control" name="updateAge_inactive" id="updateAge_inactive" step="1" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="updateSex_inactive">Sex</label>
                                            <input type="text" name="updateSex_inactive" id="updateSex_inactive" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="updateWeight_inactive">Weight</label>
                                            <input type="number" class="form-control" name="updateWeight_inactive" id="updateWeight_inactive" step="1" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="updateBlood_inactive">Bloodtype*</label>
                                            <input type="text" name="updateBlood_inactive" id="updateBlood_inactive" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateMedication_inactive">Current Medication</label>
                                        <input type="text" class="form-control" name="updateMedication_inactive" id="updateMedication_inactive" placeholder="Current medication or maintenance" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,50}" title='If None type "None"' readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateCondition_inactive">Condition Description</label>
                                        <textarea name="updateCondition_inactive" id="updateCondition_inactive" class="form-control" placeholder="Enter condition description..." readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateStatus_inactive">Status</label>
                                        <select name="updateStatus_inactive" id="updateStatus_inactive" class="form-control">
                                            <option selected>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="updateSenior_inactive" id="updateSenior_inactive" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Other Seniors Account Information</strong></h4>
                    </div>
                </div>

                <!-- INACTIVE SENIOR DATA TABLES -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM  tbl_senior WHERE status = 'Inactive' ";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-inactive" class="table table-bordered  table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Sex</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Bloodtype</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records) {
                                        foreach ($records as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['senior_id'] ?></td>
                                                <td><?php echo $row['fname'] . " " . $row['lname'] ?></td>
                                                <td style="display:none;"><?php echo $row['guardian_id'] ?></td>
                                                <td style="display:none;"><?php echo $row['address'] ?></td>
                                                <td style="display:none;"><?php echo $row['dob'] ?></td>
                                                <td><?php echo $row['age'] ?></td>
                                                <td><?php echo $row['sex'] ?></td>
                                                <td><?php echo $row['weight'] ?></td>
                                                <td><?php echo $row['bloodtype'] ?></td>
                                                <td style="display:none;"><?php echo $row['medication'] ?></td>
                                                <td style="display:none;"><?php echo $row['condition_description'] ?></td>
                                                <td><?php echo $row['status'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success viewbtn"> VIEW </button>
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
        <script src="../../js/admin_js/check_guardian.js"></script>
        <script src="../../js/admin_js/update_delete_senior.js"></script>
        <script src="../../js/admin_js/password_toggle.js"></script>
        <script src="../../js/admin_js/compute_age.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Senior Information Successfully Updated",
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
                    text: "Senior Information Update failed",
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