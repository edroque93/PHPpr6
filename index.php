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
		
			<!-- Login module and registration module should be merged -->
			<!-- Login module -->
			
			<div class="user_login">
				<?php 
					session_start();
					
					if (!isset($_SESSION['user']))
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
			
			<!-- Frontpage module -->
			
			<div id="frontpage">
				<p>Página web en versión de pruebas. Ya sé que no soy bueno con los colores Calvin.</p>
				<p>En esta página web podrás encontrar rutas que hacer en la isla de Gran Canaria.</p>
				<p>¡Te invitamos a que te registres y participes con la comunidad!</p>
				<img id="fpimg1" src="img/frontpage1.jpg" alt="Imagen portada" />
			</div>
		</div>
		
		<!-- Footer -->
		
		<div class="footer">
			<p>PHP - Programación IV, 2014</p>
		</div>
	</body>
</html>
