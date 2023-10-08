<?php 
require('connection.php'); 
  session_start();
  if(isset($_COOKIE['email_username']) && isset($_COOKIE['password'])){
    $id=$_COOKIE['email_username'];
    $pass=$_COOKIE['password'];
  }
  else {
    $id="";
    $pass="";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HF-ORDER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Konkhmer+Sleokchher&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../website.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">

</head>

<body>
    <div class="body1">
        <img href="index.html" src="../logo.png" id="logo">
        <div class="top"><a href="../index.html" style="color:white" target="_blank"><h1 class="mainhead">Home</h1></a></div>
        <div class="top"><a href="../menu.html" style="color:white" target="_blank"><h1 class="mainhead">Menu</h1></a></div>
        <div class="top"><a href="" style="color:white" target="_blank"><h1 class="mainhead">Location</h1></a></div>
        <div class="top"><a href="" style="color:white" target="_blank"><h1 class="mainhead">About us</h1></a></div>

    </div>

    <div class= "icon">
        <a  href="cart.html" style="color:white" target="blank" ><i class="fa fa-shopping-cart"></i><span></span></a>
        
     </div>
<!-- 
    <div class= "icon2">
    <a href="./loginSystem/login_register.php" id="user-btn"><i class="fa fa-user"></i></a>
    </div> -->

    
    <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
    {
       echo"
       <div class='user'>
       $_SESSION[username] - <a href='logout.php' class='logoutbtn'>LOGOUT</a>
       </div>
      ";
    }
    else
    {
      echo"
        <div class='top'>
         <button type='button' class='mainhead' onclick=\"popup('login-popup')\">LOGIN</button>
         </br>
         <button type='button' class='mainhead' onclick=\"popup('register-popup')\">REGISTER</button>
        </div>
      ";
    }
    ?>
  </header>

  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="E-mail or Username" name="email_username" value="<?php echo $id ?>">
        <input type="password" placeholder="Password" name="password" value="<?php echo $pass ?>">
        <label>
          <input type="checkbox" name="remember_me"> Remember me
        </label>
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
      <div class="forgot-btn" onclick="forgotPopup()">
          <button type="button">Forgot Password?</button>
      </div>
    </div>
  </div>

  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="login_register.php">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input type="text" placeholder="Full Name" name="fullname">
        <input type="text" placeholder="Username" name="username">
        <input type="email" placeholder="E-mail" name="email">
        <input type="password" placeholder="Password" name="password">
        <!-- /////////////////////////////////////// -->
            <div class="g-recaptcha" data-sitekey="6LdPzLggAAAAACaL9y3OrBUQb0cbc_NxMgAUPoOC"></div>
            <br/>
        <!-- /////////////////////////////////////// -->
        <button type="submit" class="register-btn" name="register">REGISTER</button>
      </form>
    </div>
  </div>

  <div class="popup-container" id="forgot-popup">
        <div class="forgot popup">
            <form method = "POST" action="forgotpassword.php">
                <h2>
                    <span>RESET PASSWORD</span>
                    <button type="reset" onclick="popup('forgot-popup')">X</button>
                </h2>
                <input type="email" placeholder="E-mail" name="email">
                <button type="submit" class="reset-btn" name="send-reset-link">SEND LINK</button>
            </form>
        </div>
    </div>
 
  <!-- after logged in this appears on screen  -->
  <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
    {
      echo"<h1 style='text-align:center; margin-top: 20%; color:#30475e;'> WELCOME - $_SESSION[username]!</h1>";
    }
  ?>

  <script>
    function popup(popup_name)
    {
      get_popup=document.getElementById(popup_name);
      if(get_popup.style.display=="flex")
      {
        get_popup.style.display="none";
      }
      else
      {
        get_popup.style.display="flex";
      }
    }

    function forgotPopup(){
            document.getElementById('login-popup').style.display="none";
            document.getElementById('forgot-popup').style.display="flex";

        }
  </script>

  <script type="text/javascript">
      var onloadCallback = function() {
      // alert("grecaptcha is ready!");
      };
  </script>
    <!-- <footer class="footer"> created by <span> HF-ORDER </span> | all rights reserved! </footer> -->

    <script src="../js/script.js"></script>

</body>
</html>
