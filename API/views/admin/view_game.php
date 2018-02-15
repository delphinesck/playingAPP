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

<style type="text/css">
.banner {
    background: url(<?= $game->getBanner() ?>);
    background-size: cover;
    background-position: top;
}
</style>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

        <!-- TITLE -->
            <div id="main_title_box" class="banner">
            <!-- BACK BUTTON -->
                <a href="/WWW/PlayingAPP/API/admin/games">
                    <div id="back_button"><i class="fas fa-angle-left"></i> Back</div>
                </a>

            <!-- EDIT BUTTON -->
                <div id="box_submit">
                    <?= "<a href='/WWW/PlayingAPP/API/admin/edit_game/" . $game->getId() . "'>" ?>
                        <div id="submit_button">
                            Edit
                        </div>
                    </a>
                </div>

            <!-- TITLE -->
                <?= "<h4>" . $game->getTitle() . "</h4>" ?>
            </div>

            <div id="main_box_game">
        <!-- BOX 1 -->
                <div class="box box_game">
                    <div class="form_title">
                        <div class="form_icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Main informations</h3>
                    </div>

                    <div class="box_content">
                    <!-- COVER -->
                        <?= "<img src='" . $game->getCover() . "' width='250px' />" ?>
                
                    <!-- RELEASE DATES -->
                        <div class="gamedetails space_under">
                            <div class="gamedetails_title">
                                <div>JP release date</div>
                                <div>NA release date</div>
                                <div>EU release date</div>
                            </div>
                            <div class="gamedetails_number">
                                <div><?= $game->getRelease_jp() ?></div>
                                <div><?= $game->getRelease_na() ?></div>
                                <div><?= $game->getRelease_eu() ?></div>
                            </div>
                        </div>

                    <!-- DEVELOPERS -->
                        <div class="space_under">
                            <h5><i class="fas fa-folder-open"></i> Developer(s)</h5>
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
                        </div>

                    <!-- PUBLISHERS -->
                        <h5><i class="fas fa-folder-open"></i> Publisher(s)</h5>
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
                    </div>
                </div>

        <!-- BOX 2 -->
                <div class="box_game2">
            <!-- BOX 2.1 -->
                    <div class="box box_game">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <h3>Summary</h3>
                        </div>

                        <div class="box_content">
                        <!-- SUMMARY -->
                            <div id="summary"><?= $game->getSummary() ?></div>
                        </div>
                    </div>

            <!-- BOX 2.2 -->
                    <div class="box box_game">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h3>Statistics</h3>
                        </div>

                        <div class="box_content" id="gamestats">
                            <div class="gamestats_box">
                                <div class="gamestats_number">
                                    5473
                                </div>
                                <div class="gamestats_title">
                                    Game page views
                                </div>
                            </div>

                            <div class="gamestats_box">
                                <div class="gamestats_number">
                                    842
                                </div>
                                <div class="gamestats_title">
                                    Adds to collection
                                </div>
                            </div>
                            
                            <div class="gamestats_box">
                                <div class="gamestats_number">
                                    218
                                </div>
                                <div class="gamestats_title">
                                    Playthroughs
                                </div>
                            </div>

                            <div class="gamestats_box">
                                <div class="gamestats_number">
                                    125
                                </div>
                                <div class="gamestats_title">
                                    Active playthroughs
                                </div>
                            </div>

                            <div class="gamestats_box">
                                <div class="gamestats_number">
                                    345
                                </div>
                                <div class="gamestats_title">
                                    Topics created
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
                    
            <!-- BOX 3 -->
                <div class="box_game2">
                <!-- BOX 3.1 -->
                    <div class="box box_game">
                        <div class="form_title">
                            <div class="form_icon">
                            <i class="fas fa-trophy"></i>
                            </div>
                            <h3>Completion</h3>
                        </div>
                        <div class="box_content gamedetails">
                            <div class="gamedetails_title">
                                <div>Time to beat</div>
                                <div>Time to 100%</div>
                                <div>Chapters</div>
                                <div>Trophies</div>
                            </div>

                            <div class="gamedetails_numbers">
                                <div><?= $game->getTimeto_beat() ?> h</div>
                                <div><?= $game->getTimeto_complete() ?> h</div>
                                <div><?= $game->getTotal_chapters() ?></div>
                                <div><?= $game->getTotal_trophies() ?></div>
                            </div>
                        </div>
                    </div>

                <!-- BOX 3.2 -->
                    <div class="box box_game">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Details</h3>
                        </div>

                        <div class="box_content">
                        <!-- FRANCHISES -->
                            <div class="space_under">
                                <h5><i class="fas fa-bookmark"></i> Franchise(s)</h5>
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
                            </div>

                        <!-- SYSTEMS -->
                            <div class="space_under">
                                <h5><i class="fas fa-gamepad"></i> System(s)</h5>
                                <?php
                                $systems_ids = $repoSystem->getSystemsByGameId($id);
                                $systems = [];

                                foreach($systems_ids as $system_id){
                                    $sys_id = $system_id["system_id"];
                                    $system = $repoSystem->getSystemById($sys_id);
                                    echo $system->getFull_name() . "<br />";
                                }
                                ?>
                            </div>

                        <!-- LABELS -->
                            <div class="space_under">
                                <h5><i class="fas fa-tags"></i> Label(s)</h5>
                                <?php
                                $labels_ids = $repoLabel->getLabelsByGameId($id);
                                $labels = [];

                                foreach($labels_ids as $label_id){
                                    $lab_id = $label_id["label_id"];
                                    $label = $repoLabel->getLabelById($lab_id);
                                    echo $label->getName() . "<br />";
                                }
                                ?>
                            </div>

                        <!-- THEMES -->
                            <h5><i class="fas fa-hashtag"></i> Theme(s)</h5>
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

                </div>

            </div>
        </div>
    </div>
</main>