<!-- check doctor if logged in -->
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

    <title>Cancelled Health Records</title>

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
                    <h5 style="margin: 0;"><?php echo $nurse_fname . " " . $nurse_lname; ?></h5>
                    <small><?php echo $role ?></small>
                </div>
                <li>
                    <a href="nurse_index.php"><span class="far fa-chart-bar"></span> Dashboard</a>
                </li>
                <li>
                    <a href="seniors.php"><span class="fas fa-users"></span> Seniors</a>
                </li>
                <li class="active">
                    <a href="#hrSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-file-medical-alt"></span> Health Information</a>
                    <ul class="collapse list-unstyled" id="hrSubmenu">
                        <li>
                            <a href="healthinformation.php">Health Records</a>
                        </li>
                        <li>
                            <a href="healthinformation_administered.php">Administered Health Records</a>
                        </li>
                        <li class="activeSub">
                            <a href="#">Cancelled Health Records</a>
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
                        <span>Cancelled Health Records</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in updating cancelled health record -->
                <div class="modal fade bd-example-modal-lg" id="healthinfo-update-cancelled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Health Information Record</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updatehealthinfo_cancelled.php" method="POST">
                                    <input type="hidden" name="updateID_cancelled" id="updateID_cancelled">
                                    <div class="form-group">
                                        <label for="updateSenior_cancelled">Name of Senior*</label>
                                        <input type="text" class="form-control" name="updateSenior_cancelled" id="updateSenior_cancelled" placeholder="Enter Fullname of Senior" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid fullname" readonly>
                                        <input type="hidden" name="updateseniorID_cancelled" id="updateseniorID_cancelled">
                                        <div id="check_senior_update"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="updateBP_cancelled">Blood Pressure*</label>
                                            <input type="text" class="form-control" name="updateBP_cancelled" id="updateBP_cancelled" placeholder="BP(example 120/80)" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateOxygen_cancelled">Oxygen Level(%)*</label>
                                            <input type="text" class="form-control" name="updateOxygen_cancelled" id="updateOxygen_cancelled" placeholder="Enter oxygen level" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateTemp_cancelled">Temperature(celsius)*</label>
                                            <input type="text" class="form-control" name="updateTemp_cancelled" id="updateTemp_cancelled" placeholder="Enter temperature" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="updatePulse_cancelled">Pulse Rate(bpm)*</label>
                                            <input type="text" class="form-control" name="updatePulse_cancelled" id="updatePulse_cancelled" placeholder="Enter pulse rate" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateWeight_cancelled">Weight(kg)*</label>
                                            <input type="number" class="form-control" name="updateWeight_cancelled" id="updateWeight_cancelled" step="1" placeholder="Enter weight" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateDate_cancelled">Date Recorded</label>
                                            <input type="date" class="form-control" name="updateDate_cancelled" id="updateDate_cancelled" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateDescription_cancelled">Description*</label>
                                        <textarea class="form-control" name="updateDescription_cancelled" id="updateDescription_cancelled" placeholder="Enter health condition details and description" readonly></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-7">
                                            <label for="updatestaffName_cancelled">Recorded By*</label>
                                            <input type="text" class="form-control" name="updatestaffName_cancelled" id="updatestaffName_cancelled" placeholder="Enter staff name" readonly>
                                            <input type="hidden" name="updateStaffID_cancelled" id="updateStaffID_cancelled">
                                            <div id="check_staff"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="updateStatus_cancelled">Status</label>
                                            <input type="text" name="updateStatus_cancelled" id="updateStatus_cancelled" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CANCELLED HEALTH INFORMATION HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Cancelled Health Information</strong></h4>
                    </div>
                </div>

                <!-- CANCELLED HEALTH INFORMATION DATA TABLE -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT tbl_healthinfo.healthinfo_id, tbl_senior.fname AS senior_fname, tbl_senior.lname AS senior_lname, tbl_healthinfo.bloodpressure, tbl_healthinfo.oxygen_level, tbl_healthinfo.temperature, tbl_healthinfo.pulserate, tbl_healthinfo.weight, tbl_healthinfo.description, tbl_healthinfo.date_recorded, tbl_staff.fname AS staff_fname, tbl_staff.lname AS staff_lname, tbl_healthinfo.status FROM ((tbl_healthinfo INNER JOIN tbl_senior ON tbl_healthinfo.senior_id = tbl_senior.senior_id) INNER JOIN tbl_staff ON tbl_healthinfo.staff_id = tbl_staff.staff_id) WHERE tbl_healthinfo.status = 'Cancelled' ";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-cancelled" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name of Senior</th>
                                        <th scope="col">Blood Pressure</th>
                                        <th scope="col">Oxygen Level(%)</th>
                                        <th scope="col">Temp(C)</th>
                                        <th scope="col" style="display: none;">Pulse Rate(bpm)</th>
                                        <th scope="col" style="display: none;">Weight(kg)</th>
                                        <th scope="col" style="display: none;"></th>
                                        <th scope="col">Date Recorded</th>
                                        <th scope="col" style="display: none;">Recorded by</th>
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
                                                <td><?php echo $row['healthinfo_id'] ?></td>
                                                <td><?php echo $row['senior_fname'] . ' ' . $row['senior_lname'] ?></td>
                                                <td><?php echo $row['bloodpressure'] ?></td>
                                                <td><?php echo $row['oxygen_level'] ?></td>
                                                <td><?php echo $row['temperature'] ?></td>
                                                <td style="display:none;"><?php echo $row['pulserate'] ?></td>
                                                <td style="display:none;"><?php echo $row['weight'] ?></td>
                                                <td style="display:none;"><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
                                                <td style="display: none;"><?php echo $row['staff_fname'] . ' ' . $row['staff_lname'] ?></td>
                                                <td><?php echo $row['status'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success editbtn"> VIEW </button>
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
        <script src="../../js/staff_js/check_senior_staff.js"></script>
        <script src="../../js/staff_js/update_delete_healthinfo.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Health Information Successfully Updated",
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
                    text: "Health Information Update failed",
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