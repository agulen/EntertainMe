<?php
session_start();

// Connect to the database
try {
  $dbname = 'entertainme';
  $user = 'root';
  $pass = '';
  $dbconn = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
}
catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

// Check login
if (isset($_POST['login']) && $_POST['login'] == 'Login') {
  $salt_stmt = $dbconn->prepare('SELECT salt FROM userlogin WHERE username=:username');
  $salt_stmt->execute(array(':username' => $_POST['username']));
  $res = $salt_stmt->fetch();
  $salt = ($res) ? $res['salt'] : '';
  $salted = hash('sha256', $salt . $_POST['pass']);


  
  $login_stmt = $dbconn->prepare('SELECT username, is_admin FROM userlogin WHERE username=:username AND password=:pass');
  $login_stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted));

  if ($user = $login_stmt->fetch()) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'];

    if ($user['is_admin']==true) {
      header('Location: admin.php');
      exit();
    }
  }
  else {
    $err = 'Incorrect username or password.';
  }
}

// Logout
/*if (isset($_SESSION['username']) && isset($_POST['logout']) && $_POST['logout'] == 'Logout') {
  // Unset the keys from the superglobal
  unset($_SESSION['username']);
  // Destroy the session cookie for this session
  setcookie(session_name(), '', time() - 72000);
  // Destroy the session data store
  session_destroy();
  $err = 'You have been logged out.';
}*/

if (isset($_POST['signup']) && $_POST['signup'] == 'Signup') {
  header('Location: signup.php');
  exit();
}


?>

<!doctype html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="all">
    <div class="logo">
      Logo area.
    </div>
    <div id="navigation">
      <div id="mainbar">     
      </div>
    </div>
    <div id="main">
      <?php if (isset($_SESSION['username'])):
              header('Location: now.html');
              exit();
           ?>
      <?php else : ?>
      <h1>Login</h1>
      <?php if (isset($err)) echo "<p>$err</p>" ?>
      <form method="post" action="login.php">
        <label for="username">Username: </label><input type="text" name="username" /></br>
        <label for="pass">Password: </label><input type="password" name="pass" /></br>
        
        <input name="login" type="submit" value="Login" />
        <input name="signup" type="submit" value="Signup" />
      </form>
      <?php endif; ?>
      </div>
    </div>
    <div id="footer">
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </div>
  </body>
</html>
