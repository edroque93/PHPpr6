<?php

	function getDB() {
		try {
			$path = $_SERVER['DOCUMENT_ROOT'];
			$db = new PDO("sqlite:$path/db/data.base");
			return($db);
		} catch (PDOException $e) {
			print "<p>Error: ".$e->getMessage()."</p>";
		}
	}
	
	$db = getDB();
	
	function getID($name, $table) {
		global $db;
		$result = $db->query("select id
							 from \"$table\"
							 where nombre=\"$name\"");
		
		return($result->fetch()["id"]);		
	}
	
?>
