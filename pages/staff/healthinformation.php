<!-- check doctor if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/staff_pages_sessions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Health Records</title>

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
                    <h5 style="margin: 0;"><?php echo $staff_fname . " " . $staff_lname; ?></h5>
                    <small><?php echo $role ?></small>
                </div>
                <li>
                    <a href="staff_index.php"><span class="far fa-chart-bar"></span> Dashboard</a>
                </li>
                <li>
                    <a href="seniors.php"><span class="fas fa-users"></span> Seniors</a>
                </li>
                <li class="active">
                    <a href="#hrSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-file-medical-alt"></span> Health Information</a>
                    <ul class="collapse list-unstyled" id="hrSubmenu">
                        <li class="activeSub">
                            <a href="#">Health Records</a>
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
                        <span>Health Records</span>
                    </button>
                </div>
            </nav>

            <main>

                <!-- Modal in adding new health record -->
                <div class="modal fade bd-example-modal-lg" id="healthinfo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Health Record</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal add -->
                            <div class="modal-body">
                                <form action="crud/addhealthinfo.php" method="POST">
                                    <div class="form-group">
                                        <label for="inputSenior">Name of Senior*</label>
                                        <select name='inputSenior' id='inputSenior' class='form-control'>
                                            <option>-</option>
                                            <?php
                                            //get senior names to dropdown
                                            $records = mysqli_query($con, "SELECT fname, lname FROM tbl_senior WHERE status ='Active'");
                                            if (mysqli_num_rows($records) > 0) {

                                                while ($row = mysqli_fetch_array($records)) {
                                                    echo "<option>" . $row['fname'] . " " . $row['lname'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="seniorID" id="seniorID">
                                        <div id="check_senior"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputBP">Blood Pressure*</label>
                                            <input type="text" class="form-control" name="inputBP" id="inputBP" placeholder="BP(example 120/80)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputOxygen">Oxygen Level(%)*</label>
                                            <input type="text" class="form-control" name="inputOxygen" id="inputOxygen" placeholder="Enter oxygen level" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputTemp">Temperature(celsius)*</label>
                                            <input type="text" class="form-control" name="inputTemp" id="inputTemp" placeholder="Enter temperature" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputPulse">Pulse Rate(bpm)*</label>
                                            <input type="text" class="form-control" name="inputPulse" id="inputPulse" placeholder="Enter pulse rate" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputWeight">Weight(kg)*</label>
                                            <input type="number" class="form-control" name="inputWeight" id="inputWeight" step="1" placeholder="Enter weight">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Description*</label>
                                        <textarea class="form-control" name="inputDescription" id="inputDescription" placeholder="Enter health condition details and description"></textarea>
                                        <input type="hidden" name="staff_fname" id="staff_fname" value="<?php echo $_SESSION['staff_fname']; ?>">
                                        <input type="hidden" name="staff_lname" id="staff_lname" value="<?php echo $_SESSION['staff_lname']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Add" name="addHealthinfo" id="addHealthinfo" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in updating pending health record -->
                <div class="modal fade bd-example-modal-lg" id="healthinfo-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <form action="crud/updatehealthinfo.php" method="POST">
                                    <input type="hidden" name="updateID" id="updateID">
                                    <div class="form-group">
                                        <label for="updateSenior">Name of Senior*</label>
                                        <input type="text" class="form-control" name="updateSenior" id="updateSenior" readonly>
                                        <?php
                                        /* //get senior names to dropdown
                                        $records = mysqli_query($con, "SELECT fname, lname FROM tbl_senior WHERE status ='Active'");
                                        if (mysqli_num_rows($records) > 0) {
                                            echo "<select name='updateSenior' id='updateSenior' class='form-control'>";
                                            while ($row = mysqli_fetch_array($records)) {
                                                echo "<option>" .$row['fname']. " " .$row['lname']. "</option>";
                                            }
                                        }
                                        echo "</select>"; */
                                        ?>
                                        <input type="hidden" name="updateseniorID" id="updateseniorID">
                                        <div id="check_senior_update"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="updateBP">Blood Pressure*</label>
                                            <input type="text" class="form-control" name="updateBP" id="updateBP" placeholder="BP(example 120/80)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateOxygen">Oxygen Level(%)*</label>
                                            <input type="text" class="form-control" name="updateOxygen" id="updateOxygen" placeholder="Enter oxygen level" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateTemp">Temperature(celsius)*</label>
                                            <input type="text" class="form-control" name="updateTemp" id="updateTemp" placeholder="Enter temperature" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="updatePulse">Pulse Rate(bpm)*</label>
                                            <input type="text" class="form-control" name="updatePulse" id="updatePulse" placeholder="Enter pulse rate" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateWeight">Weight(kg)*</label>
                                            <input type="number" class="form-control" name="updateWeight" id="updateWeight" step="1" placeholder="Enter weight">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="updateDate">Date Recorded</label>
                                            <input type="date" class="form-control" name="updateDate" id="updateDate" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateDescription">Description*</label>
                                        <textarea class="form-control" name="updateDescription" id="updateDescription" placeholder="Enter health condition details and description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-7">
                                            <label for="updatestaffName">Recorded By*</label>
                                            <input type="text" class="form-control" name="updatestaffName" id="updatestaffName" placeholder="Enter staff name" readonly>
                                            <input type="hidden" name="updateStaffID" id="updateStaffID">
                                            <div id="check_staff"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="updateStatus">Status</label>
                                            <select class="form-control" name="updateStatus" id="updateStatus">
                                                <option selected>Pending</option>
                                                <option>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Edit" name="editHealthinfo" id="editHealthinfo" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ADD HEALTHINFO HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Pending Health Information Records</strong></h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#healthinfo-modal"><i class="fas fa-plus"></i> Add New Health Record</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT tbl_healthinfo.healthinfo_id, tbl_senior.fname AS senior_fname, tbl_senior.lname AS senior_lname, tbl_healthinfo.bloodpressure, tbl_healthinfo.oxygen_level, tbl_healthinfo.temperature, tbl_healthinfo.pulserate, tbl_healthinfo.weight, tbl_healthinfo.description, tbl_healthinfo.date_recorded, tbl_staff.fname AS staff_fname, tbl_staff.lname AS staff_lname, tbl_healthinfo.status FROM ((tbl_healthinfo INNER JOIN tbl_senior ON tbl_healthinfo.senior_id = tbl_senior.senior_id) INNER JOIN tbl_staff ON tbl_healthinfo.staff_id = tbl_staff.staff_id) WHERE tbl_healthinfo.status = 'Pending' ";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records) {
                                        foreach ($records as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['healthinfo_id'] ?></td>
                                                <td><?php echo $row['senior_fname'] . " " . $row['senior_lname']; ?></td>
                                                <td><?php echo $row['bloodpressure'] ?></td>
                                                <td><?php echo $row['oxygen_level'] ?></td>
                                                <td><?php echo $row['temperature'] ?></td>
                                                <td style="display:none;"><?php echo $row['pulserate'] ?></td>
                                                <td style="display:none;"><?php echo $row['weight'] ?></td>
                                                <td style="display:none;"><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
                                                <td style="display: none;"><?php echo $row['staff_fname'] . " " . $row['staff_lname'] ?></td>
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
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'added') {
        ?>
            <script>
                swal({
                    title: "Data Inserted",
                    text: "New Health Information Recorded",
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