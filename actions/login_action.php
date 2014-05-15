<?php
	include_once "../db/db_utils.php";
	$db = getDB();
	
	session_start();
	
	$user = $_POST['acc'];
	$pass = md5($_POST['password']);
	
	$query = "select * from usuarios where identificador=\"$user\" and clave=\"$pass\"";
	
	$result = $db->query($query);
	
	if ($_SESSION['user'] = $result->fetch()) {
		header("Location: ../index.php");
	} else {
		unset($_SESSION['user']);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
?>
