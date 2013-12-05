<?php
//simple logout file. when this is linked to, the user session is destroyed and redirects to the homepage where they must sign up or log in 
	session_start();
	setcookie(session_name(),'',time() - 72000);
	session_unset();
	session_destroy();
	header('Location: index.php');
?>
