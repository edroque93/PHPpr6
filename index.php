<?php
	// Something...
	
	$something = "Lorem ipsum... y tal.";
	
	/*
	
		TO-DO:
		
			- DB module (eg: include "db_mngmnt.php")
			-- Care @lilbobbytables

			- Site
			-- Login block
			--- User menu
			--- Admin menu
			-- Frontpage design
			-- Routes (at least 3, see mockup)
			-- About page
			
			- much research, so hard, wow php
		
	*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Práctica 6 - PHP</title>
    </head>
    <body>
    	<!-- Magic link -->
    	
        <a href="database_create_fill.php" target="_blank">Genera BD</a>
        
        <!-- Site -->

        <h1>Práctica 6</h1>
        <p><?php echo $something; ?></p>
    </body>
</html>
