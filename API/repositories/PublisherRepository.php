<?php

class PublisherRepository extends Repository {

    /* GET ALL PUBLISHERS */
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

    /* GET A GAME'S PUBLISHERS */
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
}