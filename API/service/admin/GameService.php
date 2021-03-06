<?php

class GameService {
    private $error;

    /* CREATE A GAME */
    public function serviceCreateGame(){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getGameRepository();

        /* ERROR MESSAGE IF THE TITLE AND SUMMARY ARE EMPTY (DOESN'T INSERT INTO THE DATABASE) */
        if(empty($_POST["title"])){
            $paramserror = "incomplete=1";
            if(isset($paramserror)){
                Flight::redirect('/admin/new_game?'.$paramserror);
            }
        }

        /* CHECK IF THE GAME ALREADY EXISTS */
        $result = $repo->checkTitle($_POST["title"]);
        if($result == false){
            /* IF AT LEAST THE TITLE AND SUMMARY ARE ENTERED, THE GAME CAN BE INSERTED INTO THE DATABASE */
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
    

            $repo->createGame($game);
        }

        else{
            if(empty($errors)){
                $errors = "?error=1";
            }
            $errors .= "&title=" . $_POST["title"];
        }

        if(isset($errors)){
            Flight::redirect('/admin/new_game' . $errors);
        }

        else{
            Flight::redirect('/admin/games');
        }
    }

    /* UPLOAD A FILE */
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

    /* EDIT A GAME */
    public function serviceEditGame($id){
        $bddmanager = new BddManager();
        $repoGame = $bddmanager->getGameRepository();
        $game = $repoGame->getGameById($id);
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

        /* CHECK DEVELOPERS */
        $repoDeveloper = $bddmanager->getDeveloperRepository();
        $developers_ids_db = $repoDeveloper->getDevelopersByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["developers"])){
            $game->setDevelopers($_POST["developers"]);
            $developers = $repoDeveloper->checkDevelopers($game);
        }
        /* IF NOT, DELETE ALL DEVELOPERS ASSOCIATED TO THE GAME ID IN (games_developers) */
        else{
            $repoDeveloper->deleteDevelopersByGameId($game);
        }

        /* CHECK PUBLISHERS */
        $repoPublisher = $bddmanager->getPublisherRepository();
        $publishers_ids_db = $repoPublisher->getPublishersByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["publishers"])){
            $game->setPublishers($_POST["publishers"]);
            $publishers = $repoPublisher->checkPublishers($game);
        }
        /* IF NOT, DELETE ALL PUBLISHERS ASSOCIATED TO THE GAME ID IN (games_publishers) */
        else{
            $repoPublisher->deletePublishersByGameId($game);
        }

        /* CHECK FRANCHISE */
        $repoFranchise = $bddmanager->getFranchiseRepository();
        $franchises_ids_db = $repoFranchise->getFranchisesByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["franchises"])){
            $game->setFranchises($_POST["franchises"]);
            $franchises = $repoFranchise->checkFranchises($game);
        }
        /* IF NOT, DELETE ALL FRANCHISES ASSOCIATED TO THE GAME ID IN (games_franchises) */
        else{
            $repoFranchise->deleteFranchisesByGameId($game);
        }

        /* CHECK SYSTEMS */
        $repoSystem = $bddmanager->getSystemRepository();
        $systems_ids_db = $repoSystem->getSystemsByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["systems"])){
            $game->setSystems($_POST["systems"]);
            $systems = $repoSystem->checkSystems($game);
        }
        /* IF NOT, DELETE ALL SYSTEMS ASSOCIATED TO THE GAME ID IN (games_systems) */
        else{
            $repoSystem->deleteSystemsByGameId($game);
        }

        /* CHECK LABELS */
        $repoLabel = $bddmanager->getLabelRepository();
        $labels_ids_db = $repoLabel->getLabelsByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["labels"])){
            $game->setLabels($_POST["labels"]);
            $labels = $repoLabel->checkLabels($game);
        }
        /* IF NOT, DELETE ALL LABELS ASSOCIATED TO THE GAME ID IN (games_labels) */
        else{
            $repoLabel->deleteLabelsByGameId($game);
        }

        /* CHECK THEMES */
        $repoTheme = $bddmanager->getThemeRepository();
        $themes_ids_db = $repoTheme->getThemesByGameId($id);
        /* CHECK IF CHECKBOXES HAVE BEEN CHECKED */
        if(isset($_POST["themes"])){
            $game->setThemes($_POST["themes"]);
            $themes = $repoTheme->checkThemes($game);
        }
        /* IF NOT, DELETE ALL THEMES ASSOCIATED TO THE GAME ID IN (games_themes) */
        else{
            $repoTheme->deleteThemesByGameId($game);
        }

        /* COVER AND BANNER EDITION IF FILES HAVE BEEN UPLOADED */
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

        $repoGame->editGame($game);
    }

    /* DELETE A GAME */
    public function serviceDeleteGame($id){
        $bddmanager = new BddManager();
        $repoGame = $bddmanager->getGameRepository();
        $game = $repoGame->getGameById($id);
        $game = new Game();
        $game->setId($id);

        /* DELETE ATTRIBUTES ASSOCIATED TO THE GAME IN (games_xxx) */
        $repoDeveloper = $bddmanager->getDeveloperRepository();
        $repoDeveloper->deleteDevelopersByGameId($game);

        $repoPublisher = $bddmanager->getPublisherRepository();
        $repoPublisher->deletePublishersByGameId($game);

        $repoFranchise = $bddmanager->getFranchiseRepository();
        $repoFranchise->deleteFranchisesByGameId($game);

        $repoSystem = $bddmanager->getSystemRepository();
        $repoSystem->deleteSystemsByGameId($game);

        $repoLabel = $bddmanager->getLabelRepository();
        $repoLabel->deleteLabelsByGameId($game);

        $repoTheme = $bddmanager->getThemeRepository();
        $repoTheme->deleteThemesByGameId($game);

        /* DELETE THE GAME */
        $repoGame->deleteGame($game);
    }

}
