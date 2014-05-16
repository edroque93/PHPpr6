<!-- Load every route stored in the db -->
<!-- Each route has its own participants, which might be shown together with the description -->
<!-- Each route will have a "join/leave" button -->
<!-- Administrators can add a new route -->

<?php
	include "header.php";
	
	include "db/db_utils.php";

	$activities = getTable("actividades");
	$userplans = getTable("inscripciones");
	
	echo "<table><tr>";

/*
	foreach($activities["columns"] as $column) {
	  echo "<th>$column</th>";
	}*/

	echo "</tr>";

	foreach($activities["data"] as $row) {
  		echo '
  			<div>
  				<h1><a href="'.$row[url].'">'.$row[nombre].'</a></h1>
  				<h4>'.substr($row[fecha], 0, -7).'</h4>
  				<p>'.$row[descripcion].'</p>
  			</div>';
	}
	
	echo "</table>";
	
	include "footer.php";
?>
