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

    <title>Treatment Progress</title>

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
                <li class="active">
                    <a href="#trSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="far fa-calendar-alt"></span> Treatment Progress</a>
                    <ul class="collapse list-unstyled" id="trSubmenu">
                        <li>
                            <a href="treatment_progress_calendar.php">Treatment Calendar</a>
                        </li>
                        <li class="activeSub">
                            <a href="#">Treatment Progress</a>
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
                        <span>Administered Treatment</span>
                    </button>
                </div>
            </nav>
            <main>

                <!-- ADD, SEARCH, PAGINATION HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Treatment Progress</strong></h4>
                    </div>
                </div>

                <!-- TREATMENT INFORMATION DATA TABLES -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT tbl_treatment_progress.treatment_progress_id, tbl_treatment.treatment_name, tbl_treatment_progress.treatment_progress_description, tbl_treatment_progress.treatment_progress_start, tbl_treatment_progress.treatment_progress_end, CONCAT(tbl_senior.fname,' ',tbl_senior.lname) AS SeniorName, CONCAT(tbl_staff.fname,' ',tbl_staff.lname) AS StaffName, tbl_treatment_progress.date_recorded, tbl_treatment_progress.status FROM (((tbl_treatment_progress INNER JOIN tbl_treatment ON tbl_treatment_progress.treatment_id=tbl_treatment.treatment_id) INNER JOIN tbl_senior ON tbl_treatment_progress.senior_id = tbl_senior.senior_id) INNER JOIN tbl_staff ON tbl_treatment_progress.staff_id = tbl_staff.staff_id) ORDER BY tbl_treatment_progress.treatment_progress_id DESC";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable" class="table table-bordered" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col" style="display: none;">treatment_ID</th>
                                        <th scope="col">Treatment Name</th>
                                        <th scope="col" style="display: none;">Details</th>
                                        <th scope="col" style="display: none;">Start</th>
                                        <th scope="col" style="display: none;">End</th>
                                        <th scope="col">Name of Senior</th>
                                        <th scope="col">Administered By</th>
                                        <th scope="col">Date Recorded</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="display: none;">SeniorID</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($records) {
                                        foreach ($records as $row) {
                                            if ($row['status'] == 'Complete') {
                                    ?>
                                                <tr class="alert-success">
                                                <?php
                                            } else {
                                                ?>
                                                <tr>
                                                <?php
                                            } ?>
                                                <td><?php echo $row['treatment_progress_id'] ?></td>
                                                <td><?php echo $row['treatment_name'] ?></td>
                                                <td style="display: none;"><?php echo $row['treatment_progress_description'] ?></td>
                                                <td style="display: none;"><?php echo $row['treatment_progress_start'] ?></td>
                                                <td style="display: none;"><?php echo $row['treatment_progress_end'] ?></td>
                                                <td><?php echo $row['SeniorName'] ?></td>
                                                <td><?php echo $row['StaffName'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
                                                <td><?php echo $row['status'] ?></td>
                                                <td style="display: none;"><?php echo $row['senior_id'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success viewbtn" data-toggle="tooltip" data-placement="bottom" title="View Treatment"><i class="far fa-edit"></i></button>
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
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'administered') {
        ?>
            <script>
                swal({
                    title: "Administered Successfully!",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated!",
                    text: "Treatment Information Successfully Updated",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'empty') {
        ?>
            <script>
                swal({
                    title: "Administer Failed!",
                    text: "Fill up all the required fields",
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