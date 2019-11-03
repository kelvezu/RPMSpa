<?php include 'includes/header.php'; ?>

<!-- Breadcome start-->
<div class="breadcome-area des-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcome-heading">
                                <form role="search" class="">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <ul class="breadcome-menu">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Dashboard</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome End-->
<!-- welcome Project, sale area start-->
<div class="welcome-adminpro-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
                    <div class="welcome-adminpro-title">
                        <h1><b>Welcome Admin</b></h1>
                        <p>You have new notifications.</p>
                    </div>
                    <div class="pre-scrollable">
                        <div class="adminpro-message-list">
                            
                                    <table class="table table-hover">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                        <?php
                                        $no = 1;
                                        $result = $conn->query('SELECT * FROM notification_tbl WHERE `status`="Active" ORDER BY notif_id desc limit 5');
                                        while ($row = $result->fetch_assoc()) :
                                            $category = $row['category'];
                                            $title = $row['title'];
                                            $message = $row['message'];
                                            $date = $row['datetime_stamp'];
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $message; ?></td>
                                                <td> <?php echo $date; ?></td>

                                            </tr>
                                        <?php
                                            $no++;
                                        endwhile; ?>
                                    </table>
                            </div>      
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
                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                    <div class="analytics-rounded-content">
                        <h4><b>School Master List</b><span id="sparkline4"></span></h4>
                        <div class="pre-scrollable">
                            <div class="adminpro-message-list">
                            
                                <table class="table table-hover">
                                        <tr>
                                            <th>#</th>
                                            <th>School Name</th>
                                            <th>No. of Teacher</th>
                                            
                                        </tr>
                                        <?php
                                        $no = 1;
                                        $result = $conn->query('SELECT a.school_id,a.school_name, count(distinct b.user_id) as x FROM school_tbl a inner join account_tbl b on a.school_id = b.school_id where b.status="Active" and b.position like "Teacher%" or b.position like "Master Teacher%" group by a.school_name');
                                        while ($row = $result->fetch_assoc()) :
                                            $school_name = $row['school_id'];
                                            $school_name = $row['school_name'];
                                            $count = $row['x'];
    

                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><a href="dbAdminView.php?view=<?php echo $row['school_id']; ?>"><?php echo $school_name; ?> </a></td>
                                                <td><?php echo $count; ?></td>

                                            </tr>
                                        <?php
                                            $no++;
                                        endwhile; ?>
                                    </table>

                           </div>                
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="dashboard-line-chart shadow-reset mg-b-30">
                    <h4><b>Teacher IPCRF Summary Rating</b> <span class="bar">5,3,9,6,5,9,7,3,5,2</span></h4><br><br>
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
                    <div class="analytics-rounded-content">
                        <h4><b>School With ESAT</b><span id="sparkline4"></span></h4>
                        <div class="pre-scrollable">
                            <div class="adminpro-message-list">
                            
                                <table class="table table-hover">
                                        <tr>
                                            
                                            <th>No.</th>
                                            <th>School Name</th>
                                            <th># of Teacher</th>
                                            <th>With ESAT</th>
                                            <th>S_Y</th>
                                            
                                            
                                        </tr>
                                        <?php
                                        $no=1;
                                        $result = $conn->query('SELECT * FROM tbl_rptwithesat');
                                        while ($row = $result->fetch_assoc()) :
                                            $school_id = $row['school_id'];
                                            $school_name = $row['school_name'];
                                            $Total_Teacher = $row['Total_Teacher'];
                                            $With_ESAT = $row['With_ESAT'];
                                            $School_Year = $row['School_Year'];
                                            
    

                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $school_name; ?></td>
                                                <td><?php echo $Total_Teacher; ?></td>
                                                <td><?php echo $With_ESAT; ?></td>
                                                <td><?php echo $School_Year; ?></td>
                                                

                                            </tr>
                                        <?php
                                            $no++;
                                        endwhile; ?>
                                    </table>

                           </div>                
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


            <div class="col-lg-4">
                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                    <div class="dash-adminpro-project-title">
                        <h4><b>Teacher Ranking Summary </b><span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>&nbsp;&nbsp;&nbsp;<a href="#">View</a></h4>
                    </div>
                    <div class="sparkline9-graph">
                        <div class="static-table-list">
                            <table class="table sparkle-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Madelene Guerra</td>
                                        <td>Teacher I</td>
                                        <td> 5</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Rose Tan</td>
                                        <td>Teacher III</td>
                                        <td> 5</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Rafael Chavez</td>
                                        <td>Teacher II</td>
                                        <td> 5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                    <div class="dash-adminpro-project-title">
                        <h4><b>Master Teacher Ranking Summary </b><span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span> &nbsp;&nbsp;&nbsp;<a href="#">View</a></h4>
                    </div>
                    <div class="sparkline9-graph">
                        <div class="static-table-list">
                            <table class="table sparkle-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Archie Salas</td>
                                        <td>Master Teacher I</td>
                                        <td> 7</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Raymond Cunanan</td>
                                        <td>Master Teacher III</td>
                                        <td> 7</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Marlon Gelito</td>
                                        <td>Master Teacher II</td>
                                        <td> 7</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="dashone-adminprowrap shadow-reset mg-b-30">
                    <h3><b>Recommended Seminar</b></h3> <br>
                    <div class="dashone-adminprowrap shadow-reset mg-b-30 text-center">
                        <h4>International Seminar Workshop on Special Education (SPEd) <br>
                            Theme: The Changing Landscape of Special Education Worldwide: Its Impact on the Current Practices in the K to 12 Program
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>