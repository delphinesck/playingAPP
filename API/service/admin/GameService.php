<?php

class GameService {
    private $error;

    /* GAME CREATION */
    public function serviceCreateGame(){
        /* ERROR MESSAGE IF THE TITLE AND SUMMARY ARE EMPTY (DOESN'T INSERT INTO THE DATABASE) */
        if(empty($_POST["title"])){
            $paramserror = "incomplete=1";
            if(isset($paramserror)){
                Flight::redirect('/admin/new_game?'.$paramserror);
            }
        }
    
        /* IF AT LEAST THE TITLE AND SUMMARY ARE ENTERED, THE GAME CAN BE INSERTED INTO THE DATABASE */
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
            if(!empty($_POST["developers"])){
                $developers = $_POST["developers"];
            }
            if(!empty($_POST["publishers"])){
                $publishers = $_POST["publishers"];
            }
            if(!empty($_POST["franchises"])){
                $franchises = $_POST["franchises"];
            }
            if(!empty($_POST["systems"])){
                $systems = $_POST["systems"];
            }
            if(!empty($_POST["labels"])){
                $labels = $_POST["labels"];
            }
            if(!empty($_POST["themes"])){
                $themes = $_POST["themes"];
            }
    
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
            if(!empty($developers)){
                $game->setDevelopers($developers);
            }
            if(!empty($publishers)){
                $game->setPublishers($publishers);
            }
            if(!empty($franchises)){
                $game->setFranchises($franchises);
            }
            if(!empty($systems)){
                $game->setSystems($systems);
            }
            if(!empty($labels)){
                $game->setLabels($labels);
            }
            if(!empty($themes)){
                $game->setThemes($themes);
            }

            /* COVER AND BANNER UPLOAD */
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

    /* FILE UPLOAD */
    public function dlFile($file){
        if(isset($file) && $file['error'] == 0){
            if($file['size'] <= 50000000 && $file['size'] > 10){
                $fileinfo = pathinfo($file['name']);
                $extension_upload = $fileinfo['extension'];
                $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($extension_upload, $allowed_extensions)){
                    $newName = hash('sha1',$file['name']).'.'.$extension_upload;
                    move_uploaded_file($file['tmp_name'], '/Applications/MAMP/htdocs/WWW/PlayingAPP/API/images/games/'.basename($newName));
                    $url = 'http://localhost:8888/WWW/PlayingAPP/API/images/games/'.basename($newName);
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

    /* GAME INFORMATIONS EDITION */
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

    /* GAME DELETION */
    public function serviceDeleteGame($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getGameRepository();
        $game = $repo->getGameById($id);
        $game = new Game();
        $game->setId($id);

        $repo->deleteGame($game);
    }

}
