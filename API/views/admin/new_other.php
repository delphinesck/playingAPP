<?php echo $header ?>

<!-- MAIN CONTENT -->
<main>
    <div id="main_box">
        <div id="main_box_margin">

    <!-- TITLE -->
            <div id="main_title_box">
            <!-- BACK BUTTON -->
                <a href="/WWW/PlayingAPP/API/admin/games">
                    <div id="back_button"><i class="fas fa-angle-left"></i> Back</div>
                </a>
            <!-- SUBMIT BUTTON -->
                <div id="box_submit">
                    <input type="submit" value="Submit" form="form_other" id="submit_button">
                </div>
                <h2>Add other</h2>
            </div>

    <!-- ERROR MESSAGES -->
            <?php 
            if(!empty($_GET["developer"])){
                echo "<div id='incomplete'>" . $_GET['developer'] . " already exists.</div>";
            }
            if(!empty($_GET["publisher"])){
                echo "<div id='incomplete'>" . $_GET['publisher'] . " already exists.</div>";
            }
            if(!empty($_GET["franchise"])){
                echo "<div id='incomplete'>" . $_GET['franchise'] . " already exists.</div>";
            }
            if(!empty($_GET["theme"])){
                echo "<div id='incomplete'>" . $_GET['theme'] . " already exists.</div>";
            }
            if(!empty($_GET["label"])){
                echo "<div id='incomplete'>" . $_GET['label'] . " already exists.</div>";
            }
            if(!empty($_GET["label_description"])){
                echo "<div id='incomplete'>Label description is empty.</div>";
            }
            if(!empty($_GET["system"])){
                echo "<div id='incomplete'>" . $_GET['system'] . " already exists.</div>";
            }
            if(!empty($_GET["system_description"])){
                echo "<div id='incomplete'>System description is empty.</div>";
            }
            ?>


    <!-- FORM -->
            <form id="form_other" action="../admin/CreateOtherService" method="post">
                <div id="main_box_other">

                    <div class="sub_box_other">
                <!-- ADD A DEVELOPER -->
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Add a developer</h3>
                            </div>

                            <div class="box_content">
                                <input type="text" name="developer">
                            </div>
                        </div>
                        
                <!-- ADD A PUBLISHER -->
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Add a publisher</h3>
                            </div>

                            <div class="box_content">
                                <input type="text" name="publisher">
                            </div>
                        </div>

                <!-- ADD A FRANCHISE -->
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Add a franchise</h3>
                            </div>

                            <div class="box_content">
                                <input type="text" name="franchise">
                            </div>
                        </div>

                    </div>

                    <div class="sub_box_other">
                <!-- ADD A THEME -->
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Add a theme</h3>
                            </div>

                            <div class="box_content">
                                <input type="text" name="theme">
                            </div>
                        </div>

                <!-- ADD A LABEL -->
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Add a label</h3>
                            </div>

                            <div class="box_content">
                                <label>Name</label>
                                <input type="text" name="label_name"><br />
                                <label>Description</label>
                                <textarea class="textarea_other" name="label_description"></textarea>
                            </div>
                        </div>
                    </div>

                <!-- ADD A SYSTEM -->
                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Add a system</h3>
                        </div>

                        <div class="box_content">
                            <label>Full name</label>
                            <input type="text" name="system_fullname"><br />
                            <label>Short name</label>
                            <input type="text" name="system_shortname"><br />
                            <label>Company</label>
                            <input type="text" name="system_company"><br />
                            <label>Background color</label>
                            <input type="color" name="system_colorbg"><br />
                            <label>Text color</label>
                            <input type="color" name="system_colortext">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>

<?php echo $footer ?>