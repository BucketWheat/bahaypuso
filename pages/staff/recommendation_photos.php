<!-- check doctor if logged in -->
<?php
session_start();

include("functions/connections.php");
include("functions/staff_pages_sessions.php");
include("functions/pagenumber.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Photo Recommendation</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
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
                <li class="active">
                    <a href="#recommendationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="far fa-thumbs-up"></span> Recommendations</a>
                    <ul class="collapse list-unstyled" id="recommendationSubmenu">
                        <li class="activeSub">
                            <a href="#">Photos</a>
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
                        <span>Photos</span>
                    </button>
                </div>
            </nav>

            <main>

                <!-- RECOMMENDATION PHOTO HEADER -->
                <div class="card">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Photo Recommendations</strong></h4>
                    </div>
                </div>

                <div class="card">
                    <!-- CONTENTS -->
                    <div class="card-body photo-container">
                        <?php
                        //get products from database
                        $query = "SELECT * FROM tbl_recommendation_photo ORDER BY recommendation_photo_id DESC, date_created DESC LIMIT $offset, $total_records_per_page";
                        $records = mysqli_query($con, $query);
                        foreach ($records as $key => $row) {
                        ?>
                            <div class="card text-center photo-card" id="img">
                                <img src="../../uploads/photos/<?php echo $row['recommendation_photo_path'] ?>" alt="<?php echo $row['recommendation_photo_title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title" id="photo-header"><?php echo ucwords($row['recommendation_photo_title']); ?></h5>
                                    <p class="card-text" id="photo-body"><?php echo $row['recommendation_photo_description'] ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- PAGINATION -->
                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <div>
                            <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                        </div>
                        <ul class="pagination justify-content-center">
                            <?php if ($page_no > 1) {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>First Page</a></li>";
                            }
                            ?>

                            <li class='page-item' <?php if ($page_no <= 1) {
                                                        echo "class='disabled'";
                                                    } ?>>
                                <a class='page-link' <?php if ($page_no > 1) {
                                                            echo "href='?page_no=$previous_page'";
                                                        } ?>>Previous</a>
                            </li>

                            <?php
                            if ($total_no_of_pages <= 10) {
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                    } else {
                                        echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                            } elseif ($total_no_of_pages > 10) {

                                if ($page_no <= 4) {
                                    for ($counter = 1; $counter < 8; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                        } else {
                                            echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";

                                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                }
                            }
                            ?>

                            <li class='page-item' <?php if ($page_no >= $total_no_of_pages) {
                                                        echo "class='disabled'";
                                                    } ?>>
                                <a class='page-link' <?php if ($page_no < $total_no_of_pages) {
                                                            echo "href='?page_no=$next_page'";
                                                        } ?>>Next</a>
                            </li>
                            <?php if ($page_no < $total_no_of_pages) {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                            } ?>
                        </ul>
                    </div>
                </div>
            </main>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <!-- EXTERNAL JS -->
        <script src="../../js/sidebar_active.js"></script>
</body>

</html>