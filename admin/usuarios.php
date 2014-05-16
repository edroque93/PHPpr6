<?php

include "../db/db_utils.php";

$usuarios = getTable("usuarios");

echo "<table><tr id=\"columns\">";

foreach($usuarios["columns"] as $column) {
  echo "<th>$column</th>";
}

echo "</tr>";

foreach($usuarios["data"] as $row) {
  $id = $row["id"];
  echo "<tr id=\"$id\">";
  foreach($usuarios["columns"] as $column) {
    echo "<td>$row[$column]</td>";
  }
  echo "</tr>";
}

echo "</table>";

echo <<<NEW_USER

<form action="usuario_form.php" method="post">
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
		  , path = 'usuario_form.php'
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

?>
