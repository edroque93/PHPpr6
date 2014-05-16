<?php
	include_once "../db/db_utils.php";
	
	if ($_POST['password1'] !== $_POST['password2'])
		header('Location: '.$_SERVER['HTTP_REFERER']);
	
	$db = getDB();
	
	session_start();

	$acc = $_POST['acc'];	
	$user = $_POST['username'];
	$pass = md5($_POST['password1']);
	$mail = $_POST['mail'];
	
	addUser($acc, $pass, $user, $mail, 1);
	
	$query = "select * from usuarios where identificador=\"$acc\" and clave=\"$pass\"";
	$result = $db->query($query);
	
	if (!$result)
		unset($_SESSION['user']);
	else
		$_SESSION['user'] = $result->fetch();
	
	header("Location: ../index.php");
?>
