<?php




?>


<!doctype html>
<html>
  <head>
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
      <div id="navigation">
        <div id="mainbar">     
        </div>
      </div>
      <div id="all">

        <div class="logo">
          <a href="index.php">
            <img src="http://i.minus.com/iI7WTHovllxD1.png" alt="logo" width="400px" height="auto">
          </a>
        </div>
        
        <div id="main">
          <h1>Contact</h1>
            <form action="contact.php" method="post">
              <label for="name">Your name: </label><input type="text" name="cf_name" /><br>
              <label for="email">Your e-mail: </label><input type="text" name="cf_email" /><br>
              <label for="message">Message: </label><textarea name="cf_message" rows="5" cols="25" /></textarea><br/>
              <input type="submit" value="Send">
              <input type="submit" value="Clear">
            </form>
        </div>

        <div id="footer">
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </div>

      </div>
   

  </body>
</html>
