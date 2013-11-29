<?php

session_start();

if (isset($_POST['send']) && $_POST['send'] == 'Send') {
  if ((!isset($_POST['cf_name'])) || (!isset($_POST['cf_email'])) || (!isset($_POST['cf_message']))) {
    $msg = "Please fill in all form fields.";
  } else {
    $field_name = $_POST['cf_name'];
    $field_email = $_POST['cf_email'];
    $field_message = $_POST['cf_message'];

    $mail_to = 'contact@testmail.com';
    $subject = 'Message from a site visitor '.$field_name;

    $body_message = 'From: '.$field_name."\n";
    $body_message .= 'E-mail: '.$field_email."\n";
    $body_message .= 'Message: '.$field_message;

    $headers = 'From: '.$field_email."\r\n";
    $headers .= 'Reply-To: '.$field_email."\r\n";

    $mail_status = mail($mail_to, $subject, $body_message, $headers);

    if ($mail_status) {
      $msg = 'Thank you for the message. We will contact you shortly.';
    }
    else {
      $msg = 'Message failed. Please, send an email to help@testmail.com';
    }
  }
}

if (isset($_POST['clear']) && $_POST['clear']=='Clear') {
    header('Location: contact.php');
    exit();
  }

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
          <?php if (isset($msg)) : echo $msg.'<br/>';
                endif; ?>
            <form action="contact.php" method="post">
              <label for="name">Your name: </label><input type="text" name="cf_name" /><br>
              <label for="email">Your e-mail: </label><input type="text" name="cf_email" /><br>
              <label for="message">Message: </label><textarea name="cf_message" rows="5" cols="25" /></textarea><br/>
              <input type="submit" name="send" value="Send">
              <input type="submit" name="clear" value="Clear">
            </form>
        </div>

        <div id="footer">
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </div>

      </div>
   

  </body>
</html>
