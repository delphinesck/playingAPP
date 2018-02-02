<?php

class GameService {
    private $error;

    public function serviceCreateGame(){
        if(empty($_POST["title"])){

            $paramserror = "incomplete=1";
    
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
            $cover = $_FILES["cover"];
            $banner = $_FILES["banner"];
    
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

            $url = $this->dlFile($cover);
            if(empty($this->error)){
                $game->setCover($url);
            }
            $this->error = null;

            $url = $this->dlFile($banner);
            if(empty($this->error)){
                $game->setBanner($url);
            }
            $this->error = null;
    
            $bddmanager = new BddManager();
            $repo = $bddmanager->getGameRepository();
            $repo->createGame($game);
    
            Flight::redirect('/admin/games');
        }
    }

    public function dlFile($file){
        if(isset($file) && $file['error'] == 0){
            if($file['size'] <= 50000000 && $file['size'] > 10){
                $fileinfo = pathinfo($file['name']);
                $extension_upload = $fileinfo['extension'];
                $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($extension_upload, $allowed_extensions)){
                    $newName = hash('sha1',$file['name']).'.'.$extension_upload;
                    move_uploaded_file($file['tmp_name'], '/Applications/MAMP/htdocs/WWW/PlayingAPP/API/images/games/'.basename($newName));
                    $url = '/Applications/MAMP/htdocs/WWW/playingapp/API/images/games/'.basename($newName);
                    return $url;
                }
            }
            else{
                $this->error['size'] = 'This file is too big';
            }
        }
        else{
            $this->error['transfer'] = $file['error'];
        }
    }

    public function serviceEditGame($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getGameRepository();
        $game = $repo->getGameById($id);
        $game = new Game();
        $game->setId($id);
        $game->setTitle($_POST["title"]);
        $game->setSummary($_POST["summary"]);
        $game->setTimeto_beat($_POST["timeto_beat"]);
        $game->setTimeto_complete($_POST["timeto_complete"]);
        $game->setTotal_chapters($_POST["total_chapters"]);
        $game->setTotal_trophies($_POST["total_trophies"]);
        $game->setRelease_jp($_POST["release_jp"]);
        $game->setRelease_na($_POST["release_na"]);
        $game->setRelease_eu($_POST["release_eu"]);

        if(!empty($_FILES["cover"])){
            $url = $this->dlFile($_FILES["cover"]);
            if(empty($this->error)){
                $game->setCover($url);
            }
            $this->error = null;
        }

        if(!empty($_FILES["banner"])){
            $url = $this->dlFile($_FILES["banner"]);
            if(empty($this->error)){
                $game->setBanner($url);
            }
            $this->error = null;
        }

        $repo->editGame($game);
    }

    public function serviceDeleteGame($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getGameRepository();
        $game = $repo->getGameById($id);
        $game = new Game();
        $game->setId($id);

        $repo->deleteGame($game);
    }

}
