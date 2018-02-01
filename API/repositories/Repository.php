<?php

abstract class Repository {
    protected $connection;

    function __CONSTRUCT($connection){
        $this->connection = $connection;
    }
}

?>