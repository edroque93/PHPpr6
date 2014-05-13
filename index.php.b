<!-- Opera is so weird and fun http://[::1]:8000/ -->

<?php
    function initDB() {
        try {
            $db = new PDO("sqlite:./data.base");
            return($db);
        } catch (PDOException $e) {
            print '<p>Error: '.$e->getMessage().'</p>';
        }
    }

    $db = initDB(); // ould not find driver....
    
    $db->exec("CREATE TABLE IF NOT EXISTS messages (
                    id INTEGER PRIMARY KEY, 
                    title TEXT, 
                    message TEXT, 
                    time INTEGER)");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Práctica 6 - PHP</title>
    </head>
    <body>
        <h1>Práctica 6</h1>   

         <!-- <?php phpinfo(); ?> -->
    </body>
</html>
