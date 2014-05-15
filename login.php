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
	
	session_start();
	
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	
	$query = "select * from usuarios";
	
	print $query;
	


	$result = $db->query($query);
	
	print $result->rowCount()."\n";
	
	if ($result->rowCount() == 1) {
		$_SESSION['user'] = $result->fetch();
		
		print $_SESSION['user']['id'];
	} else {
		print "nope.";
	}

	//header("Location: index.php");
?>
