<?php
	echo 
		'<!-- Site -->

		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="styles.css">
				<title>Práctica 6 - PHP</title>
			</head>
			<body>
				<!-- Magic debug link -->
				
				<a href="db/database_create_fill.php" target="_blank">Genera BD</a>';
				
		if(!isset($_SESSION)){
		    session_start();
		}
		
		if (isset($_SESSION['user'])) {
			$name = $_SESSION['user']['nombre'];
			echo '<p>Hola de nuevo, '.$name.'.</p>';
			echo '<a href="logout.php">Logout</a>';
		} else
			echo '	<!-- Dirty login link -->				
					<a href="login.php">Entrar o registrarse</a>';
				
		echo '	<!-- Header -->
		
				<div>
					<div class="logo">
						<h1>Práctica 6</h1>			
					</div>
					
				<!-- Menu module -->
			
					<div class="menu">
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="routes.php">Rutas</a></li>
							<li><a href="about.php">About</a></li>
						</ul>
					</div>
				</div>';
?>
