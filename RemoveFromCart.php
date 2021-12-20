<?php
session_start();
unset($_SESSION['cart'][$_GET['itemID']]);
header('location:cart.php');
?>
