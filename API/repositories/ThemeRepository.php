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

    /* CREATE A NEW THEME */
    public function createTheme(Theme $theme){
        $query = "INSERT INTO themes SET title=:title";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'title' => $theme->getTitle()
        ));
    }

    /* CHECK IF A THEME ALREADY EXISTS IN THE DATABASE */
    public function checkTitle(Theme $theme){
        $pdo = $this->connection->prepare("SELECT title FROM themes WHERE title=:title");
        $pdo->execute(array(
            'title' => $theme->getTitle()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

    /* DELETE ALL THEMES WITH THIS GAME ID */
    public function deleteThemesByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_themes WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK THEMES IN (games_themes) */
    public function checkThemes(Game $game){
        $themes_ids = $game->getThemes();
        
        /* SELECT ALL THE THEME_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($themes_ids as $key=>$theme_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_themes WHERE game_id=:game_id AND theme_id=:theme_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'theme_id' => $theme_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE THEME_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_themes SET game_id=:game_id, theme_id=:theme_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'theme_id' => $theme_id
                ));
            }
        }

        /* SELECT ALL THE THEME_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_themes WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE THEME_IDS */
        if(isset($content)){
            foreach($content as $the){
                $flag = false;
                /* DO NOTHING IF THE THEME HAS BEEN CHECKED */
                foreach($themes_ids as $key=>$theme_id){
                    if($the["theme_id"] == $theme_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_themes WHERE theme_id=:theme_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'theme_id' => $the["theme_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }
}