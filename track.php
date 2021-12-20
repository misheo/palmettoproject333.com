<?php
session_start();
if(!isset($_SESSION['customer'])){
  header("location:index.php");
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Palmetto</title>

    <!-- This is Eric Meyers CSS reset -->
    <link rel="stylesheet" href="css-reset.css">

    <!-- This is the Bootstrap CSS & our own stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- icons library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Roboto&family=Zen+Kaku+Gothic+Antique:wght@500&display=swap" rel="stylesheet">
  </head>
  <body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
   <!--<a class="navbar-brand" href="#"><img src="images/Palmetto_Logo.jpg" height="40" alt="Palmetto"></a>-->
   <a href="index.php" class="navbar-brand">PALMETTO</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">


    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="index.php#about">About</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
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

<!-- page header -->
<div class="jumbotron-fluid page-header d-block w-100">
  <img class="d-block w-100"src="images\header.jpg" alt="" >
  <div class="centered-header"><h2>Order Status</h2></div>
</div>


<!-- order summary-->
<div class="container">
  <div class="trackcards">
<?php
try {
  require('connection.php');
  $customer = $_SESSION['customer'];
//  $status = 'unconfirmed';
  $data = $db->query("SELECT * FROM orders WHERE cid = $customer AND status != 'Completed' ORDER BY orderTime DESC")->fetchAll();
  if($data > 0){
    foreach ($data as $key ) {
      echo "<div class'card trackcard col-12'>";
      $d = "Delivering";
      $p = "Processing";
      $u = "Unconfirmed";
      $currents = $key[4];
      if($u == $currents){
        echo"<div class='progress' style='height: 20px; width:70%; margin:0 auto;'>";
          echo"<div class='progress-bar w-25 'style='background:rgb(135, 96, 93);' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>Unconfirmed</div>";
             echo"</div>";
            }
      else  if($currents==$p){
      echo "<div class='progress' style='height: 20px;width:70%; margin:0 auto;'>";
        echo"<div class='progress-bar w-50' style='background:rgb(135, 96, 93);' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>Processing</div>";
           echo "</div>";
       }
         else  if($currents==$d){
           echo"<div class='progress' style='height: 20px;width:70%; margin:0 auto;'>";
             echo"<div class='progress-bar w-75'style='background:rgb(135, 96, 93); role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'>On Route</div>";
                echo"</div>";
         }
         else {
         echo"<div class='progress'  style='height: 20px;width:70%; margin:0 auto;'>";
           echo"<div class='progress-bar w-100'style='background:rgb(135, 96, 93);' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>Completed</div>";
              echo "</div>";
          }
          echo "<br> <h4 style='text-align: center;'>Order Summary</h4><br>";
    $oid = $key['oid'];
    $order =  $db->query("SELECT * FROM orderitems WHERE orderid = $oid")->fetchAll();
    echo "<table width=90% class='mx-auto' style='text-align: center;'>";
    echo "<tr><th></th><th></th><th><b>Price</b></th></tr>";
    foreach ($order as $o) {
      $item = $o[1];
      $dish = $db->query("SELECT * FROM menu WHERE itemID = $item")->fetchAll();
      foreach ($dish as $d) {
        echo "<tr><td>x".$o[2]." ".$d[1]."</td><td></td><td>".$d[2]."</td></tr>";
      }
    }
      echo "<tr><td>Delivery</td><td></td><td> 1 BD</td></tr>";
    echo "<tr><td><b>Total</b></td><td></td><td><b>".$key[3]." BD</b></td></tr>";
    echo "</table>";

  ?></div>
      <br><br>

    <?php
  }
  }else{
    echo "you do not have any order yet!";
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

 ?>
 </div>
 </div>
<!-- status update -->







     <!-- JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
     <script src="javascripts.js"></script>
  </body>
  <footer class="bg-white text-center">
            <p>Copyright &copy; <a href="#">Palmetto</a>, All Right Reserved.</p>
    </footer>
</html>
