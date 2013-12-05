<?php
//bring in the login functionality to the homepage
require 'login.php';
?>


<!doctype html>
<html>
  <head>
    <title>Login</title>
    <link href='login.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="all">
      <div id="navigation">
        <div id="mainbar"> <!--placeholder for the nav bar at top to keep styling synonymous-->
        </div>
      </div>
      <div class="logo">
        <img src="http://i.minus.com/iI7WTHovllxD1.png" alt="logo" width="400px" height="auto" >
      </div>

      <br><div align="center">EntertainMe. Now, and Later.</div>
      
      <div id="main">
      <?php if (isset($_SESSION['username'])): //if the user is already logged in, redirect to the user's lists
                header('Location: now.php');
                exit();
             ?>
      <?php else : ?>
        <h1>Login</h1>
        <?php if (isset($err)) echo $err."<br/>"; ?>
        <form method="post" action="index.php">
          <label for="username">Username: </label><input type="text" name="username" /></br>
          <label for="pass">Password: </label><input type="password" name="pass" /></br>
          
          <input name="login" type="submit" value="Login" />
          <input name="signup" type="submit" value="Signup" />
        </form>
      <?php endif; ?>
      </div>
      <div id="footer">
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </div>
    </div>
  </body>
</html>
