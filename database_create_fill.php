<?php
    function initDB() {
        try {
            $db = new PDO("sqlite:./data.base");
            return($db);
        } catch (PDOException $e) {
            print '<p>Error: '.$e->getMessage().'</p>';
        }
    }

    $db = initDB();
    
    $db->exec(file_get_contents("create_database_structure.sql"));
    $db->exec(file_get_contents("create_mock.sql"));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Práctica 6 - PHP</title>
    </head>
    <body>
        <h1>Script de carga completado!</h1>   
    </body>
</html>
