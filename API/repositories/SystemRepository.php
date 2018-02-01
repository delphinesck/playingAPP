<?php

class SystemRepository extends Repository {

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
}