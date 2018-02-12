<?php

class SystemRepository extends Repository {

    /* GET ALL SYSTEMS */
    public function getAllSystems(){
        $query = "SELECT * FROM systems ORDER BY full_name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $systems = [];
        foreach($result as $data){
            $systems[] = new System($data);
        }
        return $systems;
    }

    /* GET A GAME'S SYSTEMS */
    public function getSystemsByGameId($id){
        $pdo = $this->connection->prepare("SELECT system_id FROM games_systems WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $systems_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $systems_ids;
    }

    /* GET A SYSTEM WITH ITS ID */
    public function getSystemById($system_id){
        $pdo = $this->connection->prepare("SELECT * FROM systems WHERE id=:system_id");
        $pdo->execute(array(
            'system_id' => $system_id
        ));
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $system = [];
        foreach($result as $data){
            array_push($system, new System($data));
        }
        
        return $system[0];
    }
}