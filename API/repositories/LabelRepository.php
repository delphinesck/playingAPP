<?php

class LabelRepository extends Repository {

    public function getAllLabels(){
        $query = "SELECT * FROM labels ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $labels = [];
        foreach($result as $data){
            $labels[] = new Label($data);
        }
        return $labels;
    }
}