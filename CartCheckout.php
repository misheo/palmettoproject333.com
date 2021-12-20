<?php
session_start();
$itemID = $_POST['itemID'];
$quantity = $_POST['q'];
if(isset($_POST['cartsbtn']) && $_POST['cartsbtn']=='Update Cart'){
  for($i=0;$i<count($quantity);$i++)
    $_SESSION['cart'][$itemID[$i]]=$quantity[$i];
    header('location:cart.php');
}
else{
  if(!isset($_SESSION['customer'])){
    header('location:sign.php');
  }
  else{
  try {
    require('connection.php');
    $db->beginTransaction();
    $sql = "INSERT INTO orders VALUES (null, '".$_SESSION['customer']."',NOW(),".$_POST['totalp'].",'Unconfirmed')";
    $r=$db->exec($sql);
    if ($r==1){
      $orderID = $db->lastInsertId();
      $sql = "INSERT INTO orderItems VALUES ($orderID, ?,?)";
      $stmt = $db->prepare($sql);
      $c=0;
      for ($i=0;$i<count($itemID);$i++){
         $stmt->execute(array($itemID[$i],$quantity[$i]));
         $c++;
      }
      $db->commit();
      if($c == count($itemID)){
      unset($_SESSION['cart']); //this will delete cart
      echo "<h2 align='center'>Your Order Placed</h2>";
      echo "<h3 align='center'><a style='text-decoration: none; color:black;' href='track.php'>Track your order</a></h3>";
      echo "<h3 align='center'><a style='text-decoration: none; color:black;' href='index.php'>Home</a></h3>";
     }
    }

  }
  catch(PDOException $e){
    $db->rollBack();
    die($e->getMessage());
  }
}
}
 ?>
