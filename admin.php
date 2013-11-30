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

  if (isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    $msg = "";
  }
  
  if (isset($_POST['register']) && $_POST['register'] == 'Register') {
    
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
      else //New user! Add to database
      {
        if (!isset($_POST['admin']) || empty($_POST['admin'])) {
          $is_admin = 0;
        }
        else {
          $is_admin = $_POST['admin'] == 'Admin';
        }
        // Generate random salt
        $salt = hash('sha256', uniqid(mt_rand(), true));      

        // Apply salt before hashing
        $salted = hash('sha256', $salt . $_POST['pass']);
        
        // Store the salt with the password, so we can apply it again and check the result
        $stmt = $dbconn->prepare("INSERT INTO userlogin (username, password, salt, is_admin) VALUES (:username, :pass, :salt, :admin)");
        $stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted, ':salt' => $salt, ':admin' => $is_admin));
        $msg = "Account created.";
      }
    }
  }

  if (isset($_POST['remove']) && $_POST['remove'] == 'Remove') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("DELETE FROM userlogin WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account removed.";
    }
  } 

    if (isset($_POST['add_item']) && $_POST['add_item'] == 'Add') {
    
    
    if (!isset($_POST['title']) || !isset($_POST['item_type']) || empty($_POST['title']) || empty($_POST['item_type']) ) {
      $msg = "Please fill in all form fields.";
    }
    else {
      $stmt = $dbconn->prepare("INSERT INTO entertainment (title, type) VALUES (:title, :type)");
      $stmt->execute(array(':title' => $_POST['title'], ':type' => $_POST['item_type']));
      $msg = "Item Added.";
    }
  } 

    if (isset($_POST['remove_item']) && $_POST['remove_item'] == 'Remove') {
    
    
    if (!isset($_POST['title']) || !isset($_POST['titleconfirm']) || empty($_POST['title']) || empty($_POST['titleconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['title'] !== $_POST['titleconfirm']) {
      $msg = "Titles must match.";
    }
    else {
      $stmt = $dbconn->prepare("DELETE FROM entertainment WHERE title = :title");
      $stmt->execute(array(':title' => $_POST['title']));
      $msg = "Item removed.";
    }
  } 

  if (isset($_POST['makeadmin']) && $_POST['makeadmin'] == 'Make Admin') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("UPDATE userlogin SET is_admin = 1 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account is now Admin User.";
    }
  } 

  if (isset($_POST['removeadmin']) && $_POST['removeadmin'] == 'Remove Admin') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("UPDATE userlogin SET is_admin = 0 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account is now User.";
    }
  } 

  if (isset($_POST['banuser']) && $_POST['banuser'] == 'Ban') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("UPDATE userlogin SET is_banned = 1, is_admin = 0 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account Banned.";
    }
  } 

  if (isset($_POST['unbanuser']) && $_POST['unbanuser'] == 'Unban') {
    
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("UPDATE userlogin SET is_banned = 0 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account Unbanned.";
    }
  } 
/*
  if (isset($_POST['test']) && $_POST['test'] == 'Test') {

    if (!isset($_POST['title']) || !isset($_POST['username']) || empty($_POST['title']) || empty($_POST['username'])) {
      $msg = "Please fill in all form fields.";
    }

    else {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO later (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_POST['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM now WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_POST['username'], ':id' => $id));

    $msg = 'It is done.';

    }

  }
  */

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>Entertain.Me - Admin Page</title>
  <link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>
  <div id="all"><br>
    <div id="banner" align="center"><h1 class="title">Admin Functions</h1></div>

    <div align="center"><?php if (isset($msg)) echo "<p>$msg</p>" ?></div>

    <div id="add_user" align="center">
      <h2 class="title">Add New User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="pass">Password: </label><input type="password" name="pass" />
          <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" />
          <input type="checkbox" name="admin" value="Admin">Make Admin
          <input type="submit" name="register" value="Register" />
        </form>
    </div>

    <div id="remove_user" align="center">
      <h2 class="title">Remove User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="remove" value="Remove" />
        </form>
    </div>

    <div id="add_item" align="center">
      <h2 class="title">Add Item</h2>
        <form method="post" action="admin.php">
          <label for="title">Title: </label><input type="text" name="title" />
          <input type="radio" name="item_type" value="Book" />Book
          <input type="radio" name="item_type" value="Movie" />Movie
          <input type="radio" name="item_type" value="Song" />Song
          <input type="radio" name="item_type" value="TV" />TV
          <input type="radio" name="item_type" value="Videogame" />Videogame
          <input type="submit" name="add_item" value="Add" />
        </form>
    </div>

    <div id="remove_item" align="center">
      <h2 class="title">Remove Item</h2>
        <form method="post" action="admin.php">
          <label for="title">Title: </label><input type="text" name="title" />
          <label for="titleconfirm">Confirm: </label><input type="text" name="titleconfirm" />
          <input type="submit" name="remove_item" value="Remove" />
        </form>
    </div>

    <div id="make_admin" align="center">
      <h2 class="title">Make Admin</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="makeadmin" value="Make Admin" />
        </form>
    </div>

    <div id="remove_admin" align="center">
      <h2 class="title">Remove Admin</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="removeadmin" value="Remove Admin" />
        </form>
    </div>

    <div id="ban_user" align="center">
      <h2 class="title">Ban User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="banuser" value="Ban" />
        </form>
    </div>

    <div id="unban_user" align="center">
      <h2 class="title">Unban User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="unbanuser" value="Unban" />
        </form>
    </div>

    <br><div align="center">
      <form method="post" action="admin.php">
        <input type="submit" name="refresh" value="Refresh" />
    </div>
<!--
    <br><div align="center">
      <form method="post" action="admin.php">
        <label for="title">Title: </label><input type="text" name="title" />
        <label for="username">Username: </label><input type="text" name="username" />
        <input type="submit" name="test" value="Test" />
    </div> -->


  </div>
</body>