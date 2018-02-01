<?php echo $header ?>

    <main>
        <div id="main_box_content">
            <h2>Add a game</h2>

            <?php 
            if(empty($_GET["incomplete"]) == false){
                echo "<div>Please fill all fields.</div>";
            } ?>

            <form id="form_newgame" action="../admin/CreateGameService" method="post">

                <div>
                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Title</h3>
                        </div>

                        <div class="box_content">
                            <input type="text" name="title">
                        </div>
                    </div>

                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="far fa-images"></i>
                            </div>
                            <h3>Images</h3>
                        </div>

                        <div class="box_content">
                            <label>Cover</label><br />
                            <input type="file" name="cover"><br />

                            <label>Banner</label><br />
                            <input type="file" name="banner">
                        </div>
                    </div>

                    <div class="box">
                        <div class="form_title">
                            <div class="form_icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h3>Completion</h3>
                        </div>

                        <div class="box_content">
                            <div>
                                <label>Estimated time to beat</label>
                                <div class="number_box">
                                    <input type="number" name="timeto_beat">hours
                                </div>
                            </div>

                            <div class="completion_margin">
                                <label>Estimated time to 100%</label>
                                <div class="number_box">
                                    <input type="number" name="timeto_complete">hours
                                </div>
                            </div>
                            <div class="completion_subbox completion_margin">
                                <label>Total number of chapters</label>
                                <span class="number_box">
                                    <input type="number" name="total_chapters">
                                </span>
                            </div>
                            <div class="completion_subbox">
                                <label>Total number of trophies
                                    <div class="form_detail">(PSN, XBOX live, Steam)</div>
                                </label>
                                <span class="number_box">
                                    <input type="number" name="total_trophies">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box0">
                    <div class="box1 box_height">
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                <i class="fas fa-align-left"></i>
                                </div>
                                <h3>Summary</h3>
                            </div>

                            <div class="box_content">
                                <textarea name="summary"></textarea>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <h3>First release dates</h3>
                            </div>

                            <div class="box_content">
                                <div class="release_country">JP</div> 
                                <input type="date" name="release_jp"><br />

                                <div class="release_country">NA</div> 
                                <input type="date" name="release_na"><br />

                                <div class="release_country">EU</div> 
                                <input type="date" name="release_eu">
                            </div>
                        </div>
                    </div>

                    <div class="box1">
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h3>Developers</h3>
                            </div>

                            <div class="box_content">
                                <select name="developer1">
                                    <option value="developer name">Developer name</option>
                                    <option value="developer name">Developer name</option>
                                    <option value="developer name">Developer name</option>
                                </select>

                                <div class="form_plus">
                                    add developer <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h3>Publishers</h3>
                            </div>

                            <div class="box_content">
                                <select name="publisher1">
                                    <option value="publisher name">Publisher name</option>
                                    <option value="publisher name">Publisher name</option>
                                    <option value="publisher name">Publisher name</option>
                                </select>

                                <div class="form_plus">
                                    add publisher <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <h3>Franchises</h3>
                            </div>

                            <div class="box_content">
                                <select name="franchise1">
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                    <option value="franchise name">Franchise name</option>
                                </select>

                                <div class="form_plus">
                                    add franchise <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box1">
                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                                <h3>Systems</h3>
                            </div>

                            <div class="box_content">
                                <select name="system1">
                                    <option value="system name">System name</option>
                                    <option value="system name">System name</option>
                                    <option value="system name">System name</option>
                                </select>

                                <div class="form_plus">
                                    add system <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <h3>Labels</h3>
                            </div>

                            <div class="box_content">
                                <select name="label1">
                                    <option value="label name">Label name</option>
                                    <option value="label name">Label name</option>
                                    <option value="label name">Label name</option>
                                </select>

                                <div class="form_plus">
                                    add label <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="form_title">
                                <div class="form_icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <h3>Themes</h3>
                            </div>

                            <div class="box_content">
                                <select name="theme1">
                                    <option value="theme name">Theme name</option>
                                    <option value="theme name">Theme name</option>
                                    <option value="theme name">Theme name</option>
                                </select>

                                <div class="form_plus">
                                    add theme <i class="fas fa-plus-square"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>
        </div>
    </main>

</div>

<?php echo $footer ?>