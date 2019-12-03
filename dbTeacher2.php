   <?php include 'includes/header.php'; ?>


   <!-- welcome Project, sale area start-->
   <div class="welcome-adminpro-area">
       <div class="container-fluid">
           <div class="row">
               <div class="col-lg-3 col-lg-3">
                   <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
                       <div class="welcome-adminpro-title">
                           <h1>Welcome <?php echo $_SESSION['position']; ?></h1>
                           <p>You have new notifications.</p>
                       </div>
                       <div class="adminpro-message-list">
                           <ul class="message-list-menu">
                               <li><span class="message-serial message-cl-one">1</span> <span class="message-info">You have new COT rating</span> <span class="message-time">09:00 pm</span>
                               </li>
                               <li><span class="message-serial message-cl-two">2</span> <span class="message-info">Your IPCRF Rating has been approved</span> <span class="message-time">10:00 pm</span>
                               </li>
                               <li><span class="message-serial message-cl-three">3</span> <span class="message-info">There is an upcomming seminar.</span> <span class="message-time">05:00 pm</span>
                               </li>
                               <li><span class="message-serial message-cl-four">4</span> <span class="message-info">You have a new PMCF</span> <span class="message-time">04:00 pm</span>
                               </li>
                               <li><span class="message-serial message-cl-five">5</span> <span class="message-info">Deadline for MOV for mid year review</span> <span class="message-time">09:00 pm</span>
                               </li>
                           </ul>
                       </div>
                   </div>
                   <div class="dashone-adminprowrap shadow-reset mg-b-30">
                       <div class="analytics-rounded-content">
                           <h5>KRA Challenges<span class="sparklineadminpro"></span></h5>
                           <h2>KRA 4</h2>
                           <p>Assessment and Reporting</p>
                           <div class="text-center">
                               <div id="sparkline25"></div>
                           </div>
                       </div>
                   </div>
                   <div class="dashone-adminprowrap shadow-reset mg-b-30">
                       <div class="analytics-rounded-content">
                           <h3>COT Rating <span id="sparkline3"></span></h3><br>
                           <h5>1st Rating = 5 &nbsp;&nbsp; 2nd Rating = 6 </h5><br>
                           <h5>3rd Rating = 5 &nbsp;&nbsp; 4th Rating = 6 </h5>
                           <div class="text-center">
                               <div id="sparkline22"></div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-lg-4 col-lg-4">
                   <div class="dashboard-line-chart shadow-reset mg-b-30">
                       <?php

                        $dataPoints = array(
                            array("y" => 3, "label" => "2018"),
                            array("y" => 3.5, "label" => "2019"),
                            array("y" => 4, "label" => "2020"),
                            array("y" => 4.3, "label" => "2021"),
                            array("y" => 4.5, "label" => "2022"),
                            array("y" => 4.7, "label" => "2023"),
                            array("y" => 5, "label" => "2024")
                        );

                        ?>

                       <script>
                           window.onload = function() {

                               var chart = new CanvasJS.Chart("chartContainer", {
                                   title: {
                                       text: "IPCRF Summary Rating"
                                   },
                                   axisY: {
                                       title: "Rating"
                                   },
                                   data: [{
                                       type: "line",
                                       dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                   }]
                               });
                               chart.render();

                           }
                       </script>

                       <div id="chartContainer" style="height: 290px; width: 95%;"></div>
                       <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


                   </div>


                   <div class="dashone-adminprowrap shadow-reset mg-b-30 text-center">
                       <h5>Congratulations! You are qualified for promotion! <span id="sparkline1"></span></h5>
                       <h5>Congratulations! You are part of the outstanding teacher!<span id="sparkline2"></span></h5>
                   </div>


                   <div class="dashone-adminprowrap shadow-reset mg-b-30 text-center">
                       <h3>COT Strength and Weakness</h3>

                       <div class="dashone-adminprowrap shadow-reset mg-b-30">
                           <div class="sparkline8-graph">
                               <span id="sparkline8"></span>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-lg-5">
                   <div class="dashone-adminprowrap shadow-reset mg-b-30 text-center">
                       <div class="dash-adminpro-project-title"><br><br>

                           <a href="kra1.php" role="button" class="btn btn-custon-rounded-four btn-primary">KRA 1</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="kra2.php" role="button" class="btn btn-custon-rounded-four btn-primary">KRA 2</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="kra3.php" role="button" class="btn btn-custon-rounded-four btn-primary">KRA 3</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="kra4.php" role="button" class="btn btn-custon-rounded-four btn-primary">KRA 4</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="kra5.php" role="button" class="btn btn-custon-rounded-four btn-primary">KRA 5</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <br><br><br>
                           <div class="dashone-adminprowrap shadow-reset mg-b-30 text-center">
                               <br><br>
                               <h1>Result Based Performance Management Sytem (RPMS)</h1><br><br><br><br>
                               <p>
                                   <h1>My Portfolio</h1>
                               </p><br><br> <br><br>
                           </div>
                           <div class="analysis-progrebar-area mg-t-30 materialdesign-alert">
                               <div class="container-fluid">
                                   <div class="row">
                                       <div class="analysis-progrebar ant-res-b-30 ant-res-b-nt-30 shadow-reset">
                                           <div class="analysis-progrebar-content">
                                               <h5>MOV Attachment Progress</h5>
                                               <h2><span class="counter">50</span>%</h2>
                                               <div class="progress progress-mini">
                                                   <div style="width: 50%;" class="progress-bar">
                                                   </div>
                                               </div>

                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <br>
                               <p>
                                   <h4>S.Y. <?php echo $_SESSION['sy']; ?></h4>
                               </p> <br><br>
                               <button class="btn btn-custon-rounded-four btn-primary" type="button">View MOV Attachments</button>


                           </div>
                       </div>
                   </div>

               </div>
           </div>
       </div>

       <?php include 'includes/footer.php'; ?>