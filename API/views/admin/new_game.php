<?php 
echo($header);
$bddmanager = new BddManager();
?>

<main>
<div id="main_box">
    <div>
        <h2>Add a game</h2>

        <?php 
        if(!empty($_GET["incomplete"])){
            echo "<div>Please fill all fields.</div>";
        } ?>

        <form id="form_newgame" action="../admin/CreateGameService" method="post" enctype="multipart/form-data">

            <div>
<!-- TITLE -->
                <div class="box">
                    <div class="form_title">
                        <div class="form_icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Title</h3>
                    </div>

                    <div class="box_content">
                        <input type="text" name="title">
                    </div>
                </div>

<!-- IMAGES -->
                <div class="box">
                    <div class="form_title">
                        <div class="form_icon">
                            <i class="far fa-images"></i>
                        </div>
                        <h3>Images</h3>
                    </div>

                    <div class="box_content">
                        <label>Cover</label><br />
                        <input type="file" name="cover"><br />

                        <label>Banner</label><br />
                        <input type="file" name="banner">
                    </div>
                </div>

<!-- COMPLETION -->
                <div class="box">
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
                                <input type="number" name="timeto_beat">hours
                            </div>
                        </div>

                        <div class="completion_margin">
                            <label>Estimated time to 100%</label>
                            <div class="number_box">
                                <input type="number" name="timeto_complete">hours
                            </div>
                        </div>
                        <div class="completion_subbox completion_margin">
                            <label>Total number of chapters</label>
                            <span class="number_box">
                                <input type="number" name="total_chapters">
                            </span>
                        </div>
                        <div class="completion_subbox">
                            <label>Total number of trophies
                                <div class="form_detail">(PSN, XBOX live, Steam)</div>
                            </label>
                            <span class="number_box">
                                <input type="number" name="total_trophies">
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box0">
                <div class="box1 box_height">

<!-- SUMMARY -->
                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                            <i class="fas fa-align-left"></i>
                            </div>
                            <h3>Summary</h3>
                        </div>

                        <div class="box_content">
                            <textarea name="summary"></textarea>
                        </div>
                    </div>

<!-- RELEASE DATES -->
                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <h3>First release dates</h3>
                        </div>

                        <div class="box_content">
                            <div class="release_country">JP</div> 
                            <input type="date" name="release_jp"><br />

                            <div class="release_country">NA</div> 
                            <input type="date" name="release_na"><br />

                            <div class="release_country">EU</div> 
                            <input type="date" name="release_eu">
                        </div>
                    </div>
                </div>

<!-- DEVELOPERS -->
                <div class="box1">
                    <div class="box">
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
                    <div class="box">
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
                    <div class="box">
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
                </div>

<!-- SYSTEMS -->
                <div class="box1">
                    <div class="box">
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
                    <div class="box">
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
                    <div class="box">
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

            <input type="submit" value="Submit">
        </form>
    </div>

</div>
                        </main>

<?php echo $footer ?>