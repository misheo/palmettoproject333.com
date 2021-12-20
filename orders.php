<?php
session_start();
if(!isset($_SESSION['staff'])){
  header('Location:index.php');
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
    <nav class="navbar navbar-expand-lg navbar-light fixed-top ApageNav">
        <!--<a class="navbar-brand" href="#"><img src="images/Palmetto_Logo.jpg" height="40" alt="Palmetto"></a>-->
        <a href="#" class="navbar-brand">PALMETTO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="orders.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- page header -->
    <div class="jumbotron-fluid staff-header d-block w-100">
        <img class="d-block w-100" src="images\header.jpg" alt="">
        <div class="centered-header">
            <h2>Orders</h2>
        </div>
    </div>


  <!--cards-->
    <div class="cards">
    <?php
// Dispay all orders with details orderd by the orderTime
// Order status can be changed in the database through selecting option and click on update button
    try {
      require ('connection.php');
      $new = $db->query("SELECT * FROM orders ORDER BY orderTime DESC");
      echo "<form class='' action='changestatus.php?' method='post'>";
      while ($data = $new ->fetch(PDO::FETCH_ASSOC)) {
        extract($data);
          ?>
          <div class="container">
          <ul id="list"><li>
        <div class="card d-block p-1" name="carcol" id="statuscol">
             <details>
               <summary>
               <table class="ordertable" style="width:100%;">
                 <tr><th><b>Order No.</b></th><th><b>Customer ID</b></th><th><b>Phone No.</b></th><th><b>Time</b></th> <th><b>Total</b></th><th><b>Status</b></th> </tr>
              <?php
                $cust = $db->query("SELECT * FROM users WHERE uid = $cid")->fetch(PDO::FETCH_ASSOC);
                extract($cust);
               echo" <tr><td>".$oid."</td><td>".$cid."</td> <td>".$phone."</td><td>".$orderTime."</td><td>".$total."</td><td>";
               $stat = array('Unconfirmed','Processing','Delivering', 'Completed');

               echo "<input type='hidden' name='orderid[]' value='$oid'>";
               if ($status == "Completed") {
                 ?>
                 <div class="comp">
                   <?php
                   echo "<select class='custom-select changestatus st' name='soption[]' id='status'>";
                  for($i=0;$i<4;++$i){
                   echo "<option ";
                   if ($stat[$i] == $status) echo "selected";
                   echo ">$stat[$i]</option>";
                 }
                 echo "</select>";
                  echo "</td>";
                    ?>
                 </div>
                 <?php
               }
                 else   if ($status == "Delivering") {
                     ?>
                     <div class="deli">
                       <?php
                       echo "<select class='custom-select changestatus st' name='soption[]' id='status'>";
                      for($i=0;$i<4;++$i){
                       echo "<option ";
                       if ($stat[$i] == $status) echo "selected";
                       echo ">$stat[$i]</option>";
                     }
                     echo "</select>";
                      echo "</td>";
                        ?>
                     </div>
                     <?php
                   }
                   else  if ($status == "Processing") {
                       ?>
                       <div class="process">
                         <?php
                         echo "<select class='custom-select changestatus st' name='soption[]' id='status'>";
                        for($i=0;$i<4;++$i){
                         echo "<option ";
                         if ($stat[$i] == $status) echo "selected";
                         echo ">$stat[$i]</option>";
                       }
                       echo "</select>";
                        echo "</td>";
                          ?>
                       </div>
                       <?php
                     }
                     else{
                         ?>
                         <div class="unconf">
                           <?php
                           echo "<select class='custom-select changestatus st' name='soption[]' id='status'>";
                          for($i=0;$i<4;++$i){
                           echo "<option ";
                           if ($stat[$i] == $status) echo "selected";
                           echo ">$stat[$i]</option>";
                         }
                         echo "</select>";
                          echo "</td>";
                            ?>
                         </div>
                         <?php
                       }

                  echo"<td><input  type='submit' class='btn btn-light' name='update' value='Update'>";
                  ?>
                 </td> </tr>
                 </table>

               </summary> <hr>
                 <table class="ordertable"style="width:100%;">
                   <tr><th><b>#</b></th><th><b>Dish</b></th><th><b>quantity</b></th><th><b>price</b></th>
                     <?php
                     $details = $db->query("SELECT * FROM orderitems WHERE orderid = $oid");
                     $i=1;
                     while($d = $details->fetch(PDO::FETCH_ASSOC)) {
                       extract($d);
                        $dish = $db->query("SELECT * FROM menu WHERE itemid = $itemid")->fetch(PDO::FETCH_ASSOC);
                        extract($dish);
                         echo "<tr><td>".$i++."</td><td>".$name."</td><td>x".$quantity."</td><td>".$price."</td> </tr>";
                     }
                     echo "<tr><td>Delivery</td><td></td><td></td><td>1.000</td></tr>";
                      ?>
                 </table>
             </details>
           </li> </ul>
        </div></div>
          <?php
      }echo "</form>";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

     ?>
</div>


     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
     <script src="javascripts.js"></script>
  </body>
</html>
