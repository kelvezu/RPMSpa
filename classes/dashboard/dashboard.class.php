<?php

namespace Dashboard;

class Dashboard
{
    public static function headerViews($position)
    {
        if ($position == "Admin") :

        elseif ($position == "Superintendent") :

        elseif ($position == "Principal") :

        elseif ($position == "School Head") :

        elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :

        elseif ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :

        else : return false;
        endif;
    }

    public static function DOpersonnelOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Admin" || $_SESSION['position'] == "Superintendent" || $_SESSION['position'] == "Admin Assistant" || $_SESSION['position'] == "Assistant Superintendent") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function DOandSHonly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Admin" || $_SESSION['position'] == "Superintendent" || $_SESSION['position'] == "Admin Assistant" || $_SESSION['position'] == "Assistant Superintendent" || $_SESSION['position'] == "School Head" || $_SESSION['position'] == "Principal" || $_SESSION['position'] == "Assistant Principal") :
                return true;
            else : return false;
            endif;
        }
    }



    public static function adminOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Admin") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function assistAdminOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Admin" || $_SESSION['position'] == "Assistant Admin") :
                return true;
            else : return false;
            endif;
        }
    }


    public static function superintendentOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Superintendent") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function principalOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Principal") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function assistPrincipalOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "Principal" || $_SESSION['position'] == "Assistant Principal") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function schoolheadOnly()
    {
        if (isset($_SESSION['position'])) {
            if ($_SESSION['position'] == "School Head" || $_SESSION['position'] == "Principal") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function mTeacherOnly()
    {
        if (isset($_SESSION['position'])) {
            $position = $_SESSION['position'];
            if ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function teacherOnly()
    {
        if (isset($_SESSION['position'])) {
            $position = $_SESSION['position'];
            if ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :
                return true;
            else : return false;
            endif;
        }
    }

    public static function navbarView()
    {
        $nav = "";
        if ($_SESSION['position'] == "Admin" or $_SESSION['position'] == "Assistant Admin") :
            $nav .= '<ul class="navbar-nav mr-auto " >';
            $nav .= '  
                <li class="nav-item active">
                    <a id="home-btn" class="nav-link" href="dbAdmin.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                        <div class="dropdown-menu " aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="esattableAdminT.php">View General Teacher ESAT</a>
                            <a class="dropdown-item" href="esattableAdminMT.php">View General Master Teacher ESAT</a>
                        </div>
                </li>

                <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="#">View Teacher Development Plan-IPCRF</a>
                        <a class="dropdown-item" href="viewgendevplant.php">View Teacher General Development Plan</a>
                        <a class="dropdown-item" href="#">VIew Master Teacher Development Plan-IPCRF</a>
                        <a class="dropdown-item" href="viewgendevplanmt.php">View Master Teacher General Development Plan</a>
                    </div>
                </li>

                <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="cotAveTadmin.php">View Teacher Average COT</a>
                                <a class="dropdown-item" href="cotAveMTadmin.php">View Master Teacher Average COT</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="">View Teacher MOV</a>
                                <a class="dropdown-item" href="">View Master Teacher MOV</a>
                            </div>
                    </li>
    

                <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                    <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                    <a href="setcotform.php" class="dropdown-item">Teacher COT Rating Sheet</a>
                    <a href="setcotformMT.php" class="dropdown-item">Master Teacher COT Rating Sheet</a>
                    <a href="tipcrf.php" class="dropdown-item">Teacher IPCRF Rating Sheet</a>
                    <a href="mtipcrf.php" class="dropdown-item">Master Teacher IPCRF Rating Sheet</a>
                    <a href="pmcf.php" class="dropdown-item">PMCF</a>
                    <a href="mrf.php" class="dropdown-item">MRF</a>
                    </div>
                </li>

                <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-cog"></i> User Settings</a>
                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a href="displayusers.php" class="dropdown-item">View User</a>
                                <a href="usercsv.php" class="dropdown-item">Mass Upload</a>
                                <a href="signup.php" class="dropdown-item">Add User</a>
                                <a href="promote.php" class="dropdown-item">Promote User</a>
                                <a href="selectteacher.php" class="dropdown-item">Assign Teacher</a>
                                <a href="SELECTTRATEE.php" class="dropdown-item">Assign Rater</a>
                    </div>
                </li>

                <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                        <a href="#" class="dropdown-item">Teacher KRA Challenges</a>
                        <a href="#" class="dropdown-item">Master Teacher KRA Challenges</a>
                        <a href="#" class="dropdown-item">Teacher Performance Summary </a>
                        <a href="#" class="dropdown-item">Master Teacher Performance Summary </a>
                        <a href="#" class="dropdown-item">Teacher IPCRF with MOV Rating</a>
                        <a href="#" class="dropdown-item">Master Teacher IPCRF with MOV Rating</a>
                        <a href="#" class="dropdown-item">Teacher IPCRF Summary Rating</a>
                        <a href="#" class="dropdown-item">Master Teacher IPCRF Summary Rating</a>
                        <a href="#" class="dropdown-item">Teacher Recommended for Promotion</a>
                        <a href="#" class="dropdown-item">Master Teacher Recommended for Promotion</a>
                        <a href="#" class="dropdown-item">Seminar List</a>
                    </div>
                </li>

                <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> Settings</a>
                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                    <a href="sy.php" class="dropdown-item">School Year</a>
                    <a href="school.php" class="dropdown-item">School Info</a>
                    <a href="displaypolicy.php" class="dropdown-item">Policy</a>
                    <a href="ESAT.php" class="dropdown-item">ESAT Details </a>
                    <a href="displaycbc.php " class="dropdown-item">ESAT Core Behavioral Settings </a>
                    <a href="displaytRubric.php" class="dropdown-item">Teacher COT Rubrics</a>
                    <a href="displaymtRubric.php" class="dropdown-item">Master Teacher COT Rubrics</a>
                    <a href="displaytindicator.php" class="dropdown-item">Teacher COT Indicator List</a>
                    <a href="displaymtindicator.php" class="dropdown-item">Master Teacher COT Indicator List</a>
                    <a href="displayperftindicator.php" class="dropdown-item">Teacher Performance Indicator List</a>
                    <a href="displayperfmtindicator.php" class="dropdown-item">Master Teacher Performance Indicator List</a>
                    <a href="displaytkramov.php" class="dropdown-item">Teacher KRA and Objective Details</a>
                    <a href="displaymtkramov.php" class="dropdown-item">Master Teacher Objective Details</a>
                    <a href="displaytmov.php" class="dropdown-item">Teacher MOV Details</a>
                    <a href="displaymtmov.php" class="dropdown-item">Master Teacher MOV Details</a>
                    <a href="displayseminar.php" class="dropdown-item">Seminar List</a>
                    </div>
                </li>

            ';
            $nav .= '</ul>';

        elseif ($_SESSION['position'] == "Superintendent" or $_SESSION['position'] == "Assistant Superintendent" or $_SESSION['position'] == "Asst. Superintendent") :
            $nav .= '<ul class="navbar-nav mr-auto " >';
            $nav .= '  
                    <li class="nav-item active">
                        <a id="home-btn" class="nav-link" href="dbAsstSuperintendent.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                    </li>
    
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="esattablePrincipalMT.php">View General Master Teacher ESAT</a>
                            </div>
                    </li>
    
                    <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                        <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="#">VIew Master Teacher Development Plan-IPCRF</a>
                            <a class="dropdown-item" href="#">View Master Teacher General Development Plan</a>
                            <a class="dropdown-item" href="#">Create Master Teacher General Development Plan</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                        <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="cotrateviewMTprincipal.php">View Master Teacher COT</a>
                            <a class="dropdown-item" href="cotAveMTprincipal.php">View Master Teacher Average COT</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                        <div class="dropdown-menu " aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="">View Master Teacher MOV</a>
                        </div>
                </li>

                    <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                        <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                        <a href="setcotformMT.php" class="dropdown-item">Master Teacher COT Rating Sheet</a>
                        <a href="mtipcrf.php" class="dropdown-item">Master Teacher IPCRF Rating Sheet</a>
                        <a href="devplan.php" class="dropdown-item">Development Plan</a>
                        <a href="pmcf.php" class="dropdown-item">PMCF</a>
                        <a href="mrf.php" class="dropdown-item">MRF</a>
                        </div>
                    </li>
    
                    <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                        <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a href="#" class="dropdown-item">Master Teacher KRA Challenges</a>
                            <a href="#" class="dropdown-item">Master Teacher Performance Summary </a>
                            <a href="#" class="dropdown-item">Master Teacher IPCRF with MOV Rating</a>
                            <a href="#" class="dropdown-item">Master Teacher IPCRF Summary Rating</a>
                            <a href="#" class="dropdown-item">Master Teacher Recommended for Promotion</a>
                            <a href="#" class="dropdown-item">Seminar List</a>
                        </div>
                    </li>
    
                   
    
                ';
            $nav .= '</ul>';

        elseif ($_SESSION['position'] == "Principal" or $_SESSION['position'] == "Assistant Principal") :
            $nav .= '<ul class="navbar-nav mr-auto " >';
            $nav .= '  
                        <li class="nav-item active">
                            <a id="home-btn" class="nav-link" href="dbPrincipal.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                        </li>
        
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                                <div class="dropdown-menu " aria-labelledby="dropdown03">
                                    <a class="dropdown-item" href="esattablePrincipalT.php">View General Teacher ESAT</a>
                                    <a class="dropdown-item" href="esattablePrincipalMT.php">View General Master Teacher ESAT</a>
                                </div>
                        </li> 
    
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chart-line"></i> Teacher Progress</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="displaytprogress.php">Teacher Progress</a>
                                <a class="dropdown-item" href="displaymtprogress.php">Master Teacher Progress</a>
                            </div>
                    </li>
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="#">View Teacher Development Plan-IPCRF</a>
                                <a class="dropdown-item" href="viewgendevplant.php">View Teacher General Development Plan</a>
                                <a class="dropdown-item" href="#">VIew Master Teacher Development Plan-IPCRF</a>
                                <a class="dropdown-item" href="viewgendevplanmt.php">View Master Teacher General Development Plan</a>
                                <a class="dropdown-item" href="gendevplanT.php">Create Teacher General Development Plan</a>
                                <a class="dropdown-item" href="gendevplanMT.php">Create Master Teacher General Development Plan</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="cotrateviewTprincipal.php">View Teacher COT</a>
                                <a class="dropdown-item" href="cotAveTprincipal.php">View Teacher Average COT</a>
                                <a class="dropdown-item" href="cotrateviewMTprincipal.php">View Master Teacher COT</a>
                                <a class="dropdown-item" href="cotAveMTprincipal.php">View Master Teacher Average COT</a>
                                <a class="dropdown-item" href="setcotform.php">Rate Teacher COT</a>
                                <a class="dropdown-item" href="setcotformMT.php">Rate Master Teacher COT</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="">View Teacher MOV</a>
                                <a class="dropdown-item" href="">View Master Teacher MOV</a>
                            </div>
                    </li>
    
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                            <a href="setcotform.php" class="dropdown-item">Teacher COT Rating Sheet</a>
                            <a href="setcotformMT.php" class="dropdown-item">Master Teacher COT Rating Sheet</a>
                            <a href="tipcrf.php" class="dropdown-item">Teacher IPCRF Rating Sheet</a>
                            <a href="mtipcrf.php" class="dropdown-item">Master Teacher IPCRF Rating Sheet</a>
                            <a href="devplan.php" class="dropdown-item">Development Plan</a>
                            <a href="pmcf.php" class="dropdown-item">PMCF</a>
                            <a href="mrf.php" class="dropdown-item">MRF</a>
                            </div>
                        </li>
        
                       
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a href="#" class="dropdown-item">Teacher KRA Challenges</a>
                                <a href="#" class="dropdown-item">Master Teacher KRA Challenges</a>
                                <a href="#" class="dropdown-item">Teacher Performance Summary </a>
                                <a href="#" class="dropdown-item">Master Teacher Performance Summary </a>
                                <a href="#" class="dropdown-item">Teacher IPCRF with MOV Rating</a>
                                <a href="#" class="dropdown-item">Master Teacher IPCRF with MOV Rating</a>
                                <a href="#" class="dropdown-item">Teacher IPCRF Summary Rating</a>
                                <a href="#" class="dropdown-item">Master Teacher IPCRF Summary Rating</a>
                                <a href="#" class="dropdown-item">Teacher Recommended for Promotion</a>
                                <a href="#" class="dropdown-item">Master Teacher Recommended for Promotion</a>
                                <a href="#" class="dropdown-item">Seminar List</a>
                            </div>
                        </li>
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> Settings</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a href="setobsperiod.php" class="dropdown-item">Set COT Period</a>
                            <a href="selecttratee.php" class="dropdown-item">Select Teacher to Rate</a>
                            </div>
                        </li>
        
                    ';
            $nav .= '</ul>';
        elseif ($_SESSION['position'] == "School Head") :
            $nav .= '<ul class="navbar-nav mr-auto ">';
            $nav .= '  
                        <li class="nav-item active">
                            <a id="home-btn" class="nav-link" href="dbSchoolHead.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                        </li>
        
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                                <div class="dropdown-menu " aria-labelledby="dropdown03">
                                    <a class="dropdown-item" href="esattableschoolheadT.php">View General Teacher ESAT</a>
                                    <a class="dropdown-item" href="esattableschoolheadMT.php">View General Master Teacher ESAT</a>
                                </div>
                        </li>
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="#">View Teacher Development Plan-IPCRF</a>
                                <a class="dropdown-item" href="#">View Teacher General Development Plan</a>
                                <a class="dropdown-item" href="#">VIew Master Teacher Development Plan-IPCRF</a>
                                <a class="dropdown-item" href="#">View Master Teacher General Development Plan</a>
                                <a class="dropdown-item" href="#">Create Teacher General Development Plan</a>
                                <a class="dropdown-item" href="#">Create Master Teacher General Development Plan</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="cotrateviewTschoolhead.php">View Teacher COT</a>
                                <a class="dropdown-item" href="cotAveTschoolhead.php">View Teacher Average COT</a>
                                <a class="dropdown-item" href="cotrateviewMTschoolhead.php">View Master Teacher COT</a>
                                <a class="dropdown-item" href="cotAveMTschoolhead.php">View Master Teacher Average COT</a>
                                <a class="dropdown-item" href="setcotform.php">Rate Teacher COT</a>
                                <a class="dropdown-item" href="setcotformMT.php">Rate Master Teacher COT</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="viewattachment.userMT.php">View MOV</a>
                            </div>
                    </li>
            
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                            <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                            <a href="setcotform.php" class="dropdown-item">Teacher COT Rating Sheet</a>
                            <a href="setcotformMT.php" class="dropdown-item">Master Teacher COT Rating Sheet</a>
                            <a href="tipcrf.php" class="dropdown-item">Teacher IPCRF Rating Sheet</a>
                            <a href="mtipcrf.php" class="dropdown-item">Master Teacher IPCRF Rating Sheet</a>
                            <a href="devplan.php" class="dropdown-item">Development Plan</a>
                            <a href="pmcf.php" class="dropdown-item">PMCF</a>
                            <a href="mrf.php" class="dropdown-item">MRF</a>
                            </div>
                        </li>
        
                       
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a href="#" class="dropdown-item">Teacher KRA Challenges</a>
                                <a href="#" class="dropdown-item">Master Teacher KRA Challenges</a>
                                <a href="#" class="dropdown-item">Teacher Performance Summary </a>
                                <a href="#" class="dropdown-item">Master Teacher Performance Summary </a>
                                <a href="#" class="dropdown-item">Teacher IPCRF with MOV Rating</a>
                                <a href="#" class="dropdown-item">Master Teacher IPCRF with MOV Rating</a>
                                <a href="#" class="dropdown-item">Teacher IPCRF Summary Rating</a>
                                <a href="#" class="dropdown-item">Master Teacher IPCRF Summary Rating</a>
                                <a href="#" class="dropdown-item">Teacher Recommended for Promotion</a>
                                <a href="#" class="dropdown-item">Master Teacher Recommended for Promotion</a>
                                <a href="#" class="dropdown-item">Seminar List</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>Ratee</a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a href="selecttratee.php" class="dropdown-item">Select Teacher to Rate</a>
                            </div>
                        </li>



                    ';
            $nav .= '</ul>';
        elseif ($_SESSION['position'] == "Master Teacher I" or $_SESSION['position'] == "Master Teacher II" or $_SESSION['position'] == "Master Teacher III" or $_SESSION['position'] == "Master Teacher IV") :
            $nav .= '<ul class="navbar-nav mr-auto ">';
            $nav .= '  
                            <li class="nav-item active">
                                <a id="home-btn" class="nav-link" href="dbMasterTeacher.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                            </li>
            
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                                    <div class="dropdown-menu " aria-labelledby="dropdown03">
                                        <a class="dropdown-item" href="esattableschoolheadT.php">View General Teacher ESAT</a>
                                        <a class="dropdown-item" href="esattableMasterTeacher.php">View My ESAT Result</a>
                                       
                                    </div>
                            </li>
        
                        <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="attachfileMT.php">Attach File</a>
                                <a class="dropdown-item" href="viewattachment.userMT.php">View MOV</a>
                            </div>
                    </li>

            
                            <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                                <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                    <a class="dropdown-item" href="#">View Teacher Development Plan-IPCRF</a>
                                    <a class="dropdown-item" href="viewgendevplant.php">View Teacher General Development Plan</a>
                                    <a class="dropdown-item" href="#">Create IPCRF Development Plan</a>
                                </div>
                            </li>
s
                            <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                            <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="cotrateviewTschoolhead.php">View Teacher COT</a>
                                <a class="dropdown-item" href="cotAveTschoolhead.php">View Teacher Average COT</a>
                                <a class="dropdown-item" href="cotrateviewMT.php">View My COT Rating</a>
                                <a class="dropdown-item" href="cotAveMT.php">View My Average COT</a>
                                <a class="dropdown-item" href="setcotform.php">Rate Teacher COT</a>
                            </div>
                        </li>
        
                            <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                                <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                                <a href="setcotform.php" class="dropdown-item">Teacher COT Rating Sheet</a>                  <a href="tipcrf.php" class="dropdown-item">Teacher IPCRF Rating Sheet</a> 
                                <a href="viewgendevplanmt.php" class="dropdown-item">Development Plan</a>
                                <a href="pmcf.php" class="dropdown-item">PMCF</a>
                                <a href="mrf.php" class="dropdown-item">MRF</a>
                                </div>
                            </li>
            
                           
            
                            <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="dbTeacher.php" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                                <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                    <a href="#" class="dropdown-item">Teacher KRA Challenges</a>
                                    <a href="#" class="dropdown-item">Teacher Performance Summary </a>
                                    <a href="#" class="dropdown-item">Teacher IPCRF with MOV Rating</a>
                                    <a href="#" class="dropdown-item">Teacher IPCRF Summary Rating</a>
                                    <a href="#" class="dropdown-item">Teacher Recommended for Promotion</a>
                                    <a href="#" class="dropdown-item">Seminar List</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>Ratee</a>
                                <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                    <a href="selecttratee.php" class="dropdown-item">Select Teacher to Rate</a>
                                </div>
                            </li>
            
                           
            
                        ';
            $nav .= '</ul>';

        elseif ($_SESSION['position'] == "Teacher I" or $_SESSION['position'] == "Teacher II" or $_SESSION['position'] == "Teacher III") :
            $nav .= '<ul class="navbar-nav mr-auto ">';
            $nav .= '  
                                <li class="nav-item active">
                                    <a id="home-btn" class="nav-link" href="#"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                                </li>
                
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chalkboard-teacher"></i> ESAT</a>
                                        <div class="dropdown-menu " aria-labelledby="dropdown03">
                                            <a class="dropdown-item" href="esattableTeacher.php">My ESAT Progress</a>
                                        </div>
                                </li>
            
                                <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-chart-line"></i> My Progress</a>
                                    <div class="dropdown-menu " aria-labelledby="dropdown03">
                                        <a class="dropdown-item" href="#">My RPMS Progress</a>
                                    </div>
                            </li>

                            <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-folder-open"></i> Means of Verification</a>
                            <div class="dropdown-menu " aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="attachfile.php">Attach File</a>
                                <a class="dropdown-item" href="viewattachment.userT.php">View MOV</a>
                            </div>
                    </li>
                
                                <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chalkboard"></i> Development Plan</a>
                                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                        <a class="dropdown-item" href="#">My Teacher Development Plan-IPCRF</a>
                                        <a class="dropdown-item" href="#">View Teacher General Development Plan</a>
                                        <a class="dropdown-item" href="#">Create IPCRF Development Plan</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-edit"></i> COT </a>
                                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                        <a class="dropdown-item" href="cotrateviewT.php">View My COT Rating</a>
                                        <a class="dropdown-item" href="cotAveT.php">View My Average COT</a>
                                    </div>
                                </li>
            
                                <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder"></i> RPMS Forms</a>
                                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                    <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                                    <a href="viewgendevplant.php" class="dropdown-item">My Development Plan</a>
                                    <a href="pmcf.php" class="dropdown-item">PMCF</a>
                                    <a href="mrf.php" class="dropdown-item">MRF</a>
                                    </div>
                                </li>
                
                               
                
                                <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Reports</a>
                                    <div class="dropdown-menu  border border-dark" aria-labelledby="dropdown03">
                                        <a href="#" class="dropdown-item">My KRA Challenges</a>
                                        <a href="#" class="dropdown-item">My Performance Summary </a>
                                        <a href="#" class="dropdown-item">My IPCRF with MOV Rating</a>
                                        <a href="#" class="dropdown-item">My IPCRF Summary Rating</a>
                                        <a href="#" class="dropdown-item">My Recommended for Promotion</a>
                                        <a href="#" class="dropdown-item">Seminar List</a>
                                    </div>
                                </li>
                
                               
                
                            ';
            $nav .= '</ul>';
        else : return false;
        endif;

        return $nav;
    }
}
