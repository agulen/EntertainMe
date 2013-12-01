<?php

 if (isset($_POST['additem']) && $_POST['additem'] == 'Submit') {
    
    
    if (!isset($_POST['title']) || empty($_POST['title'])) {
      $addmsg = "Please fill in the title.";
    }
    else if ($_POST['dropdown'] == "") {
      $addmsg = "Please select a type of entertainment.";
    }
    else {
      //insert items into entertainment table
      $stmt = $conn->prepare("INSERT INTO entertainment (title, description, type) 
                          VALUES (:title, :descr, :type)");
      $stmt->execute(array(':title' => $_POST['title'],
                           ':descr' => $_POST['description'], 
                           ':type' => $_POST['dropdown']));

      //grab id from entertainment table
      $stmt = $conn->prepare("SELECT id FROM entertainment WHERE title = :title");
      $stmt->execute(array(':title' => $_POST['title']));
      $res = $stmt->fetch();
      $id = $res['id'];

      //insert this id and the session username into the now table
      $stmt = $conn->prepare("INSERT INTO now (username, entertainment_id) VALUES (:username, :id)");
      $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

      $addmsg = "Item added.";
    }
  
  }

?>
