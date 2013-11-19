<?php
  session_start();
  
  // Connect to the database
  try {
    $dbname = 'lecture18';
    $user = 'root';
    $pass = '';
    $dbconn = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
  }
  catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
  
  if (isset($_POST['register']) && $_POST['register'] == 'Register') {
    
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
      
      // Store the salt with the password, so we can apply it again and check the result
      $stmt = $dbconn->prepare("INSERT INTO users_secure (username, pass, salt) VALUES (:username, :pass, :salt)");
      $stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted, ':salt' => $salt));
      $msg = "Account created.";
    }
  }

    if (isset($_POST['remove']) && $_POST['remove'] == 'Remove') {
    
    // @TODO: Check to see if duplicate usernames exist
    
    if (!isset($_POST['username']) || !isset($_POST['userconfirm']) || empty($_POST['username']) || empty($_POST['userconfirm']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['username'] !== $_POST['userconfirm']) {
      $msg = "Usernames must match.";
    }
    else {
      $stmt = $dbconn->prepare("DELETE FROM users_secure WHERE username == :username");
      $stmt->execute(array(':username' => $_POST['username']));
      $msg = "Account removed.";
    }
  } 

    if (isset($_POST['add_item']) && $_POST['add_item'] == 'Add') {
    
    // @TODO: Check to see if duplicate usernames exist
    
    if (!isset($_POST['title']) || !isset($_POST['item_type']) || empty($_POST['title']) || empty($_POST['item_type']) ) {
      $msg = "Please fill in all form fields.";
    }
    else {
      $stmt = $dbconn->prepare("INSERT INTO :database (title) VALUES (:title)");
      $stmt->execute(array(':database' => $_POST['item_type'], ':title' => $_POST['title']));
      $msg = "Item Added.";
    }
  } 

    if (isset($_POST['remove_item']) && $_POST['remove_item'] == 'Remove') {
    
    // @TODO: Check to see if duplicate usernames exist
    
    if (!isset($_POST['title']) || !isset($_POST['titleconfirm']) || !isset($_POST['item_type']) || empty($_POST['title']) || empty($_POST['titleconfirm']) || empty($_POST['item_type']) ) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['title'] !== $_POST['titleconfirm']) {
      $msg = "Titles must match.";
    }
    else {
      $stmt = $dbconn->prepare("DELETE FROM :database WHERE title == :title");
      $stmt->execute(array(':database' => $_POST['item_type'], ':title' => $_POST['title']));
      $msg = "Item removed.";
    }
  } 

?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<title>Entertain.Me - Admin Page</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>
	<div id="all">
		<div id="banner" align="center"><h1 class="title">Admin Functions</h1></div><br>

		<div id="add_user" align="center">
			<h2 class="title">Add New User</h2>
			<?php if (isset($msg)) echo "<p>$msg</p>" ?>
			  <form method="post" action="admin.php">
			    <label for="username">Username: </label><input type="text" name="username" />
			    <label for="pass">Password: </label><input type="password" name="pass" />
			    <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" />
			    <input type="submit" name="register" value="Register" />
			  </form>
		</div>

		<div id="remove_user" align="center">
			<h2 class="title">Remove User</h2>
			<?php if (isset($msg)) echo "<p>$msg</p>" ?>
			  <form method="post" action="admin.php">
			    <label for="username">Username: </label><input type="text" name="username" />
			    <label for="userconfirm">Confirm: </label><input type="text" name="userconfirm" />
			    <input type="submit" name="remove" value="Remove" />
			  </form>
		</div>

		<div id="add_item" align="center">
			<h2 class="title">Add Item</h2>
			<?php if (isset($msg)) echo "<p>$msg</p>" ?>
			  <form method="post" action="admin.php">
			    <label for="title">Title: </label><input type="text" name="title" />
			    <input type="radio" name="item_type" value="Book" />Book
			    <input type="radio" name="item_type" value="Movie" />Movie
			    <input type="radio" name="item_type" value="Song" />Song
			    <input type="submit" name="add_item" value="Add" />
			  </form>
		</div>

		<div id="remove_item" align="center">
			<h2 class="title">Remove Item</h2>
			<?php if (isset($msg)) echo "<p>$msg</p>" ?>
			  <form method="post" action="admin.php">
			    <label for="title">Title: </label><input type="text" name="title" />
			    <label for="confirmtitle">Confirm: </label><input type="text" name="confirmtitle" />
			    <input type="radio" name="item_type" value="Book" />Book
			    <input type="radio" name="item_type" value="Movie" />Movie
			    <input type="radio" name="item_type" value="Song" />Song
			    <input type="submit" name="remove_item" value="Remove" />
			  </form>
		</div>

	</div>
</body>