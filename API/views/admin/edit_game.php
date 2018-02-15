<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getGameRepository();
$game = $repo->getGameById($id);

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
            <!-- BACK BUTTON -->
                <a href="/WWW/PlayingAPP/API/admin/games">
                    <div id="back_button"><i class="fas fa-angle-left"></i> Back</div>
                </a>
            <!-- SUBMIT BUTTON -->
                <div id="box_submit">
                    <input type="submit" value="Edit" form="form_game" id="submit_button">
                </div>
                <h2>Edit game</h2>
            </div>

    <!-- INCOMPLETE MESSAGE -->
            <?php 
            if(!empty($_GET["incomplete"])){
                echo "<div id='incomplete'>Please fill all fields.</div>";
            } ?>


    <!-- FORM -->
            <?= "<form id='form_game' action='/WWW/PlayingAPP/API/admin/EditGameService/" . $id . "' method='post' enctype='multipart/form-data'>" ?>
        <!-- DIV 1 -->
                <div id="main_box_left">
            <!-- TITLE -->
                    <div class="box type1">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Title</h3>
                        </div>

                        <div class="box_content">
                            <?= "<input type='text' name='title' value='" . $game->getTitle() . "'>" ?>
                        </div>
                    </div>

            <!-- IMAGES -->
                    <div class="box type1">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="far fa-images"></i>
                            </div>
                            <h3>Images</h3>
                        </div>

                        <div class="box_content">
                            <label>Cover</label>
                            <input type="file" name="cover">

                            <label>Banner</label>
                            <input type="file" name="banner">
                        </div>
                    </div>

            <!-- COMPLETION -->
                    <div class="box type1">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h3>Completion</h3>
                        </div>

                        <div class="box_content">
                            <div>
                                <label>Estimated time to beat</label>
                                <div class="number_box">
                                    <?= "<input type='number' name='timeto_beat' value='" . $game->getTimeto_beat() . "'>hours" ?>
                                </div>
                            </div>

                            <div class="completion_margin">
                                <label>Estimated time to 100%</label>
                                <div class="number_box">
                                    <?= "<input type='number' name='timeto_complete' value='" . $game->getTimeto_complete() . "'>hours" ?>
                                </div>
                            </div>
                            <div class="completion_subbox completion_margin">
                                <label>Total number of chapters</label>
                                <span class="number_box">
                                    <?= "<input type='number' name='total_chapters' value='" . $game->getTotal_chapters() . "'>" ?>
                                </span>
                            </div>
                            <div class="completion_subbox">
                                <label>Total number of trophies
                                    <div class="form_detail">(PSN, XBOX live, Steam)</div>
                                </label>
                                <span class="number_box">
                                    <?= "<input type='number' name='total_trophies' value='" . $game->getTotal_trophies() . "'>" ?>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

        <!-- DIV 2 -->
                <div id="main_box_right">
                    <div id="sub_box_right_top">

            <!-- SUMMARY -->
                        <div class="box type2">
                            <div class="form_title">
                                <div class="form_icon">
                                <i class="fas fa-align-left"></i>
                                </div>
                                <h3>Summary</h3>
                            </div>

                            <div class="box_content">
                                <textarea name="summary"><?= $game->getSummary() ?></textarea>
                            </div>
                        </div>

            <!-- RELEASE DATES -->
                        <div class="box type3">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <h3>First release dates</h3>
                            </div>

                            <div class="box_content">
                                <div class="release_country">JP</div> 
                                <?= "<input type='date' name='release_jp' value='" . $game->getRelease_jp() . "'><br />" ?>

                                <div class="release_country">NA</div> 
                                <?= "<input type='date' name='release_na' value='" . $game->getRelease_na() . "'><br />" ?>

                                <div class="release_country">EU</div> 
                                <?= "<input type='date' name='release_eu' value='" . $game->getRelease_eu() . "'><br />" ?>
                            </div>
                        </div>
                    </div>

            <!-- DEVELOPERS -->
                    <div id="sub_box_right_middle">
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h3>Developers</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $developers_ids = $repoDeveloper->getDevelopersByGameId($id);
                                $developers = $repoDeveloper->getAllDevelopers();
                                foreach($developers as $key=>$developer){
                                    echo "<label><input type='checkbox' value='" . $developer->getId() . "' name='developers[" . $key . "]' ";

                                    foreach($developers_ids as $developer_id){
                                        $dev_id = $developer_id["developer_id"];

                                        if($dev_id == $developer->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $developer->getName() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

            <!-- PUBLISHERS -->
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h3>Publishers</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $publishers_ids = $repoPublisher->getPublishersByGameId($id);
                                $publishers = $repoPublisher->getAllPublishers();
                                foreach($publishers as $key=>$publisher){
                                    echo "<label><input type='checkbox' value='" . $publisher->getId() . "' name='publishers[" . $key . "]' ";

                                    foreach($publishers_ids as $publisher_id){
                                        $pub_id = $publisher_id["publisher_id"];

                                        if($pub_id == $publisher->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $publisher->getName() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

            <!-- FRANCHISES -->
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <h3>Franchises</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $franchises_ids = $repoFranchise->getFranchisesByGameId($id);
                                $franchises = $repoFranchise->getAllFranchises();
                                foreach($franchises as $key=>$franchise){
                                    echo "<label><input type='checkbox' value='" . $franchise->getId() . "' name='franchises[" . $key . "]' ";

                                    foreach($franchises_ids as $franchise_id){
                                        $fra_id = $franchise_id["franchise_id"];

                                        if($fra_id == $franchise->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $franchise->getName() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

            <!-- SYSTEMS -->
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                                <h3>Systems</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $systems_ids = $repoSystem->getSystemsByGameId($id);
                                $systems = $repoSystem->getAllSystems();
                                foreach($systems as $key=>$system){
                                    echo "<label><input type='checkbox' value='" . $system->getId() . "' name='systems[" . $key . "]' ";

                                    foreach($systems_ids as $system_id){
                                        $sys_id = $system_id["system_id"];

                                        if($sys_id == $system->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $system->getFull_name() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

            <!-- LABELS -->
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <h3>Labels</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $labels_ids = $repoLabel->getLabelsByGameId($id);
                                $labels = $repoLabel->getAllLabels();
                                foreach($labels as $key=>$label){
                                    echo "<label><input type='checkbox' value='" . $label->getId() . "' name='labels[" . $key . "]' ";

                                    foreach($labels_ids as $label_id){
                                        $lab_id = $label_id["label_id"];

                                        if($lab_id == $label->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $label->getName() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

            <!-- THEMES -->
                        <div class="box type4">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <h3>Themes</h3>
                            </div>

                            <div class="box_content scrolling">
                                <?php
                                $themes_ids = $repoTheme->getThemesByGameId($id);
                                $themes = $repoTheme->getAllThemes();
                                foreach($themes as $key=>$theme){
                                    echo "<label><input type='checkbox' value='" . $theme->getId() . "' name='themes[" . $key . "]'";

                                    foreach($themes_ids as $theme_id){
                                        $the_id = $theme_id["theme_id"];

                                        if($the_id == $theme->getId()){
                                            echo "checked ";
                                        }
                                    }
                                    echo ">";
                                    echo $theme->getTitle() . "</label>";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php echo $footer ?>