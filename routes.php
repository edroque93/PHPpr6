<?php
	include "header.php";
	
	include "db/db_utils.php";

	$activities = getTable("actividades");
	$userplans = getTable("inscripciones");
	
	if(!isset($_SESSION)){
	    session_start();
	}

	foreach($activities["data"] as $row) {
  		echo '<div class="route">
				<h1><a href="'.$row['url'].'" target="_blank">'.$row['nombre'].'</a>';
  		
		if (isset($_SESSION["user"])) { // Only registered users
			$print = false;
			
			foreach($userplans["data"] as $plan) {
				if ($plan["actividad"] === $row["id"] && $plan["usuario"] === $_SESSION["user"]["id"]) {
					$print = true;
					break;
				}
			}
			
			if ($print) {
				echo '<img class="leave" src="img/leave.png" alt="Leave" />';
			} else {
				echo '<img class="join" src="img/join.png" alt="Join" />';
			}
  		}
  		
  		echo '</h1><h4>'.$row['fecha'].'</h4><p>'.$row['descripcion'].'</p>';
  				
  		if (isset($_SESSION["user"])) { // Only registered users
	  		echo '<h4>Inscritos:</h4><ul>';
  				
  			$someone = false;
  				
	  		foreach($userplans["data"] as $plan) {
				if ($plan["actividad"] === $row["id"]) {
					echo '<li><p>';
					echo getUserNameByID($plan["usuario"]);
					echo '</p></li>';
					$someone = true;
				}
			}
		
			if (!$someone) {
				echo '<li><p>Este podría ser tu nombre, ¡apúntate ya!</p></li>';		
			}
  				
	  		echo '</ul>';
  		}
  		
  		echo '</div>';
	}
	
	
	include "footer.php";
	
	$js = <<<SCRIPT
	<script>
	(function(){
		var join = function(){
			var form = document.createElement('form')
			  , method = 'post'
			  , path = '/actions/join_action.php'
			  , hiddenId = document.createElement('input');

			form.setAttribute('method',method);
			form.setAttribute('action',path);
			hiddenId.setAttribute('type','hidden');
			hiddenId.setAttribute('name','id');
			hiddenId.setAttribute('value', this.previousSibling.innerHTML);
			form.appendChild(hiddenId);
			document.body.appendChild(form);
			form.submit();
		}
		
		var leave = function(){
			var form = document.createElement('form')
			  , method = 'post'
			  , path = '/actions/leave_action.php'
			  , hiddenId = document.createElement('input');

			form.setAttribute('method',method);
			form.setAttribute('action',path);
			hiddenId.setAttribute('type','hidden');
			hiddenId.setAttribute('name','id');
			hiddenId.setAttribute('value', this.previousSibling.innerHTML);
			form.appendChild(hiddenId);
			document.body.appendChild(form);
			form.submit();
		}
		
		var elements = document.getElementsByClassName("join");
		for (var i=0; i<elements.length; i++)
			elements[i].onclick = join;
		var elements = document.getElementsByClassName("leave");
		for (var i=0; i<elements.length; i++)
			elements[i].onclick = leave;
	})();
	</script>
SCRIPT;

	echo $js;
?>
