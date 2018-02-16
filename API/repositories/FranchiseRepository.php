<?php

class FranchiseRepository extends Repository {

    /* GET ALL FRANCHISES */
    public function getAllFranchises(){
        $query = "SELECT * FROM franchises ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $franchises = [];
        foreach($result as $data){
            $franchises[] = new Franchise($data);
        }
        return $franchises;
    }

    /* GET ALL FRANCHISES ORDERED BY ID */
    public function getAllFranchisesOrderedById(){
        $query = "SELECT * FROM franchises ORDER BY id";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $franchises = [];
        foreach($result as $data){
            $franchises[] = new Franchise($data);
        }
        return $franchises;
    }

    /* GET A GAME'S FRANCHISES */
    public function getFranchisesByGameId($id){
        $pdo = $this->connection->prepare("SELECT franchise_id FROM games_franchises WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $franchises_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $franchises_ids;
    }

    /* GET A FRANCHISE WITH ITS ID */
    public function getFranchiseById($franchise_id){
        $pdo = $this->connection->prepare("SELECT name FROM franchises WHERE id=:franchise_id");
        $pdo->execute(array(
            'franchise_id' => $franchise_id
        ));
        $franchise = $pdo->fetch(PDO::FETCH_ASSOC);
        
        return new Franchise($franchise);
    }

    /* CREATE A NEW FRANCHISE */
    public function createFranchise(Franchise $franchise){
        $query = "INSERT INTO franchises SET name=:name";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'name' => $franchise->getName()
        ));
    }

    /* CHECK IF A FRANCHISE ALREADY EXISTS IN THE DATABASE */
    public function checkName(Franchise $franchise){
        $pdo = $this->connection->prepare("SELECT name FROM franchises WHERE name=:name");
        $pdo->execute(array(
            'name' => $franchise->getName()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

    /* DELETE ALL FRANCHISES WITH THIS GAME ID */
    public function deleteFranchisesByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_franchises WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK FRANCHISES IN (games_franchises) */
    public function checkFranchises(Game $game){
        $franchises_ids = $game->getFranchises();
        
        /* SELECT ALL THE FRANCHISE_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($franchises_ids as $key=>$franchise_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_franchises WHERE game_id=:game_id AND franchise_id=:franchise_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'franchise_id' => $franchise_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE FRANCHISE_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_franchises SET game_id=:game_id, franchise_id=:franchise_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'franchise_id' => $franchise_id
                ));
            }
        }

        /* SELECT ALL THE FRANCHISE_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_franchises WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE FRANCHISE_IDS */
        if(isset($content)){
            foreach($content as $fra){
                $flag = false;
                /* DO NOTHING IF THE FRANCHISE HAS BEEN CHECKED */
                foreach($franchises_ids as $key=>$franchise_id){
                    if($fra["franchise_id"] == $franchise_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_franchises WHERE franchise_id=:franchise_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'franchise_id' => $fra["franchise_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }

    /* EDIT A FRANCHISE */
    public function editFranchise(Franchise $franchise){
        $prepared = $this->connection->prepare("UPDATE franchises SET name=:name WHERE id=:id");
        $prepared->execute(array(
            'id' => $franchise->getId(),
            'name' => $franchise->getName()
        ));
    }

    /* DELETE A FRANCHISE */
    public function deleteFranchise(Franchise $franchise){
        $prepared = $this->connection->prepare("DELETE FROM franchises WHERE id=:id");
        $prepared->execute(array(
            'id' => $franchise->getId()
        ));
    }
}