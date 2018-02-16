<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getSystemRepository();
$system = $repo->getSystemById($id);
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
            <!-- BACK BUTTON -->
                <a href="/WWW/PlayingAPP/API/admin/systems">
                    <div id="back_button"><i class="fas fa-angle-left"></i> Back</div>
                </a>
            <!-- SUBMIT BUTTON -->
                <div id="box_submit">
                    <input type="submit" value="Submit" form="form_system" id="submit_button">
                </div>
                <h2>Edit system</h2>
            </div>


    <!-- FORM -->
            <?= "<form id='form_system' action='/WWW/PlayingAPP/API/admin/EditSystemService/" . $id . "' method='post'>" ?>
                <div id="main_box_attributes">

                    <div class="sub_box_attributes">
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Edit a system</h3>
                            </div>

                            <div class="box_content">
                                <label>Full name</label>
                                <?= "<input type='text' name='full_name' value='" . $system->getFull_name() . "'><br />" ?>

                                <label>Short name</label>
                                <?= "<input type='text' name='short_name' value='" . $system->getShort_name() . "'><br />" ?>

                                <label>Company</label>
                                <?= "<input type='text' name='company' value='" . $system->getCompany() . "'><br />" ?>
                                
                                <label>Background color</label>
                                <?= "<input type='color' name='color_bg' value='" . $system->getColor_bg() . "'><br />" ?>

                                <label>Text color</label>
                                <?= "<input type='color' name='color_text' value='" . $system->getColor_text() . "'>" ?>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>

<?php echo $footer ?>