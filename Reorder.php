<?php
session_start();
try {
  require('connection.php');
  $idorder = $_POST['order'];
  $data = $db->query("SELECT * FROM orderitems WHERE orderid = $idorder");
  while($details = $data->fetch(PDO::FETCH_ASSOC)){
    extract($details);
    $itemID = $itemid;
    $_SESSION['cart'][$itemID]=$quantity;
  }
  header("location:cart.php");

} catch (PDOException $e) {
  echo $e->getMessage();
}

 ?>
