<?php
	include_once "db_utils.php";
	global $db;
	
	session_start();
	
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	
	$query = "select * from usuarios where identificador=\"$user\"";
	
	$result = $db->query($query);
	
	if ($_SESSION['user'] = $result->fetch()) {
		print $_SESSION['user']['id'];
	} else {
		print "nope.";
	}

	//header("Location: index.php");
?>
