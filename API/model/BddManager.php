<?php

class BddManager {
    private $connection;
    private $gameRepository;

    public function __CONSTRUCT(){
        $this->connection = Connection::getConnection();
        $this->gameRepository = new GameRepository(Connection::getConnection());
        $this->developerRepository = new DeveloperRepository(Connection::getConnection());
        $this->publisherRepository = new PublisherRepository(Connection::getConnection());
        $this->franchiseRepository = new FranchiseRepository(Connection::getConnection());
        $this->systemRepository = new SystemRepository(Connection::getConnection());
        $this->labelRepository = new LabelRepository(Connection::getConnection());
        $this->themeRepository = new ThemeRepository(Connection::getConnection());
    }

    function getGameRepository(){
        return $this->gameRepository;
    }

    function getDeveloperRepository(){
        return $this->developerRepository;
    }

    function getPublisherRepository(){
        return $this->publisherRepository;
    }

    function getFranchiseRepository(){
        return $this->franchiseRepository;
    }

    function getSystemRepository(){
        return $this->systemRepository;
    }

    function getLabelRepository(){
        return $this->labelRepository;
    }

    function getThemeRepository(){
        return $this->themeRepository;
    }
}