<?php

class FranchiseRepository extends Repository {

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
}