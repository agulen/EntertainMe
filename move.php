<?php
  session_start();
  
  //connect to the database
  require 'connect.php';
  //Use the connection from connect.php
  $dbconn = $conn;

  // READ THIS:
  // Since each if statement essestially performs the same action, the process wil be describe for the first one only.

  if (isset($_POST['nowtolater']) && $_POST['nowtolater'] == 'nowtolater') {
    // get entertainment item
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    // since entertainment items are unique, pull first (only) response
    $res = $stmt->fetch();
    // get entertainment_id
    $id = $res['id'];

    // put item in destination table
    $stmt = $dbconn->prepare("INSERT INTO later (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    // remove it from source table
    $stmt = $dbconn->prepare("DELETE FROM now WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    // return us to whatever list we came from
    header('Location: now.php');
    exit();
  }

  if (isset($_POST['nowtodone']) && $_POST['nowtodone'] == 'nowtodone') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO done (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM now WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    header('Location: now.php');
    exit();
  }

  if (isset($_POST['latertonow']) && $_POST['latertonow'] == 'latertonow') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO now (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM later WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    header('Location: later.php');
    exit();
  }

  if (isset($_POST['latertodone']) && $_POST['latertodone'] == 'latertodone') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO done (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM later WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    header('Location: later.php');
    exit();
  }

  if (isset($_POST['donetonow']) && $_POST['donetonow'] == 'donetonow') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO now (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM done WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    header('Location: done.php');
    exit();
  }

  if (isset($_POST['donetolater']) && $_POST['donetolater'] == 'donetolater') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO later (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM done WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    header('Location: done.php');
    exit();
  }

  if (isset($_POST['remove'])) {
    
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    if($_POST['remove'] == 'now')
    {
      $stmt = $dbconn->prepare("DELETE FROM now WHERE username = :username AND entertainment_id = :id ");
      $res = $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    }
    else if($_POST['remove'] == 'later')
    {
      $stmt = $dbconn->prepare("DELETE FROM later WHERE username = :username AND entertainment_id = :id ");
      $res = $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    }
    else if($_POST['remove'] == 'done')
    {
      $stmt = $dbconn->prepare("DELETE FROM done WHERE username = :username AND entertainment_id = :id ");
      $res = $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    }

    header('Location: now.php');
    exit();
  }
?>
