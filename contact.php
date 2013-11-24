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
  	<div id="all">
      <div class="logo">
        <a href="index.php">
          <img src="http://www.qmix.com/dev/wp-content/uploads/2013/09/how-to-write-a-Movie-Review-300x300.jpg" alt="logo" width="200" height="200">
        </a>
      </div>
      <div id="navigation">
        <div id="mainbar">     
        </div>
      </div>
      <div id="main">
        <h1>Contact</h1>
  	  	<form action="contact.php" method="post">
          Your name: <input type="text" name="cf_name" placeholder="Your name"/><br>
          Your e-mail: <input type="text" name="cf_email" placeholder="Your e-mail"/><br>
          Message: <textarea name="cf_message" rows="5" cols="25" placeholder="Message"></textarea><br/>
          <input type="submit" value="Send">
  		    <input type="submit" value="Clear">
  		  </form>
	     </div>
	 </div>
   <div id="footer">
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
    </div>

  </body>
</html>
