<?php

class ThemeRepository extends Repository {

    public function getAllThemes(){
        $query = "SELECT * FROM themes ORDER BY title";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $themes = [];
        foreach($result as $data){
            $themes[] = new Theme($data);
        }
        return $themes;
    }
}