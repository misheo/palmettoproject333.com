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


<!-- Order Details Table-->
<?php
require("connection.php");

// Requesting the data from the database for the order ID provided in the link
$statement = "
SELECT menu.picture, menu.name, menu.price, orderitems.quantity
FROM orderitems
INNER JOIN menu ON orderitems.itemid = menu.itemID AND orderitems.orderid = :id;

";

// Preparing the statement
$stmt = $db->prepare($statement);
$stmt->bindParam(':id', $id);

// Taking the order id from the link
$id = $_GET['id'];

?>

<!-- Table Header -->
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>

<?php
// Order Details

// Initiating the total amount value, then it will be calculated by adding the amount for each item
$total=0;

if($stmt->execute()){
    while($row = $stmt->fetch()){
        // Defining each variable that will be used
        $picture= 'images/products/pic1639162485207352598161b3a275a3dbc.jpg';
        $name= $row['name'];
        $price= $row['price'];
        $quantity= $row['quantity'];
        $amount = $price * $quantity;
        $total += $amount;

        // Printing the Values
        echo("<tr>
        <th scope='row'><img style='max-height: 120px;' src='".$picture."'</img></th>
        <td>".$name."</td>
        <td>BD ".$price."</td>
        <td>".$quantity."</td>
        <td>BD ".$amount."</td>
      </tr>
      <tr>
      ");
    }
    echo("</tbody>
    </table>
    <hr>
    <div style='display: flex; justify-content: space-between; font-size: 1.2rem;  padding-right: 5rem;'>
        <p></p>
        <p>Total: BD ".$total."</p>"); // Printing the total amount
}


$db =null;

?>


</div>
</div>
