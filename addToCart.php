<?php
session_start();
$itemID = $_POST['iid'];
if($_POST['q'] > 0){
    $quantity = $_POST['q'];
  }else {
    $quantity = 1;
  }
$_SESSION['cart'][$itemID]=$quantity;
header('Location:menu.php');
//echo $quantity ." + ". $itemID;
 ?>
