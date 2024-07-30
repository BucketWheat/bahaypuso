<?php
require "functions/checklogin.php";
require "functions/check_account.php";
require "functions/connections.php";
include "functions/user_sessions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- MODAL BOOTSTRAP PLUGINS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- DATA TABLES CSS PLUGIN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- FONTAWESOME ICONS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../css/donations.css">
    <link rel="shortcut icon" href="../../imgs/logo.png">
    <title>Donations</title>
</head>

<body>
    <!-- BOOTSTRAP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(52, 160, 160);">
        <a class="navbar-brand" href="donation_index.php">
            <img src="../../imgs/logo.png" width="50" height="50" class="d-inline-block align-bottom" alt="Senior Care Logo">
            <span>Health Care</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="donation_index.php">Donate</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="account.php">Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <!-- MODAL FOR VIEWING CASH DONATIONS-->
        <div class="modal fade" id="modal-cash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Donation Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Donation Type" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" readonly>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="10" rows="2" placeholder="Donation description..." readonly></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="recorded">Date Recorded</label>
                                <input type="text" class="form-control" name="recorded" id="recorded" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received">Date Received</label>
                                <input type="text" class="form-control" name="received" id="received" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" name="status" id="status" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL FOR VIEWING MISC DONATIONS-->
        <div class="modal fade" id="modal-misc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Donation Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="type_misc">Type</label>
                            <input type="text" class="form-control" name="type_misc" id="type_misc" placeholder="Donation Type" readonly>
                        </div>
                        <div class="form-group">
                            <label for="description_misc">Description</label>
                            <textarea class="form-control" name="description_misc" id="description_misc" cols="10" rows="2" placeholder="Donation description..." readonly></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="recorded_misc">Date Recorded</label>
                                <input type="text" class="form-control" name="recorded_misc" id="recorded_misc" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received_misc">Date Received</label>
                                <input type="text" class="form-control" name="received_misc" id="received_misc" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_misc">Status</label>
                            <input type="text" name="status_misc" id="status_misc" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mainContent donations-main">
            <div class="card donations-container d-flex flex-row p-3 justify-content-between align-items-start">
                <div class="card-left">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                                <h3 class="text-center mb-2"><strong>Cash</strong></h3>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-row justify-content-between">
                            <h5>Total Cash Donated:</h5>
                            <h5>
                                <?php if (!empty($totalCash)) { ?>&#8369;
                            <?php echo $totalCash . ".00";
                                } else {
                                    echo "0";
                                } ?>
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $donor_id = $_SESSION['donor_id'];
                            $records_query = "SELECT * FROM tbl_donation WHERE donor_id = $donor_id AND donation_category = 'Cash'";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-cash" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
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
                                                <td><?php echo $row['donation_category'] ?></td>
                                                <td><?php echo $row['amount'] ?></td>
                                                <td style="display: none;"><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
                                                <td><?php if (!empty($row['date_received'])) {
                                                        echo $row['date_received'];
                                                    } else {
                                                        echo 'N/A';
                                                    } ?></td>
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
                <div class="card-right">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                                <h3 class="text-center mb-2"><strong>Miscellaneous</strong></h3>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-row justify-content-between">
                            <h5>Total Miscellaneous Donated:</h5>
                            <h5>
                                <?php if (!empty($totalDonations)) {
                                    echo $totalDonations;
                                } else {
                                    echo "0";
                                } ?>
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_donation WHERE donor_id = $donor_id AND donation_category != 'Cash'";
                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-misc" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
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
                                                <td><?php echo $row['donation_category'] ?></td>
                                                <td style="display: none;"><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['date_recorded'] ?></td>
                                                <td><?php if (!empty($row['date_received'])) {
                                                        echo $row['date_received'];
                                                    } else {
                                                        echo 'N/A';
                                                    } ?></td>
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
        </div>
        <!-- <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a> -->
    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Data tables plugin -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- EXTERNAL JS -->
    <script src="../../js/sidebar_active.js"></script>
    <script src="../../js/scrolltop.js"></script>
    <script src="../../js/donor_js/view_donations.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'success') {
    ?>
        <script>
            swal({
                title: "Thank You! Your donation has been saved.",
                text: "Please wait our message for further details of your donation. You can check your previous donations on Donations tab.",
                icon: "success",
                button: "Ok",
            });
        </script>
    <?php
    } else if (isset($_SESSION['info']) && $_SESSION['info'] == "account updated") {
    ?>
        <script>
            swal({
                title: "Account Details Saved!",
                text: "You're all set! Now you can start donating.",
                icon: "success",
                button: "Ok",
            });
        </script>
    <?php
        unset($_SESSION['formSubmitted']);
        unset($_SESSION['info']);
        unset($_SESSION['notice']);
    }
    ?>

</body>

</html>