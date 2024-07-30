<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- BOOTSTRAP PLUGINS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- FONTAWESOME ICONS -->
    <script src="https://kit.fontawesome.com/a76822949c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="shortcut icon" href="../imgs/logo.png">
    <title>Home</title>
</head>

<body>
    <!-- BOOTSTRAP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(52, 160, 160);">
        <a class="navbar-brand" href="index.php">
            <img src="../imgs/logo.png" width="50" height="50" class="d-inline-block align-bottom" alt="Senior Care Logo">
            <span>Health Care</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donation_login.php">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactus">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="guardianlogin.php">Guardian</a>
                        <a class=" dropdown-item" href="stafflogin.php">Staff</a>
                        <div class=" dropdown-divider">
                        </div>
                        <a class="dropdown-item" href="adminlogin.php">Admin</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="main-content">
            <div class="content-header">
                <div class="header-title">
                    <span>Bahay Puso Apostulate Foundation</span>
                </div>
                <div class="header-subtitle">
                    <span>HEALTHCARE INFORMATION</span>
                </div>
            </div>

            <div class="content-body">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="3000">
                            <img src="../imgs/bahaypuso.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../imgs/eating.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../imgs/madres.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../imgs/seniors1.jpg" class="container-fluid" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="divider" id="aboutus">
                    <strong>About Us</strong>
                </div>
                <div class="row1 content">
                    <div class="paragraph par1">
                        <h2>Vision <i class="far fa-eye"></i></h2>
                        <p>The Obispado de Balanga Bahay Puso Foundation, Inc. envisions itself as a home for the abandoned, neglected, and homeless elderly to reclaim their dignity and self-worth, and to strengthened their faith to God.</p>
                    </div>
                </div>
                <div class="row2 content">
                    <div class="paragraph par2">
                        <h2>Mission <i class="far fa-flag"></i></h2>
                        <p>To provide a caring and loving home for the elderly where actions and programs are aimed at rebuilding and enriching their worth, dignity, and spiritually.</p>
                    </div>
                </div>
                <div class="row3 content">
                    <div class="paragraph par3">
                        <h2>Objectives</h2>
                        <p>To be able to achieve the Vision and Mission, the Obispado de Balanga Bahay Puso Foundation, Inc. is committed to:</p>
                        <ul>
                            <li>To provide the basic welfare assistance to the elderly through the well-meaning programs and activities.</li>
                            <li>To ensure that all clients of Bahay Puso are provided with basic needs, peaceful and comfortable accommodation.</li>
                            <li>To create programs for their total human development in order to achieve the vision of seeing the elderly with reclaimed dignity and self-worth and with strengthened faith in God.</li>
                            <li>To ensure that the actions and programs of Bahay Puso are aimed to rebuilding and enriching the spirituality of the clients.</li>
                        </ul>
                    </div>
                </div>
                <div class="divider">
                    <strong>Where to find us</strong>
                </div>
                <div class="map-direction">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.4148118311923!2d120.50458619972227!3d14.689118578790605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33966ab79ed358c9%3A0x5e1fc41969c1a2f7!2sBahay%20Puso%20Apostulate%20Foundation%2C%20Sitio%20Mathay%2C%20Balanga%2C%20Bataan!5e0!3m2!1sen!2sph!4v1621237237477!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </div>

        <div class="content-footer" id="contactus">
            <div class="col1">
                <h4><strong>BAHAY PUSO</strong></h4>
                <small>Home for the abandoned and sick lay aged</small>
                <small>The Diocese’s service to the life and dignity of the elderly</small>
                <small><i class="fas fa-directions"></i> Sitio Mathay, Upper Tuyo, Balanga City, 2100 Bataan</small>
                <small><i class="fas fa-phone-alt"></i> 047-2376700</small>
            </div>
            <div class="col2">
                <h4><strong>LINKS</strong></h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                    <li><a href="donations.php#donate">Donate</a></li>
                </ul>
            </div>
            <div class="col3">
                <div class="upper">
                    <h4><strong>SOCIALS</strong></h4>
                    <span><a href="https://www.facebook.com/pages/Bahay-Puso-Apostolate-Foundation-Inc-Balanga-Bataan/182754895203790" target="_blank"><i class="fab fa-facebook" style="font-size: 30px;"></i></a></span>
                </div>
                <div class="lower">
                    <span><i class="far fa-copyright"></i>  NW3A Group 2</span>
                </div>
            </div>
        </div>
        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
    </main>
    <!-- Bootstrap and Jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- EXTERNAL JS -->
    <script src="../js/scrolltop.js"></script>
</body>

</html>