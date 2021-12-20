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
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
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

      <li class="nav-item active">
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
  <div class="centered-header"><h2>Order History</h2></div>
</div>

<!-- Order History Table -->
<?php
require('connection.php');

// Requesting from the database the orders where it matches the given id
$stmt = $db->prepare("SELECT * FROM orders WHERE cid = :id ORDER BY oid DESC");
$stmt->bindParam(':id', $id);

//$id = $_GET['id']; // Should be replaced after the login autorization is ready ******IMPORTANT*******
$id= $_SESSION['customer'];

// Preparing a statement to request the names for the given order
$stmtName = "
SELECT menu.name
FROM orderitems
INNER JOIN menu ON orderitems.itemid = menu.itemID AND orderitems.orderid = :oid
;";
$Name = $db -> prepare($stmtName);
?>

<!-- Table Header -->
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col" class="w-10 p-3">Order ID</th>
      <th scope="col" class="w-25 p-3">Order Items</th>
      <th scope="col" class="w-10 p-3">Total</th>
      <th scope="col" class="w-10 p-3">Date</th>
      <th scope="col" class="w-10 p-3">Status</th>
      <th scope="col" class="w-10 p-3">Reorder</th>
    </tr>
  </thead>
  <tbody>
<?php

// Orders

if($stmt->execute()){

    $first=true;
    while($row = $stmt->fetch()){
        // Requesting the names
        $Name->bindParam(':oid', $row['oid']);
        $Name->execute();

        // Printing order ID
        echo("<tr>
        <td>".$row['oid']."</td>
        <td>
        ");

        // Printing the names
        while($n = $Name->fetch()){
          if($first){
            echo($n['name']);
            $first = false;
          }
          else{
          echo(", ".$n['name']);
          }
        }
        $first=true;

        // Printing an order details link carrying the order id in the link + Total price + Status
        echo("<br> <a href='orderDetails.php?id=".$row['oid']."'>view details</a> </td>
        <td>BD  ".$row['total']."</td>
        <td>".$row['orderTime']."</td>");
        if ($row[4] == 'Completed') {
          echo "<td>".$row['status']."</td>";
        }
        else {
          echo "<td>".$row['status']."
          <br> <a href='track.php'>Track Order</a></td>
          <td>";
        }
        ?>
        <form method='POST' action='Reorder.php'>
          <input type="hidden" name="order" value="<?php echo $row[0]; ?>">
        <?php
        echo "<input type='submit' value='reorder' class='btn btn-outline-info'>
        </form>
        </td>
      </tr>
      <tr>
      ";
    }
}


?>

  </tbody>
</table>
</div>





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
