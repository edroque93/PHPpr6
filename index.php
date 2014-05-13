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
    // $db->exec(file_get_contents("create_mock.sql"));
?>
