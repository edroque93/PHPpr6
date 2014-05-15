<?php
	session_start();
	
	// Check user exists in db and stuff...
	
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	header("Location: index.php");
?>
