<?php

class PublisherRepository extends Repository {

    /* GET ALL PUBLISHERS ORDERED BY NAME */
    public function getAllPublishers(){
        $query = "SELECT * FROM publishers ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $publishers = [];
        foreach($result as $data){
            $publishers[] = new Publisher($data);
        }
        return $publishers;
    }

    /* GET ALL PUBLISHERS ORDERED BY ID */
    public function getAllPublishersOrderedById(){
        $query = "SELECT * FROM publishers ORDER BY id";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $publishers = [];
        foreach($result as $data){
            $publishers[] = new Publisher($data);
        }
        return $publishers;
    }

    /* GET A GAME'S PUBLISHERS IDS */
    public function getPublishersByGameId($id){
        $pdo = $this->connection->prepare("SELECT publisher_id FROM games_publishers WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $publishers_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $publishers_ids;
    }

    /* GET A PUBLISHER WITH ITS ID */
    public function getPublisherById($publisher_id){
        $pdo = $this->connection->prepare("SELECT name FROM publishers WHERE id=:publisher_id");
        $pdo->execute(array(
            'publisher_id' => $publisher_id
        ));
        $publisher = $pdo->fetch(PDO::FETCH_ASSOC);
        
        return new Publisher($publisher);
    }

    /* CREATE A NEW PUBLISHER */
    public function createPublisher(Publisher $publisher){
        $query = "INSERT INTO publishers SET name=:name";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'name' => $publisher->getName()
        ));
    }

    /* CHECK IF A PUBLISHER ALREADY EXISTS IN THE DATABASE */
    public function checkName(Publisher $publisher){
        $pdo = $this->connection->prepare("SELECT name FROM publishers WHERE name=:name");
        $pdo->execute(array(
            'name' => $publisher->getName()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

    /* DELETE ALL PUBLISHERS WITH THIS GAME ID */
    public function deletePublishersByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_publishers WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK PUBLISHERS IN (games_publishers) */
    public function checkPublishers(Game $game){
        $publishers_ids = $game->getPublishers();

        /* SELECT ALL THE PUBLISHER_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($publishers_ids as $key=>$publisher_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_publishers WHERE game_id=:game_id AND publisher_id=:publisher_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'publisher_id' => $publisher_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE PUBLISHER_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_publishers SET game_id=:game_id, publisher_id=:publisher_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'publisher_id' => $publisher_id
                ));
            }
        }

        /* SELECT ALL THE PUBLISHER_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_publishers WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE PUBLISHER_IDS */
        if(isset($content)){
            foreach($content as $pub){
                $flag = false;
                /* DO NOTHING IF THE PUBLISHER HAS BEEN CHECKED */
                foreach($publishers_ids as $key=>$publisher_id){
                    if($pub["publisher_id"] == $publisher_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_publishers WHERE publisher_id=:publisher_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'publisher_id' => $pub["publisher_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }

    /* EDIT A PUBLISHER */
    public function editPublisher(Publisher $publisher){
        $prepared = $this->connection->prepare("UPDATE publishers SET name=:name WHERE id=:id");
        $prepared->execute(array(
            'id' => $publisher->getId(),
            'name' => $publisher->getName()
        ));
    }

    /* DELETE A PUBLISHER */
    public function deletePublisher(Publisher $publisher){
        $prepared = $this->connection->prepare("DELETE FROM publishers WHERE id=:id");
        $prepared->execute(array(
            'id' => $publisher->getId()
        ));
    }
}