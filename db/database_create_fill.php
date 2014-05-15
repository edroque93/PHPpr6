<?php
	function getDB() {
		try {
			$db = new PDO("sqlite:./data.base");
			return($db);
		} catch (PDOException $e) {
			print "<p>Error: ".$e->getMessage()."</p>";
		}
	}
	
	function addUser($acc, $passwd, $user, $mail, $type) {
		global $db;
		$db->exec("insert into usuarios(identificador, clave, nombre, email, tipo) 
					values ( 
						\"$acc\", 
						\"$passwd\", 
						\"$user\", 
						\"$mail\", 
						$type
					);");
	}
	
	function addActivity($date, $name, $details, $URL) {
		global $db;
		$db->exec("insert into actividades(fecha, nombre, descripcion, url) 
					values ( 
						\"$date\", 
						\"$name\", 
						\"$details\", 
						\"$URL\"
					);");
	}
	
	function addInscription($activityID, $userID) {
		global $db;
		$db->exec("insert into inscripciones(actividad, usuario) 
					values ( 
						\"$activityID\", 
						\"$userID\"
					);");
	}
	
	function getUserID($name) {
		global $db;
		$result = $db->query("select id from usuarios where nombre=\"$name\"");
		
		return($result->fetch()["id"]);
	}
	
	function getActivityID($name) {
		global $db;
		$result = $db->query("select id from actividades where nombre=\"$name\"");
		
		return($result->fetch()["id"]);
	}

	$db = getDB();
	
	// DB structure
	
	$db->exec(file_get_contents("create_database_structure.sql"));
	
	// Admins
	
	addUser("piratecat", md5("madzcat"), "Quique", "piratecat@mad.cat", 0);
	addUser("cabul", md5("winkwink"), "Calvin", "cabul@mad.net", 0);
	
	// Users
	
	addUser("user1", md5("imarobot"), "Federico", "user1@robot.es", 1);
	addUser("user2", md5("imbrobot"), "Paco", "paco@robot.es", 1);
	addUser("user3", md5("imcrobot"), "Juan Carlos", "juanca@robot.es", 1);
	addUser("user4", md5("imdrobot"), "José", "jose@robot.es", 1);
	addUser("user5", md5("imerobot"), "Alguien", "alguien@robot.es", 1);
	
	// Actividades
	
	addActivity("2014-04-02 10:35:00.000", "Roque Nublo", "Paseo por la cumbre...", "roquenublo.html");
	addActivity("2014-04-12 16:00:00.000", "Bandama", "Paseo por bandama...", "bandama.html");
	addActivity("2014-04-09 07:30:00.000", "Aldea", "Caminata por la aldea...", "aldea.html");
	
	// Inscripciones
	
	addInscription(getActivityID("Roque Nublo"), getUserID("Juan Carlos"));
	addInscription(getActivityID("Roque Nublo"), getUserID("Paco"));
	addInscription(getActivityID("Roque Nublo"), getUserID("José"));
	addInscription(getActivityID("Roque Nublo"), getUserID("Calvin"));
	addInscription(getActivityID("Aldea"), getUserID("Quique"));
	addInscription(getActivityID("Aldea"), getUserID("Calvin"));
	addInscription(getActivityID("Bandama"), getUserID("Federico"));
	
	print "<p>Script completed</p>";
?>
