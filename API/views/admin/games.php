<?php echo $header ?>

    <div id="main_box">
        <h2>Games</h2>

        <a href="/WWW/PlayingAPP/API/admin/new_game">
            <button>Add a game</button>
        </a>
        <a href="/WWW/PlayingAPP/API/admin/new_other">
            <button>Add other</button>
        </a>
        
        <br /><br />

        <table>
            <tr>
                <th class="table_id">#</th>
                <th class="table_title">Game title</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <?php
            $bddmanager = new BddManager();
            $repo = $bddmanager->getGameRepository();
            $games = $repo->getAllGames();
            foreach($games as $game){
            ?>

                <tr>
                <?= "<td class='table_id'>" . $game->getId() . "</td>" ?>
                <?= "<td class='table_title'>" . $game->getTitle() . "</td>" ?>
                <td><button>View</button></td>
                <td><button>Edit</button></td>
                <td><button>Delete</button></td>
                </tr>

            <?php 
            } 
            ?>

        </table>
        </div>

<?php echo $footer ?>