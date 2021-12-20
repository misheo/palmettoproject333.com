<!DOCTYPE html>
<?php session_start(); ?>
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
    <style media="screen">
    /********js*********/
    :root{
      --success-color: #30d275;
      --error-color: #e74c3c;
    }
    .form-group.success input {
      border-color: var(--success-color);
    }

    .form-group.error input {
      border-color: var(--error-color);
    }

    .form-group small {
      color: var(--error-color);
      position: absolute;
      bottom: 0;
      left: 0;
      visibility: hidden;
    }
    .form-group.error small {
      visibility: visible;
    }
    .myrightscr{
      position: relative;
      background-image: linear-gradient(45deg, #c98fa6, #d7b1cb);
      border-radius: 25px;
      height: 100%;
      padding: 50px;
      color: rgb(192,192,192);
      font-size: 12px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
    }
    </style>
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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="About.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    </div>
    </nav>

<!-- page header -->
<div class="jumbotron-fluid staff-header d-block w-100">
  <img class="d-block w-100"src="images\header.jpg" alt="" >
  <div class="centered-header"><h2>Sing In</h2></div>
</div>

<!---SIGN IN--->
<?php
if (isset($_POST['signbtn'])){
 $us = $_POST['us'];
 $ps = $_POST['ps'];
 //inputs validation..
 $uspattern= "/^[a-zA-Z][0-9_.-]{6,15}$/";
 $pspattern= "/^[a-zA-Z0-9_.-@]{6,15}$/";
 try {
   require('connection.php');
  if (preg_match($uspattern, $us) && preg_match($pspattern, $ps)){
  $sql = "SELECT * FROM users WHERE username ='$us'";
  $rs = $db->query($sql);
  if ($row=$rs->fetch()){
      extract($row);
      if(password_verify($ps,$password)){
        if ($type =='Staff'){
          $_SESSION['staff'] = $uid;
          header('location:orders.php');
        }
        if ($type == 'Admin'){
          $_SESSION['admin'] = $uid;
          echo "string";
         header('location:admin.php');
      }
        if ($type =='customer'){
          $_SESSION['customer'] = $uid;
          header('location:menu.php');
       }
      }
    }
  }
  else {echo "Your inputs are not match the format";}
  }
catch (PDOException $e) {
  die("Error Message: ".$e->getmessage());
}
$db=null;
}
 ?>
 <!---SIGN UP--->
 <?php
    if(isset($_POST['rbtn'])){
      $fn = $_POST['fn'];
      $ln = $_POST['ln'];
      $u = $_POST['u'];
      $p = $_POST['p'];
      $pn = $_POST['pn'];
      //inputs validation...
      $fnpattern = "/^[a-zA-Z]{3,20}$/";
      $lnpattern = "/^[a-zA-Z]{3,20}$/";
      $upattern = "/^[a-zA-Z][0-9_.-]{6,15}$/";
      $pspattern = "/^[a-zA-Z0-9_.-@]{6,15}$/";
      $pnpattern = "/^((\+||00)973)?[36][0-9]{7}$/";
      try {
        require('connection.php');
        $hps = password_hash($p, PASSWORD_DEFAULT);
        if (preg_match($fnpattern, $fn) && preg_match($lnpattern, $ln) && preg_match($upattern, $u) && preg_match($pspattern, $p) && preg_match($pnpattern, $pn)){
        $sql = "INSERT INTO users VALUES(NULL, '$fn','$ln','$u','$hps','$pn', 'customer')";
        $rs = $db->exec($sql);
      }
      else {
        echo "Data not match the format.";
      }
        if ($rs>0){
          header("index.php");
          die();
        }
      } catch (PDOException $e) {
        if ($db->errorCode()==23000)
        echo "Failed, username already taken, try another username";
        else
        die("Error Message: ".$e->getmessage());
      }
      $db = null;

    }
  ?>

<div class="sign">
  <div class="mycard">
    <div class="row myrow">
      <div class="col-md-6">
        <div class="myleftscr">
          <form class="myForm-text-center" id="SignInForm" method="post">
            <h3>Sign In</h3>
            <div class="form-group">
              <input type="hidden" class="myInput" name="uid">
            </div>
            <div class="form-group">
              <input type="text" class="myInput" id="us" name="us" placeholder="User Name"/>
              <small>Error message</small>
            </div>
            <div class="form-group">
              <input type="password" class="myInput" id="ps" name="ps" placeholder="Password"/>
              <small>Error message</small>
            </div>
              <button type="submit" name="signbtn" class="submit-btn">Log In</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="myrightscr">
          <form class="myForm-text-center" id="SignUpForm" method="post">
            <h3>Sign Up</h3>
            <div class="form-group">
              <input type="text" class="myInput" name="fn" id="fn" placeholder="First Name"/>
              <small>Error message</small>
            </div>
            <div class="form-group">
              <input type="text" class="myInput" name="ln" id="ln" placeholder="Last Name"/>
              <small>Error message</small>
            </div>
            <div class="form-group">
              <input type="text" class="myInput" name="u" id="u" placeholder="User Name"/>
              <small>Error message</small>
            </div>
            <div class="form-group">
              <input type="password" class="myInput" name="p" id="p" placeholder="Password"/>
              <small>Error message</small>
            </div>
            <div class="form-group">
              <input type="text" class="myInput" name="pn" id="pn" placeholder="Phone Number"/>
              <small>Error message</small>
           </div>
            <button type="submit" name="rbtn" class="submit-btn">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
     <!-- JavaScript -->
     <script src="javascripts.js">
     // VALIDATION FOR SIGN IN / SIGN UP FORMS
     const form1 = document.getElementById('SignInForm');
     const form1Us = document.getElementById('us');
     const form1Ps = document.getElementById('ps');
     const form2 = document.getElementById('fn');
     const form2 = document.getElementById('ln');
     const form2 = document.getElementById('u');
     const form2 = document.getElementById('p');
     const form2 = document.getElementById('pn');

     function showError(input, message) {
       const formGroup = input.parentElement;
       formGroup.className = 'form-group error';
       const small = formGroup.querySelector('small');
       small.innerText = message;
     }
     function showSuccess(input) {
       const formGroup = input.parentElement;
       formGroup.className = 'form-group success';
     }

     function checkRequired(inputArr) {
       let error=0;
       inputArr.forEach(function(input) {
         if (input.value.trim() === '') {
           showError(input, `${getFieldName(input)} is required`);
           ++error;
         } else {
           showSuccess(input);
         }
       });
       return error;
     }
     function checkLength(input, min, max) {
  let error=0;
  if (input.value.length < min) {
    showError(
      input,
      `${getFieldName(input)} must be at least ${min} characters`
    );
    ++error;
  } else if (input.value.length > max) {
    showError(
      input,
      `${getFieldName(input)} must be less than ${max} characters`
    );
    ++error;
  } else {
    showSuccess(input);
  }
  return error;
}
     function getFieldName(input) {
     return input.id.charAt(0).toUpperCase() + input.id.slice(1);
   }
     form1.addEventListener('submit', function(e) {
       e.preventDefault(); //prevents auto submit
       let allErrors = 0;
       allErrors+=checkRequired([us, ps]);
       allErrors+=checkLength(us, 6, 15);
       allErrors+=checkLength(ps, 6, 15);
       //If all requirements are successful, submit the form
       if (allErrors===0)
           form1.submit();
     });
     form2.addEventListener('submit', function(e) {
       e.preventDefault(); //prevents auto submit
       let allErrors = 0;
       allErrors+=checkRequired([fn,ln,u,p,pn]);
       allErrors+=checkLength(fn, 3, 20);
       allErrors+=checkLength(ln, 3, 20);
       allErrors+=checkLength(u, 6, 15);
       allErrors+=checkLength(p, 6, 15);
       allErrors+=checkLength(pn, 8,8);
       //If all requirements are successful, submit the form
       if (allErrors===0)
           form2.submit();
     });
   </script>
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  </body>
  <footer class="bg-white text-center">
            <p>Copyright &copy; <a href="#">Palmetto</a>, All Right Reserved.</p>
    </footer>
</html>
