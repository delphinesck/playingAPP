<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getGameRepository();
$games = $repo->getAllGames();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Games</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_game">
                        <div class="add game">
                            <i class="fas fa-plus"></i>
                            Add game
                        </div>
                    </a>

                    <a href="/WWW/PlayingAPP/API/admin/new_other">
                        <div class="add other">
                            <i class="fas fa-plus"></i>
                            Add other
                        </div>
                    </a>
                </div>
            </div>

    <!-- TABLE -->
            <table>
                <tr>
                    <th class="table_id">#</th>
                    <th class="table_title">Game title</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                foreach($games as $game){
                ?>

                    <tr>
                    <?= "<td class='table_id'>" . $game->getId() . "</td>" ?>
                    <?= "<td class='table_title'>" . $game->getTitle() . "</td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/game/" . $game->getId() . "'><button class='small_buttons view'>View</button></a></td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/edit_game/" . $game->getId() . "'><button class='small_buttons edit'>Edit</button></a></td>" ?>
                    <td>
                        <?= "<form action='/WWW/PlayingAPP/API/admin/DeleteGameService/" . $game->getId() . "' method='post'>" ?>
                            <input type='submit' value='Delete' class='small_buttons delete' />
                        </form>
                    </td>
                    </tr>

                <?php 
                } 
                ?>
            </table>
        </div>
    </div>
</main>

<?php echo $footer ?>