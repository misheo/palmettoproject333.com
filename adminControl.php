<?php
if(isset($_POST['new-role']) && isset($_POST['user-id'])){
    $newRole = $_POST['new-role'];
    $userID = $_POST['user-id'];
    echo("I will change the role of the user ".$userID." to ".$newRole."");
    try {
        require('connection.php');
          $sql = $db->query("UPDATE users SET type='$newRole' WHERE uid=$userID")->execute();
        }
       catch (PDOException $e) {
        die("Error Message: ".$e->getmessage());
      }

      header('location: admin.php');
}

if(isset($_POST['item-id'])){
    $itemID = $_POST['item-id'];
    if($_POST['operation'] == 'delete'){
        try {
            require('connection.php');
              $sql = $db->query("DELETE FROM menu WHERE itemID=$itemID;")->execute();
              header('location: admin.php');
            }
           catch (PDOException $e) {
            die("Error Message: ".$e->getmessage());
          }
    }

    if($_POST['operation']=='update'){
        echo("I will update this item");
        require("connection.php");
        if(isset($_FILES["file"])){
        $stmt = $db->prepare("UPDATE menu SET name=:name, type=:type, price=:price, picture=:picture WHERE itemID=:itemID");
        $stmt->bindParam(':itemID', $itemID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':picture', $picture);

        if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2000000)) {
        if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />"; }
        else {
            $fdetails=explode(".",$_FILES["file"]["name"]);
            $fext=end($fdetails);
            $fn="pic".time().uniqid(rand()).".$fext";
            move_uploaded_file($_FILES["file"]["tmp_name"], "images/products/$fn");
            $picture = "images/products/".$fn;
        }
        }
        else{
        $stmt = $db->prepare("UPDATE menu SET name=:name, type=:type, price=:price WHERE itemID=:itemID");
        $stmt->bindParam(':itemID', $itemID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);
        }

        $itemID = $_POST['item-id'];
        $name = $_POST["name"];
        $price = floatval($_POST["price"]);
        $type = $_POST["type"];


}
else { echo "Invalid file"; }
$stmt->execute();
    $db =null;
    header('location: admin.php');

    }

}
else if($_POST['operation']=='add'){
    require("connection.php");
    $stmt = $db->prepare("INSERT INTO MENU (name, price, type, picture) VALUES (:name, :price, :type, :picture)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':picture', $picture);

    $name = $_POST["name"];
    $price = floatval($_POST["price"]);
    $type = $_POST["type"];

    if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 2000000)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />"; }
    else {
            $fdetails=explode(".",$_FILES["file"]["name"]);
            $fext=end($fdetails);
            $fn="pic".time().uniqid(rand()).".$fext";
            move_uploaded_file($_FILES["file"]["tmp_name"], "images/products/$fn");
            $picture = "images/products/".$fn;
    }
}
else { echo "Invalid file"; }
$stmt->execute();
    $db =null;
    header('location: admin.php');

}


?>






















<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=admin.php">
    <title>Document</title>
</head>
<body>
    <div style="text-align: center;">
    <h1>


</h1>

</div>
</body>
</html>
-->
