<?php session_start();
 /*if (!isset($_SESSION['customer']))
 header('Location: sign.php');*/?>
 <!DOCTYPE html>
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
     <nav class="navbar navbar-expand-lg navbar-light ">
       <a class="navbar-brand">PALMETTO</a>
     </nav>



  <!-- cart details-->

   <?php
   if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
     ?>
     <div class="container">
       <div class="card text-center" width="100%" style="border:0;">
         <h3>Your cart is empty!</h3>
         <a href="menu.php"><button class="btn btn-light" type="button" name="button">Discover our menu</button> </a>
       </div>
     </div>
     <?php
     die();
   }
   else{
   try{
     require('connection.php');
   ?>
             <div class="container">
                  <h3 align="center">Your Shopping Cart</h3><br/>
                  <br />
                  <h5 align="center">Order Details</h5>
                  <br>
                  <div class="table-responsive" align="center" style="width:100%;">
                       <table style="text-align:center;" width="90%">
                            <tr>
                                 <th class='itempiccart' width="23%">Item</th>
                                 <th width="27%">Dish</th>
                                 <th width="18%">Quantity</th>
                                 <th width="20%">Price</th>
                                 <th width="10%">Action</th>
                            </tr>
                        <form method='post' action='CartCheckout.php'>
                  <?php
                  $total=0;
                  foreach($_SESSION['cart'] as $itemID=>$squantity){
                  $sql = "SELECT * FROM menu WHERE itemID = $itemID";
                    $details = $db->query($sql);
                    if ($products=$details->fetch(PDO::FETCH_ASSOC)){
                        extract($products);
                        echo "<tr>";
                        echo "<td > <img class='cartpic p-2' src=".$picture." width='100' height='100' /></td>";
                        echo "<td>".$name."</td>";
                        echo "<td>";
                        echo "<input type='number' name='q[]' value=".$squantity." min='0' max='100'>";
                        echo "</td>";
                        echo "<td>".floatval($price)."</td>";
                        echo "<input type='hidden' name='itemID[]' value=".$itemID." />";
                        echo "<td><a href='RemoveFromCart.php?itemID=$itemID'>Remove</a></td></tr>";
                        $total+= ($price * $squantity);
                      }

                  }
                  ?>
                </table>
                <hr>
                <table width="80%">
                  <tr>
                    <th style="text-align: left; padding-left:1rem;">Subtotal</th><td></td><td></td> <th><?php echo floatval($total); ?></th>
                  </tr>
                  <tr>
                    <th style="text-align: left; padding-left:1rem;">Delivery</th><td></td><td></td> <th>1.000</th>
                  </tr>
                  <tr>
                    <th style="text-align: left; padding-left:1rem;">Total</th><td></td><td></td> <th><?php echo floatval($total+=1.000); ?></th>
                  </tr>
                  <input type="hidden" name="totalp" value="<?php echo $total; ?>">
                  </tr>
                </table>
                <br><br>
                <input class='btn cartbtns' type='submit' name='checkout' value='Checkout' style="background: rgba(134, 101, 101, 0.95); color:white;"/>
                <input class='btn cartbtns' type='submit' name='cartsbtn' value='Update Cart' style="background: rgba(134, 101, 101, 0.95); color:white;" />
              </form>
              </div></div>
                  <?php


}catch(PDOException $e){
  echo $e->getMessage();
}}
   ?>

<div class="exspace">

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
