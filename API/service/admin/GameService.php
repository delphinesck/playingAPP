<?php

class GameService {

    public function serviceGetAllGames(){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getGameRepository();
        $repo->getAllGames();
    }

    public function serviceCreateGame(){
        if( empty($_POST["title"]) ){

            $paramserror = "incomplete";
    
            if(isset($paramserror)){
                Flight::redirect('/admin/new_game?'.$paramserror);
            }
        }
    
        else {
            $title = $_POST["title"];
            $summary = $_POST["summary"];
            $timeto_beat = $_POST["timeto_beat"];
            $timeto_complete = $_POST["timeto_complete"];
            $total_chapters = $_POST["total_chapters"];
            $total_trophies = $_POST["total_trophies"];
            $release_jp = $_POST["release_jp"];
            $release_na = $_POST["release_na"];
            $release_eu = $_POST["release_eu"];
            $cover = $_POST["cover"];
            $banner = $_POST["banner"];
    
            $game = new Game();
            $game->setTitle($title);
            $game->setSummary($summary);
            $game->setTimeto_beat($timeto_beat);
            $game->setTimeto_complete($timeto_complete);
            $game->setTotal_chapters($total_chapters);
            $game->setTotal_trophies($total_trophies);
            $game->setRelease_jp($release_jp);
            $game->setRelease_na($release_na);
            $game->setRelease_eu($release_eu);
            $game->setCover($cover);
            $game->setBanner($banner);
    
            $bddmanager = new BddManager();
            $repo = $bddmanager->getGameRepository();
            $repo->createGame($game);
    
            Flight::redirect('/admin/games');
        }
    }

}
