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

    <title>Donations</title>

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
                <li class="active">
                    <a href="#donationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-donate"></span> Donations</a>
                    <ul class="collapse list-unstyled" id="donationSubmenu">
                        <li>
                            <a href="donation_pending.php">Pending</a>
                        </li>
                        <li class="activeSub">
                            <a href="#">Received</a>
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
                        <span>Donations</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- MODAL FOR VIEWING received CASH DONATIONS-->
                <div class="modal fade bd-example-modal-lg" id="modal-received-cash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Donation Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="crud/update_donation_received.php" method="POST">
                                    <input type="hidden" name="donationID-cash" id="donationID-cash">
                                    <div class="form-group">
                                        <label for="fullname">Fullname</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="institution">Institution</label>
                                            <input type="text" class="form-control" name="institution" id="institution" placeholder="Institution" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="contact">Contact no.</label>
                                            <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="type">Type</label>
                                            <input type="text" class="form-control" name="type" id="type" placeholder="Donation Type" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="recorded">Date Recorded</label>
                                            <input type="text" class="form-control" name="recorded" id="recorded" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="received">Date Received</label>
                                            <input type="text" class="form-control" name="received" id="received" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="10" rows="2" placeholder="Donation description..." readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option selected>Pending</option>
                                            <option>Received</option>
                                            <option>Cancelled</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="Update" name="update-cash" id="update-cash" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL FOR VIEWING received MISC DONATIONS-->
                <div class="modal fade bd-example-modal-lg" id="modal-received-misc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Donation Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="crud/update_donation_received.php" method="POST">
                                    <input type="hidden" name="donationID-misc" id="donationID-misc">
                                    <div class="form-group">
                                        <label for="fullname-misc">Fullname</label>
                                        <input type="text" class="form-control" name="fullname-misc" id="fullname-misc" placeholder="Fullname" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="institution-misc">Institution</label>
                                            <input type="text" class="form-control" name="institution-misc" id="institution-misc" placeholder="Institution" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="contact-misc">Contact no.</label>
                                            <input type="text" class="form-control" name="contact-misc" id="contact-misc" placeholder="Contact" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address-misc">Address</label>
                                        <input type="text" class="form-control" name="address-misc" id="address-misc" placeholder="Address" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-misc">Email</label>
                                        <input type="email" class="form-control" name="email-misc" id="email-misc" placeholder="Email" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="type-misc">Type</label>
                                            <input type="text" class="form-control" name="type-misc" id="type-misc" placeholder="Donation Type" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recorded-misc">Date Recorded</label>
                                            <input type="text" class="form-control" name="recorded-misc" id="recorded-misc" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="received-misc">Date Received</label>
                                            <input type="text" class="form-control" name="received-misc" id="received-misc" readonly>
                                        </div>
                                    </div>
                                    <!--  <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" readonly>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="description-misc">Description</label>
                                        <textarea class="form-control" name="description-misc" id="description-misc" cols="10" rows="2" placeholder="Donation description..." readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status-misc">Status</label>
                                        <select name="status-misc" id="status-misc" class="form-control">
                                            <option selected>Pending</option>
                                            <option>Received</option>
                                            <option>Cancelled</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="Update" name="update-misc" id="update-misc" class="btn btn-primary" style="background-color: rgb(52, 160, 160); color: white;"></input>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mainContent donations-main">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="card" style="margin-bottom: 1rem;">
                                <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                                    <h3 class="mb-2"><strong>Received Cash Donations</strong></h3>
                                </div>
                            </div>
                            <!-- <div class="card-body d-flex flex-row justify-content-between">
                                <h5>Total Cash Donated this Month:</h5>
                                <h5>
                                    <?php if (!empty($totalCash)) { ?>&#8369;
                                <?php echo $totalCash . ".00";
                                    } else {
                                        echo "0";
                                    } ?>
                                </h5>
                            </div> -->
                            <div class="table-responsive">
                                <?php
                                $records_query = "SELECT tbl_donation.donation_id, tbl_donation.donor_id, tbl_donor.fullname, tbl_donor.institution, tbl_donor.contact_number, tbl_donor.address, tbl_donor.email, tbl_donation.donation_category, tbl_donation.amount, tbl_donation.description, tbl_donation.date_recorded, tbl_donation.date_received, tbl_donation.status FROM (tbl_donation INNER JOIN tbl_donor ON tbl_donation.donor_id = tbl_donor.donor_id) WHERE tbl_donation.donation_category = 'Cash' AND tbl_donation.status ='Received'";
                                $records = mysqli_query($con, $records_query);
                                ?>
                                <table id="datatable-received-cash" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col" style="display: none;">Donor ID</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Institution</th>
                                            <th scope="col" style="display: none;">Contact No.</th>
                                            <th scope="col" style="display: none;">Address</th>
                                            <th scope="col" style="display: none;">Email</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount (in Php)</th>
                                            <th scope="col" style="display: none;">Description</th>
                                            <th scope="col">Date Recorded</th>
                                            <th scope="col">Date Received</th>
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
                                                    <td><?php echo $row['donation_id'] ?></td>
                                                    <td style="display: none;"><?php echo $row['donor_id'] ?></td>
                                                    <td><?php echo $row['fullname'] ?></td>
                                                    <td><?php echo $row['institution'] ?></td>
                                                    <td style="display: none;"><?php echo $row['contact_number'] ?></td>
                                                    <td style="display: none;"><?php echo $row['address'] ?></td>
                                                    <td style="display: none;"><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['donation_category'] ?></td>
                                                    <td><?php echo number_format($row['amount']) ?></td>
                                                    <td style="display: none;"><?php echo $row['description'] ?></td>
                                                    <td><?php echo $row['date_recorded'] ?></td>
                                                    <td><?php echo $row['date_received'] ?></td>
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

                    <div class="card">
                        <div class="card-body">
                            <div class="card" style="margin-bottom: 1rem;">
                                <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                                    <h3 class="mb-2"><strong>Received Miscellaneous</strong></h3>
                                </div>
                            </div>
                            <!--  <div class="card-body d-flex flex-row justify-content-between">
                                <h5>Total Miscellaneous Donated this Month:</h5>
                                <h5>
                                    <?php if (!empty($totalDonations)) {
                                        echo $totalDonations;
                                    } else {
                                        echo "0";
                                    } ?>
                                </h5>
                            </div> -->
                            <div class="table-responsive">
                                <?php
                                $records_query = "SELECT tbl_donation.donation_id, tbl_donation.donor_id, tbl_donor.fullname, tbl_donor.institution, tbl_donor.contact_number, tbl_donor.address, tbl_donor.email, tbl_donation.donation_category, tbl_donation.amount, tbl_donation.description, tbl_donation.date_recorded, tbl_donation.date_received, tbl_donation.status FROM (tbl_donation INNER JOIN tbl_donor ON tbl_donation.donor_id = tbl_donor.donor_id) WHERE tbl_donation.donation_category != 'Cash' AND tbl_donation.status ='Received'";
                                $records = mysqli_query($con, $records_query);
                                ?>
                                <table id="datatable-received-misc" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col" style="display: none;">Donor ID</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Institution</th>
                                            <th scope="col" style="display: none;">Contact No.</th>
                                            <th scope="col" style="display: none;">Address</th>
                                            <th scope="col" style="display: none;">Email</th>
                                            <th scope="col">Type</th>
                                            <th scope="col" style="display: none;">Description</th>
                                            <th scope="col">Date Recorded</th>
                                            <th scope="col">Date Received</th>
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
                                                    <td><?php echo $row['donation_id'] ?></td>
                                                    <td style="display: none;"><?php echo $row['donor_id'] ?></td>
                                                    <td><?php echo $row['fullname'] ?></td>
                                                    <td><?php echo $row['institution'] ?></td>
                                                    <td style="display: none;"><?php echo $row['contact_number'] ?></td>
                                                    <td style="display: none;"><?php echo $row['address'] ?></td>
                                                    <td style="display: none;"><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['donation_category'] ?></td>
                                                    <td style="display: none;"><?php echo $row['description'] ?></td>
                                                    <td><?php echo $row['date_recorded'] ?></td>
                                                    <td><?php echo $row['date_received'] ?></td>
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
        <script src="../../js/admin_js/update_delete_donations.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Updated",
                    text: "Donation Details Successfully Updated",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } else if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'no changes') {
        ?>
            <script>
                swal({
                    title: "No Changes Made",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } else if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'failed') {
        ?>
            <script>
                swal({
                    title: "Update Failed",
                    text: "Donation Details Update Failed",
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