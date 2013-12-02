<?php 
  function load($entertainmentType, $timePeriod) {

    require 'connect.php';

    /*count statement for null checking*/
    $sql = "SELECT COUNT(*)
    FROM  `entertainment` 
    INNER JOIN  `".$timePeriod."` 
    ON ".$timePeriod.".`entertainment_id` = entertainment.`id`
    WHERE  `username`='".$_SESSION['username']."' AND `type`='".$entertainmentType."'";
    $call = $conn->query($sql);
    if ($call) {
      /*checking if no items*/
      if ($call->fetchColumn() == 0) {
      	echo 'Nothing is here yet';
      }
      else {
    	  $sql = "SELECT entertainment.`title` , entertainment.`description`
    	  FROM  `entertainment` 
        INNER JOIN  `".$timePeriod."` 
        ON ".$timePeriod.".`entertainment_id` = entertainment.`id` 
        WHERE  `username`='".$_SESSION['username']."' AND `type`='".$entertainmentType."'";
        $call = $conn->query($sql);
        echo '<ul>';
        foreach ($call as $row) {
        	echo '<li>';
          echo '<form method="post" action="move.php">';
          echo '<label for="title">'.$row['title'].'</label>';
          echo '<input type="text" name="title" class="nodisplay" value="'.$row['title'].'" readonly>';
        	if ($timePeriod == 'now') {
            echo '<input type="submit" name="nowtolater" value="nowtolater" class="icon" />
                  <input type="submit" name="nowtodone" value="nowtodone" class="icon" />
                  <input type="image" src="deleteButton.png" name="remove" value="now" class="icon" />';
        }
          if ($timePeriod == 'later') {
            echo '<input type="submit" name="latertonow" value="latertonow" class="icon" />
                  <input type="submit" name="latertodone" value="latertodone" class="icon" />
                  <input type="image" src="deleteButton.png" name="remove" value="later" class="icon" />';
          }
          if ($timePeriod == 'done') {
            echo '<input type="submit" name="donetonow" value="donetonow" class="icon" />
                  <input type="submit" name="donetolater" value="donetolater" class="icon" />;
                  <input type="image" src="deleteButton.png" name="remove" value="done" class="icon" />';
          }
          echo '</form>';
          /*printf("Title: %s <span class='icons'>
            <span class='icon1'>&#x2611</span>
            <span class='icon2'>&#x2799</span>
            <span class='icon3'>&#x2612</span></span>
        		<br/>", $row['title']);*/
        	printf("Description: %s ", $row['description']);
        	echo '</li>';
        }
        echo '</ul>';
    	}
    }
  }


?>

