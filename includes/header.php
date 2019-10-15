<?php
session_start();
require_once 'security.php';
include_once 'conn.inc.php';
include_once 'includes/constants.inc.php';
include_once 'includes/classautoloader.inc.php';
include_once 'libraries/db.library.php';
include_once 'libraries/func.lib.php';
include_once 'includes/security.php';


$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$position = $_SESSION['position'];


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $_SESSION['position']; ?> Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- data-table CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- charts C3 CSS
		============================================ -->
    <link rel="stylesheet" href="css/c3.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<?php include_once 'libraries/queries.library.php'; ?>

<body class="materialdesign">
    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="#"><img src="img/message/1.jpg" alt="img/message/2.jpg" />
                    </a>
                    <h3><?php
                        if (isset($fullname)) :
                            echo 'Welcome, ' . $fullname;
                        else :
                            echo 'Welcome, Guest';
                        endif;
                        ?></h3>
                    <p><?php echo $_SESSION['position']; ?></p>
                    <strong><i class="fa big-icon fa-institution"></i> </strong>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro ">
                        <li class="nav-item ">
                            <a href="?i_love_you_so_much_baby_<3" role="button"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-list"></i> <span class="mini-dn">ESAT</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown animated flipInX">
                                <a href="#" class="dropdown-item">View Teacher Result</a>
                                <a href="#" class="dropdown-item">View Master Teacher Result</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-bullseye"></i> <span class="mini-dn">Development Plan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown animated flipInX">
                                <a href="#" class="dropdown-item">View Teacher Development Plan-IPCRF</a>
                                <a href="#" class="dropdown-item">View Teacher General Development Plan</a>
                                <a href="#" class="dropdown-item">VIew Master Teacher Development Plan-IPCRF</a>
                                <a href="#" class="dropdown-item">View Master Teacher General Development Plan</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-check-circle"></i> <span class="mini-dn">Means of Verification</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown animated flipInX">
                                <a href="#" class="dropdown-item">View Teacher MOVs</a>
                                <a href="#" class="dropdown-item">View Master Teacher MOVs</a>

                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-star"></i> <span class="mini-dn">COT</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown chart-left-menu-std animated flipInX">
                                <a href="#" class="dropdown-item">View Teacher COT</a>
                                <a href="#" class="dropdown-item">View Master Teacher COT</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-table"></i> <span class="mini-dn">IPCRF</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown animated flipInX">
                                <a href="#" class="dropdown-item">View Teacher IPCRF Rating</a>
                                <a href="#" class="dropdown-item">View Teacher PMCF Logs</a>
                                <a href="#" class="dropdown-item">View Teacher MRF</a>
                                <a href="#" class="dropdown-item">View Master Teacher IPCRF Rating</a>
                                <a href="#" class="dropdown-item">View Master Teacher PMCF Logs</a>
                                <a href="#" class="dropdown-item">View Master Teacher MRF</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-files-o"></i> <span class="mini-dn">Forms</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown form-left-menu-std animated flipInX">
                                <a href="ESATform1.php" class="dropdown-item">ESAT Form</a>
                                <a href="tcotform.php" class="dropdown-item">Teacher COT Rating Sheet</a>
                                <a href="tioafform.php" class="dropdown-item">Teacher IOAF Rating Sheet</a>
                                <a href="mtcotform.php" class="dropdown-item">Master Teacher COT Rating Sheet</a>
                                <a href="mtioafform.php" class="dropdown-item">Master Teacher IOAF Rating Sheet</a>
                                <a href="tipcrf.php" class="dropdown-item">Teacher IPCRF Rating Sheet</a>
                                <a href="mtipcrf.php" class="dropdown-item">Master Teacher IPCRF Rating Sheet</a>
                                <a href="devplan.php" class="dropdown-item">Development Plan</a>
                                <a href="pmcf.php" class="dropdown-item">PMCF</a>
                                <a href="mrf.php" class="dropdown-item">MRF</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-users"></i> <span class="mini-dn">Users</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown form-left-menu-std animated flipInX">
                                <a href="displayusers.php" class="dropdown-item">View User</a>
                                <a href="signup.php" class="dropdown-item">Add User</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-bullhorn"></i> <span class="mini-dn">Announcement</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown form-left-menu-std animated flipInX">
                                <a href="#" class="dropdown-item">View Announcements</a>
                                <a href="#" class="dropdown-item">Add Add Announcement</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-edit"></i> <span class="mini-dn">Reports</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown form-left-menu-std animated flipInX">
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
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-cogs"></i> <span class="mini-dn">Settings</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu pre-scrollable left-menu-dropdown form-left-menu-std animated flipInX">
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
                    </ul>
                </div>

            </nav>
        </div>
    </div>


    <div class="content-inner-all">
        <div class="header-top-area">
            <div class="fixed-header-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="admin-logo logo-wrap-pro">
                                <a href="#"><img src="img/logo/log.png" alt="" />
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                            <div class="header-top-menu tabl-d-n">
                                <ul class="nav navbar-nav mai-top-nav">
                                    <li class="nav-item"><a href="#" class="nav-link">Home</a>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">About</a>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="header-right-info">
                                <ul class="nav navbar-nav mai-top-nav header-right-menu">

                                    <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-bell-o" aria-hidden="true"></i><!-- <span class="indicator-nt"></span> --></a>
                                        <div role="menu" class="notification-author dropdown-menu animated flipInX">
                                            <div class="notification-single-top">
                                                <h1>Notifications</h1>
                                            </div>
                                            <ul class="notification-menu">
                                                <li>
                                                    <a href="#">
                                                        <div class="notification-icon">
                                                            <span class="adminpro-icon adminpro-cloud-computing-down"></span>
                                                        </div>
                                                        <div class="notification-content">
                                                            <!-- NOTIFICATION AREA! -->
                                                            <span class="notification-date">13 Sept</span>
                                                            <h5>Archie Salas</h5>
                                                            <p>Your IPCRF Rating has been approved.</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="notification-view">
                                                <a href="#">View All Notification</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                            <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                            <span class="admin-name">
                                                <?php
                                                if (isset($fullname)) :
                                                    echo 'Welcome, ' . $fullname;
                                                else :
                                                    echo 'Welcome, Guest';
                                                endif;
                                                ?></span>
                                            <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                            <li><a href="#"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>My Account</a>
                                            </li>
                                            <li><a href="#"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>My Profile</a>
                                            </li>
                                            <li><a href="#"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                                            </li>
                                            <li><a href="includes/logout.inc.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Header top area end-->
        <!-- Breadcome start-->
        <div class="breadcome-area mg-b-30 small-dn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
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