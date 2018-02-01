<?php

class BddManager {
    private $connection;
    private $gameRepository;

    public function __CONSTRUCT(){
        $this->connection = Connection::getConnection();
        $this->gameRepository = new GameRepository(Connection::getConnection());
    }

    function getGameRepository(){
        return $this->gameRepository;
    }
}