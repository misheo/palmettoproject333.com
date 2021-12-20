<?php
session_start();
if (!isset($_SESSION['admin'])) {
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
   <a href="#" class="navbar-brand">PALMETTO</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link" href="admin.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active"  href="Logout.php">Logout</a>
      </li>
    </ul>

  </div>

</nav>


<!-- page header -->
<div class="jumbotron-fluid page-header d-block w-100">
  <img class="d-block w-100"src="images\header.jpg" alt="" >
  <div class="centered-header"><h2>Admin Panel</h2></div>
</div>

<!-- Main -->
<div class="container">

<!-- tabs -->
<div class="container px-4 d-flex">
<button type="button" data-tab-target="#users" class="btn btn-primary btn-lg">Users</button>
<button type="button" data-tab-target="#items" class="btn btn-secondary btn-lg">Items</button>
</div>
<hr>

<!-- container -->
<div class="container ap-box border p-3">

<!-- items -->
    <div id="items" data-tab-content>
<nav class="navbar navbar-light justify-content-between"  style="position:relative; width: relative;">
<button type="button" class="btn btn-secondary btn-lg" data-form-target='#add-13'>Add Item</button>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" onkeyup="showResult(this.value)">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<div id="dsearch" class="ml-auto p-1 pl-2" style="width:22%; text-align:left; color:black; margin-right:10%; position:inherit;"></div>

<hr>

<!-- Add Item -->
<div id='add-13' data-form-content>
  <form class='form-group' action='adminControl.php' method='POST' enctype='multipart/form-data'>
    <input type='hidden' name='optype' value='item'>
    <input type='hidden' name='operation' value='addItem'>
    <label for='name'>Name:</label><br>
    <input class='form-control' type='text' name ='name'><br>
    <label for='price'>Price: </label><br>
    <input class='form-control' type='text' name ='price'><br>
    <label for='type'>Type: </label>
    <select class='form-control' name='type'>
        <option value='breakfast'>Breakfast</option>
        <option value='mains'>Mains</option>
        <option value='burgers'>Burgers</option>
        <option value='salads'>Salads</option>
        <option value='sides'>Sides</option>
        <option value='desserts'>Desserts</option>
        <option value='drinks'>Drinks</option>
        <option value='coffee' >Coffee</option>
        </select><br>

    <label for='file'>Picture: </label>
    <div class='input-group mb-3'>
  <div class='input-group-prepend'>
    <span class='input-group-text'>Upload</span>
  </div>
  <div class='custom-file'>
    <input type='file' name ='file' value='file' class='custom-file-input' id='inputGroupFile01'>
    <label class='custom-file-label' for='inputGroupFile01'>Choose file</label>
  </div>
</div>
    <input type="hidden" id="operation" name="operation" value="add">
    <input type='submit' class="btn btn-outline-secondary" name='submit' value='Add'><br>

</form>
</div>
<hr>


<!-- Item -->
<?php
require('connection.php');
$sql = "SELECT * FROM menu";
$items = $db->query($sql);

foreach($items as $item){
  $itemID = $item['itemID'];
  $name = $item['name'];
  $price = $item['price'];
  $type = $item['type'];
  $picture = $item['picture'];

  echo("
<div class='ap-item' id='$name'>
  <div class='row'>
    <div class='col-sm'>
      <img src=".$picture." class='ap-img'/>
    </div>
    <div class='col-sm ap-item-center'>
      <h5>".$name."</h5><br>
      <p>Price: BD".$price."</p><br>
      <p>".$type."</p>
    </div>
    <div class='col-sm ap-item-center'>
      <form class='w-100' action='adminControl.php' method='POST'>


        <!-- Delete button -->
        <input type='hidden' id='item-id' name='item-id' value=".$itemID.">
        <input type='hidden' id='operation' name='operation' value='delete'>
        <input type='submit' value= 'Delete' class='btn btn-outline-danger w-100 mb-2'><br>
    </form>


        <!-- Edit button -->
    <button class='edit-button btn btn-outline-dark w-100 mt-2' data-form-target=#item-".$itemID.">Edit</button>
    </div>
  </div>
  <hr>

        <!-- Edit form -->
  <div id=item-".$itemID." data-form-content>
  <form class='form-group' action='adminControl.php' method='POST' enctype='multipart/form-data'>
    <label for='name'>Name:</label><br>
    <input class='form-control' type='text' name ='name' value=".$name."><br>
    <label for='price'>Price: </label><br>
    <input class='form-control' type='text' name ='price' value=".$price."><br>
    <label for='type'>Type: </label>
    <select class='form-control' name='type'>
    ");
    if($type == 'breakfast'){
      echo("<option value='breakfast' selected>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'mains'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains' selected>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'burgers'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers' selected>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'salads'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads' selected>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'sides'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides' selected>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'desserts'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts' selected>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'drinks'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks' selected>Drinks</option>
      <option value='coffee' >Coffee</option>");
    }
    else if($type == 'coffee'){
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee' selected>Coffee</option>");
    }
    else{
      echo("<option value='breakfast'>Breakfast</option>
      <option value='mains'>Mains</option>
      <option value='burgers'>Burgers</option>
      <option value='salads'>Salads</option>
      <option value='sides'>Sides</option>
      <option value='desserts'>Desserts</option>
      <option value='drinks'>Drinks</option>
      <option value='coffee'>Coffee</option>
      ");
    }

echo("
        </select><br>

    <label for='file'>Picture: </label>
    <div class='input-group mb-3'>
  <div class='input-group-prepend'>
    <span class='input-group-text'>Upload</span>
  </div>
  <div class='custom-file'>
    <input type='file' name ='file' value='file' class='custom-file-input' id='inputGroupFile01'>
    <label class='custom-file-label' for='inputGroupFile01'>Choose file</label>
  </div>
</div>
<input type='hidden' id='operation' name='operation' value='update'>
<input type='hidden' id='item-id' name='item-id' value=".$itemID.">
<input type='submit' class='btn btn-outline-secondary' name='submit' value='Update'><br>
</form>
</div>
<hr>
</div>
");
}



?>
<!-- End of item -->



</div>
<!-- users -->
<div id="users" data-tab-content>
<nav class="navbar navbar-light justify-content-between">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" onkeyup="showUsers(this.value)">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<div id="asearch" class="ml-3 p-1 pl-2" style="width:22%; text-align:left; color:black;"></div>

<hr>

<table class="table">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Role</th>
      <th scope="col">Change Role</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    require('connection.php');
    $sql = "SELECT * from users";
    $users = $db->query($sql);

    foreach($users as $user){
      $userID = $user['uid'];
      $fname = $user['Fname'];
      $lname = $user['Lname'];
      $role = $user['type'];

      echo("
      <tr id='$fname'>
        <th scope='row'>".$userID."</th>
        <td>".$fname."</td>
        <td>".$lname."</td>
        <td>".$role."</td>
          <form method='POST' action='adminControl.php'>
        <td><div class='input-group mb-3'>
          <div class='input-group-prepend'>
            <label class='input-group-text' for='inputGroupSelect01'>Change</label>
          </div>
          <select name='new-role' class='custom-select' id='inputGroupSelect01'>
          ");
          if($role == 'customer'){
            echo("<option value='customer' selected>customer</option>
            <option value='staff'>staff</option>
            <option value='Admin'>Admin</option>");
          }
          else if($role == 'staff'){
            echo("<option value='customer'>customer</option>
            <option value='staff' selected>staff</option>
            <option value='Admin'>Admin</option>");
          }
          else if($role == 'Admin'){
            echo("<option value='customer'>customer</option>
            <option value='staff'>staff</option>
            <option value='Admin' selected>Admin</option>");
          }
          else{
          echo("<option value='customer'>customer</option>
            <option value='staff'>staff</option>
            <option value='Admin'>Admin</option>");
          }

            echo("
          </select>
            </div></td>
        <input type='hidden' id='user-id' name='user-id' value=".$userID.">
        <input type='hidden' id='operation' name='operation' value='changeRole'>
        <td><input type='submit' class='btn btn-outline-primary' value='update'></td>
          </form>
      </tr>
  ");
    }

     $db =null;
?>
  </tbody>
</table>

</div>
</div>
</div>
<div class="exspace">
</div>

<footer class="bg-white text-center">
          <p>Copyright &copy; <a href="#">Palmetto</a>, All Right Reserved.</p>
  </footer>

     <!-- JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
     <script src="javascripts.js"></script>
     <script>
     // search bar in Menu
     var inp=false;
     function showUsers(str) {
       var myexp=/^[a-zA-Z][a-zA-Z' ']{1,49}$/;
       if (!myexp.test(str) ){
           return;
         }
       else{
           if (str.length==0) {
             document.getElementById("asearch").innerHTML="";
             document.getElementById("asearch").style.border="0px";
             return;
           }

           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function() {
             if (this.readyState==4 && this.status==200) {
               document.getElementById("asearch").innerHTML=this.responseText;
               document.getElementById("asearch").style.border="1px solid rgb(66, 148, 215)";
               document.getElementById("asearch").style.borderRadius="4px";
             }
           }
           xmlhttp.open("GET","Adminsearch.php?q="+str,true);
           xmlhttp.send();
         }

     }
     </script>
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
             document.getElementById("dsearch").innerHTML="";
             document.getElementById("dsearch").style.border="0px";
             return;
           }

           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function() {
             if (this.readyState==4 && this.status==200) {
               document.getElementById("dsearch").innerHTML=this.responseText;
               document.getElementById("dsearch").style.border="1px solid rgb(66, 148, 215)";
               document.getElementById("dsearch").style.borderRadius="4px";
             }
           }
           xmlhttp.open("GET","AdminDSearch.php?q="+str,true);
           xmlhttp.send();
         }

     }
     </script>
  </body>
</html>
