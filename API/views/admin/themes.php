<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getThemeRepository();
$themes = $repo->getAllThemesOrderedById();
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
                <h2>Themes</h2>

            <!-- BUTTONS -->
                <div id="button_box">
                    <a href="/WWW/PlayingAPP/API/admin/new_attribute">
                        <div class="add attributes">
                            <i class="fas fa-plus"></i>
                            Add theme
                        </div>
                    </a>
                </div>
            </div>

    <!-- TABLE -->
            <table id="attributes">
                <tr>
                    <th class="table_id">#</th>
                    <th class="table_title">Theme title</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                foreach($themes as $theme){
                ?>

                    <tr>
                    <?= "<td class='table_id'>" . $theme->getId() . "</td>" ?>
                    <?= "<td class='table_title'>" . $theme->getTitle() . "</td>" ?>
                    <?= "<td><a href='/WWW/PlayingAPP/API/admin/edit_theme/" . $theme->getId() . "'><button class='small_buttons edit'>Edit</button></a></td>" ?>
                    <td>
                        <?= "<form action='/WWW/PlayingAPP/API/admin/DeleteThemeService/" . $theme->getId() . "' method='post'>" ?>
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