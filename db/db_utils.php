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


  // devuelve un array
  // columns: array con los nombres de las columnas
  // data: array con
  //   array con los datos
  function getTable($table) {
    global $db;
    $col_names = $db->query("PRAGMA table_info($table)");
    $columns = array();
    foreach($col_names as $col){
      $columns[] = $col[1];
    }
    $data = $db->query("select * from $table")->fetchAll();
    return array("columns" => $columns,"data" => $data);
  }
	
?>
