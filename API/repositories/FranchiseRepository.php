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
}