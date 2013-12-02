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
        echo 'Nothing is here';
      }
      else {
        //Populate accordion with data!
        $sql = "SELECT entertainment.`title` , entertainment.`description`
        FROM  `entertainment` 
        INNER JOIN  `".$timePeriod."` 
        ON ".$timePeriod.".`entertainment_id` = entertainment.`id` 
        WHERE  `username`='".$_SESSION['username']."' AND `type`='".$entertainmentType."'";
        $call = $conn->query($sql);
        echo '<ul id="accordionList">';
        foreach ($call as $row) {
          echo '<li>';
          echo '<form method="post" action="move.php">';
          echo '<label class="mediaTitle" for="title">'.$row['title'].'</label>';
          echo '<input type="text" name="title" class="nodisplay" value="'.$row['title'].'" readonly>';
          if ($timePeriod == 'now') {
            echo '<div class="buttons">
                    <input type="image" src="toLater.png" name="nowtolater" value="nowtolater" class="icon" title="Move to later"/>
                    <input type="image" src="toDone.png" name="nowtodone" value="nowtodone" class="icon" title="Mark as done"/>
                    <input type="image" id="deleteItem" src="deleteButton.png" name="remove" value="now" class="icon" title="Delete"/>
                  </div>';
          }
          if ($timePeriod == 'later') {
            echo '<div class="buttons">
                    <input type="image" src="toNow.png" name="latertonow" value="latertonow" class="icon" title="Move to now"/>
                    <input type="image" src="toDone.png" name="latertodone" value="latertodone" class="icon" title="Mark as done"/>
                    <input type="image" id="deleteItem" src="deleteButton.png" name="remove" value="later" class="icon" title="Delete"/>
                  </div>';
          }
          if ($timePeriod == 'done') {
            echo '<div class="buttons">
                    <input type="image" src="toNow.png" name="donetonow" value="donetonow" class="icon" title="Move to now"/>
                    <input type="image" src="toLater.png" name="donetolater" value="donetolater" class="icon" title="Move to later"/>
                    <input type="image" id="deleteItem" src="deleteButton.png" name="remove" value="done" class="icon" title="Delete"/>
                  </div>';
          }
          echo '</form>';          
          echo '<div class="mediaDescription">'.$row['description'].'</div>';
          echo '</li>';
        }
        echo '</ul>';
      }
    }
  }
?>

