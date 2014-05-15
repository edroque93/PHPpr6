<?php
	$something = "Lorem ipsum... y tal.";
	
	/*
	
		TO-DO:
		
			- DB module (eg: include "db_mngmnt.php")
			-- Care @lilbobbytables

			- Site
			-- Register block
			-- Login block
			--- User menu
			--- Admin menu
			-- Frontpage design
			-- Routes (at least 3, see mockup)
			-- About page
			
			- much research, so hard, wow php
		
	*/
?>

<!-- Site -->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<title>Práctica 6 - PHP</title>
	</head>
	<body>
		<!-- Magic debug link -->
		
		<a href="database_create_fill.php" target="_blank">Genera BD</a>
		
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
		</div>

		<!-- Body -->

		<div>
		
			<!-- Login module -->
			
			<div class="user_login">
				<?php 
					session_start();
					
					if (!isset($_SESSION['username']))
						echo
							'<form name="loginform" action="login.php" method="post">
								<fieldset>
									<legend>Log in</legend>
									<label for="user">Usuario:</label><input type="text" name="username"><br>
									<label for="password">Contraseña:</label><input type="password" name="password"><br />
									<input type="submit" value="Entrar" />
								</fieldset>
							</form>';
					else
						echo '<p>Bienvenido de nuevo, '.$_SESSION["username"].'.</p>';
				?>
			</div>
			
			<!-- Register module -->
			
			<div class="registration">
			</div>
			
		</div>
		
		<!-- Footer -->
		
		<div>
			<p>PHP - Programación IV, 2014</p>
		</div>
	</body>
</html>
