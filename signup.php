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
  
// vaidate admin
    // $is_admin = $dbconn->prepare('SELECT is_admin FROM users_auth WHERE username=:username AND is_admin=1');   
    // $is_admin->execute(array(':username' => $_SESSION['username']));
    // $user = $is_admin->fetch();
    if (isset($_POST['quit']) && $_POST['quit']=='Cancel') {
      header('Location: login.php');
      exit();
    }



    /*if ($_SESSION['is_admin'] != true) {
      header('Location: login.php');
      exit();
    } else {*/

      if (isset($_POST['signup']) && $_POST['signup'] == 'Sign up') {
        
        // @TODO: Check to see if duplicate usernames exist
        
        if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
          $msg = "Please fill in all form fields.";
        }
        else if ($_POST['pass'] !== $_POST['passconfirm']) {
          $msg = "Passwords must match.";
        }
        else {
          // Generate random salt
          $salt = hash('sha256', uniqid(mt_rand(), true));      

          // Apply salt before hashing
          $salted = hash('sha256', $salt . $_POST['pass']);
   	  
          $is_admin = ($_POST['isadmin'] == "true" ? true : false);

          // Store the salt with the password, so we can apply it again and check the result
          $stmt = $dbconn->prepare("INSERT INTO users (username, email, pass, salt, is_admin) 
                              VALUES (:username, :email, :pass, :salt, :isadmin)");
          $stmt->execute(array(':username' => $_POST['username'],
          					   ':email' => $_POST['email'],
                               ':pass' => $salted, 
                               ':salt' => $salt,
                               ':isadmin'=> $is_admin
                                ));
          $msg = "Account created.";
        }
      }
    //}
?>

<!doctype html>
<html>
<head>
	<title>Sign up</title>
</head>
<body>
	<h1>Sign up</h1>
	<?php if (isset($msg)) echo "<p>$msg</p>" ?>
  	<form method="post" action="signup.php">
    	<label for="username">Username: </label><input type="text" name="username" /></br>
    	<label for="email">E-mail: </label><input type="text" name="email" /></br>
    	<label for="pass">Password: </label><input type="password" name="pass" /><br>
    	<label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" /></br>
    	<label for="setadmin">Admin?: </label><input type="radio" name="isadmin" value="true" />Yes
                                          <input type="radio" name="isadmin" value="false" />No</br>
    	<input type="submit" name="register" value="Sign up" />

  		<form method="post" action="login.php">
    		<input name="quit" type="submit" value="Cancel" />
  		</form>
  	</form>
</body>
</html>
