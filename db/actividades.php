<?php

include "../db/db_utils.php";

if(!$_POST){ // Normal mode
$usuarios = getTable("usuarios");
echo "<h1>Usuarios</h1>";
echo "<table><tr id=\"columns\">";

foreach($usuarios["columns"] as $column) {
  echo "<th>$column</th>";
}

echo "</tr>";

foreach($usuarios["data"] as $row) {
  $id = $row["id"];
  echo "<tr id=\"$id\">";
  foreach($usuarios["columns"] as $column) {
  	if($column == "clave")
  		echo "<td>*****</td>";
  	else
    	echo "<td>$row[$column]</td>";
  }
  echo "</tr>";
}

echo "</table>";

echo <<<NEW_USER

<form action="usuarios.php" method="post">
	<input type="submit" value="Nuevo Usuario"/>
	<input type="hidden" name="opt" value="add"/>
</form>

NEW_USER;

$js = <<<SCRIPT
<script id="hack">
(function(){
	var rows = document.querySelectorAll('tr');

	var callback = function(ev){
		var form = document.createElement('form')
		  , method = 'post'
		  , path = 'usuarios.php'
		  , hiddenId = document.createElement('input')
		  , hiddenOpt = document.createElement('input');

		form.setAttribute('method',method);
		form.setAttribute('action',path);
		hiddenId.setAttribute('type','hidden');
		hiddenId.setAttribute('name','id');
		hiddenId.setAttribute('value', ev.target.parentElement.id);
		hiddenOpt.setAttribute('type','hidden');
		hiddenOpt.setAttribute('name','opt');
		hiddenOpt.setAttribute('value','mod');
		form.appendChild(hiddenId);
		form.appendChild(hiddenOpt);
		document.body.appendChild(form);
		form.submit();
	}

	for( var i = 1; i < rows.length; i++ ){
		rows[i].onclick = callback;
	}

	document.body.removeChild(document.getElementById('hack'));

})();
</script>
SCRIPT;

echo $js;

} else { // Post called

$opt = $_POST['opt'];

switch($opt){
	case "mod":
		buildForm($_POST['id']);
		break;
	case "add":
		buildForm("");
		break;
	case "del":
		deleteUser($_POST['id']);
		break;
	case "upd":
		updateDatabase($_POST);
		break;
}

}

function buildForm($id){
	$h = ($id)?"Modificar":"Crear Nuevo";
	echo "<h1>$h Usuario $id</h1>";
	if($id){
		$db = getDB();
		$user_raw = $db->query("select * from usuarios where id=$id")->fetch();
		echo <<<DEL_USER
			<form action="usuarios.php" method="post">
				<input type="submit" value="Borrar Usuario"/>
				<input type="hidden" name="opt" value="del"/>
				<input type="hidden" name="id" value="$id"/>
			</form>
DEL_USER;
	}
	$columns = array("identificador","nombre","email","tipo","clave");
	echo <<<UPD_FORM
		<form action="usuarios.php" method="post">
			<input type="hidden" name="opt" value="upd"/>
			<input type="hidden" name="id" value="$id";
UPD_FORM;
	for( $i = 0; $i < 3; $i++ ){
		$val = ($id)?$user_raw[$columns[$i]]:"";
		echo "<label for=\"$columns[$i]\">$columns[$i]:</label><br/>";
		echo "<input type=\"text\" name=\"$columns[$i]\" id=\"$columns[$i]\" value=\"$val\"/><br/>";
	}
	$sel = ($id)?$user_raw["tipo"]:"1";
	echo '<label for "tipo">tipo:</label><br/>';
	echo '<select name="tipo"><option value="1" ';
	if($sel == 1) echo 'selected>Normal</option>';
	else echo '>Normal</option>';
	echo '<option value="2"';
	if($sel == 2) echo 'selected>Administrador</option>';
	else echo '>Administrador</option>';
	echo "</select><br/>";

	echo '<label for="clave">clave:</label><br/>';
	echo '<input type="password" name="clave" value=""/><br/>';
	echo '<input type="submit" value="Confirmar"/><br/>';
	echo '</form>';

	echo "<a href=\"usuarios.php\">Volver</a>";
}

function deleteUser($id){
	$db = getDB();
	$db->query("delete from usuarios where id=$id");
	echo "<p>Usuario borrado</p>";
	echo "<a href=\"usuarios.php\">Volver</a>";
}

function updateDatabase($post){
	$db = getDB();
	$updates = array("identificador","nombre","email","tipo");
	foreach($updates as $upd){
		if(!$post[$upd]){
			return errMsg("$upd sin especificar");
		}
	}
	if($post['clave']) {
		$updates[] = "clave";
		$post['clave'] = md5($post['clave']);
	} else {
		if(!$post["id"]){
			return errMsg("clave sin especificar");
		}
	}
	if($post["id"]){
		$id = $post["id"];
		$query="update usuarios set";
		foreach($updates as $upd){
			$query .= " $upd=\"$post[$upd]\",";
		}
		$query = substr($query, 0,-1);
		$query .= "where id=$id";
		$db->exec($query);
	} else {
		$query = "insert into usuarios(";
		foreach ($updates as $upd){
			$query .= "$upd,";
		}
		$query = substr($query, 0,-1);
		$query .= ") values( ";
		foreach ($updates as $upd){
			$query .= "\"$post[$upd]\",";
		}
		$query = substr($query, 0,-1);
		$query .= ")";
		$db->exec($query);
	}

	echo "<p>La base de datos ha sido actualizada</p>";
	echo "<a href=\"usuarios.php\">Volver</a>";

}

function errMsg($msg){
	echo "<p>Error: $msg</p>";
	echo "<a href=\"usuarios.php\">Volver</a>";
}

?>