    <?php

    use DevPlan\DevPlan;
    use FilterUser\FilterUser;



    include_once 'sampleheader.php';
     $sy = $_SESSION['active_sy_id'];
 $school = $_SESSION['school_id'];

// $show_str = displayDPstr($conn,$sy,$school);
$show_str = t_fetch_DEV_STR($conn,$sy,$school);
$show_dn =  t_fetch_DEV_NEEDS($conn,$sy,$school); 
$show_str_kra_cbc =  t_fetch_STR_KRA($conn,$sy,$school);
$show_devneed_kra_cbc = t_fetch_DEVNEED_KRA($conn,$sy,$school);

    
    $userESATstats =  isTakenEsat($conn, $_SESSION['position'], $_SESSION['user_id']);
    //A.1 DISPLAY ERRORS IF THE USER DID NOT TAKE ESAT 
    if ($userESATstats) :
        echo  '<ul class="red-notif-border">';
        foreach ($userESATstats as $esatStatNotif) :
            echo  $esatStatNotif;
        endforeach;
        echo '</ul>';

    //A.2 DISPLAY THE DEVPLAN IF USER HAS TAKEN ESAT
    else :
        /* THIS CONDITION WILL HIDE THE DEVELOPMENT PLAN IF USER ALREADY SUBMITTED  */
        $notifsss = (isSubmit($conn));
        if (!$notifsss) :
            ?>
            <main>
                <div class="container ">
                    <div class="breadcome-list shadow-reset">
                        <h2 class="text-center"><strong>PART IV: General Master Teacher Development Plan</strong></h2>
                        <div>
                         
                            <form action="" method="post" class="form-group">
                              
                            

                                <input type="hidden" name="approving_authority" value="<?php echo $_SESSION['approving_authority'] ?>" />
                                <div id="A">
                                    <fieldset>
                                        <div class="bg-black">
                                            <label><strong>A. Functional Competencies</strong></label>
                                        </div>

                                        <!--A. Strengths -->
                                        <div class="black-border">
                                            <div class="bg-black"><label for="a_strength" class="form-control-label">Strengths</label>

                                            </div>
                                            <!-- ----------------------------------------- -->
                                            <?php 
                                     
                                            if($show_str):
                                                foreach($show_str as $s_str): ?>
                                                <p class="tomato-color">
                                                    <?php echo displayKRA($conn,$s_str['a_strengths']) ?>
                                                </p>

                                                   <?php $str_obj =  t_fetch_STR_OBJ($conn,$sy,$school,$s_str['a_strengths']); 
                                                //    pre_r($str_obj);
                                                    foreach($str_obj as $s_obj): ?>
                                                    <li>
                                                      <?php echo displayObjectiveT($conn,$s_obj['strengths_mtobj']) ?>
                                                    </li>
                                                    <?php endforeach; endforeach;?>
                                            <?php else: ?>
                                                <p class="red-notif-border">
                                                    No result!
                                                </p>

                                                <?php endif ?>
                                            
                                                <!-- ------------------------------------------------------------------ -->
                                        </div>

                                        <!-- A. Development Needs -->
                                        <div class="black-border">
                                            <div class="bg-black"><label for="a_devneeds" class="form-control-label">Development Needs</label></div>
                                      <?php 
                                     
                                            if($show_dn):
                                                foreach($show_dn as $s_dn): ?>
                                                <p class="tomato-color">
                                                    <?php echo displayKRA($conn,$s_dn['a_devneeds']) ?>
                                                </p>

                                                   <?php $dn_obj =  t_fetch_DEVNEEDS_OBJ($conn,$sy,$school,$s_dn['a_devneeds']); 
                                                //   pre_r($str_obj);
                                                    foreach($dn_obj as $s_obj): ?>
                                                    <li>
                                                      <?php echo displayObjectiveT($conn,($s_obj['devneeds_mtobj'])) ?>
                                                    </li>
                                                    <?php endforeach; endforeach;?>
                                            <?php else: ?>
                                                <p class="red-notif-border">
                                                    No result!
                                                </p>

                                                <?php endif ?>
                                        </div>
                                        <!-- Action Plan -->
                                        <div class="black-border">
                                            <?php
                                                    $action = devplan::showA3Action($conn);
                                                    foreach ($action as $act) :
                                                        $inter = $act['a_intervention'];
                                                        $learn = $act['a_learning_objectives'];
                                                        $time = $act['a_timeline'];
                                                        $resource = $act['a_resources_needed'];
                                                    endforeach;
                                                    ?>
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Action Plan</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="a_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" disabled class="form-control textarea">
                                                    <?php if (!empty($learn)): echo $learn; else: echo "No record found"; endif; ?></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="a_intervention">Interventions:</label>
                                                    <textarea name="a_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" disabled class="form-control textarea">
                                                    <?php if (!empty($inter)): echo $inter; else: echo "No record found"; endif; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline and Resources needed -->
                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Timelines and Resources needed</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="timelines">Timelines:</label>
                                                    <textarea name="a_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." disabled class="form-control textarea"><?php  if (!empty($time)): echo $time; else: echo "No record found"; endif;?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="a_resources_needed" id="" cols="30" disabled rows="10" placeholder="Enter the Resources needed." class="form-control textarea"><?php  if (!empty($resource)): echo $resource; else: echo "No record found"; endif; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- B. Compentencies -->

                                        <div class="bg-black">
                                            <label><strong>B. Core Behavioral Competencies</strong></label>

                                        </div>
                                        <div class="black-border">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="bg-black"><label for="b_strength" class="form-control-label ">Strengths</label></div>
                                                    <?php if($show_str_kra_cbc):
                                                        foreach($show_str_kra_cbc as $kra_cbc): ?>
                                                        <p class="tomato-color">
                                                        <?php echo displayCBCname($conn,$kra_cbc['strength_cbc_id']) ?>
                                                        </p>
                                                         <?php foreach(t_fetch_STR_IND_CBC($conn,$sy,$school,$kra_cbc['strength_cbc_id']) as $cbc_indi ):?>
                                                        <li>
                                                            <?= displayCBCind($conn,$cbc_indi['strength_cbc_ind_id'])  ?>
                                                        </li>
                                                         <?php endforeach; endforeach; endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="bg-black"><label for="a_strength" class="form-control-label ">Development Needs</label></div>
                                           

                                                    <?php if($show_devneed_kra_cbc):
                                                        foreach($show_devneed_kra_cbc as $kra_cbc): ?>
                                                        <p class="tomato-color">
                                                        <?php echo displayCBCname($conn,$kra_cbc['devneed_cbc_id']) ?>
                                                        </p>
                                                         <?php foreach(t_fetch_DEVNEED_IND_CBC($conn,$sy,$school,$kra_cbc['devneed_cbc_id']) as $cbc_indi ):?>
                                                        <li>
                                                            <?= displayCBCind($conn,$cbc_indi['devneed_cbc_ind_id'])  ?>
                                                        </li>
                                                         <?php endforeach; endforeach; endif; ?>

                                               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Action Plan</label>
                                                <?php
                                                        $action = devplan::showB3Action($conn);
                                                        foreach ($action as $act) :
                                                            $interb = $act['b_intervention'];
                                                            $learnb = $act['b_learning_objectives'];
                                                            $timeb = $act['b_timeline'];
                                                            $resourceb = $act['b_resources_needed'];
                                                        endforeach;
                                                        ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="b_learning_objectives" disabled id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"><?php if (!empty($learnb)): echo $learnb; else: echo "No record found"; endif; ?> </textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="intervention">Interventions:</label>
                                                    <textarea name="b_intervention" id="" disabled cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"> <?php if (!empty($interb)): echo $interb; else: echo "No record found"; endif; ?> </textarea>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Timelines, Resources needed and Feedback</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="timelines">Timelines:</label>
                                                    <textarea name="b_timeline" id="" cols="30" disabled rows="10" placeholder="Enter Timelines." class="form-control textarea"> <?php if (!empty($timeb)): echo $timeb; else: echo "No record found"; endif; ?></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="b_resources_needed" id="" disabled cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"> <?php if (!empty($resourceb)): echo $resourceb; else: echo "No record found"; endif; ?></textarea>
                                                </div>
                                            </div>

                                            <div>
                                                <?php
                                                        $action3 = devplan::showDevC($conn);
                                                        foreach ($action3 as $act3) :
                                                            $act3 = $act3['feedback'];
                                                        endforeach;
                                                        ?>
                                                <label for="learn-objectives" class="form-control-label">Feedback: </label>
                                                <textarea name="feedback" id="" cols="30" disabled rows="10" class="form-control textarea" placeholder=""><?php if (!empty($act3)): echo $act3; else: echo "No record found"; endif; ?></textarea>
                                            </div>
                                        </div>

                                        <br>
                                        <center>

                                            <?php directLastPage() ?>

                                        </center>

                            </form>
                        </div>
                        <!--end breadcome -->
                    </div><!-- end of container -->

                    <br>
                    <main>
                    <?php
                        /* ELSE FOR NOTIFICATION */
                        else :
                            echo  '<ul class="red-notif-border">';
                            foreach ($notifsss as $notifs) :
                                echo  $notifs;
                            endforeach;
                            echo '</ul>';
                            ?>
                <?php
                    /* END IF */
                    endif;
                /*--------------------------------------*/
                endif;
                include 'samplefooter.php';
                ?>