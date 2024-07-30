<?php
require "functions/checklogin.php";
require "functions/check_account.php";
?>
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

    <link rel="stylesheet" href="../../css/donations.css">
    <link rel="shortcut icon" href="../../imgs/logo.png">
    <title>Donate</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="donation_index.php">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donations.php">Donations</a>
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
        <div class="mainContent">
            <div class="donateHeader">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="3000">
                            <img src="../../imgs/bahaypuso.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../imgs/eating.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../imgs/madres.jpg" class="container-fluid" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="../../imgs/seniors1.jpg" class="container-fluid" alt="...">
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
            </div>
            <div class="donateMain" id="donate">
                <div class="sectionLeft">
                    <p class="content-quote">
                        <sup>24</sup> One gives freely, yet grows all the richer; another withholds what he should give, and only suffers want. <sup>25</sup> Whoever brings blessing will be enriched, and one who waters will himself be watered.
                    </p>
                    <p class="content-verse">
                        <strong>Proverbs 11:24-25</strong>
                    </p>
                </div>
                <div class="sectionRight" id="donate">
                    <form action="crud/adddonation.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <h3 class="text-center">Donation</h3>
                        </div>
                        <?php
                        if (isset($_SESSION['notice'])) {
                        ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                echo $_SESSION['notice'];
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <input type="hidden" name="donorID" value="<?php echo $donor_id ?>">
                        <div class="form-group">
                            <label for="inputCategory">Donation Type*</label>
                            <select name="inputCategory" id="inputCategory" class="form-control">
                                <option selected>-</option>
                                <option>Cash</option>
                                <option>Medicine</option>
                                <option>Goods</option>
                                <option>Clothes</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group" id="amount-input">
                            <!-- <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" step="10" required> -->
                        </div>
                        <!-- <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">>&#8369;</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="inputDescription">Desription</label>
                            <textarea name="inputDescription" id="inputDescription" class="form-control" placeholder="Enter a brief description of your donation here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary donate" id="donate" name="inputDonate">Donate</button>
                    </form>
                </div>
            </div>
            <div class="message">
                <p><em>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi dolorem iste, officia et ratione ea? Qui officiis numquam doloremque reprehenderit, consectetur ratione, cumque quis sit harum optio corrupti asperiores autem accusantium dolores ab et. Ipsa ipsam aliquid recusandae fuga natus!</em></p>
            </div>
        </div>
        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
    </main>

    <!-- Bootstrap and Jquery plugin -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- EXTERNAL JS -->
    <script src="../../js/sidebar_active.js"></script>
    <script src="../../js/scrolltop.js"></script>
    <script src="../../js/donor_js/donation_type.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 3000
        })
    </script>

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