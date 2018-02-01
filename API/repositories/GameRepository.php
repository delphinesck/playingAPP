<?php

class GameRepository extends Repository {

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
        return $pdo->rowCount();
    }

}

?>