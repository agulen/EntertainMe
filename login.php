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
  $salt_stmt = $dbconn->prepare('SELECT salt FROM users_login WHERE username=:username');
  $salt_stmt->execute(array(':username' => $_POST['username']));
  $res = $salt_stmt->fetch();
  $salt = ($res) ? $res['salt'] : '';
  $salted = hash('sha256', $salt . $_POST['pass']);


  
  $login_stmt = $dbconn->prepare('SELECT username, uid FROM users_secure WHERE username=:username AND pass=:pass');
  $login_stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted));
  
  
  if ($user = $login_stmt->fetch()) {
    $_SESSION['username'] = $user['username'];
  }
  else {
    $err = 'Incorrect username or password.';
  }
}

// Logout
if (isset($_SESSION['username']) && isset($_POST['logout']) && $_POST['logout'] == 'Logout') {
  // Unset the keys from the superglobal
  unset($_SESSION['username']);
  // Destroy the session cookie for this session
  setcookie(session_name(), '', time() - 72000);
  // Destroy the session data store
  session_destroy();
  $err = 'You have been logged out.';
}


?>

<!doctype html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<?php if (isset($_SESSION['username'])): ?>
  	<h1>Welcome, <?php echo htmlentities($_SESSION['username']) ?></h1>
  	<form method="post" action="login.php">
    	<input name="logout" type="submit" value="Log out" />
  	</form>
  	<?php else: ?>
  	<h1>Login</h1>
  	<?php if (isset($err)) echo "<p>$err</p>" ?>
  	<form method="post" action="login.php">
    	<label for="username">Username: </label><input type="text" name="username" /></br>
    	<label for="pass">Password: </label><input type="password" name="pass" /></br>
    	
    	<input name="login" type="submit" value="Log in" />
  		<input name="signup" type="submit" value="Sign up" />
  	</form>
  <?php endif; ?>
</body>
</html>
