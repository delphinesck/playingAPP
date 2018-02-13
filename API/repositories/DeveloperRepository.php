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

    /* CREATE A NEW DEVELOPER */
    public function createDeveloper(Developer $developer){
        $query = "INSERT INTO developers SET name=:name";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'name' => $developer->getName()
        ));
    }

    /* CHECK IF ALREADY EXISTS */
    public function checkName(Developer $developer){
        $pdo = $this->connection->prepare("SELECT name FROM developers WHERE name=:name");
        $pdo->execute(array(
            'name' => $developer->getName()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }
}