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
	
	include "header.php";
?>



		<!-- Body -->

		<div>
		
			<!-- Login module and registration module should be merged -->
			<!-- Login module -->
			
			<div class="user_login">
				<?php 
					session_start();
					
					if (!isset($_SESSION['user']))
						echo
							'<form name="loginform" action="actions/login_action.php" method="post">
								<fieldset>
									<legend>Log in</legend>
									<label for="user">Usuario:</label><input type="text" name="username"><br>
									<label for="password">Contraseña:</label><input type="password" name="password"><br />
									<input type="submit" value="Entrar" />
								</fieldset>
							</form>';
					else
						echo '<p>Bienvenido de nuevo, '.$_SESSION["user"]['identificador'].'.</p>';
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
		
<?php
	include "footer.php";
?>
		

