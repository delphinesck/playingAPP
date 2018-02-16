<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getSystemRepository();
$systems = $repo->getAllSystemsOrderedById();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Systems</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_attribute">
                        <div class="add attributes">
                            <i class="fas fa-plus"></i>
                            Add system
                        </div>
                    </a>
                </div>
            </div>

    <!-- TABLE -->
            <table>
                <tr>
                    <th class="table_id">#</th>
                    <th class="table_name">Full name</th>
                    <th class="table_shortname">Short</th>
                    <th class="table_company">Company</th>
                    <th class="table_colorbg">Background</th>
                    <th class="table_colortext">Text</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                foreach($systems as $system){
                ?>

                    <tr>
                    <?= "<td class='table_id'>" . $system->getId() . "</td>" ?>
                    <?= "<td class='table_name'>" . $system->getFull_name() . "</td>" ?>
                    <?= "<td class='table_shortname' style='text-transform:uppercase'>" . $system->getShort_name() . "</td>" ?>
                    <?= "<td class='table_company'>" . $system->getCompany() . "</td>" ?>
                    <?= "<td class='table_colorbg'>" . $system->getColor_bg() . "</td>" ?>
                    <?= "<td class='table_colortext'>" . $system->getColor_text() . "</td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/edit_system/" . $system->getId() . "'><button class='small_buttons edit'>Edit</button></a></td>" ?>
                    <td>
                        <?= "<form action='/WWW/PlayingAPP/API/admin/DeleteSystemService/" . $system->getId() . "' method='post'>" ?>
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