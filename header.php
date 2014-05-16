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
				<!-- Magic debug link 
				

				<a id="gendb" href="db/database_create_fill.php" target="_blank">Genera BD</a>
				
				-->';


		if(!isset($_SESSION)){
		    session_start();
		}
		
		echo '<div class="tif">';
		
		if (isset($_SESSION['user'])) {
			$name = $_SESSION['user']['nombre'];
			echo '<p>Hola de nuevo, '.$name.'.</p><br />';
			
			if ($_SESSION['user']['tipo'] == 2) {
				echo '<a class="logged" href="admin/usuarios.php">Administración</a><br />';			
			}
			
			echo '<a class="logged" href="logout.php">Logout</a><br />';
		} else
			echo '	<!-- Dirty login link -->				
					<a class="register" id="" href="login.php">Entrar o registrarse</a>';
				
		echo '	</div>
		
				<!-- Header -->
		
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
