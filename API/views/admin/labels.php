<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getLabelRepository();
$labels = $repo->getAllLabelsOrderedById();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Labels</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_attribute">
                        <div class="add attributes">
                            <i class="fas fa-plus"></i>
                            Add label
                        </div>
                    </a>
                </div>
            </div>

    <!-- TABLE -->
            <table>
                <tr>
                    <th class="table_id">#</th>
                    <th class="table_name">Label name</th>
                    <th class="table_description">Description</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                foreach($labels as $label){
                ?>

                    <tr>
                    <?= "<td class='table_id'>" . $label->getId() . "</td>" ?>
                    <?= "<td class='table_name'>" . $label->getName() . "</td>" ?>
                    <?= "<td class='table_description'>" . $label->getDescription() . "</td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/edit_label/" . $label->getId() . "'><button class='small_buttons edit'>Edit</button></a></td>" ?>
                    <td>
                        <?= "<form action='/WWW/PlayingAPP/API/admin/DeleteLabelService/" . $label->getId() . "' method='post'>" ?>
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