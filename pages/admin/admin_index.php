<!-- check user if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/sessions.php");
include("functions/dashboard_values.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard</title>

    <!-- MODAL BOOTSTRAP PLUGINS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../css/admin.css">
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
                <li class="active">
                    <a href="#"><span class="far fa-chart-bar"></span> Dashboard</a>
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
                        <span>Dashboard</span>
                    </button>
                </div>
            </nav>

            <main>

                <div class="cards">
                    <a href="nurse_active.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $totalNurses ?></h1>
                                <span style="font-size: 18px;">Nurses</span>
                            </div>
                            <div>
                                <span class="fas fa-user-md"></span>
                            </div>
                        </div>
                    </a>

                    <a href="staff_active.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $totalStaff ?></h1>
                                <span style="font-size: 18px;">Medical Staffs</span>
                            </div>
                            <div>
                                <span class="fas fa-user-nurse"></span>
                            </div>
                        </div>
                    </a>

                    <a href="guardian_active.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $totalGuardians ?></h1>
                                <span style="font-size: 18px;">Guardians</span>
                            </div>
                            <div>
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                    </a>

                    <a href="senior_active.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $totalSeniors ?></h1>
                                <span style="font-size: 18px;">Seniors</span>
                            </div>
                            <div>
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                    </a>
                    <a href="donation_pending.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $pendingTotal ?></h1>
                                <span style="font-size: 18px;">Pending Donations</span>
                            </div>
                            <div>
                                <span class="fas fa-donate"></span>
                            </div>
                        </div>
                    </a>
                    <a href="donation_received.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $receivedDonation ?></h1>
                                <span style="font-size: 18px;">Donations this Month</span>
                            </div>
                            <div>
                                <span class="fas fa-donate"></span>
                            </div>
                        </div>
                    </a>
                    <a href="admins.php">
                        <div class="card-single">
                            <div>
                                <h1><?php echo $totalAdmin ?></h1>
                                <span style="font-size: 18px;">Admins</span>
                            </div>
                            <div>
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </a>
                </div>

            </main>
        </div>

        <!-- Bootstrap and Jquery plugin -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!-- External JS -->
        <script src="../../js/sidebar_active.js"></script>

</body>

</html>