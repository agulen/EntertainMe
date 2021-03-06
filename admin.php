<?php
  session_start();
  require 'connect.php';  

  //Check if Refresh button was pressed
  if (isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    $msg = "";
  }
  
  //Check if Register button was pressed
  if (isset($_POST['register']) && $_POST['register'] == 'Register') {
    //Check for any empty form fields
    if (!isset($_POST['username']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['pass'] !== $_POST['passconfirm']) {
      $msg = "Passwords must match.";
    }
    else {      
      //Check for duplicate usernames
      $stmt = $conn->prepare("SELECT COUNT(*) FROM userlogin WHERE username=:username");
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
        $stmt = $conn->prepare("INSERT INTO userlogin (username, password, salt, is_admin) VALUES (:username, :pass, :salt, :admin)");
        $stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted, ':salt' => $salt, ':admin' => $is_admin));
        $msg = "Account created.";
      }
    }
  }
  
  //Check if Remove button was pressed
  if (isset($_POST['remove']) && $_POST['remove'] == 'Remove') {
    //Check for any empty form fields
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      // delete user's now list
      $stmt = $conn->prepare("DELETE FROM now WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      // delete user's later list
      $stmt = $conn->prepare("DELETE FROM later WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      // delete user's done list
      $stmt = $conn->prepare("DELETE FROM done WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      // delete user
      $stmt = $conn->prepare("DELETE FROM userlogin WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account removed.";

      //If you deleted your own account...
      if($_POST['username'] == $_SESSION['username'])
      {
        unset($_SESSION['username']);
        unset($_SESSION['is_admin']);
        header('Location: index.php');
      }
    }
  } 

  //Check if Add Item button was pressed
  if (isset($_POST['add_item']) && $_POST['add_item'] == 'Add') {
    if (!isset($_POST['title']) || !isset($_POST['item_type']) || !isset($_POST['description']) || 
        empty($_POST['title']) || empty($_POST['item_type']) || empty($_POST['description']) ) {
      $msg = "Please fill in all form fields.";
    }
    else {
      // add items to entertainment table
      $stmt = $conn->prepare("INSERT INTO entertainment (title, description, type) VALUES (:title, :description, :type)");
      $stmt->execute(array(':title' => $_POST['title'], ':description' => $_POST['description'], ':type' => $_POST['item_type']));
      $msg = "Item Added.";
    }
  } 

  //Check if Remove Item button was pressed
  if (isset($_POST['remove_item']) && $_POST['remove_item'] == 'Remove') {
    //Check for any empty form fields
    if (!isset($_POST['title']) || !isset($_POST['titleconfirm']) || empty($_POST['title']) || empty($_POST['titleconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['title'] !== $_POST['titleconfirm']) {
      $msg = "Titles must match.";
    }
    else {
      // remove item from entertainment table
      $stmt = $conn->prepare("DELETE FROM entertainment WHERE title = :title");
      $stmt->execute(array(':title' => $_POST['title']));
      $msg = "Item removed.";
    }
  } 
  
  //Check if Make Admin button was pressed
  if (isset($_POST['makeadmin']) && $_POST['makeadmin'] == 'Make Admin') {
    //Check for any empty form fields
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      // update user's "is_admin" to true
      $stmt = $conn->prepare("UPDATE userlogin SET is_admin = 1 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account is now Admin User.";
    }
  } 

  //Check if Remove Admin button was pressed
  if (isset($_POST['removeadmin']) && $_POST['removeadmin'] == 'Remove Admin') {
    //Check for any empty form fields
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      // update user's is_admin to false
      $stmt = $conn->prepare("UPDATE userlogin SET is_admin = 0 WHERE username = :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account is no longer an Admin.";

      //If you specify your own account...
      if($_POST['username'] == $_SESSION['username'])
      {        
        $_SESSION['is_admin'] = false;
        header('Location: index.php');
      }
    }
  } 
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>Entertain.Me - Admin Page</title>
  <link rel="stylesheet" type="text/css" href="admin.css">
  <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
</head>

<body>
  <div id="all"><br>
    <div id="banner"><h1 class="title">Admin Functions</h1></div>

    <div><?php if (isset($msg)) echo "<p>$msg</p>" ?></div>

    <div id="add_user">
      <h2 class="title">Add New User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="pass">Password: </label><input type="password" name="pass" />
          <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" />
          <input type="checkbox" name="admin" value="Admin">Make Admin
          <input type="submit" name="register" value="Register" />
        </form>
    </div>

    <div id="remove_user">
      <h2 class="title">Remove User</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="remove" value="Remove" />
        </form>
    </div>

    <div id="add_item">
      <h2 class="title">Add Item</h2>
        <form method="post" action="admin.php">
          <label for="title">Title: </label><input type="text" name="title" />
          <label for="description">Description: </label><input id="descriptionText" type="text" name="description" />
          <input type="radio" name="item_type" value="Book" />Book
          <input type="radio" name="item_type" value="Movie" />Movie
          <input type="radio" name="item_type" value="Song" />Song
          <input type="radio" name="item_type" value="TV" />TV
          <input type="radio" name="item_type" value="Videogame" />Videogame
          <input type="submit" name="add_item" value="Add" />
        </form>
    </div>

    <div id="remove_item">
      <h2 class="title">Remove Item</h2>
        <form method="post" action="admin.php">
          <label for="title">Title: </label><input type="text" name="title" />
          <label for="titleconfirm">Confirm: </label><input type="text" name="titleconfirm" />
          <input type="submit" name="remove_item" value="Remove" />
        </form>
    </div>

    <div id="make_admin">
      <h2 class="title">Make Admin</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="makeadmin" value="Make Admin" />
        </form>
    </div>

    <div id="remove_admin">
      <h2 class="title">Remove Admin</h2>
        <form method="post" action="admin.php">
          <label for="username">Username: </label><input type="text" name="username" />
          <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
          <input type="submit" name="removeadmin" value="Remove Admin" />
        </form>
    </div>

    <br><div>
      <form method="post" action="admin.php">
        <input type="submit" name="refresh" value="Refresh" />
    </div>
  </div>
</body>
