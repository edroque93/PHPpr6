<?php
	session_start();
	
	if (isset($_SESSION['user'])) header('Location: '.$_SERVER['HTTP_REFERER']);

	include "header.php";
	
	echo '<div class="loginregister">
			<table>
				<tr>
					<td>
						<form name="loginform" action="actions/login_action.php" method="post">
						<fieldset>
							<legend>Log in</legend>
							<label for="acc">Usuario:</label><input type="text" name="acc"><br>
							<label for="password">Contraseña:</label><input type="password" name="password"><br />
							<input type="submit" value="Entrar" />
						</fieldset>
						</form>
					</td>
					<td>
						<form name="registerform" action="actions/register_action.php" method="post">
						<fieldset>
							<legend>Registrarse</legend>
							<label for="acc">Cuenta:</label><input type="text" name="acc"><br>
							<label for="user">Usuario:</label><input type="text" name="username"><br>
							<label for="password1">Contraseña:</label><input type="password" name="password1"><br />
							<label for="password2">Repita contraseña:</label><input type="password" name="password2"><br />
							<label for="mail">Mail:</label><input type="text" name="mail"><br>
							<input type="submit" value="Entrar" />
						</fieldset>
						</form>
					</td>
				</tr>
			</table>
		</div>';
	
	include "footer.php";
?>
