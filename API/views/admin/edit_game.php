<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getGameRepository();
$game = $repo->getGameById($id);
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
                            <label>Cover</label><br />
                            <input type="file" name="cover">

                            <label>Banner</label><br />
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
                                $repo = $bddmanager->getDeveloperRepository();
                                $developers = $repo->getAllDevelopers();
                                foreach($developers as $developer){
                                    echo "<label><input type='checkbox' value='" . $developer->getId() . "' name='developer'>";
                                    echo $developer->getName() . "</label><br />";
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
                                $repo = $bddmanager->getPublisherRepository();
                                $publishers = $repo->getAllPublishers();
                                foreach($publishers as $publisher){
                                    echo "<label><input type='checkbox' value='" . $publisher->getId() . "' name='publisher'>";
                                    echo $publisher->getName() . "</label><br />";
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
                                $repo = $bddmanager->getFranchiseRepository();
                                $franchises = $repo->getAllFranchises();
                                foreach($franchises as $franchise){
                                    echo "<label><input type='checkbox' value='" . $franchise->getId() . "' name='franchise'>";
                                    echo $franchise->getName() . "</label><br />";
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
                                $repo = $bddmanager->getSystemRepository();
                                $systems = $repo->getAllSystems();
                                foreach($systems as $system){
                                    echo "<label><input type='checkbox' value='" . $system->getId() . "' name='system'>";
                                    echo $system->getFull_name() . "</label><br />";
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
                                $repo = $bddmanager->getLabelRepository();
                                $labels = $repo->getAllLabels();
                                foreach($labels as $label){
                                    echo "<label><input type='checkbox' value='" . $label->getId() . "' name='label'>";
                                    echo $label->getName() . "</label><br />";
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
                                $repo = $bddmanager->getThemeRepository();
                                $themes = $repo->getAllThemes();
                                foreach($themes as $theme){
                                    echo "<label><input type='checkbox' value='" . $theme->getId() . "' name='theme'>";
                                    echo $theme->getTitle() . "</label><br />";
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