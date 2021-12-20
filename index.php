<?php
session_start();
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Palmetto</title>

    <!-- This is Eric Meyers CSS reset -->
    <link rel="stylesheet" href="css-reset.css">

    <!-- This is the Bootstrap CSS & our own stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- icons library -->
    <script src="https://kit.fontawesome.com/2defa84f41.js" crossorigin="anonymous"></script>
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Prata&family=Roboto&family=Zen+Kaku+Gothic+Antique:wght@500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: twinkle-star;
    }
    </style>

</head>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <!--<a class="navbar-brand" href="#"><img src="images/Palmetto_Logo.jpg" height="40" alt="Palmetto"></a>-->
        <a href="index.php" class="navbar-brand">PALMETTO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">


            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="menu.php">View Menu</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="menu.php#breackfast">Breakfast</a>
                        <a class="dropdown-item" href="menu.php#mains">Mains</a>
                        <a class="dropdown-item" href="menu.php#burgers">Burgers</a>
                        <a class="dropdown-item" href="menu.php#salads">Salads</a>
                        <a class="dropdown-item" href="menu.php#sides">Sides</a>
                        <a class="dropdown-item" href="menu.php#desserts">Desserts</a>
                        <a class="dropdown-item" href="menu.php#drinks">Drinks</a>
                        <a class="dropdown-item" href="menu.php#coffee">Coffee</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <?php
        if (isset($_SESSION['customer'])) {
        ?>
                <li class="nav-item">
                    <a class="nav-link" href="EditUserProfile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="OrderHistory.php">My orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Logout.php">Logout</a>
                </li>
                <?php
        } else {
        ?>
                <li class="nav-item">
                    <a class="nav-link" href="sign.php">Sign</a>
                </li>
                <?php
        }
        ?>
            </ul>
        </div>

    </nav>


    <!-- carousel -->
    <div class="jumbotron-fluid">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/carousel1.jpg" class="d-block w-100" alt="...">
                    <p>Escape The Ordinary</p><br>
                    <a type="button" href="menu.php" class="btn incas">Explore our Menu</a>
                </div>
                <div class="carousel-item">
                    <img src="images/carousel2.jpg" class="d-block w-100" alt="...">
                    <p>Escape The Ordinary</p><br>
                    <a type="button" href="menu.php" class="btn incas">Explore our Menu</a>
                </div>
                <div class="carousel-item">
                    <img src="images/carousel3.jpg" class="d-block w-100 " alt="...">
                    <p>Escape The Ordinary</p><br>
                    <a type="button" href="menu.php" class="btn incas">Explore our Menu</a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us jumbotron -->
    <div class="jumbotron container" style="background-color: transparent !important" id="about">
        <h1 class="display-4 jumpsmall">We Escape The Ordinary By Simply <br> Looking Around Us!</h1>
        <p class="lead">Palmetto was born of our love for Home.</p>
        <hr class="my-4">
        <p> From Bahrain’s rich history as a place for all people, to our community’s reknown warmth and creativity;
            <br>
            from being founded by local entrepreneurs, to being brought to life by local creative collaborations: <br>
            our home is overflowing with inspiration that makes Palmetto what it is. <br><br> We escape the ordinary by
            simply looking around us.
        </p>

    </div>

    <!-- Location -->
    <div class="container">
        <h2 style="text-align:center;">Find Us</h2>
        <br>
        <div class="row ">
            <div class="col-md-6 embed-responsive embed-responsive-16by9" style="">
                <iframe class="embed-responsive-item"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3579.775424209272!2d50.49742241503001!3d26.20398278343787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49b00ec064a9a5%3A0x4f34a8ac999580!2sPalmetto!5e0!3m2!1sen!2sbh!4v1639729585030!5m2!1sen!2sbh"
                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h4 class="card-title findt">Our Address</h4>
                    <p class="card-text findx">Nakheel Center, Budaiya, Avenue 57</p>
                    <br>
                    <h4 class="card-title findt">Openeng Times</h4>
                    <p class="card-text findx">7:00AM - 11:30PM</p>
                </div>
            </div>
        </div>
        <br>
        <hr><br><br>
    </div>


    <!-- Contact -->
    <div class="container" id="contact">
        <h2 style="text-align:center;">Contact Us</h2>
        <br>
        <div class="card row pt-4 pl-4 pr-4" style="background: rgba(125, 60, 60, 0.05); border:0;">
            <div class="row">
                <div class="col-4 text-center">
                    <a href="https://www.instagram.com/palmetto.bh"><i class="fab fa-instagram"
                            style=" font-size:2.3rem;color:rgb(59, 38, 33);"></i> </a>
                </div>
                <div class="col-4 text-center">
                    <a href="https://www.instagram.com/palmetto.bh"><i class="fab fa-facebook-f"
                            style=" font-size:2.3rem;color:rgb(59, 38, 33);"></i> </a>
                </div>
                <div class="col-4 text-center">
                    <a class=""><i class="fas fa-phone-alt" style=" font-size:2rem;color:rgb(59, 38, 33);"></i> </a>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-4 text-center">
                    <a href="https://www.instagram.com/palmetto.bh" style="color:rgb(92, 63, 56);">palmetto.ph</a>
                </div>
                <div class="col-4 text-center">
                    <a href="https://www.facebook.com/pages/category/Restaurant/Palmetto-Bahrain-101234101858817/"
                        style="color:rgb(92, 63, 56);">Palmetto Bahrain</a>
                </div>
                <div class="col-4 text-center">
                    <a style="color:rgb(92, 63, 56);">1759 5474</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <!-- Gallary -->
    <div class="container">
        <h2 style="text-align:center;">Gallary</h2>
        <br>
        <div class="card-deck">
            <div class="card" style=" border:0;">
                <img src="images/g4.jpg" style="border-radius:2rem;" alt="...">
            </div>
            <div class="card" style=" border:0;">
                <img src="images/g5.jpg" style="border-radius:2rem;" alt="...">
            </div>
            <div class="card" style=" border:0;">
                <img src="images/g3.jpg" style="border-radius:2rem;" alt="...">
            </div>
        </div>
    </div>
    <br><br>




    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="javascripts.js"></script>
</body>
<footer class="bg-white text-center">
    <p>Copyright &copy; <a href="#">Palmetto</a>, All Right Reserved.</p>
</footer>

</html>