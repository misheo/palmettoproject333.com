<!DOCTYPE html>
<?php session_start();
  if (!isset($_SESSION['customer'])){
  header('Location:index.php');}
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
    <!---PHP CODE FOR EDIT USER PROFILE------>
    <?php
       if (isset($_POST['ebtn'])){
         $f = $_POST['f'];
         $l = $_POST['l'];
         $n = $_POST['n'];
         $pass = $_POST['pass'];
         $p = $_POST['p'];
         $hps = password_hash($pass, PASSWORD_DEFAULT);
         try {
           require('connection.php');
           $sql = "UPDATE users SET Fname ='$f', Lname='$l', username='$n'
           , password='$hps', phone ='$p', type='customer'
           WHERE username='$n'";
           $rs = $db->exec($sql);
         } catch (PDOException $e) {
           die("Error Mesaage: ".$e->getmessage());
         }

       }
     ?>

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
<div>
<div class="jumbotron-fluid page-header d-block w-100">
  <img class="d-block w-100"src="images\header.jpg" alt="" >
  <div class="centered-header"><h2>Edit User Profile</h2></div>
</div>
<div class="edit">
  <div class="mycard">
    <div class="row">
      <div class="col-md-6">
        <div class="myleftscr">
          <form class="myForm-text-center" action="editprofile.html" method="post">
            <h3>User Profile</h3>
            <?php
               try {
                 require('connection.php');
                 $current = $_SESSION['customer'];
                 $sql = "SELECT * FROM users WHERE uid = '$current'";
                 $rs = $db->query($sql);
                   while($row=$rs->fetch()){
                     echo "<header>".$row[1]." ".$row[2]."</header>";
                     echo "<header>".$row[3]."</header>";
                     echo "<header>".$row[5]."</header>";
                     $cname = $row[1];
                     $clname = $row[2];
                     $cus = $row[3];
                     $cphone = $row[5];
                     $ppp = $row[4];
                 }

               } catch (PDOException $e) {
                 die("Error Message: ".$e->getmessage());
               }
             ?>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="myrightscr">
          <form class="myForm-text-center" action="EditUserProfile.php" method="post">
            <h3>Edit User Profile</h3>
            <div class="form-group">
              <i class="fasfa-user"></i>
              <input type="text" class="myInput" name="f" placeholder="First Name" value="<?php echo $cname; ?>">
            </div>
            <div class="form-group">
              <i class="fas fa-evelope"></i>
              <input type="text" class="myInput" name="l" placeholder="Last Name" value="<?php echo $clname; ?>">
            </div>
            <div class="form-group">
              <i class="fas fa-evelope"></i>
              <input type="text" class="myInput" name="n" placeholder="User Name" value="<?php echo $cus; ?>">
            </div>
            <div class="form-group">
              <i class="fas fa-evelope"></i>
              <input type="password" class="myInput" name="pass" placeholder="Password" value="<?php echo $ppp; ?>">
            </div>
            <div class="form-group">
              <i class="fas fa-evelope"></i>
              <input type="text" class="myInput" name="p" placeholder="Phone Number" value="<?php echo $cphone; ?>">
            </div>
            <button type="submit" name="ebtn" class="submit-btn">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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
