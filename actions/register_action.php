<?php
	include_once "../db/db_utils.php";
	
	if ($_POST['password1'] !== $_POST['password2'])
		header('Location: '.$_SERVER['HTTP_REFERER']);
	
	$db = getDB();
	
	session_start();
	
	$user = $_POST['username'];
	$pass = md5($_POST['password1']);
	$mail = md5($_POST['mail']);
	
	$db->exec();
	
	header("Location: ../index.php");
?>
