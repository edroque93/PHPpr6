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
	
	addUser("piratecat", md5("madzcat"), "Quique", "piratecat@mad.cat", 2);
	addUser("cabul", md5("winkwink"), "Calvin", "cabul@mad.net", 2);
	
	// Users
	
	addUser("user1", md5("imarobot"), "Federico", "user1@robot.es", 1);
	addUser("user2", md5("imbrobot"), "Paco", "paco@robot.es", 1);
	addUser("user3", md5("imcrobot"), "Juan Carlos", "juanca@robot.es", 1);
	addUser("user4", md5("imdrobot"), "José", "jose@robot.es", 1);
	addUser("user5", md5("imerobot"), "Alguien", "alguien@robot.es", 1);
	
	// Actividades
	
	addActivity("2014-04-02 10:35", "Roque Nublo",
				"Es uno de los Monumentos Naturales más representativos del Archipiélago y el 
				símbolo indiscutible de la isla de Gran Canaria y de sus habitantes. Los 
				excepcionales valores naturales de este monolito de origen erosivo y del 
				espacio natural que le rodea hacen de estos lugares centro de  visita obligada 
				para caminantes  y amantes de la naturaleza que en la pequeña red de senderos 
				que recorre este paraje singular encuentran otro motivo de intenso disfrute.", 
				"http://www.senderosdegrancanaria.com/6.html");
				
	addActivity("2014-04-12 16:00", "Bandama", 
				"Se trata de una caldera de explosión de más de 220 metros de profundidad. El 
				diámetro del borde superior de sus abruptas paredes de rocas fonolíticas, 
				coronadas por aglomerados Roque Nublo, es de unos 1.000 metros y su perímetro 
				supera los 3 kilómetros. El conjunto del Pico (574 msnm) y Caldera de Bandama 
				constituyen un muestrario de enorme valor científico. El Gobierno de Canarias 
				lo catalogó dentro de la extensa Red de Espacios Naturales Protegidos, otorgándole 
				la categoría de Monumento Natural. A su vez, el Instituto Tecnológico Geominero 
				de España lo declaró como punto de interés geológico.", 
				"http://www.medianias.org/senderos/es/santa_brigida_34.htm");
				
	addActivity("2014-04-09 07:30", "Aldea", 
				"La Meca para cualquier senderista en Gran Canaria, es conocer la Playa de Güigüi, 
				dentro del Macizo del mismo nombre, la ruta más conocida para llegar a la playa es 
				la de Tasartico, no obstante desde La Aldea, existen dos posibilidades para llegar 
				a la playa una vez pasada la Degollada de Güigüi Chico; la ruta larga, por la 
				Medialuna y la corta, la más habitual por el sendero de Güigüi Chico.", 
				"http://www.infonortedigital.com/portada/component/content/article/8468-la-aldea-medialuna-la-alddea");
				
	addActivity("2015-01-05 10:30", "Dunas de Maspalomas",
				"Con este nombre se conoce al principal núcleo turístico de la isla y a la famosa 
				playa que  constituye su mayor reclamo internacional, pero Maspalomas es también 
				uno de los espacios naturales más representativos del Archipiélago, declarado 
				Reserva Natural Especial y Lugar de Interés Comunitario (LIC) de la Red Natura 
				2000 europea. por su  excepcional valor científico y singular belleza.",
				"http://www.senderosdegrancanaria.com/8.html");
	
	addActivity("2014-09-13 08:30", "Pinar de Tamadaba",
				"El  antiquísimo macizo montañoso de Tamadaba-Altavista  situado en el noroeste de 
				la isla es sin duda uno de sus espacios naturales de mayor riqueza biológica y 
				paisajística que le han valido su declaración de Parque Natural, cuyo conocimiento 
				y disfrute justifican plenamente su visita a pesar de su  relativa lejanía de la 
				capital insular. Mientras que sus laderas noroccidentales son escarpadas, en gran 
				parte acantilados que se alzan a más de 1000 metros sobre el mar, su zona superior 
				se caracteriza por suaves lomas y llanos cubiertos de uno de los pinares naturales 
				más antiguos de Canarias.",
				"http://www.senderosdegrancanaria.com/9.html");
	
	// Inscripciones
	
	addInscription(getActivityID("Roque Nublo"), getUserID("Juan Carlos"));
	addInscription(getActivityID("Roque Nublo"), getUserID("Paco"));
	addInscription(getActivityID("Roque Nublo"), getUserID("José"));
	addInscription(getActivityID("Roque Nublo"), getUserID("Calvin"));
	addInscription(getActivityID("Bandama"), getUserID("Quique"));
	addInscription(getActivityID("Bandama"), getUserID("Calvin"));
	addInscription(getActivityID("Aldea"), getUserID("Federico"));
	
	print "<p>Script completed</p>";
?>
