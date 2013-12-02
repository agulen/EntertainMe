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
  

  if (isset($_POST['quit']) && $_POST['quit']=='Cancel') {
    header('Location: index.php');
    exit();
  }
  if (isset($_POST['signup']) && $_POST['signup'] == 'Signup') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['pass'] !== $_POST['passconfirm']) {
      $msg = "Passwords must match.";
    }    
    else {
      //Check for duplicate usernames
      $stmt = $dbconn->prepare("SELECT COUNT(*) FROM userlogin WHERE username=:username");
      $stmt->execute(array(':username' => $_POST['username']));
      $result = $stmt->fetch();     

      if ($result['COUNT(*)'] > 0) 
      {
        $msg = "Username exists already.";
      }
      else
      {
	      // Generate random salt
	      $salt = hash('sha256', uniqid(mt_rand(), true));      

	      // Apply salt before hashing
	      $salted = hash('sha256', $salt . $_POST['pass']);
	         
	      //$is_admin = ($_POST['isadmin'] == "true" ? true : false);

	      // Store the salt with the password, so we can apply it again and check the result
	      $stmt = $dbconn->prepare("INSERT INTO userlogin (username, password, salt, is_admin) 
	                          VALUES (:username, :pass, :salt, :isadmin)");
	      $stmt->execute(array(':username' => $_POST['username'],
	                           ':pass' => $salted, 
	                           ':salt' => $salt,
	                           ':isadmin'=> 0));
	      $msg = "Account created. Logging in...";

	      $login_stmt = $dbconn->prepare('SELECT username/*, is_admin*/ FROM userlogin WHERE username=:username AND password=:pass');
	      $login_stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted));
	      $user = $login_stmt->fetch();
        
        if($user){
          $_SESSION['username'] = $user['username'];
          $_SESSION['is_admin'] = $user['is_admin'];
          
          ob_start();
          while (ob_get_status()) 
          {
            ob_end_clean();
          }
          header( "refresh:2, url=now.php" );
        } else{
          $err = 'Error with account creation. Couldn\'t log in';
        }
  	  }
    }
  }
?>

<!doctype html>
<html>
  <head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="all">
      <div class="logo">
        <img src="http://i.minus.com/iI7WTHovllxD1.png" alt="logo" width="400px" height="auto">
      </div>
      <div id="navigation">
        <div id="mainbar">     
        </div>
      </div>
      <div id="main">
          <h1>Sign up</h1>
          <?php if (isset($msg)) : echo $msg.'<br/>';
                endif; ?>
            <form method="post" action="signup.php">
              <label for="username">Username: </label><input type="text" name="username" /></br>
              <label for="pass">Password: </label><input type="password" name="pass" /><br>
              <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" /></br>
             <!-- <label for="setadmin">Admin?: </label>
              <input type="radio" name="isadmin" value="true" />Yes
              <input type="radio" name="isadmin" value="false" />No</br>-->
              <input type="submit" name="signup" value="Signup" />
              <form method="post" action="login.php">
                <input name="quit" type="submit" value="Cancel" />
              </form>
            </form>
      </div>
      <div id="footer">
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </div>
    </div>
  </body>
</html>
