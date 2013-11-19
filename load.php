<?php 
require 'connect.php';
	/*if ($conn) {
		echo "Connected!";
	}*/
?>



<?php 
	/*count statement for null checking*/
      $sql = "SELECT COUNT(*)
      FROM  `entertainment` 
      INNER JOIN  `now` 
      ON now.`entertainment_id` = entertainment.`id` 
      WHERE  `username`='altan' AND `type`='movie'";
      if ($movies = $conn->query($sql)) {

      /*checking if no items*/
      if ($movies->fetchColumn() == 0) {
      	echo 'Nothing exciting is here! Do you want to add something? hello';
      	/*fields to add items*/
      }
      else {
    	  $sql = "SELECT entertainment.`title` , entertainment.`description`
    	  FROM  `entertainment` 
	      INNER JOIN  `now` 
	      ON now.`entertainment_id` = entertainment.`id` 
	      WHERE  `username`='altan' AND `type`='movie'";
	      $movies = $conn->query($sql);
	      echo '<ul>';
	      foreach ($movies as $row) {
	      	echo '<li>';
	      	printf("Title: %s <span class='icons'>&#x2611 &#x2799 &#x2612</span>
	      		<br/>", $row['title']);
	      	printf("Description: %s ", $row['description']);
	      	echo '</li>';
	      }
	      echo '</ul>';
    	}
    }

	/*count statement for null checking
      $sql = "SELECT COUNT(*)
      FROM  `entertainment` 
      INNER JOIN  `now` 
      ON now.`entertainment_id` = entertainment.`id` 
      WHERE  `username`='altan' AND `type`='tv'";
      if ($tvshows = $conn->query($sql)) {

      checking if no items
      if ($tvshows->fetchColumn() == 0) {
      	echo 'Nothing exciting is here! Do you want to add something? hi';
      	/*fields to add items
      }
      else {
    	  $sql = "SELECT entertainment.`title` , entertainment.`description`
    	  FROM  `entertainment` 
	      INNER JOIN  `now` 
	      ON now.`entertainment_id` = entertainment.`id` 
	      WHERE  `username`='altan' AND `type`='tv'";
	      $tvshows = $conn->query($sql);
	      echo '<ul>';
	      foreach ($tvshows as $row) {
	      	echo '<li>';
	      	printf("Title: %s <br/>", $row['title']);
	      	printf("Description: %s <br/>", $row['description']);
	      	echo '<span class="icons">&#x2611 &#x2799 &#x2612</span></li>';
	      }
	      echo '</ul>';
    	}
    }*/
?>
