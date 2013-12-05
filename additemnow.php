<?php

  //if the 'submit' button is pressed on the now page...
  if (isset($_POST['additem']) && $_POST['additem'] == 'Submit') {
    
    //make sure the title and entertainment type are filled in
    if (!isset($_POST['title']) || empty($_POST['title'])) {
      $addmsg = "Please fill in the title.";
    }
    else if ($_POST['dropdown'] == "") {
      $addmsg = "Please select a type of entertainment.";
    }
    else { //if all set...
      //insert items into entertainment table the items that were posted
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

      //use this id to insert id and username into the now table for the user's viewing
      $stmt = $conn->prepare("INSERT INTO now (username, entertainment_id) VALUES (:username, :id)");
      $stmt->execute(array(':username' => $_SESSION['username'], ':id' => $id));

      $addmsg = "Item added.";
    }
  
  }

?>
