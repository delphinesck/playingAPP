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

    /* CREATE A NEW SYSTEM */
    public function createSystem(System $system){
        $query = "INSERT INTO systems SET   full_name=:full_name, 
                                            short_name=:short_name, 
                                            company=:company, 
                                            color_bg=:color_bg, 
                                            color_text=:color_text";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'full_name' => $system->getFull_name(),
            'short_name' => $system->getShort_name(),
            'company' => $system->getCompany(),
            'color_bg' => $system->getColor_bg(),
            'color_text' => $system->getColor_text()
        ));
    }

    /* CHECK IF ALREADY EXISTS */
    public function checkName(System $system){
        $pdo = $this->connection->prepare("SELECT full_name FROM systems WHERE full_name=:full_name");
        $pdo->execute(array(
            'full_name' => $system->getFull_name()
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