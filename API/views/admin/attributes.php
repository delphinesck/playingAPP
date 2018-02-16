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

            <a href="/WWW/PlayingAPP/API/admin/developers">
                <button>Developers</button>
            </a>

            <a href="/WWW/PlayingAPP/API/admin/publishers">
                <button>Publishers</button>
            </a>

            <a href="/WWW/PlayingAPP/API/admin/franchises">
                <button>Franchises</button>
            </a>

            <a href="/WWW/PlayingAPP/API/admin/systems">
                <button>Systems</button>
            </a>

            <a href="/WWW/PlayingAPP/API/admin/labels">
                <button>Labels</button>
            </a>

            <a href="/WWW/PlayingAPP/API/admin/themes">
                <button>Themes</button>
            </a>

        </div>
    </div>
</main>

<?php echo $footer ?>