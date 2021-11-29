<?php

// XAMP

define('SERVER_NAME', '127.0.0.1');
define('PORT', 3306);
define('DATABASE_NAME', 'beadando');
define('USER_NAME', 'root');
define('PASSWORD', '');



// ONLINE
/*
define('SERVER_NAME', 'localhost');
define('DATABASE_NAME', 'fekeztarhely');
define('USER_NAME', 'fekeztarhely');
define('PASSWORD', 'JC!Pia!GRsfX4Y8');
*/

class Database
{
    public static function getConnection(): PDO
    {
        $conn = new PDO(
            // XAMP
            
            'mysql:host=' . SERVER_NAME . ':' . PORT . ';dbname=' . DATABASE_NAME,
            USER_NAME, PASSWORD); 
            

            // ONLINE
            /*
            'mysql:host=' . SERVER_NAME . ';dbname=' . DATABASE_NAME,
            USER_NAME, PASSWORD);
            */

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
