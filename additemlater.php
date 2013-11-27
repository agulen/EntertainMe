
<?php


//select the id



 if (isset($_POST['additem']) && $_POST['additem'] == 'Submit') {
    
    
    if (!isset($_POST['title']) || empty($_POST['title'])) {
      $addmsg = "Please fill in the title.";
    }
    else if ($_POST['dropdown'] == "") {
      $addmsg = "Please select a type of entertainment.";
    }
    else {
      // Generate random salt
      $stmt = $conn->prepare("INSERT INTO entertainment (title, description, type) 
                          VALUES (:title, :descr, :type)");
      $stmt->execute(array(':title' => $_POST['title'],
                           ':descr' => $_POST['description'], 
                           ':type' => $_POST['dropdown']));
      $insertsql = "INSERT INTO later (entertainment_id)
      					SELECT MAX(id) FROM entertainment";
      $stmt2 = $conn->query($insertsql);

      $updatesql = $conn->prepare("UPDATE later SET username=:user WHERE entertainment_id=MAX(entertainment_id)");
      $updatesql->execute(array(':user' => $_SESSION['username']));
      
      $addmsg = "Item added.";
    }
  
  }

  //NOW and LATER are made up of foreign keys....preventing updates and inserts





?>
