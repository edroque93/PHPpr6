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

$js = <<<SCRIPT
<script>
(function(){
	var rows = document.querySelectorAll('tr');

	var callback = function(ev){
		var form = document.createElement('form')
		  , method = 'post'
		  , path = 'usuario_form.php'
		  , hiddenId = document.createElement('input');

		form.setAttribute('method',method);
		form.setAttribute('action',path);
		hiddenId.setAttribute('type','hidden');
		hiddenId.setAttribute('name','id');
		hiddenId.setAttribute('value', ev.target.parentElement.id);
		form.appendChild(hiddenId);
		document.body.appendChild(form);
		form.submit();
	}

	for( var i = 1; i < rows.length; i++ ){
		rows[i].onclick = callback;
	}

})();
</script>
SCRIPT;

echo $js;

?>
