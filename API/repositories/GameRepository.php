<?php

class GameRepository extends Repository {

    /* GET ALL GAMES */
    public function getAllGames(){
        $query = "SELECT * FROM games";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $games = [];
        foreach($result as $data){
            $games[] = new Game($data);
        }
        return $games;
    }

    /* GET A GAME WITH ITS ID */
    public function getGameById($id){
        $pdo = $this->connection->prepare("SELECT * FROM games WHERE id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $game = $pdo->fetch(PDO::FETCH_ASSOC);

        return new Game($game);
    }

    /* CREATE A NEW GAME */
    public function createGame(Game $game){
        $query = "INSERT INTO games SET title=:title, 
                                        summary=:summary, 
                                        timeto_beat=:timeto_beat,
                                        timeto_complete=:timeto_complete,
                                        total_chapters=:total_chapters,
                                        total_trophies=:total_trophies,
                                        release_jp=:release_jp,
                                        release_na=:release_na,
                                        release_eu=:release_eu,
                                        cover=:cover,
                                        banner=:banner";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'title' => $game->getTitle(),
            'summary' => $game->getSummary(),
            'timeto_beat' => $game->getTimeto_beat(),
            'timeto_complete' => $game->getTimeto_complete(),
            'total_chapters' => $game->getTotal_chapters(),
            'total_trophies' => $game->getTotal_trophies(),
            'release_jp' => $game->getRelease_jp(),
            'release_na' => $game->getRelease_na(),
            'release_eu' => $game->getRelease_eu(),
            'cover' => $game->getCover(),
            'banner' => $game->getBanner()
        ));

        /* FIND THE CURRENT GAME'S ID TO INSERT THE FOLLOWING VALUES INTO THEIR RESPECTIVE TABLES */
        $pdo = $this->connection->prepare("SELECT id FROM games WHERE title=:title");
        $pdo->execute(array(
            'title' => $game->getTitle()
        ));
        $game_id = $pdo->fetch(PDO::FETCH_ASSOC);

        /* VERIFY IF BOXES HAVE BEEN CHECKED AND INSERT THE VALUES INTO THE RIGHT TABLES */
        if(!empty($game->getDevelopers())){
            foreach($game->getDevelopers() as $developer_id){
                $query = "INSERT INTO games_developers SET game_id=:game_id, developer_id=:developer_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'developer_id' => $developer_id
                ));
            }
        }

        if(!empty($game->getPublishers())){
            foreach($game->getPublishers() as $publisher_id){
                $query = "INSERT INTO games_publishers SET game_id=:game_id, publisher_id=:publisher_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'publisher_id' => $publisher_id
                ));
            }
        }

        if(!empty($game->getFranchises())){
            foreach($game->getFranchises() as $franchise_id){
                $query = "INSERT INTO games_franchises SET game_id=:game_id, franchise_id=:franchise_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'franchise_id' => $franchise_id
                ));
            }
        }

        if(!empty($game->getSystems())){
            foreach($game->getSystems() as $system_id){
                $query = "INSERT INTO games_systems SET game_id=:game_id, system_id=:system_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'system_id' => $system_id
                ));
            }
        }

        if(!empty($game->getLabels())){
            foreach($game->getLabels() as $label_id){
                $query = "INSERT INTO games_labels SET game_id=:game_id, label_id=:label_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'label_id' => $label_id
                ));
            }
        }

        if(!empty($game->getThemes())){
            foreach($game->getThemes() as $theme_id){
                $query = "INSERT INTO games_themes SET game_id=:game_id, theme_id=:theme_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game_id["id"],
                    'theme_id' => $theme_id
                ));
            }
        }
        
    }

    /* EDIT A GAME */
    public function editGame(Game $game){
        $prepared = $this->connection->prepare("UPDATE games 
                                                SET title=:title, 
                                                    summary=:summary, 
                                                    timeto_beat=:timeto_beat,
                                                    timeto_complete=:timeto_complete,
                                                    total_chapters=:total_chapters,
                                                    total_trophies=:total_trophies,
                                                    release_jp=:release_jp,
                                                    release_na=:release_na,
                                                    release_eu=:release_eu
                                                WHERE id=:id");
        $prepared->execute(array(
            'id' => $game->getId(),
            'title' => $game->getTitle(),
            'summary' => $game->getSummary(),
            'timeto_beat' => $game->getTimeto_beat(),
            'timeto_complete' => $game->getTimeto_complete(),
            'total_chapters' => $game->getTotal_chapters(),
            'total_trophies' => $game->getTotal_trophies(),
            'release_jp' => $game->getRelease_jp(),
            'release_na' => $game->getRelease_na(),
            'release_eu' => $game->getRelease_eu()
        ));

        /* VERIFY IF A NEW COVER HAS BEEN UPLOADED; IF NULL, DON'T UPDATE THE FILE */
        if($game->getCover() != null){
            $prepared = $this->connection->prepare("UPDATE games SET cover=:cover WHERE id=:id");
            $prepared->execute(array(
                'id' => $game->getId(),
                'cover' => $game->getCover()
            ));
        }

        /* VERIFY IF A NEW BANNER HAS BEEN UPLOADED; IF NULL, DON'T UPDATE THE FILE */
        if($game->getBanner() != null){
            $prepared = $this->connection->prepare("UPDATE games SET banner=:banner WHERE id=:id");
            $prepared->execute(array(
                'id' => $game->getId(),
                'banner' => $game->getBanner()
            ));
        }
    }

    /* CHECK IF A GAME ALREADY EXISTS IN THE DATABASE */
    public function checkTitle($title){
        $pdo = $this->connection->prepare("SELECT title FROM games WHERE title=:title");
        $pdo->execute(array(
            'title' => $title
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

    /* DELETE A GAME */
    public function deleteGame(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games WHERE id=:id");
        $prepared->execute(array(
            'id' => $game->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS DEVELOPER ID IN (games_developers) */
    public function deleteGamesByDeveloperId(Developer $developer){
        $prepared = $this->connection->prepare("DELETE FROM games_developers WHERE developer_id=:developer_id");
        $prepared->execute(array(
            'developer_id' => $developer->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS PUBLISHER ID IN (games_publishers) */
    public function deleteGamesByPublisherId(Publisher $publisher){
        $prepared = $this->connection->prepare("DELETE FROM games_publishers WHERE publisher_id=:publisher_id");
        $prepared->execute(array(
            'publisher_id' => $publisher->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS FRANCHISE ID IN (games_franchises) */
    public function deleteGamesByFranchiseId(Franchise $franchise){
        $prepared = $this->connection->prepare("DELETE FROM games_franchises WHERE franchise_id=:franchise_id");
        $prepared->execute(array(
            'franchise_id' => $franchise->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS SYSTEM ID IN (games_systems) */
    public function deleteGamesBySystemId(System $system){
        $prepared = $this->connection->prepare("DELETE FROM games_systems WHERE system_id=:system_id");
        $prepared->execute(array(
            'system_id' => $system->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS LABEL ID IN (games_labels) */
    public function deleteGamesByLabelId(Label $label){
        $prepared = $this->connection->prepare("DELETE FROM games_labels WHERE label_id=:label_id");
        $prepared->execute(array(
            'label_id' => $label->getId()
        ));
    }

    /* DELETE ALL GAMES WITH THIS THEME ID IN (games_themes) */
    public function deleteGamesByThemeId(Theme $theme){
        $prepared = $this->connection->prepare("DELETE FROM games_themes WHERE theme_id=:theme_id");
        $prepared->execute(array(
            'theme_id' => $theme->getId()
        ));
    }

}

?>