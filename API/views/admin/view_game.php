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
                <?= "<h2>View game " . $game->getTitle() . "</h2>" ?>
            </div>


        </div>
    </div>
</main>