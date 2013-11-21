<link rel="stylesheet" type="text/css" href="mainpages.css">

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
  
// validate admin
     /*$is_admin = $dbconn->prepare('SELECT is_admin FROM userlogin WHERE username=:username AND is_admin=1');   
     $is_admin->execute(array(':username' => $_SESSION['username']));
     $user = $is_admin->fetch();*/
    if (isset($_POST['quit']) && $_POST['quit']=='Cancel') {
      header('Location: login.php');
      exit();
    }



    /*if ($_SESSION['is_admin'] != true) {
      header('Location: login.php');
      exit();
    } else {*/

      if (isset($_POST['signup']) && $_POST['signup'] == 'Signup') {
        
        // @TODO: Check to see if duplicate usernames exist
        
        if (!isset($_POST['username']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
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
          $stmt = $dbconn->prepare("INSERT INTO userlogin (username, password, salt, is_admin, is_banned) 
                              VALUES (:username, :pass, :salt, :isadmin, :isbanned)");
          $stmt->execute(array(':username' => $_POST['username'],
                               ':pass' => $salted, 
                               ':salt' => $salt,
                               ':isadmin'=> $is_admin,
                               ':isbanned' => 0 ));
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
            <label for="pass">Password: </label><input type="password" name="pass" /><br>
            <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" /></br>
            <label for="setadmin">Admin?: </label>
            <input type="radio" name="isadmin" value="true" />Yes
            <input type="radio" name="isadmin" value="false" />No</br>
            <input type="submit" name="signup" value="Signup" />
            <form method="post" action="login.php">
              <input name="quit" type="submit" value="Cancel" />
            </form>
          </form>
</body>
</html>
