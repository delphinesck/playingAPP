<?php

class Connection {
    static $connection = null;

    static function getConnection(){
        if(self::$connection){
            return self::$connection;
        }
        else {
            self::$connection = new PDO(
                "mysql:dbname=playingapp;host=localhost",
                "root",
                "root"
            );
            return self::$connection;
        }
    }

    private function __CONSTRUCT(){
    }
}

?>