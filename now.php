<?php 
	session_start();
	require 'connect.php';
	include 'additemnow.php';
	include 'load.php';
 ?>


<!DOCTYPE html>
<html>
	<head>
  	<title>EntertainMe - Now</title>
  	<link rel="stylesheet" type="text/css" href="mainpages.css">
  	<link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
  	<!--accordion styling-->
  	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
  </head>
	<body>
		<div id="navigation">
			<div id="mainbar">
				<ul>
					<li class="current">
						<a href="now.php">Now</a>
					</li>
					<li class="#">
						<a href="later.php">Later</a>
					</li>
					<li class="#">
						<a href="done.php">Done</a>
					</li>
					<!-- Drop Down menu Items -->  
					<li class="dropdown">
					 <dl class="staticMenu"> <!--dl, dt, dd from code given to make the dropdown menu, see link in sources.txt-->
				    <dt>
				     <a href="#" onClick="return false;"><?php echo htmlentities($_SESSION['username']); ?>
				     	&#8595;</a>
				    </dt>
					 	<dd>
							<ul class="mainMenuSub">
							 <?php if ($_SESSION['is_admin']==true) : ?>
							 <li><a href="admin.php">Admin Settings</a></li>
							 <li><div class="mid-line"></div></li>
							 <?php endif; ?>
							 <li><a href="logout.php">Logout</a></li>
							</ul>
					 	</dd>
					 </dl>
					</li>
				</ul>
			</div>
		</div>

		<div id="all">
  		<div class="logo">
  			<img src="http://i.minus.com/iI7WTHovllxD1.png" alt="logo" width="400px" height="auto" >
  		</div>
			<div id="main">
				<div id="pageDescription">
					<h1>Now</h1>
		  		<p class="about_list">Media you want to experience as soon as possible. Right here, right now.</p>
		  	</div>
		  	<div id="lists">
			  	<h4>Your Lists</h4>
					<div id="accordion">
						<h3>Movies</h3>
							<div class="moviedata">
								<?php 
								$entertainmentType = 'movie';
								$timePeriod = 'now';
								load($entertainmentType, $timePeriod);
								 ?>
							</div>
						<h3>TV Shows</h3>
							<div class="tvdata">
								<?php 
								$entertainmentType = 'tv';
								$timePeriod = 'now';
								load($entertainmentType, $timePeriod);
								 ?>
							</div>
					  <h3>Music</h3>
						  <div class="musicdata">
						  	<?php 
								$entertainmentType = 'music';
								$timePeriod = 'now';
								load($entertainmentType, $timePeriod);
								 ?>
						  </div>
					  <h3>Books</h3>
						  <div class="bookdata">
						  	<?php 
								$entertainmentType = 'book';
								$timePeriod = 'now';
								load($entertainmentType, $timePeriod);
								 ?>
						  </div>
					  <h3>Games</h3>
						  <div class="gamesdata">
						  	<?php 
								$entertainmentType = 'game';
								$timePeriod = 'now';
								load($entertainmentType, $timePeriod);
								 ?>
					  	</div>
					</div>
				</div>
				<div id="add">
					<h5>Add more items</h5><br/>
					<div class="additems">
						<form method="post" action="now.php">
							<select name="dropdown">
							  <option value="">What type of entertainment?</option>
							  <option value="movie">Movie</option>
							  <option value="tv">TV Show</option>
							  <option value="music">Music</option>
							  <option value="book">Book</option>
							  <option value="game">Game</option>
							</select><br/>
			            <label for="title">Title </label><input type="text" name="title" /></br>
			            <label for="description">Description </label><textarea id="description" name="description"></textarea><br/>
			            <input type="submit" name="additem" value="Submit" />
			        	</form>
			        	<?php if (isset($addmsg)) echo $addmsg; ?>
		      </div>
				</div>
			</div> <!--div for main-->

	  	<div id="footer">
	  		<li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
	  	</div>
	  </div> <!--div for all-->

	</body>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="navmenu.js" type="text/javascript"></script>
	<script src="accordion.js" type="text/javascript"></script>
</html>
