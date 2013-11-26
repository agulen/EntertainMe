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
          /*echo '<input type="text" name="title" value="'.$row['title'].'" readonly>';*/
        	printf("Title: %s <span class='icons'>
            <span class='icon1'>&#x2611</span>
            <span class='icon2'>&#x2799</span>
            <span class='icon3'>&#x2612</span></span>
        		<br/>", $row['title']);
        	printf("Description: %s ", $row['description']);
        	echo '</li>';
        }
        echo '</ul>';
    	}
    }
  }


?>

