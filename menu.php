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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Roboto&family=Zen+Kaku+Gothic+Antique:wght@500&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
</head>

<body>

  <!-- Navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top ApageNav">
      <!--<a class="navbar-brand" href="#"><img src="images/Palmetto_Logo.jpg" height="40" alt="Palmetto"></a>-->
      <a href="#" class="navbar-brand">PALMETTO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">

          <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                  <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php#about">About</a>
              </li>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" href="" id="navbarDropdown" role="button"
                      data-toggle="dropdown" aria-expanded="false">
                      Menu
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="menu.php">View Menu</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#breakfast">Breakfast</a>
                      <a class="dropdown-item" href="#mains">Mains</a>
                      <a class="dropdown-item" href="#burgers">Burgers</a>
                      <a class="dropdown-item" href="#salads">Salads</a>
                      <a class="dropdown-item" href="#sides">Sides</a>
                      <a class="dropdown-item" href="#desserts">Desserts</a>
                      <a class="dropdown-item" href="#drinks">Drinks</a>
                      <a class="dropdown-item" href="#coffee">Coffee</a>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php#contact">Contact</a>
              </li>
              <?php
              if(isset($_SESSION['customer'])){
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
              }else {
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

    <!-- View Cart-->
    <div class="viewCart sticky-top">
      <a href="cart.php" class="cartIcon" style="color:white; font-size:1.6rem;"><i class="fa fa-shopping-cart"></i></a>
    </div>

    <!-- page header -->
    <div class="jumbotron-fluid page-header d-block w-100">
        <img class="d-block w-100" src="images\header.jpg" alt="">
        <div class="centered-header">
            <h2>Menu</h2>
        </div>
    </div>

    <!--   search menu  -->
    <div class="container card" style="text-align:center; color: black; border:0; width:60%;">
      <form>
        <div class="searchcontainer d-flex"><input class="form-control smenbox" type="search"  onkeyup="showResult(this.value)" placeholder="Search Menu" style="position: relative;">
          <button class="btn" type="submit"><i class="fa fa-search"></i></button>
        </div>
       <div id="livesearch" class="livesearch p-1 pl-2" style="width:95%; position: inherit; text-align:left; color:black;"></div>
     </form>
    </div>

<br><br>

    <!-- Menu -->
    <div class="container">
    <div class="sideMenu sideMenuMain card d-block" id="sideMenu">
        <div class="menScrol"> <a href="#breakfast">Breakfast</a></div>
        <div class="menScrol"> <a href="#mains">Mains</a></div>
        <div class="menScrol"> <a href="#burgers">Burgers</a></div>
        <div class="menScrol"> <a href="#salads">Salads</a></div>
        <div class="menScrol"> <a href="#sides">Sides</a></div>
        <div class="menScrol"> <a href="#desserts">Desserts</a></div>
        <div class="menScrol"> <a href="#drinks">Drinks</a></div>
        <div class="menScrol"> <a href="#coffee">Coffee</a></div>
    </div>
    <hr>


  <!-- Menu items -->
  <?php
  try {
    require('connection.php');
    $sql = "SELECT * FROM menu WHERE type = 'breakfast'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block' id='breackfast'><a>Breakfast</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol' id='$name'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number"  name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";

    $sql = "SELECT * FROM menu WHERE type = 'mains'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='mains'><a>Mains</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol' id='$name'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'burgers'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='burgers'><a>Burgers</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol' id='$name'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'salads'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='salads'><a>Salads</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol' id='$name'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'sides'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='sides'><a>Sides</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'desserts'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='desserts'><a>Desserts</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'drinks'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='drinks'><a>Drinks</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    $sql = "SELECT * FROM menu WHERE type = 'coffee'";
    $menu = $db->query($sql);
    echo "<div class='container sideMenu card d-block mt-4' id='coffee'><a>Coffee</a></div>";
    echo "<div class='row  align-items-center'>";
    while ($details = $menu->fetch(PDO::FETCH_ASSOC)) {
      extract($details);
        echo "<div class='col col-md-4 col-lg-3 pt-4 imcol'>";
        echo "<div class='d-flex justify-content-around imenu impic'><img src='$picture'style='max-width: 12rem; max-height: 12rem; border-radius:3px;'/></div>";
        echo "<div class='d-flex justify-content-around imenu'>$name</div>";
        echo "<div class='d-flex justify-content-around imenu'>$price BD</div>";
        ?>
        <div class="d-flex justify-content-around imenu">
        <form class="" action="addToCart.php" method="post">
          <input type="number" name="q" min="0" max="100">
          <input type='hidden' name='iid' value='<?php echo $itemID; ?>' />
          <button type="submit" class="btn btn-light">Add to cart</button>
        </form>
        </div>
        <?php
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
  } catch (PDOException $e) {
      echo $e->getMessage();
  }

    ?>
    </div>
<div class="exspace">

</div>

    <footer class="bg-white text-center">
        <p>Copyright &copy; <a href="#">Palmetto</a>, All Right Reserved.</p>
    </footer>

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
    <script>
    // search bar in Menu
    var inp=false;
    function showResult(str) {
      var myexp=/^[a-zA-Z][a-zA-Z' ']{1,49}$/;
      if (!myexp.test(str) ){
          return;
        }
      else{
          if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            document.getElementById("livesearch").style.border="0px";
            return;
          }

          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("livesearch").innerHTML=this.responseText;
              document.getElementById("livesearch").style.border="1px solid rgb(181, 150, 150)";
              document.getElementById("livesearch").style.borderRadius="4px";
            }
          }
          xmlhttp.open("GET","search.php?q="+str,true);
          xmlhttp.send();
        }

    }
    </script>

</body>

</html>
