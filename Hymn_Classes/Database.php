<?php

class Database {

    private connection ;
    private $dsn = "mysql:host=localhost;dbname=HYMN" ;
    private $user = "root" ;
    private $password = "Morisset1" ;
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    private $attributes = "" ;

    function __construct(){
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {
                $this->_connection = new \PDO($this->dsn, $this->user, $this->password);
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }
    }

    public function connect(){
        return $this->_connection ? $this->_connection : null;
    }


}
?>