<?php 
echo($header);
$bddmanager = new BddManager();
$repo = $bddmanager->getFranchiseRepository();
$franchise = $repo->getFranchiseById($id);
?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
            <!-- BACK BUTTON -->
                <a href="/WWW/PlayingAPP/API/admin/franchises">
                    <div id="back_button"><i class="fas fa-angle-left"></i> Back</div>
                </a>
            <!-- SUBMIT BUTTON -->
                <div id="box_submit">
                    <input type="submit" value="Submit" form="form_franchise" id="submit_button">
                </div>
                <h2>Edit franchise</h2>
            </div>


    <!-- FORM -->
            <?= "<form id='form_franchise' action='/WWW/PlayingAPP/API/admin/EditFranchiseService/" . $id . "' method='post'>" ?>
                <div id="main_box_attributes">

                    <div class="sub_box_attributes">
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Edit a franchise</h3>
                            </div>

                            <div class="box_content">
                                <?= "<input type='text' name='name' value='" . $franchise->getName() . "'>" ?>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>

<?php echo $footer ?>