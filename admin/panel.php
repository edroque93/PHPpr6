<?php

function showPanel($select){
  
	$pages = array("Usuarios","Actividades","Inscripciones");

	echo '<select onchange="location = this.options[this.selectedIndex].value;">';
	foreach($pages as $page){
		echo "<option value=\"".strtolower($page).".php\" ";
		if($select == $page) echo "selected";
		echo">$page</option>";
	}
	echo "</select>";
}

?>
