<?php

class ThemeRepository extends Repository {

    /* GET ALL THEMES */
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

    /* GET A GAME'S THEMES */
    public function getThemesByGameId($id){
        $pdo = $this->connection->prepare("SELECT theme_id FROM games_themes WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $themes_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $themes_ids;
    }

    /* GET A THEME WITH ITS ID */
    public function getThemeById($theme_id){
        $pdo = $this->connection->prepare("SELECT * FROM themes WHERE id=:theme_id");
        $pdo->execute(array(
            'theme_id' => $theme_id
        ));
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $theme = [];
        foreach($result as $data){
            array_push($theme, new Theme($data));
        }
        
        return $theme[0];
    }
}