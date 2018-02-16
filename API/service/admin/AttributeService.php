<?php

class AttributeService {

    /* ATTRIBUTES CREATION */
    public function serviceCreateAttribute(){
        $bddmanager = new BddManager();

        /* DEVELOPER */
        if(!empty($_POST["developer"])){
            $developer_name = $_POST["developer"];
            $developer = new Developer();
            $developer->setName($developer_name);
            $repoDeveloper = $bddmanager->getDeveloperRepository();

            /* CHECK IF DEVELOPER ALREADY EXISTS */
            $result = $repoDeveloper->checkName($developer);
            if($result == false){
                $repoDeveloper->createDeveloper($developer);
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&developer=" . $developer->getName();
            }
        }

        /* PUBLISHER */
        if(!empty($_POST["publisher"])){
            $publisher_name = $_POST["publisher"];
            $publisher = new Publisher();
            $publisher->setName($publisher_name);
            $repoPublisher = $bddmanager->getPublisherRepository();

            /* CHECK IF PUBLISHER ALREADY EXISTS */
            $result = $repoPublisher->checkName($publisher);
            if($result == false){
                $repoPublisher->createPublisher($publisher);
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&publisher=" . $publisher->getName();
            }
        }

        /* FRANCHISE */
        if(!empty($_POST["franchise"])){
            $franchise_name = $_POST["franchise"];
            $franchise = new Franchise();
            $franchise->setName($franchise_name);
            $repoFranchise = $bddmanager->getFranchiseRepository();

            /* CHECK IF FRANCHISE ALREADY EXISTS */
            $result = $repoFranchise->checkName($franchise);
            if($result == false){
                $repoFranchise->createFranchise($franchise);
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&franchise=" . $franchise->getName();
            }
        }

        /* THEME */
        if(!empty($_POST["theme"])){
            $theme_title = $_POST["theme"];
            $theme = new Theme();
            $theme->setTitle($theme_title);
            $repoTheme = $bddmanager->getThemeRepository();

            /* CHECK IF THEME ALREADY EXISTS */
            $result = $repoTheme->checkTitle($theme);
            if($result == false){
                $repoTheme->createTheme($theme);
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&theme=" . $theme->getTitle();
            }
        }

        /* LABEL */
        if(!empty($_POST["label_name"])){
            $label_name = $_POST["label_name"];
            $label_description = $_POST["label_description"];

            /* CHECK IF DETAILS HAVE BEEN ENTERED */
            if(!empty($_POST["label_description"])){
                $label = new Label();
                $label->setName($label_name);
                $label->setDescription($label_description);
                $repoLabel = $bddmanager->getLabelRepository();
                
                /* CHECK IF LABEL ALREADY EXISTS */
                $result = $repoLabel->checkName($label);
                if($result == false){
                    $repoLabel->createLabel($label);
                }
    
                else{
                    if(empty($errors)){
                        $errors = "?error=1";
                    }
                    $errors .= "&label=" . $label->getName();
                }
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&label_description=false";
            }
        }

        /* SYSTEM */
        if(!empty($_POST["system_fullname"])) {
            $system_fullname = $_POST["system_fullname"];
            $system_shortname = $_POST["system_shortname"];
            $system_company = $_POST["system_company"];
            $system_colorbg = $_POST["system_colorbg"];
            $system_colortext = $_POST["system_colortext"];

            /* CHECK IF DETAILS HAVE BEEN ENTERED */
            if( !empty($_POST["system_shortname"]) && 
                !empty($_POST["system_company"]) && 
                !empty($_POST["system_colorbg"]) && 
                !empty($_POST["system_colortext"])){
                $system = new System();
                $system->setFull_name($system_fullname);
                $system->setShort_name($system_shortname);
                $system->setCompany($system_company);
                $system->setColor_bg($system_colorbg);
                $system->setColor_text($system_colortext);
                $repoSystem = $bddmanager->getSystemRepository();

                /* CHECK IF SYSTEM ALREADY EXISTS */
                $result = $repoSystem->checkName($system);
                if($result == false){
                    $repoSystem->createSystem($system);
                }
    
                else{
                    if(empty($errors)){
                        $errors = "?error=1";
                    }
                    $errors .= "&system=" . $system->getFull_name();
                }
            }

            else{
                if(empty($errors)){
                    $errors = "?error=1";
                }
                $errors .= "&system_description=false";
            }
        }

        if(isset($errors)){
            Flight::redirect('/admin/new_attribute' . $errors);
        }

        else{
            Flight::redirect('/admin/games');
        }
    }

    /* EDIT A DEVELOPER */
    public function serviceEditDeveloper($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getDeveloperRepository();
        $developer = $repo->getDeveloperById($id);
        $developer = new Developer();
        $developer->setId($id);
        $developer->setName($_POST["name"]);

        $repo->editDeveloper($developer);
    }

    /* DELETE A DEVELOPER */
    public function serviceDeleteDeveloper($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getDeveloperRepository();
        $developer = $repo->getDeveloperById($id);
        $developer = new Developer();
        $developer->setId($id);

        $repo->deleteDeveloper($developer);
    }

    /* EDIT A PUBLISHER */
    public function serviceEditPublisher($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getPublisherRepository();
        $publisher = $repo->getPublisherById($id);
        $publisher = new Publisher();
        $publisher->setId($id);
        $publisher->setName($_POST["name"]);

        $repo->editPublisher($publisher);
    }

    /* DELETE A PUBLISHER */
    public function serviceDeletePublisher($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getPublisherRepository();
        $publisher = $repo->getPublisherById($id);
        $publisher = new Publisher();
        $publisher->setId($id);

        $repo->deletePublisher($publisher);
    }

    /* EDIT A FRANCHISE */
    public function serviceEditFranchise($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getFranchiseRepository();
        $franchise = $repo->getFranchiseById($id);
        $franchise = new Franchise();
        $franchise->setId($id);
        $franchise->setName($_POST["name"]);

        $repo->editFranchise($franchise);
    }

    /* DELETE A FRANCHISE */
    public function serviceDeleteFranchise($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getFranchiseRepository();
        $franchise = $repo->getFranchiseById($id);
        $franchise = new Franchise();
        $franchise->setId($id);

        $repo->deleteFranchise($franchise);
    }

    /* EDIT A SYSTEM */
    public function serviceEditSystem($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getSystemRepository();
        $system = $repo->getSystemById($id);
        $system = new System();
        $system->setId($id);
        $system->setFull_name($_POST["full_name"]);
        $system->setShort_name($_POST["short_name"]);
        $system->setCompany($_POST["company"]);
        $system->setColor_bg($_POST["color_bg"]);
        $system->setColor_text($_POST["color_text"]);

        $repo->editSystem($system);
    }

    /* DELETE A SYSTEM */
    public function serviceDeleteSystem($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getSystemRepository();
        $system = $repo->getSystemById($id);
        $system = new System();
        $system->setId($id);

        $repo->deleteSystem($system);
    }

    /* EDIT A LABEL */
    public function serviceEditLabel($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getLabelRepository();
        $label = $repo->getLabelById($id);
        $label = new Label();
        $label->setId($id);
        $label->setName($_POST["name"]);
        $label->setDescription($_POST["description"]);

        $repo->editLabel($label);
    }

    /* DELETE A LABEL */
    public function serviceDeleteLabel($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getLabelRepository();
        $label = $repo->getLabelById($id);
        $label = new Label();
        $label->setId($id);

        $repo->deleteLabel($label);
    }

    /* EDIT A THEME */
    public function serviceEditTheme($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getThemeRepository();
        $theme = $repo->getThemeById($id);
        $theme = new Theme();
        $theme->setId($id);
        $theme->setTitle($_POST["title"]);

        $repo->editTheme($theme);
    }

    /* DELETE A THEME */
    public function serviceDeleteTheme($id){
        $bddmanager = new BddManager();
        $repo = $bddmanager->getThemeRepository();
        $theme = $repo->getThemeById($id);
        $theme = new Theme();
        $theme->setId($id);

        $repo->deleteTheme($theme);
    }

}

?>