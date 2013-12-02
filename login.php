<?php
session_start();

//connect to the database
require 'connect.php';
//Use the connection from connect.php
$dbconn = $conn;

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

  }
  else {
    $err = 'Incorrect username or password.';
  }
}

if (isset($_POST['signup']) && $_POST['signup'] == 'Signup') {
  header('Location: signup.php');
  exit();
}

?>


