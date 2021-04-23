<?php

class DBHandler {
    private  $db;
    //once you call the function it creates a connection
    function __construct() {
        $this->connect_database();
    }
    public function getInstance() {
        return $this->db;
    }
    private function connect_database() {
        define('USER', 'root');
        define('PASSWORD', '');
        // Database connection
        try {
            $connection_string = 'mysql:host=localhost;dbname=ezcut;charset=utf8';
            $connection_array = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $this->db = new PDO($connection_string, USER, PASSWORD, $connection_array);
        }
        catch(PDOException $e) {
            $this->db = null;
        }
    }
}

?>
