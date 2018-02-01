<?php

class DeveloperRepository extends Repository {

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
}