<?php

class DeveloperRepository extends Repository {

    /* GET ALL DEVELOPERS ORDERED BY NAME */
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

    /* GET ALL DEVELOPERS ORDERED BY ID */
    public function getAllDevelopersOrderedById(){
        $query = "SELECT * FROM developers ORDER BY id";
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

    /* CHECK IF A DEVELOPER ALREADY EXISTS IN THE DATABASE */
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

    /* DELETE ALL DEVELOPERS WITH THIS GAME ID */
    public function deleteDevelopersByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_developers WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK DEVELOPERS IN (games_developers) */
    public function checkDevelopers(Game $game){
        $developers_ids = $game->getDevelopers();
        
        /* SELECT ALL THE DEVELOPER_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($developers_ids as $key=>$developer_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_developers WHERE game_id=:game_id AND developer_id=:developer_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'developer_id' => $developer_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE DEVELOPER_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_developers SET game_id=:game_id, developer_id=:developer_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'developer_id' => $developer_id
                ));
            }
        }

        /* SELECT ALL THE DEVELOPER_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_developers WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE DEVELOPER_IDS */
        if(isset($content)){
            foreach($content as $dev){
                $flag = false;
                /* DO NOTHING IF THE DEVELOPER HAS BEEN CHECKED */
                foreach($developers_ids as $key=>$developer_id){
                    if($dev["developer_id"] == $developer_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_developers WHERE developer_id=:developer_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'developer_id' => $dev["developer_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }

    /* EDIT A DEVELOPER */
    public function editDeveloper(Developer $developer){
        $prepared = $this->connection->prepare("UPDATE developers SET name=:name WHERE id=:id");
        $prepared->execute(array(
            'id' => $developer->getId(),
            'name' => $developer->getName()
        ));
    }

    /* DELETE A DEVELOPER */
    public function deleteDeveloper(Developer $developer){
        $prepared = $this->connection->prepare("DELETE FROM developers WHERE id=:id");
        $prepared->execute(array(
            'id' => $developer->getId()
        ));
    }

}