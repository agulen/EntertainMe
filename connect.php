<?php 

$config = array(
	'DB_HOST'		=> 'localhost',
	'DB_USERNAME'	=> 'root',
	'DB_PASSWORD'	=> '',
);

try { 
	$conn = new PDO('mysql:host=localhost;dbname=entertainme',
		$config['DB_USERNAME'],$config['DB_PASSWORD']);
}	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

?>
