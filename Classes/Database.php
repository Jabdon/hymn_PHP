<?php

class Database {

    private static $connection ;
    private static $dsn = 'mysql:host=localhost;dbname=hymn' ;
    private static $user = 'root' ;
    private static $password = 'Morisset1' ;
    private static $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
        PDO::MYSQL_ATTR_FOUND_ROWS => true,
    );
    private $attributes = "" ;

    function __construct(){
        
    }

    public static function getConnection(){
        try {
            if (is_null(self::$connection) || empty(self::$connection)) {
                self::$connection = new PDO(self::$dsn, self::$user, self::$password, self::$options);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return self::$connection ;
    }


}
?>