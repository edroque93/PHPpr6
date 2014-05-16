<?php

include "../db/db_utils.php";

include "check_session.php";

$err = check_session();
if($err){
	echo "<p>$err</p>";
	echo "<a href=\"../index.php\">Volver</a>";
	return;
}

if(!$_POST){ // Normal mode
$inscripciones = getTable("inscripciones");

echo "<h1>Inscripciones</h1>";
echo "<table><tr id=\"columns\">";

foreach($inscripciones["columns"] as $column) {
  echo "<th>$column</th>";
}

echo "</tr>";

function getName($db,$table,$id){
	$query = "select nombre from $table where id=$id";
	$result = $db->query($query);
	if($result){
		return $result->fetch()['nombre'];
	}
}

$db = getDB();

foreach($inscripciones["data"] as $row) {
	$actividad = $row['actividad'];
	$usuario = $row['usuario'];
  $id = "$actividad-$usuario";
  echo "<tr id=\"$id\">";
  $actividad = getName($db,"actividades",$actividad);
  $usuario = getName($db,"usuarios",$usuario);
  echo "<td>$actividad</td><td>$usuario</td>";
  echo "</tr>";
}

echo "</table>";

echo <<<NEW_ACT

<form action="inscripciones.php" method="post">
	<input type="submit" value="Nueva Actividad"/>
	<input type="hidden" name="opt" value="add"/>
</form>

NEW_ACT;

$js = <<<SCRIPT
<script id="hack">
(function(){
	var rows = document.querySelectorAll('tr');

	var callback = function(ev){
		var form = document.createElement('form')
		  , method = 'post'
		  , path = 'actividades.php'
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
		deleteElem($_POST['id']);
		break;
	case "upd":
		updateDatabase($_POST);
		break;
}

}

function buildForm($id){
	$h = ($id)?"Modificar":"Crear Nueva";
	echo "<h1>$h Actividad $id</h1>";
	if($id){
		$db = getDB();
		$id = splite("-",$id);
		$actividad = $id[0];
		$usuario = $id[1];
		$inscr_raw = $db->query("select * from inscripciones where actividad=$actividad and usuario=$usuario")->fetch();
		echo <<<DEL_INSCR
			<form action="inscripciones.php" method="post">
				<input type="submit" value="Borrar Actividad"/>
				<input type="hidden" name="opt" value="del"/>
				<input type="hidden" name="id" value="$id"/>
			</form>
DEL_INSCR;
	}
	$actividades = $db->query("select id,nombre from actividades");
	$usuarios = $db->query("select id,nombre from usuarios");
	$columns = array("fecha","nombre","url","descripcion");
	echo <<<UPD_FORM
		<form action="actividades.php" method="post">
			<input type="hidden" name="opt" value="upd"/>
			<input type="hidden" name="id" value="$id";
UPD_FORM;
		
	
	echo '<input type="submit" value="Confirmar"/><br/>';
	echo '</form>';

	echo "<a href=\"inscripciones.php\">Volver</a>";
}

function deleteElem($id){
	$db = getDB();
	$db->query("delete from actividades where id=$id");
	echo "<p>Actividad borrada</p>";
	echo "<a href=\"actividades.php\">Volver</a>";
}

function updateDatabase($post){
	$db = getDB();
	$updates = array("fecha","nombre","descripcion","url");
	foreach($updates as $upd){
		if(!$post[$upd]){
			return errMsg("$upd sin especificar");
		}
	}
	if($post["id"]){
		$id = $post["id"];
		$query="update actividades set";
		foreach($updates as $upd){
			$query .= " $upd=\"$post[$upd]\",";
		}
		$query = substr($query, 0,-1);
		$query .= "where id=$id";
		if(!$db->exec($query)){
			return errMsg("La base de datos no se ha podido actualizar");
		}
	} else {
		$query = "insert into actividades(";
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
		if(!$db->exec($query)){
			return errMsg("La base de datos no se ha podido actualizar");
		}
	}

	echo "<p>La base de datos ha sido actualizada</p>";
	echo "<a href=\"actividades.php\">Volver</a>";

}

function errMsg($msg){
	echo "<p>Error: $msg</p>";
	echo "<a href=\"actividades.php\">Volver</a>";
}

?>
