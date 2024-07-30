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

    <title>Manage Recommendations</title>

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
                <li class="active">
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
                        <li class="activeSub">
                            <a href="#">Manage Recommendations</a>
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
                        <span>Manage Recommendations</span>
                    </button>
                </div>
            </nav>

            <main>
                <!-- Modal in adding new photo recommendation -->
                <div class="modal fade bd-example-modal-lg" id="photo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">New Photo Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal add -->
                            <div class="modal-body">
                                <form action="crud/addphoto.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title-photo">Title*</label>
                                        <input type="text" class="form-control" name="title-photo" id="title-photo" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-photo">Description*</label>
                                        <textarea class="form-control" name="description-photo" id="description-photo" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-photo" name="file-photo" required>
                                                <label class="custom-file-label" for="file-photo">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="button" value="Upload" name="upload-photo" id="upload-photo" class="btn btn-primary"></input>
                                        </div>
                                    </div>
                                    <input type="hidden" name="uploader-photo" value="<?php echo $nurse_fname . " " . $nurse_lname; ?>">
                                    <div>Image Preview</strong></div>
                                    <div id="preview-photo" class="justify-content-center">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Save" name="add-photo" id="add-photo" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in viewing and updating photo recommendation -->
                <div class="modal fade bd-example-modal-lg" id="photo-modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Recommended Photo Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updatephoto.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="photo-id" id="photo-id">
                                    <div class="form-group">
                                        <label for="title-photo-update">Title*</label>
                                        <input type="text" class="form-control" name="title-photo-update" id="title-photo-update" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-photo-update">Description*</label>
                                        <textarea class="form-control" name="description-photo-update" id="description-photo-update" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="date-photo-update">Date Created*</label>
                                            <input type="text" class="form-control" name="date-photo-update" id="date-photo-update" placeholder="dd/mm/yyyy" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="created-photo-update">Created By*</label>
                                            <input type="text" class="form-control" name="created-photo-update" id="created-photo-update" placeholder="Enter title" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-photo-update" name="file-photo-update">
                                                <label class="custom-file-label" for="file-photo-update">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="button" value="Upload" name="upload-photo-update" id="upload-photo-update" class="btn btn-primary"></input>
                                        </div>
                                    </div>
                                    <div>Image Preview</strong></div>
                                    <div id="preview-photo-update" class="justify-content-center">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="add-photo-update" id="add-photo-update" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL IN DELETING PHOTO -->
                <div class="modal fade" id="delmodal-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Photo Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal delete -->
                            <div class="modal-body">
                                <form action="crud/deletephoto.php" method="POST">
                                    <input type="hidden" name="delete-photo-id" id="delete-photo-id">
                                    <h4 id="del-photo-title"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary clear" data-dismiss="modal">Cancel</button>
                                <input type="submit" value="Delete" name="delete-photo" id="delete-submit" class="btn btn-primary"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in adding new photo recommendation -->
                <div class="modal fade bd-example-modal-lg" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">New Video Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal add -->
                            <div class="modal-body">
                                <form action="crud/addvideo.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title-video">Title*</label>
                                        <input type="text" class="form-control" name="title-video" id="title-video" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-video">Description*</label>
                                        <textarea class="form-control" name="description-video" id="description-video" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-video" name="file-video" required>
                                                <label class="custom-file-label" for="file-video">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="button" value="Upload" name="upload-video" id="upload-video" class="btn btn-primary"></input>
                                        </div>
                                    </div>
                                    <input type="hidden" name="uploader-video" value="<?php echo $nurse_fname . " " . $nurse_lname; ?>">
                                    <div>Video Preview</strong></div>
                                    <div id="preview-video" class="justify-content-center">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Save" name="add-video" id="add-video" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in viewing and updating video recommendation -->
                <div class="modal fade bd-example-modal-lg" id="video-modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Recommended Video Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updatevideo.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="video-id" id="video-id">
                                    <div class="form-group">
                                        <label for="title-video-update">Title*</label>
                                        <input type="text" class="form-control" name="title-video-update" id="title-video-update" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-video-update">Description*</label>
                                        <textarea class="form-control" name="description-video-update" id="description-video-update" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="date-video-update">Date Created*</label>
                                            <input type="text" class="form-control" name="date-video-update" id="date-video-update" placeholder="dd/mm/yyyy" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="created-video-update">Created By*</label>
                                            <input type="text" class="form-control" name="created-video-update" id="created-video-update" placeholder="Enter title" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file-video-update" name="file-video-update">
                                                <label class="custom-file-label" for="file-video-update">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="button" value="Upload" name="upload-video-update" id="upload-video-update" class="btn btn-primary"></input>
                                        </div>
                                    </div>
                                    <div>Video Preview</strong></div>
                                    <div id="preview-video-update" class="justify-content-center">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="add-video-update" id="add-video-update" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL IN DELETING VIDEO -->
                <div class="modal fade" id="delmodal-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Video Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal delete -->
                            <div class="modal-body">
                                <form action="crud/deletevideo.php" method="POST">
                                    <input type="hidden" name="delete-video-id" id="delete-video-id">
                                    <h4 id="del-video-title"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary clear" data-dismiss="modal">Cancel</button>
                                <input type="submit" value="Delete" name="delete-video" id="delete-submit" class="btn btn-primary"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in adding new article recommendation -->
                <div class="modal fade bd-example-modal-lg" id="article-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">New Article Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal add -->
                            <div class="modal-body">
                                <form action="crud/addarticle.php" method="POST">
                                    <div class="form-group">
                                        <label for="title-article">Title*</label>
                                        <input type="text" class="form-control" name="title-article" id="title-article" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-article">Description*</label>
                                        <textarea class="form-control" name="description-article" id="description-article" maxlength="1000" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="url-article">Source Url*</label>
                                        <input type="url" class="form-control" name="url-article" id="url-article" placeholder="https://www.google.com/search?q=health+tips" required>
                                    </div>
                                    <input type="hidden" name="uploader-article" value="<?php echo $nurse_fname . " " . $nurse_lname; ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Save" name="add-article" id="add-article" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal in viewing and updating article recommendation -->
                <div class="modal fade bd-example-modal-lg" id="article-modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(52, 160, 160); color: white;">
                                <h5 class="modal-title" id="exampleModalLabel">Recommended Article Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal update -->
                            <div class="modal-body">
                                <form action="crud/updatearticle.php" method="POST">
                                    <input type="hidden" name="article-id" id="article-id">
                                    <div class="form-group">
                                        <label for="title-article-update">Title*</label>
                                        <input type="text" class="form-control" name="title-article-update" id="title-article-update" placeholder="Enter title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-article-update">Description*</label>
                                        <textarea class="form-control" name="description-article-update" id="description-article-update" placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="date-article-update">Date Created*</label>
                                            <input type="text" class="form-control" name="date-article-update" id="date-article-update" placeholder="dd/mm/yyyy" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="created-article-update">Created By*</label>
                                            <input type="text" class="form-control" name="created-article-update" id="created-article-update" placeholder="Enter title" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="url-article-update">Source Url*</label>
                                        <input type="url" class="form-control" name="url-article-update" id="url-article-update" placeholder="https://www.google.com/search?q=health+tips" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" value="Update" name="add-article-update" id="add-article-update" class="btn btn-primary" style="background-color: rgb(52, 160, 160);"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- MODAL IN DELETING ARTICLE -->
                 <div class="modal fade" id="delmodal-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Article Recommendation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- main section of modal delete -->
                            <div class="modal-body">
                                <form action="crud/deletearticle.php" method="POST">
                                    <input type="hidden" name="delete-article-id" id="delete-article-id">
                                    <h4 id="del-article-title"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary clear" data-dismiss="modal">Cancel</button>
                                <input type="submit" value="Delete" name="delete-article" id="delete-submit" class="btn btn-primary"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RECOMMENDED PHOTOS HEADER -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Photo Recommendations</strong></h4>
                    </div>
                </div>

                <!-- DATA TABLE -->
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#photo-modal"><i class="fas fa-plus"></i> Add Content</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_recommendation_photo";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-photo" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col" style="display: none;">Description</th>
                                        <th scope="col" style="display: none;">Path</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Action</th>
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
                                                <td><?php echo $row['recommendation_photo_id'] ?></td>
                                                <td><?php echo $row['recommendation_photo_title'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_photo_description'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_photo_path'] ?></td>
                                                <td><?php echo $row['date_created'] ?></td>
                                                <td><?php echo $row['created_by'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success editbtn"> VIEW </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                                </td>
                                                <!-- <td>
                                                <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                            </td> -->
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

                <!-- RECOMMENDED VIDEOS HEADER -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Video Recommendations</strong></h4>
                    </div>
                </div>

                <!-- DATA TABLE -->
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#video-modal"><i class="fas fa-plus"></i> Add Content</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_recommendation_video";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-video" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col" style="display: none;">Description</th>
                                        <th scope="col" style="display: none;">Path</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Action</th>
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
                                                <td><?php echo $row['recommendation_video_id'] ?></td>
                                                <td><?php echo $row['recommendation_video_title'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_video_description'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_video_path'] ?></td>
                                                <td><?php echo $row['date_created'] ?></td>
                                                <td><?php echo $row['created_by'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success editbtn"> VIEW </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                                </td>
                                                <!-- <td>
                                                <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                            </td> -->
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

                <!-- RECOMMENDED ARTICLES HEADER -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-body" style="background-color: rgb(52, 160, 160); color: white;">
                        <h4><strong>Article Recommendations</strong></h4>
                    </div>
                </div>

                <!-- DATA TABLE -->
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right" style="margin-bottom: 1rem;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#article-modal"><i class="fas fa-plus"></i> Add Content</button>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $records_query = "SELECT * FROM tbl_recommendation_article";

                            $records = mysqli_query($con, $records_query);
                            ?>
                            <table id="datatable-article" class="table table-bordered table-hover table-striped" style="width: 100%; text-align: center;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col" style="display: none;">Description</th>
                                        <th scope="col" style="display: none;">Path</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Action</th>
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
                                                <td><?php echo $row['recommendation_article_id'] ?></td>
                                                <td><?php echo $row['recommendation_article_title'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_article_description'] ?></td>
                                                <td style="display: none;"><?php echo $row['recommendation_article_url'] ?></td>
                                                <td><?php echo $row['date_created'] ?></td>
                                                <td><?php echo $row['created_by'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success editbtn"> VIEW </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                                </td>
                                                <!-- <td>
                                                <button type="button" class="btn btn-danger delbtn"> DELETE </button>
                                            </td> -->
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
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

        <!-- Data tables plugin -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <!-- EXTERNAL JS -->
        <script src="../../js/sidebar_active.js"></script>
        <script src="../../js/staff_js/update_delete_recommendations.js"></script>
        <script src="../../js/staff_js/showfilename.js"></script>
        <script src="../../js/staff_js/filepreview.js"></script>

        <!-- ALERT MESSAGE AFTER FORM SUBMIT -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php
        if (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'added') {
        ?>
            <script>
                swal({
                    title: "Successfully Added!",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'updated') {
        ?>
            <script>
                swal({
                    title: "Data Successfully Updated!",
                    icon: "success",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'update_failed') {
        ?>
            <script>
                swal({
                    title: "Data not Updated!",
                    text: "Unknown error occured!",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'db error') {
        ?>
            <script>
                swal({
                    title: "Data not Added!",
                    text: "Database error occured!",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'failed') {
        ?>
            <script>
                swal({
                    title: "Data not Added!",
                    text: "Unknown error occured!",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'oversized') {
        ?>
            <script>
                swal({
                    title: "Data not Added!",
                    text: "Image file shoud be less than 25mb",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'oversized_vid') {
        ?>
            <script>
                swal({
                    title: "Data not Added!",
                    text: "Video file should be less than 1gb",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'invalid type') {
        ?>
            <script>
                swal({
                    title: "Data not Added!",
                    text: "Image file shoud be less than 25mb",
                    icon: "warning",
                    button: "Confirm",
                });
            </script>
        <?php
        } elseif (isset($_SESSION['formSubmitted']) && $_SESSION['formSubmitted'] == 'deleted') {
        ?>
            <script>
                swal({
                    title: "Data Successfully Deleted!",
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