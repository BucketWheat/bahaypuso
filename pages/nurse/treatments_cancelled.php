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

    <title>Cancelled Treatment Records</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

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
                <li class="active">
                    <a href="#treatmentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-file-prescription"></span> Treatments</a>
                    <ul class="collapse list-unstyled" id="treatmentSubmenu">
                        <li>
                            <a href="treatments.php">Treatment Records</a>
                        </li>
                        <li>
                            <a href="treatments_administered.php">Administered Treatments</a>
                        </li>
                        <li class="activeSub">
                            <a href="#">Cancelled Treatments</a>
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
                        <span>Cancelled Treatment Records</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in viewing cancelled treatment information -->
                <div class="modal fade bd-example-modal-lg" id="cancelled_treatment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Cancelled Treatments</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal view and update -->
                            <div class="modal-body">
                                <form action="#" method="POST">
                                    <!-- <input type="hidden" name="updateID" id="updateID">
                        <input type="hidden" name="healthinfoID" id="healthinfoID"> -->
                                    <div class="form-group">
                                        <label for="updateSenior_cancelled">Name of Senior</label>
                                        <input type="text" class="form-control" name="updateSenior_cancelled" id="updateSenior_cancelled" placeholder="Enter Fullname of Senior" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid fullname" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateCondition_cancelled">Condition Description</label>
                                        <textarea class="form-control" name="updateCondition_cancelled" id="updateCondition_cancelled" placeholder="Enter condition details and description" readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateTreatmentName_cancelled">Treatment Name*</label>
                                        <input type="text" class="form-control" name="updateTreatmentName_cancelled" id="updateTreatmentName_cancelled" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid treatment name" placeholder="Enter treatment name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateTreatmentDetails_cancelled">Treatment Details*</label>
                                        <textarea class="form-control" name="updateTreatmentDetails_cancelled" id="updateTreatmentDetails_cancelled" placeholder="Enter treatment details and description" readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateNurse_cancelled">Given by*</label>
                                        <input type="text" class="form-control" name="updateNurse_cancelled" id="updateNurse_cancelled" pattern="(?=.*[a-z])(?=.*[A-Z]).{1,50}" title="Enter valid nurse fullname" placeholder="Enter treatment name" readonly>
                                        <div class="check_nurse"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="updateDate_cancelled">Date Recorded*</label>
                                            <input type="date" class="form-control" name="updateDate_cancelled" id="updateDate_cancelled" readonly>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="updateStatus_cancelled">Status</label>
                                            <input type="text" name="updateStatus_cancelled" id="updateStatus_cancelled" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- <input type="submit" value="Update" name="updateTreatment" id="updateTreatment" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ADD, SEARCH, PAGINATION HEADER -->
                <div class="card" style="margin-top: 3rem;">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Cancelled Treatments Information</strong></h4>
                    </div>
                    <!-- <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#healthinfo-modal">Add New Health Record</button>
                </div> -->
                </div>

                <!-- CANCELLED TREATMENT INFORMATION DATA TABLES -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT tbl_treatment.treatment_id, tbl_senior.fname AS Senior_fname, tbl_senior.lname AS Senior_lname, tbl_healthinfo.description AS ConditionDescription, tbl_treatment.treatment_name, tbl_treatment.treatment_description, tbl_nurse.fname AS Nurse_fname, tbl_nurse.lname AS Nurse_lname, tbl_treatment.date_recorded, tbl_treatment.status
                        FROM (((tbl_treatment
                        INNER JOIN tbl_senior ON tbl_treatment.senior_id = tbl_senior.senior_id)
                        INNER JOIN tbl_healthinfo ON tbl_treatment.healthinfo_id = tbl_healthinfo.healthinfo_id)
                        INNER JOIN tbl_nurse ON tbl_treatment.nurse_id = tbl_nurse.nurse_id)
                        WHERE tbl_treatment.status = 'Cancelled'";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable_cancelled" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name of Senior</th>
                                        <th scope="col">Condition Description</th>
                                        <th scope="col">Treatment Name</th>
                                        <th scope="col" style="display: none;">Details</th>
                                        <th scope="col">Given By</th>
                                        <th scope="col">Date Recorded</th>
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
                                                <td><?php echo $row['treatment_id'] ?></td>
                                                <td><?php echo $row['Senior_fname'] . " " . $row['Senior_lname'] ?></td>
                                                <td><?php echo $row['ConditionDescription'] ?></td>
                                                <td><?php echo $row['treatment_name'] ?></td>
                                                <td style="display: none;"><?php echo $row['treatment_description'] ?></td>
                                                <td><?php echo $row['Nurse_fname'] . " " . $row['Nurse_lname'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
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

        <!-- FONTAWESOME ICONS PLUGIN -->
        <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

        <!-- External JS -->
        <script src="../../js/sidebar_active.js"></script>
        <script src="../../js/staff_js/update_delete_treatment.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'administered') {
        ?>
            <script>
                swal({
                    title: "Data Inserted",
                    text: "New Treatment Information Recorded",
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
                    text: "Treatment Information Successfully Updated",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'failed') {
        ?>
            <script>
                swal({
                    title: "Data not Updated",
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