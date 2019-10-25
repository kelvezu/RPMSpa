<?php
    include 'includes/header.php';
?>
            <!-- welcome -->
            <div class="welcome-adminpro-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
                                <div class="welcome-adminpro-title">
                                    <h1><b>Welcome Principal</b></h1>
                                    <p>You have new notifications.</p>
                                </div>
                                <div class="adminpro-message-list">
                                    <ul class="message-list-menu">
                                        <li><span class="message-serial message-cl-one">1</span> <span class="message-info">A teacher has uploaded an MOV </span> <span class="message-time">09:00 pm</span>
                                        </li>
                                        <li><span class="message-serial message-cl-two">2</span> <span class="message-info">New IPCRF rating has been generated.</span> <span class="message-time">10:00 pm</span>
                                        </li>
                                        <li><span class="message-serial message-cl-three">3</span> <span class="message-info">There is an upcomming seminar.</span> <span class="message-time">05:00 pm</span>
                                        </li>
                                        <li><span class="message-serial message-cl-three">4</span> <span class="message-info">Deadline of IPCRF approval in 5 days.</span> <span class="message-time">05:00 pm</span>
                                        </li>
                                        <li><span class="message-serial message-cl-three">5</span> <span class="message-info">Deadline of MOV approval in 5 days.</span> <span class="message-time">05:00 pm</span>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                    <div class="analytics-rounded-content">
                                        <h5><b>Teacher KRA Challenges</b><span class="sparklineadminpro"></span></h5>
                                        <h2>KRA 4</h2>
                                        <p>Assessment and Reporting</p>
                                    <div class="text-center">
                                        <div id="sparkline25"></div>
                                    </div>
                                    </div>
                                </div>   
                                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                    <div class="analytics-rounded-content">
                                        <h5><b>Master Teacher KRA Challenges</b><span id="sparkline3"></span></h5>
                                        <h2>KRA 4</h2>
                                        <p>Assessment and Reporting</p>
                                    <div class="text-center">
                                        <div id="sparkline22"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                    
                        <div class="col-lg-4">
                            <div class="dashboard-line-chart shadow-reset mg-b-30">
                                <h4><b>Teacher IPCRF Summary Rating</b> <span class="bar">5,3,9,6,5,9,7,3,5,9</span></h4><br><br>
                                    <div class="text-center">
                                        <div id="sparkline24">
                                        </div>
                                    </div>
                            </div>
                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <h4><b> Master Teacher IPCRF Summary Rating</b> <span class="bar">5,3,9,6,5,8,7,3,5,2</span></h4> <br><br>
                                <div class="text-center">
                                        <div id="sparkline23">
                                        </div>
                                 </div>
                            </div>           
                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <h4><b> ESAT Progress</b> <span class="bar">5,3,9,6,5,8,7,3,5,2</span></h4>
                                <div class="text-center">
                                        <div id="sparkline51"> 
                                        </div>
                                </div>
                            </div>
                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <h4><b> IPCRF Progress </b><span class="bar">5,3,9,6,5,8,7,3,5,2</span></h4>
                                <div class="text-center">
                                        <div id="sparkline54"> 
                                        </div>
                                </div>
                            </div>           
                        </div>
                            

                        <div class="col-lg-4" >

                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <div class="dash-adminpro-project-title"> 
                                    <h4><a href="displaytprogress.php"><b>Teacher Masterlist</a></b><span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>&nbsp;&nbsp;&nbsp; 
                                    
                                </div>
                                    <div class="sparkline9-graph">
                                    <div class="static-table-list">
                                    <div class= "pre-scrollable">
                                        
                                        

                                        <table class="table sparkle-table ">
                                            
                                               
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if(isset($teacherMasterlist_results)):
                                                foreach($teacherMasterlist_results as $teacher):
                                                    $teachername = $teacher['firstname'].' '.substr($teacher['middlename'],0,1).'. '.$teacher['surname'];
                                                    ?>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td><?php echo $teachername; ?></td>
                                                    <td><?php echo $teacher['position']; ?></td>
                                                    <!-- <td><?php echo $teacher['status']; ?></td> -->
                                                </tr>
                                                <?php
                                                endforeach;
                                            else:
                                                echo 'no record';

                                            endif;
                                        ?>
                                        
                                            </tbody>
                                        </table>
                                        
                                    </div><br>
                                    <b>
                                        <?php if(isset($teacherTotal)):?>
                                                   <p>Total of Teachers: </b><?php
                                                   foreach($teacherTotal as $tCount):
                                                    echo $tCount['Total_Count_Teacher'];
                                                endforeach;
                                                    ?></p>
                                                    <?php
                                                else:
                                                echo 'No total of teachers!';
                                                endif;
                                                 ?>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <div class="dash-adminpro-project-title"> 
                                    <h4><a href="displaymtprogress.php"><b>Master Teacher Masterlist</a></b><span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>&nbsp;&nbsp;&nbsp; 
                                    
                                </div>
                                    <div class="sparkline9-graph">
                                    <div class="static-table-list">
                                    <div class= "pre-scrollable">
                                        
                                        

                                        <table class="table sparkle-table ">
                                            
                                               
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if(isset($masterteacherMasterlist_results)):
                                                foreach($masterteacherMasterlist_results as $masterteacher):
                                                    $masterteachername = $masterteacher['firstname'].' '.substr($masterteacher['middlename'],0,1).'. '.$masterteacher['surname'];
                                                    ?>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td><?php echo $masterteachername; ?></td>
                                                    <td><?php echo $masterteacher['position']; ?></td>
                                                    <!-- <td><?php echo $masterteacher['status']; ?></td> -->
                                                </tr>
                                                <?php
                                                endforeach;
                                            else:
                                                echo 'no record';

                                            endif;
                                        ?>
                                        
                                            </tbody>
                                        </table>
                                        
                                    </div><br>
                                    <b>
                                        <?php if(isset($masterteacherTotal)):?>
                                                   <p>Total of Master Teachers: </b><?php
                                                   foreach($masterteacherTotal as $mtCount):
                                                    echo $mtCount['Total_Count_MasterTeacher'];
                                                endforeach;
                                                    ?></p>
                                                    <?php
                                                else:
                                                echo 'No total of Master teachers!';
                                                endif;
                                                 ?>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <div class="dash-adminpro-project-title"> 
                                    <h4><b>School Heads Masterlist</b><span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>&nbsp;&nbsp;&nbsp; 
                                    
                                </div>
                                    <div class="sparkline9-graph">
                                    <div class="static-table-list">
                                    <div class= "pre-scrollable">
                                        
                                        

                                        <table class="table sparkle-table ">
                                            
                                               
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <!-- <?php
                                            if(isset($schoolheadMasterlist_results)):
                                                foreach($schoolheadMasterlist_results as $schoolhead):
                                                    $schoolheadname = $schoolhead['firstname'].' '.substr($schoolhead['middlename'],0,1).'. '.$schoolhead['surname'];
                                                    ?> -->
                                            <tbody>
                                                <tr>
                                                    
                                                    <td><?php echo $schoolheadname; ?></td>
                                                    <!-- <td><?php echo $schoolhead['position']; ?></td> -->
                                                    <!-- <td><?php echo $schoolhead['status']; ?></td> -->
                                                </tr>
                                                <?php
                                                endforeach;
                                            else:
                                                echo 'no record';

                                            endif;
                                        ?>
                                        
                                            </tbody>
                                        </table>
                                        
                                    </div><br>
                                    <b>
                                        <?php if(isset($schoolheadTotal)):?>
                                                   <p>Total of School Head: </b><?php
                                                   foreach($schoolheadTotal as $shCount):
                                                    echo $shCount['Total_Count_SchoolHead'];
                                                endforeach;
                                                    ?></p>
                                                    <?php
                                                else:
                                                echo 'No total of School Head!';
                                                endif;
                                                 ?>
                                        
                                    </div>
                                </div>
                            </div>
                            

                            <!-- <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                <h3><b>Recommended Seminar</b></h3> <br>
                                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                                    <h4><center>International Seminar Workshop on Special Education (SPEd) <br>
                                    Theme: The Changing Landscape of Special Education Worldwide: Its Impact on the Current Practices in the K to 12 Program
                                    </center></h4>
                                </div>
                            </div> -->
    </div>
</div>
</div>
</div>
<br>

<?php include 'includes/footer.php'; ?>