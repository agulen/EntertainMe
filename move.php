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

  if (isset($_POST['nowtolater']) && $_POST['nowtolater'] == 'nowtolater') {
    $stmt = $dbconn->prepare("SELECT id FROM entertainment WHERE title = :title");
    $stmt->execute(array(':title' => $_POST['title']));
    $res = $stmt->fetch();
    $id = $res['id'];

    $stmt = $dbconn->prepare("INSERT INTO later (username, entertainment_id) VALUES (:username, :id)");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

    $stmt = $dbconn->prepare("DELETE FROM now WHERE username = :username AND entertainment_id = :id");
    $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));
    
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

    $stmt = $dbconn->prepare("INSERT INTO archive (username, entertainment_id) VALUES (:username, :id)");
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
?>
