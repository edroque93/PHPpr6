<?php

include "../header.php";

include "../db/db_utils.php";

include "panel.php";

showPanel("Inscripciones");

if(!$_POST){ // Normal mode
$inscripciones = getTable("inscripciones");

echo "<h2>Inscripciones</h2>";
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
	$act_id = $row['actividad'];
	$usr_id = $row['usuario'];
	$actividad = getName($db,"actividades",$act_id);
  $usuario = getName($db,"usuarios",$usr_id);
  echo "<tr>";
  echo "<td class=\"act\" id=\"act-$act_id\">$actividad</td>
  <td class=\"usr\" id=\"usr-$usr_id\">$usuario</td>
  <td class=\"del\" id=\"del-$act_id-$usr_id\">Borrar</td>";
  echo "</tr>";
}

echo "<tr>";

$all_acts = $db->query("select id,nombre from actividades")->fetchAll();
$all_usrs = $db->query("select id,nombre from usuarios")->fetchAll();

echo '<td><select name="actividad" form="create">';
foreach($all_acts as $act){
	$id = $act["id"];
	$actividad = $act["nombre"];
	echo "<option value=$id>$actividad</option>";
}
echo "</select></td>";
echo '<td><select name="usuario" form="create">';
foreach($all_usrs as $usr){
	$id = $usr["id"];
	$usuario = $usr["nombre"];
	echo "<option value=$id>$usuario</option>";
}
echo "</select></td>";
echo '<td><input type="submit" value="Crear" form="create"/></td>';
echo "</tr>";
echo "</table>";

echo '<form action="inscripciones.php" method="post" id="create">
		    <input type="hidden" name="opt" value="add"/></form>';


$js = <<<SCRIPT
<script id="hack">
(function(){

	function create_callback(path){
		return function(ev){
			var form = document.createElement('form')
		  	, method = 'post'
		  	, hiddenId = document.createElement('input')
		  	, hiddenOpt = document.createElement('input')
		  	, id = ev.target.id.split("-")[1];

			form.setAttribute('method',method);
			form.setAttribute('action',path);
			hiddenId.setAttribute('type','hidden');
			hiddenId.setAttribute('name','id');
			hiddenId.setAttribute('value', id);
			hiddenOpt.setAttribute('type','hidden');
			hiddenOpt.setAttribute('name','opt');
			hiddenOpt.setAttribute('value','mod');
			form.appendChild(hiddenId);
			form.appendChild(hiddenOpt);
			document.body.appendChild(form);
			form.submit();
		}	
	}

	var act_cb = create_callback('actividades.php')
	var usr_cb = create_callback('usuarios.php');
	var del_cb = function(ev){
		var form = document.createElement('form')
		  , method = 'post'
		  , action = 'inscripciones.php'
		  , hiddenAct = document.createElement('input')
		  , hiddenUsr = document.createElement('input')
		  , hiddenOpt = document.createElement('input')
		  , id = ev.target.id.split("-");

		form.setAttribute('method',method);
		form.setAttribute('action',action);
		hiddenAct.setAttribute('type','hidden');
		hiddenAct.setAttribute('name','actividad');
		hiddenAct.setAttribute('value',id[1]);
		hiddenUsr.setAttribute('type','hidden');
		hiddenUsr.setAttribute('name','usuario')
		hiddenUsr.setAttribute('value',id[2]);;
		hiddenOpt.setAttribute('type','hidden');
		hiddenOpt.setAttribute('name','opt');
		hiddenOpt.setAttribute('value','del');
		form.appendChild(hiddenAct);
		form.appendChild(hiddenUsr);
		form.appendChild(hiddenOpt);
		document.body.appendChild(form);
		form.submit();
	}

	var acts = document.getElementsByClassName('act');
	for( var i = 0; i < acts.length; i++ ){
		acts[i].onclick = act_cb;
	}

	var usrs = document.getElementsByClassName('usr');
	for( var i = 0; i < usrs.length; i++ ){
		usrs[i].onclick = usr_cb;
	}

	var dels = document.getElementsByClassName('del');
	for( var i = 0; i < dels.length; i++ ){
		dels[i].onclick = del_cb;
	}

	document.body.removeChild(document.getElementById('hack'));

})();
</script>
SCRIPT;

echo $js;

} else { // Post called

$opt = $_POST['opt'];

switch($opt){
	case "del":
		deleteElem($_POST['actividad'],$_POST['usuario']);
		break;
	case "add":
		addElem($_POST['actividad'],$_POST['usuario']);
		break;
}

}

function deleteElem($actividad,$usuario){
	$db = getDB();
	$db->query("delete from inscripciones where actividad=$actividad and usuario=$usuario");
	echo "<p>Inscripcion borrada</p>";
	echo "<a href=\"inscripciones.php\">Volver</a>";
}

function addElem($actividad,$usuario){
	$db = getDB();
	if(!$db->exec("insert into inscripciones(actividad,usuario) values($actividad,$usuario)")){
		return errMsg("La base de datos no se ha podido actualizar</p><p>Probablemente ya existe la inscripcion");
	}
	echo "<p>La base de datos ha sido actualizada</p>";
	echo "<a href=\"inscripciones.php\">Volver</a>";
}

function errMsg($msg){
	echo "<p>Error: $msg</p>";
	echo "<a href=\"inscripciones.php\">Volver</a>";
}


include "../footer.php";

?>
