<?php
	include_once "../db/db_utils.php";
	
	$db = getDB();

	session_start();
	
	if (!isset($_SESSION['user'])) header('Location: '.$_SERVER['HTTP_REFERER']);
		
	$usr = $_SESSION['user']['id'];
	$act = getActivityID($_POST["id"]);
	
	addInscription($act, $usr);
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>
