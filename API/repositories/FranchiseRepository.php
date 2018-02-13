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

    /* CHECK IF ALREADY EXISTS */
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
}