<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getFranchiseRepository();
$franchises = $repo->getAllFranchisesOrderedById();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Developers</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_attribute">
                        <div class="add attributes">
                            <i class="fas fa-plus"></i>
                            Add franchise
                        </div>
                    </a>
                </div>
            </div>

    <!-- TABLE -->
            <table id="attributes">
                <tr>
                    <th class="table_id">#</th>
                    <th class="table_title">Franchise name</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                foreach($franchises as $franchise){
                ?>

                    <tr>
                    <?= "<td class='table_id'>" . $franchise->getId() . "</td>" ?>
                    <?= "<td class='table_title'>" . $franchise->getName() . "</td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/edit_franchise/" . $franchise->getId() . "'><button class='small_buttons edit'>Edit</button></a></td>" ?>
                    <td>
                        <?= "<form action='/WWW/PlayingAPP/API/admin/DeleteFranchiseService/" . $franchise->getId() . "' method='post'>" ?>
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