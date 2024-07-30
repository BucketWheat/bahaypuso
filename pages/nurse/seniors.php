<!-- check nurse if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/nurse_pages_sessions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Seniors</title>

    <!-- BOOTSTRAP PLUGINS -->
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
                    <h5 style="margin: 0;"><?php echo $nurse_fname . " " . $nurse_lname; ?></h5>
                    <small><?php echo $role ?></small>
                </div>
                <li>
                    <a href="nurse_index.php"><span class="far fa-chart-bar"></span> Dashboard</a>
                </li>
                <li class="active">
                    <a href="#"><span class="fas fa-users"></span> Seniors</a>
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
                    <a href="#treatmentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-file-prescription"></span> Treatments</a>
                    <ul class="collapse list-unstyled" id="treatmentSubmenu">
                        <li>
                            <a href="treatments.php">Treatment Records</a>
                        </li>
                        <li>
                            <a href="treatments_administered.php">Administered Treatments</a>
                        </li>
                        <li>
                            <a href="treatments_cancelled.php">Cancelled Treatments</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#trSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="far fa-calendar-alt"></span> Treatment Progress</a>
                    <ul class="collapse list-unstyled" id="trSubmenu">
                        <li>
                            <a href="treatment_progress.php">Treatment Calendar</a>
                        </li>
                        <li>
                            <a href="treatment_progress_administered.php">Administered Treatments</a>
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
                        <li>
                            <a href="recommendation_management.php">Manage Recommendations</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="account.php"><span class="far fa-user-circle"></span> Account</a>
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
                        <span>Seniors</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in viewing and updating staff data -->
                <div class="modal fade bd-example-modal-lg" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="updateID" id="updateID">
                                <div class="form-group">
                                    <label for="updateFullname">Fullname</label>
                                    <input type="text" class="form-control" name="updateFullname" id="updateFullname" placeholder="Enter fullname" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid Fullname" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="updateGuardian">Guardian</label>
                                    <input type="text" class="form-control" name="updateGuardian" id="updateGuardian" placeholder="Enter guardian's name" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid guardian name" readonly>
                                    <input type="hidden" name="updateGuardianID" id="updateGuardianID">
                                    <div id="check_guardian_update"></div>
                                </div>
                                <div class="form-group">
                                    <label for="updateAddress">Complete Address</label>
                                    <input type="text" class="form-control" name="updateAddress" id="updateAddress" placeholder="Enter complete address" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="updateDOB">Date of Birth</label>
                                        <input type="date" class="form-control" name="updateDOB" id="updateDOB" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="updateAge">Age</label>
                                        <input type="number" class="form-control" name="updateAge" id="updateAge" step="1" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="updateSex">Sex</label>
                                        <input type="text" name="updateSex" id="updateSex" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="updateWeight">Weight</label>
                                        <input type="number" class="form-control" name="updateWeight" id="updateWeight" step="1" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="updateBlood">Bloodtype</label>
                                        <input type="text" name="updateBlood" id="updateBlood" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateMedication">Current Medication</label>
                                    <input type="text" class="form-control" name="updateMedication" id="updateMedication" placeholder="Current medication or maintenance" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,50}" title='If None type "None"' readonly>
                                </div>
                                <div class="form-group">
                                    <label for="updateCondition">Condition Description</label>
                                    <textarea name="updateCondition" id="updateCondition" class="form-control" placeholder="Enter condition description..." readonly></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Senior's Information Records</strong></h4>
                    </div>
                </div>

                <!-- DATA TABLES -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_senior WHERE status ='Active'";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Sex</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Bloodtype</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Edit</th>
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
                                                <td><?php echo $row['dob'] ?></td>
                                                <td><?php echo $row['age'] ?></td>
                                                <td><?php echo $row['sex'] ?></td>
                                                <td><?php echo $row['weight'] ?></td>
                                                <td><?php echo $row['bloodtype'] ?></td>
                                                <td style="display:none;"><?php echo $row['medication'] ?></td>
                                                <td style="display:none;"><?php echo $row['condition_description'] ?></td>

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

        <!-- FONTAWESOME ICONS PLUGIN -->
        <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

        <!-- EXTERNAL JS -->
        <script src="../../js/sidebar_active.js"></script>
        <script src="../../js/staff_js/update_delete_senior.js"></script>
        <script src="../../js/staff_js/check_guardian.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'added') {
        ?>
            <script>
                swal({
                    title: "Data Inserted",
                    text: "New Senior Successfully Added",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'deleted') {
        ?>
            <script>
                swal({
                    title: "Data Deleted",
                    text: "Senior Information Successfully Deleted",
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
                    text: "Senior Information Successfully Updated",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        }
        unset($_SESSION['formSubmitted']);
        ?>
</body>

</html>