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

    /* GET ALL SYSTEMS ORDERED BY ID */
    public function getAllSystemsOrderedById(){
        $query = "SELECT * FROM systems ORDER BY id";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $systems = [];
        foreach($result as $data){
            $systems[] = new System($data);
        }
        return $systems;
    }

    // /* GET A GAME'S SYSTEMS */
    // public function getSystemsByGameId($id){
    //     $pdo = $this->connection->prepare("SELECT system_id FROM games_systems WHERE game_id=:id");
    //     $pdo->execute(array(
    //         'id' => $id
    //     ));
    //     $systems_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

    //     return $systems_ids;
    // }

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

    /* CHECK IF A SYSTEM ALREADY EXISTS IN THE DATABASE */
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

    /* DELETE ALL SYSTEMS WITH THIS GAME ID */
    public function deleteSystemsByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_systems WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK SYSTEMS IN (games_systems) */
    public function checkSystems(Game $game){
        $systems_ids = $game->getSystems();
        
        /* SELECT ALL THE SYSTEM_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($systems_ids as $key=>$system_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_systems WHERE game_id=:game_id AND system_id=:system_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'system_id' => $system_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE SYSTEM_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_systems SET game_id=:game_id, system_id=:system_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'system_id' => $system_id
                ));
            }
        }

        /* SELECT ALL THE SYSTEM_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_systems WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE SYSTEM_IDS */
        if(isset($content)){
            foreach($content as $sys){
                $flag = false;
                /* DO NOTHING IF THE SYSTEM HAS BEEN CHECKED */
                foreach($systems_ids as $key=>$system_id){
                    if($sys["system_id"] == $system_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_systems WHERE system_id=:system_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'system_id' => $sys["system_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }

    /* EDIT A SYSTEM */
    public function editSystem(System $system){
        $prepared = $this->connection->prepare("UPDATE systems 
                                                SET full_name=:full_name,
                                                short_name=:short_name,
                                                company=:company,
                                                color_bg=:color_bg,
                                                color_text=:color_text 
                                                WHERE id=:id");
        $prepared->execute(array(
            'id' => $system->getId(),
            'full_name' => $system->getFull_name(),
            'short_name' => $system->getShort_name(),
            'company' => $system->getCompany(),
            'color_bg' => $system->getColor_bg(),
            'color_text' => $system->getColor_text()
        ));
    }

    /* DELETE A SYSTEM */
    public function deleteSystem(System $system){
        $prepared = $this->connection->prepare("DELETE FROM systems WHERE id=:id");
        $prepared->execute(array(
            'id' => $system->getId()
        ));
    }
}