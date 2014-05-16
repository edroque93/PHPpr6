<?php
	include "header.php";
	
	include "db/db_utils.php";

	$activities = getTable("actividades");
	$userplans = getTable("inscripciones");
	
	echo "<table><tr>";

	echo "</tr>";
	
	session_start();
	

	foreach($activities["data"] as $row) {
  		echo '
  			<div>
  				<h1><a href="'.$row[url].'">'.$row[nombre].'</a>';
  		
		if (isset($_SESSION["user"])) {
			$print = false;
			
			foreach($userplans["data"] as $plan) {
				if ($plan["actividad"] === $row["id"] && $plan["usuario"] === $_SESSION["user"]["id"]) {
					$print = true;
					break;
				}
			}
			
			if ($print) {
				echo '<img class="joinleave" src="img/leave.png" alt="Leave" />';
			} else {
				echo '<img class="joinleave" src="img/join.png" alt="Join" />';
			}
  		}
  		
  		echo '</h1>
  				<h4>'.substr($row[fecha], 0, -7).'</h4>
  				<p>'.$row[descripcion].'</p>
  			</div>';
	}
	
	echo "</table>";
	
	include "footer.php";
?>
