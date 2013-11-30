<?php
  //probably do not need this, because we should already be connected via a session ?
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
  }


echo '<form method="post" action="move.php">
	<label for="title">'.$row['title'].'</label><input type="text" name="title" class="nodisplay" value="'.$row['title'].'" readonly>;
	<input type="submit" name="nowtolater" value="nowtolater" class="icon" />
	<input type="submit" name="nowtodone" value="nowtodone" class="icon" />
	<input type="submit" name="latertodone" value="latertodone" class="icon" />
	<input type="submit" name="remove" value="remove" class="icon" />
</form>';

?>

CSS to Add:

.nodisplay {
	display: none;
}