<?php 
echo($header);
$bddmanager = new BddManager();
$repoDeveloper = $bddmanager->getDeveloperRepository();
$developers = $repoDeveloper->getAllDevelopersOrderedById();
$repoPublisher = $bddmanager->getPublisherRepository();
$publishers = $repoPublisher->getAllPublishersOrderedById();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Attributes</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_attribute">
                        <div class="add attributes">
                            <i class="fas fa-plus"></i>
                            Add attributes
                        </div>
                    </a>
                </div>
            </div>

            <div id="attributes_box">
                <div>
                    <a href="/WWW/PlayingAPP/API/admin/developers">
                        <div class="attribute att_dev">
                            <i class="fas fa-folder-open"></i>
                            Developers
                        </div>
                    </a>
                    <a href="/WWW/PlayingAPP/API/admin/publishers">
                        <div class="attribute att_pub">
                            <i class="fas fa-folder-open"></i>
                            Publishers
                        </div>
                    </a>
                </div>

                <div>
                    <a href="/WWW/PlayingAPP/API/admin/franchises">
                        <div class="attribute att_fra">
                            <i class="fas fa-bookmark"></i>
                            Franchises
                        </div>
                    </a>
                    <a href="/WWW/PlayingAPP/API/admin/systems">
                        <div class="attribute att_sys">
                            <i class="fas fa-gamepad"></i>
                            Systems
                        </div>
                    </a>
                </div>

                <div>
                    <a href="/WWW/PlayingAPP/API/admin/labels">
                        <div class="attribute att_lab">
                            <i class="fas fa-tags"></i>
                            Labels
                        </div>
                    </a>
                    <a href="/WWW/PlayingAPP/API/admin/themes">
                        <div class="attribute att_the">
                            <i class="fas fa-hashtag"></i>
                            Themes
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>

<?php echo $footer ?>