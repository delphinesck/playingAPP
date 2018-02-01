<?php

class PublisherRepository extends Repository {

    public function getAllPublishers(){
        $query = "SELECT * FROM publishers ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $publishers = [];
        foreach($result as $data){
            $publishers[] = new Publisher($data);
        }
        return $publishers;
    }
}