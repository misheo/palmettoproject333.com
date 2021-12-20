<?php
if(isset($_POST['update'])){
  try {
    require('connection.php');
    $st = $_POST['soption'];
    $o = $_POST['orderid'];
    echo $st[0];
    for($i=0; $i<count($o); $i++){
      $r = $db->query("UPDATE orders SET status = '$st[$i]' WHERE oid = $o[$i]")->execute();
  }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
header('location:orders.php');
 ?>
