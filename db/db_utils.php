<?php

	function getDB() {
		try {
			$db = new PDO("sqlite:./data.base");
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
