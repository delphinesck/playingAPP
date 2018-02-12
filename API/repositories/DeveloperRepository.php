<?php

class DeveloperRepository extends Repository {

    /* GET ALL DEVELOPERS */
    public function getAllDevelopers(){
        $query = "SELECT * FROM developers ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $developers = [];
        foreach($result as $data){
            $developers[] = new Developer($data);
        }
        return $developers;
    }

    /* GET A GAME'S DEVELOPERS */
    public function getDevelopersByGameId($id){
        $pdo = $this->connection->prepare("SELECT developer_id FROM games_developers WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $developers_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $developers_ids;
    }

    /* GET A DEVELOPER WITH ITS ID */
    public function getDeveloperById($developer_id){
        $pdo = $this->connection->prepare("SELECT name FROM developers WHERE id=:developer_id");
        $pdo->execute(array(
            'developer_id' => $developer_id
        ));
        $developer = $pdo->fetch(PDO::FETCH_ASSOC);
        
        return new Developer($developer);
    }
}