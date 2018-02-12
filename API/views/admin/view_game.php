<?php 
echo($header);
$bddmanager = new BddManager();
$repoGame = $bddmanager->getGameRepository();
$game = $repoGame->getGameById($id);

$repoDeveloper = $bddmanager->getDeveloperRepository();
$repoPublisher = $bddmanager->getPublisherRepository();
$repoFranchise = $bddmanager->getFranchiseRepository();
$repoSystem = $bddmanager->getSystemRepository();
$repoLabel = $bddmanager->getLabelRepository();
$repoTheme = $bddmanager->getThemeRepository();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <?= "<h2>" . $game->getTitle() . "</h2>" ?>
            </div>

            <?= "Summary: " . $game->getSummary() . "<br />" ?>
            <?= "Time to beat: " . $game->getTimeto_beat() . "<br />" ?>
            <?= "Time to 100%: " . $game->getTimeto_complete() . "<br />" ?>
            <?= "JP release date: " . $game->getRelease_jp() . "<br />" ?>
            <?= "NA release date: " . $game->getRelease_na() . "<br />" ?>
            <?= "EU release date: " . $game->getRelease_eu() . "<br />" ?>
            <?= "Chapters: " . $game->getTotal_chapters() . "<br />" ?>
            <?= "Trophies: " . $game->getTotal_trophies() . "<br />" ?>
            <?= "Cover: <img src='" . $game->getCover() . "' /><br />" ?>
            <?= "Banner: <img src='" . $game->getBanner() . "' /><br />" ?>

            Developer(s): <br />
            <?php
            $developers_ids = $repoDeveloper->getDevelopersByGameId($id);
            $developers = [];

            foreach($developers_ids as $developer_id){
                $dev_id = $developer_id["developer_id"];
                $developer = $repoDeveloper->getDeveloperById($dev_id);
                $developer_name = $developer->getName();
                echo $developer_name . "<br />";
            }
            ?>

            Publisher(s): <br />
            <?php
            $publishers_ids = $repoPublisher->getPublishersByGameId($id);
            $publishers = [];

            foreach($publishers_ids as $publisher_id){
                $pub_id = $publisher_id["publisher_id"];
                $publisher = $repoPublisher->getPublisherById($pub_id);
                $publisher_name = $publisher->getName();
                echo $publisher_name . "<br />";
            }
            ?>

            Franchise(s): <br />
            <?php
            $franchises_ids = $repoFranchise->getFranchisesByGameId($id);
            $franchises = [];

            foreach($franchises_ids as $franchise_id){
                $fra_id = $franchise_id["franchise_id"];
                $franchise = $repoFranchise->getFranchiseById($fra_id);
                $franchise_name = $franchise->getName();
                echo $franchise_name . "<br />";
            }
            ?>

            System(s): <br />
            <?php
            $systems_ids = $repoSystem->getSystemsByGameId($id);
            $systems = [];

            foreach($systems_ids as $system_id){
                $sys_id = $system_id["system_id"];
                $system = $repoSystem->getSystemById($sys_id);
                echo $system->getFull_name() . "<br />";
            }
            ?>

            Label(s): <br />
            <?php
            $labels_ids = $repoLabel->getLabelsByGameId($id);
            $labels = [];

            foreach($labels_ids as $label_id){
                $lab_id = $label_id["label_id"];
                $label = $repoLabel->getLabelById($lab_id);
                echo $label->getName() . "<br />";
            }
            ?>

            Theme(s): <br />
            <?php
            $themes_ids = $repoTheme->getThemesByGameId($id);
            $themes = [];

            foreach($themes_ids as $theme_id){
                $the_id = $theme_id["theme_id"];
                $theme = $repoTheme->getThemeById($the_id);
                echo $theme->getTitle() . "<br />";
            }
            ?>
        </div>
    </div>
</main>