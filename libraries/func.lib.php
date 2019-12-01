
            <?php


            //GET THE START

            use Dashboard\Dashboard;

            function getStartYear()
            {
                return date('Y');
            }

            function getEndYear()
            {
                $currentYear =  date('Y');
                $nextYear = strtotime('next Year');
                return date('Y', $nextYear);
            }


            // username Generator
            function usernameGen($firstname, $surname, $contact)
            {
                $user = substr($firstname, 0, 4) . substr($surname, 0, 3) . substr($contact, 7, 11);
                $username = str_replace(' ', '', $user);
                return strtolower($username);
            }

            //default password generator
            function defaultPwd()
            {
                $rawpassword = 'Welcome' . date('Y');
                $password = password_hash($rawpassword, PASSWORD_DEFAULT);
                return $password;
            }

            function pre_r($array)
            {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }




            function errorCatcher(array $notif_array)
            {
                foreach ($notif_array as $notif) :
                    $notif_array = array_push($notif_array, $notif);
                endforeach;
                return $notif_array;
            }

            function isSubmit(mysqli $dbcon)
            {
                $notif_array = [];
                $submit_result = $dbcon->query(' SELECT * FROM `devplan_c_tbl` WHERE `user_id` ="' . $_SESSION['user_id'] . '" AND status = "Submit" ');
                if ($submit_result) :
                    $result = mysqli_num_rows($submit_result);
                    if ($result > 0) :
                        array_push($notif_array, '<li class="green-notif-border">Youve already submitted your Development Plan!</li>');
                    endif;

                else :
                    // echo 'You have no devplan yet';  
                    return false;
                endif;


                //errorCatcher($notif_array);
                return $notif_array;
            }

            function isTakenEsat(mysqli $dbcon, $position, $user_id)
            {
                $notif_array = [];
                //THIS WILL CHECK THE POSITION OF THE USER
                if (!empty($position)) :


                    if (strpos(($position), 'aster')) :
                        $esatForm1qry = 'SELECT * FROM `esat1_demographicsmt_tbl` WHERE `user_id` = "' . $user_id . '" AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';

                        $esatForm2qry = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE `user_id`= "' . $user_id . '"AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';

                        $esatForm3qry = 'SELECT * FROM `esat3_core_behavioralmt_tbl` WHERE `user_id`= "' . $user_id . '"AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';

                    elseif (strpos(($_SESSION['position']), 'eacher')) :
                        $esatForm1qry = 'SELECT * FROM `esat1_demographicst_tbl` WHERE `user_id` = "' . $user_id . '" AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';

                        $esatForm2qry = 'SELECT * FROM `esat2_objectivest_tbl` WHERE `user_id`= "' . $user_id . '"AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';

                        $esatForm3qry = 'SELECT * FROM `esat3_core_behavioralt_tbl` WHERE `user_id`= "' . $user_id . '"AND school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"';
                    else :
                        return false;
                    endif;

                    //CHECK IF user has esat!
                    $dbcon->query($esatForm1qry);
                    $esat1 = fetchAll($dbcon, $esatForm1qry);
                    if (!$esat1) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 1 yet!</li>');
                    endif;

                    //THIS WILLCHECK IF THE USER TAKEN ESAT 1
                    $esat2 = fetchAll($dbcon, $esatForm2qry);
                    if (!$esat2) :
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 2 yet!</li>');
                    endif;

                    $esat3 = fetchAll($dbcon, $esatForm3qry);
                    if (!$esat3) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 3 yet!</li>');

                    endif;

                    return $notif_array;
                else : return false;
                endif;
            }

            function hasDevplan(mysqli $dbcon, $position, $user_id)
            {
                $notif_array = [];
                //THIS WILL CHECK THE POSITION OF THE USER
                if (isset($position)) :
                    if (strpos(($position), 'aster')) :
                        $devplanmt_a1_strength_tbl = 'SELECT * FROM `devplanmt_a1_strength_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_a2_devneeds_tbl = 'SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_a3_actionplan_tbl = 'SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_b1_strength_tbl = 'SELECT * FROM `devplanmt_b1_strength_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_b2_devneeds_tbl = 'SELECT * FROM `devplanmt_b2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_b3_actionplan_tbl = 'SELECT * FROM `devplanmt_b3_actionplan_tbl` WHERE `user_id`= "' . $user_id . '"';
                        $devplanmt_c_tbl = 'SELECT * FROM `devplan_c_tbl` WHERE `user_id`= "' . $user_id . '"';

                    elseif (strpos(($_SESSION['position']), 'eacher')) :
                        $devplan_t_strength = 'SELECT * FROM `esat2_objectivest_tbl` WHERE `user_id` ="' . $user_id . '"';
                    else :
                        echo 'Error in isTakenEsat function';
                    endif;
                else :
                    echo '<p class="red-notif-border"> Error! </p>';
                endif;
            }

            function directToCharts($position)
            {
                if (isset($position)) :
                    if (strpos(($position), 'aster')) :
                        header('location:../displaymtchart.php');
                        exit();
                    elseif (strpos(($position), 'eacher')) :
                        header('location:../displaytchart.php');
                        exit();
                    else :
                        return false;
                        exit();
                    endif;
                else :
                    return false;
                endif;
            }

            function switchRateeWord($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'aster')) :
                        echo "Teachers";
                    elseif (strpos($position, 'eacher')) :
                        echo 'Master Teachers';
                    else :
                        echo 'Employees';
                    endif;
                else :
                    'You dont have a Position Yet';
                endif;
            }

            function displayDate($date)
            {
                date_default_timezone_set('Asia/Manila');
                $san_date = filter_var($date, FILTER_SANITIZE_STRING);
                $new_date = new DateTime($san_date);
                return $new_date->format('M d, Y');
            }

            function activeSY(mysqli $dbcon)
            {
                date_default_timezone_set('Asia/Manila');
                $syQry = 'SELECT * FROM sy_tbl WHERE `status` = "Active" ';
                $syResult = mysqli_query($dbcon, $syQry);

                if ($syResult) :
                    foreach ($syResult as $sy_item) :
                        $_SESSION['active_sy_id'] = $sy_item['sy_id'];
                        $_SESSION['start_date'] = $sy_item['startDate'] . '<br>';
                        $_SESSION['end_date'] = $sy_item['end_date'] . '<br>';
                        $_SESSION['active_sy'] = $sy_item['sy_desc'] . '<br>';
                        $_SESSION['sy_status'] = $sy_item['status'] . '<br>';
                    endforeach;
                    $startdate = $_SESSION['start_date'] ?? null;
                    $_SESSION['start_year'] = substr($startdate, 0, 4) . BR;
                    $_SESSION['start_month'] = substr($startdate, 5, 2) . BR;
                    $_SESSION['start_day'] = substr($startdate, 8, 2) . BR;

                    $enddate = $_SESSION['start_date'] ?? null;
                    $_SESSION['end_year'] = substr($enddate, 0, 4) . BR;
                    $_SESSION['end_month'] = substr($enddate, 5, 2) . BR;
                    $_SESSION['end_day'] = substr($enddate, 8, 2) . BR;


                else :
                    $_SESSION['active_sy_id'] = 'none';
                    $_SESSION['start_date'] =  'none';
                    $_SESSION['end_date'] =  'none';
                    $_SESSION['active_sy'] = 'none';
                    $_SESSION['sy_status'] =  'none';
                    $startdate = 'none';
                    $_SESSION['start_year'] = 'none';
                    $_SESSION['start_month'] = 'none';
                    $_SESSION['start_day'] = 'none';
                endif;
            }

            function endSchoolYear($conn, $sy_id)
            {
                //SET THE DATABASE TO INACTIVE IF THE END DATE IS EQUAL TO END_DATE
                if (!empty($sy_id)) :
                    if (!empty($_SESSION['end_date'])) :
                        $today_date = strtotime(intval(date('Y-m-d')));
                        $enddate = strtotime(intval($_SESSION['end_date']));
                        if ($today_date >= $enddate) :

                            $qry = 'UPDATE sy_tbl SET `status` = "Inactive"';
                            mysqli_query($conn, $qry);

                            // $qry_account = 'UPDATE account_tbl SET `status` = "Inactive" , rater = null, approving_authority = null WHERE `status` = "Active"';
                            // mysqli_query($conn, $qry_account);

                            $qry_subject = 'UPDATE subject_tbl SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_subject);

                            $qry_age = 'UPDATE age_tbl SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_age);

                            $qry_totalyr = 'UPDATE totalyear_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_totalyr);

                            $qry_glt = 'UPDATE gradelvltaught_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_glt);

                            $qry_kra = 'UPDATE kra_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_kra);

                            exit();
                        else : return false;

                        endif;
                    else :
                        $qry = 'UPDATE sy_tbl SET `status` = "Inactive"';
                        mysqli_query($conn, $qry);
                        return false;

                    endif;
                else :
                    session_unset();
                    session_destroy();


                endif;
            }

            function showRatee($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'rincipal')) :
                        return   'SELECT * FROM account_tbl WHERE rater = "' . $_SESSION['user_id'] . '"  AND school_id = "' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") AND status = "Active"';
                    elseif (strpos($position, 'aster')) :
                        return  'SELECT * FROM account_tbl WHERE rater = "' . $_SESSION['user_id'] . '"  AND school_id = "' . $_SESSION['school_id'] . '"  AND position IN ("Teacher I", "Teacher II", "Teacher III") AND status = "Active" ';
                    else :
                        return false;
                        exit();
                    endif;
                else :
                    echo '<p class="red-notif-border">You dont have a position!</p>';
                endif;
            }

            function showNoRater($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'rincipal')) :
                        return   'SELECT * FROM account_tbl WHERE position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") AND rater IS NULL AND school_id = "' . $_SESSION['school_id'] . '"  AND `user_id` <> " ' . $_SESSION['user_id'] . ' " AND status = "Active"';
                    elseif (strpos($position, 'aster')) :
                        return 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $_SESSION['school_id'] . '"  AND `user_id` <> " ' . $_SESSION['user_id'] . '" AND status = "Active"';
                    else :
                        return false;
                    endif;
                else :
                    echo '<p class="red-notif-border">You dont have a position!</p>';
                endif;
            }

            function devplanUSerFilter($position)
            {
                if (isset($position)) :
                    if (!strpos($position, 'aster') || (strpos($position, 'eacher'))) :
                        echo '<p class="red-notif-border">Master Teachers and Teachers only who can create their development plan!</p>';
                    else :
                        echo '<p class="red-notif-border">You dont have permission to rate!</p>';
                    endif;
                else :
                    echo '<p class="red-notif-border">You dont have a position!</p>';
                endif;
            }

            function directLastPage()
            {
                echo '<input type="button" class="btn btn-danger" value="Go back" onClick="javascript:history.go(-1)">';
            }

            /* THIS FUNCTION WILL REDIRECT THE USER TO THEIR RESPECTIVE DASHBOARD AFTER LOGGING IN*/
            function redirectToDashboard($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'dmin')) :
                        header('location:dbAdmin.php');
                        exit();
                    elseif (strpos($position, 'uper')) :
                        header('location:dbAsstSuperintendent.php');
                        exit();
                    elseif (strpos($position, 'rincipal')) :
                        header('location:dbPrincipal.php');
                        exit();
                    elseif (strpos($position, 'chool Head')) :
                        header('location:dbSchoolHead.php');
                        exit();
                    elseif (strpos($position, 'aster')) :
                        header('location:dbMasterTeacher.php');
                        exit();
                    elseif (strpos($position, 'eacher')) :
                        header('location:dbTeacher.php');
                        exit();
                    else :
                        echo '<p class="red-notif-border"><b>Error: </b> You dont have position yet.</p>';
                        return false;
                    endif;
                else :
                    return false;
                endif;
            }

            function positionFormat($position)
            {
                if (isset($position)) :
                    $smallcaps = strtolower($position);
                    if (stripos(($position), 'aster')) :
                        $raw = substr($position, 15);
                        $raw_title = substr($smallcaps, 0, 15);
                        return ucwords($raw_title)  . strtoupper($raw);

                    elseif (stripos(($position), 'eacher')) :
                        $raw = substr($position, 7);
                        $raw_title = substr($smallcaps, 0, 7);
                        return ucwords($raw_title) . strtoupper($raw);
                    else :
                        return ucwords($position);
                    endif;
                endif;
            }

            function nameFormat($name)
            {
                $smallcaps = strtolower($name);
                return ucwords($smallcaps);
            }

            function fullnameFormat($firstname, $middlename, $surname)
            {
                echo $firstname . ' ' . substr($middlename, 0, 1) . '. ' . $surname;
            }

            /* 
            USED IN: ESAT FORM 1
            OUTPUT: ARRAY OF RESULTS
            */
            function positionQuery($conn, $position)
            {
                $result_arr = [];
                if (isset($position)) :
                    if (stripos(($position), 'aster')) :
                        $query =  'SELECT * FROM position_tbl WHERE  position_name IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")';
                    elseif (stripos(($position), 'eacher')) :
                        $query =  'SELECT * FROM position_tbl WHERE  position_name IN ("Teacher I", "Teacher II", "Teacher III")';
                    else :
                        return false;
                    endif;
                else :
                    $query =  'SELECT * FROM position_tbl WHERE  position_name IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV","Teacher I", "Teacher II", "Teacher III")';
                endif;

                $results = mysqli_query($conn, $query);
                if ($results) :
                    foreach ($results as $result) :
                        array_push($result_arr, $result);
                    endforeach;
                    return $result_arr;
                else :

                    return false;
                endif;
            }

            function checkSY($active_sy)
            {
                if (isset($active_sy)) :
                    echo '<p class="red-notif-border"> There is no Active School Year! </p>';
                    include 'includes/footer.php';
                    die();
                endif;
            }

            function displayName($conn, $user_id)
            {
                $qry = "SELECT * FROM account_tbl WHERE user_id = $user_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return fullnameFormat($res['firstname'], $res['middlename'], $res['surname']);
                    endforeach;
                else :
                    return false;
                endif;
            }

            function displaySY($conn, $sy_id)
            {
                $qry = "SELECT * FROM sy_tbl WHERE sy_id = $sy_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return $res['sy_desc'];
                    endforeach;
                else :
                    return false;
                endif;
            }

            function displaySchool($conn, $school_id)
            {
                $qry = "SELECT * FROM school_tbl WHERE school_id = $school_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return $res['school_name'];
                    endforeach;
                else :
                    return "School Undefined!";
                endif;
            }

            function formatDate($year, $month, $day)
            {
                return $year . '/' . $month . '/' . $day;
            }

            function activeObsPeriod($conn)
            {
                date_default_timezone_set('Asia/Manila');
                $result_arr = [];
                $qry = 'SELECT * FROM obs_period_tbl WHERE `status` = "Active" AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' ';
                $result = mysqli_query($conn, $qry);
                if (!empty($result)) :
                    foreach ($result as $res) :
                        $_SESSION['first_period'] = $res['first_period'];
                        $_SESSION['second_period'] = $res['second_period'];
                        $_SESSION['third_period'] = $res['third_period'];
                        $_SESSION['final_period'] = $res['fourth_period'];
                    endforeach;
                // return $result_arr;
                else :
                    $_SESSION['first_period'] = '';
                    $_SESSION['second_period'] = '';
                    $_SESSION['third_period'] = '';
                    $_SESSION['final_period'] = '';
                endif;
            }

            function loginError($get)
            {
                switch ($get) {
                    case 'emptyfields':
                        echo  'Fields must not be empty!';
                        break;

                    case 'wrongpwd':
                        echo 'User name and Password did not match!';
                        break;

                    case 'nouser':
                        echo 'User does not exist!';
                        break;

                    case 'emailnotverified':
                        echo 'Your email is not yet verified! Please check your email for verification!';
                        break;

                    default:
                        return false;
                        break;
                }
            }

            function annNotif($get)
            {
                if (isset($get)) :
                    if ($get == "success") :
                        return '<div class="green-notif-border">Announcement has been updated!</div>';
                    else : return '<div class="red-notif-border">Announcement update failed!</div>';
                    endif;
                else :
                    return false;
                endif;
            }

            function directToDb($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'dmin')) :
                        $href = '../dbAdmin.php';

                    elseif (strpos($position, 'uper')) :
                        $href = '../dbAsstSuperintendent.php';

                    elseif (strpos($position, 'rincipal')) :
                        $href = '../dbPrincipal.php';

                    elseif (strpos($position, 'chool Heads')) :
                        $href = '../dbSchoolHead.php';

                    elseif (strpos($position, 'aster')) :
                        $href = '../dbMasterTeacher.php';

                    elseif (strpos($position, 'eacher')) :
                        $href = '../dbTeacher.php';

                    else :
                        return false;
                    endif;

                    return  "<a href='$href' class='btn btn-sm btn-primary'>Back to Dashboard</a>";
                else :
                    return false;
                endif;
            }

            // THIS FUNCTION IS FOR RATER 
            function showObsRatingT($conn, $obs_period, $indicator_id, $user_id, $sy, $school_id)
            {
                $qry = "SELECT * FROM `cot_t_rating_a_tbl` WHERE indicator_id = $indicator_id AND `user_id` = $user_id  AND `obs_period` = $obs_period AND sy = $sy  AND school_id = " . $school_id . " AND `status` = 'Active' ";

                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_results = mysqli_num_rows($results);
                if ($count_results > 0) {
                    foreach ($results as $result) :
                        return floatval($result['rating']);
                    endforeach;
                } else {
                    return 0;
                }
            }

            // THIS FUNCTION WILL RETRIEVE THE RATING IN INDICATOR 
            // used in auto generate cot indicator average
            function showObsRatingMT($conn, $obs_period, $indicator_id, $user_id, $sy, $school_id)
            {
                $qry = "SELECT * FROM `cot_mt_rating_a_tbl` WHERE indicator_id = $indicator_id AND `user_id` = $user_id  AND `obs_period` = $obs_period AND sy = $sy  AND school_id = " . $school_id . " AND `status` = 'Active' ";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_results = mysqli_num_rows($results);
                if ($count_results > 0) {
                    foreach ($results as $result) :
                        return floatval($result['rating']);
                    endforeach;
                } else {
                    return 0;
                }
            }

            // THIS WILL OUTPUT THE AVERAGE IN COT RATING
            function showObsAverage($obs1_score, $obs2_score, $obs3_score, $obs4_score)
            {
                if (preg_match('/^[0-9]+$/', $obs1_score) and ($obs1_score != 0)) {
                    $num1 = 1;
                } else {
                    $obs1_score = 0;
                    $num1 = 0;
                }

                if (preg_match('/^[0-9]+$/', $obs2_score) and ($obs2_score != 0)) {
                    $num2 = 1;
                } else {
                    $obs2_score = 0;
                    $num2 = 0;
                }

                if (preg_match('/^[0-9]+$/', $obs3_score) and ($obs3_score != 0)) {
                    $num3 = 1;
                } else {
                    $obs3_score = 0;
                    $num3 = 0;
                }

                if (preg_match('/^[0-9]+$/', $obs4_score) and ($obs4_score != 0)) {
                    $num4 = 1;
                } else {
                    $obs4_score = 0;
                    $num4 = 0;
                }
                $total = floatval($obs1_score) + floatval($obs2_score) + floatval($obs3_score) + floatval($obs4_score);
                $num = $num1 + $num2 + $num3 + $num4;
                if (!empty($total) and (!empty($num))) :
                    $ave = $total / $num;


                    return floatval($ave);
                else : return 0;
                endif;
            }

            function displayKRA($conn, $kra_id)
            {
                $qry = "SELECT * FROM kra_tbl WHERE kra_id = $kra_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['kra_name'];
                    }
                }
            }

            function displayObjectiveT($conn, $tobj_id)
            {
                $qry = "SELECT * FROM tobj_tbl WHERE tobj_id = $tobj_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['tobj_name'];
                    }
                }
            }

            function displayObjectiveMT($conn, $mtobj_id)
            {
                $qry = "SELECT * FROM mtobj_tbl WHERE mtobj_id = $mtobj_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['mtobj_name'];
                    }
                }
            }

            function displayKRAidofTobj($conn, $tobj_id)
            {
                $qry = "SELECT * FROM tobj_tbl WHERE tobj_id = $tobj_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['kra_id'];
                    }
                }
            }

            function displayKRAidofMTobj($conn, $mtobj_id)
            {
                $qry = "SELECT * FROM mtobj_tbl WHERE mtobj_id = $mtobj_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['kra_id'];
                    }
                }
            }

            function displayTindicator($conn, $indicator_id)
            {
                $qry = "SELECT * FROM tindicator_tbl WHERE indicator_id = $indicator_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['indicator_name'];
                    }
                }
            }

            function displayMTindicator($conn, $indicator_id)
            {
                $qry = "SELECT * FROM mtindicator_tbl WHERE mtindicator_id = $indicator_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['mtindicator_name'];
                    }
                }
            }

            function countDB($conn, $sy, $school, $table_name)
            {
                $qry = "SELECT *,COUNT(`user_id`) AS `total` FROM $table_name WHERE sy = '$sy' AND school = '$school'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) {
                        return $res['total'];
                    }
                }
            }

            function displayAgeDesc($conn, $age_id)
            {
                $qry = "SELECT * FROM `age_tbl` WHERE age_id = '$age_id'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['age_name'];
                    }
                }
            }

            function displaygenderDesc($conn, $gender)
            {
                $qry = "SELECT * FROM `gender_tbl` WHERE gender_id = '$gender'";
                $res = mysqli_query($conn, $qry) or die($conn->error);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['gender_name'];
                    }
                }
            }

            function displaycurri($conn, $curriclass_id)
            {
                $qry = "SELECT * FROM `curriclass_tbl` WHERE curriclass_id = '$curriclass_id'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['curriclass_name'];
                    }
                }
            }

            function displayregion($conn, $region_id)
            {
                $qry = "SELECT * FROM `region_tbl` WHERE reg_id = '$region_id'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['region_name'];
                    }
                }
            }

            function displaySydesc($conn, $sy_id)
            {
                $qry = "SELECT * FROM `sy_tbl` WHERE sy_id = '$sy_id'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['sy_desc'];
                    }
                }
            }

            function displayTotalyear($conn, $totalyr)
            {
                $qry = "SELECT * FROM `totalyear_tbl` WHERE totalyear_id = '$totalyr'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['totalyear_name'];
                    }
                }
            }

            function displayGradelvltaught($conn, $glt_id)
            {
                $qry = "SELECT * FROM `gradelvltaught_tbl` WHERE gradelvltaught_id = '$glt_id'";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $re) {
                        return $re['gradelvltaught_name'];
                    }
                }
            }

            function console_log($data)
            {
                echo '<script>';
                echo 'console.log(' . json_encode($data) . ')';
                echo '</script>';
            }

            function displayKRAandOBJ($conn, $position)
            {
                if ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :

                    $qry = "SELECT * FROM `mtobj_tbl`";
                    $results = mysqli_query($conn, $qry) or die($conn->error . $qry);
                    if (mysqli_num_rows($results) > 0) :
                        return $results;
                    else : return false;
                    endif;

                elseif ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :
                    $qry = "SELECT * FROM `tobj_tbl`";

                    $results = mysqli_query($conn, $qry) or die($conn->error . $qry);
                    if (mysqli_num_rows($results) > 0) :
                        return $results;
                    else : return false;
                    endif;

                else : 'invalid pos';
                endif;
            }

            function showAttachmentMT($conn, $objective_id, $user, $school, $sy, $mov_type)
            {
                $attach_arr = [];
                $sql_mov_b = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE obj_id = '$objective_id' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy' AND `status` = 'Active'";
                $result_b = mysqli_query($conn, $sql_mov_b) or die($conn->error . $sql_mov_b);
                if (mysqli_num_rows($result_b) > 0) :
                    foreach ($result_b as $res) :
                        $mov_id = $res['mov_id'];
                        $sql_mov_a = " SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id =' $mov_id' AND mov_type = '$mov_type' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy'";
                        $result_a = mysqli_query($conn, $sql_mov_a) or die($conn->error . $sql_mov_a);
                        if (mysqli_num_rows($result_a) > 0) :
                            foreach ($result_a as $re) :
                                array_push($attach_arr, $re);
                            endforeach;
                        endif;
                    endforeach;
                endif;
                return $attach_arr;
            }

            function displayAttachmentMT($conn, $objective_id, $user, $school, $sy, $mov_type)
            {
                $attach_arr = [];
                $sql_mov_b = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE obj_id = '$objective_id' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy'";
                $result_b = mysqli_query($conn, $sql_mov_b) or die($conn->error . $sql_mov_b);
                if (mysqli_num_rows($result_b) > 0) :
                    foreach ($result_b as $res) :
                        $mov_id = $res['mov_id'];

                        $sql_mov_a = " SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id =' $mov_id' AND mov_type = '$mov_type' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy'";
                        $result_a = mysqli_query($conn, $sql_mov_a) or die($conn->error . $sql_mov_a);
                        if (mysqli_num_rows($result_a) > 0) :
                            foreach ($result_a as $re) :
                                array_push($attach_arr, $re);
                            endforeach;

                        endif;
                    endforeach;
                endif;
                return $attach_arr;
            }

            function showAttachmentIDMT($conn, $sy, $school, $mov_id, $obj_id, $mov_type)
            {
                $qry = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE sy_id = $sy and school_id = $school AND mov_id = $mov_id AND obj_id = $obj_id AND mov_type = '$mov_type'";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['attach_mov_id'];
                    }
                }
            }


            function showAttachmentStatusMT($conn, $attach_mov_id)
            {
                $qry = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }

            function displayFileMT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id = '$mov_id'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) :
                        $type = $res['file_type'];
                        if ($type == "jpg" || $type == "png") :
                            return "<img src='attachments/Master Teacher/" . $res['attachment'] . "' class='rounded'  width='400' height='400' alt='" . $res['file_name'] . "' />";
                        elseif ($type == "pdf") :
                            return "<embed src='attachments/Master Teacher/" . $res['attachment'] . "' width='700px' height='400px' />";
                        else :
                            return "<a href='downloadmt.php?file=" . $res['attachment'] . "'><b class='text-danger'>Click to download File:</b> " . $res['file_name'] . "</a>";
                        endif;
                    endforeach;
                }
            }
            // this function is for average of COT only!

            function generateAVGforCOT($conn, $table_name, $user, $indicator, $sy, $school)
            {
                $qry = "SELECT AVG(ALL rating) AS ave FROM `$table_name` WHERE `user_id` = '$user' AND indicator_id = '$indicator' AND `sy` = '$sy' AND `school_id` = '$school' AND `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if ($result) :
                    foreach ($result as $res) :
                        return floatval($res['ave']);
                    endforeach;
                else : return false;
                endif;
            }

            function showSchool($conn)
            {
                $qry = "SELECT * FROM school_tbl WHERE school_grade_lvl IN ('Elementary School','Secondary School')";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if ($result) :
                    $res_arr = [];
                    foreach ($result as $res) :
                        array_push($res_arr, $res);
                    endforeach;
                    return $res_arr;
                endif;
            }


            function showObsPeriodMT($conn, $user, $sy, $school)
            {
                $qry = "SELECT `obs_period` FROM cot_mt_rating_a_tbl where `user_id` = $user and `sy` = $sy and `school_id` = $school and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function showObsPeriodT($conn, $user, $sy, $school)
            {
                $qry = "SELECT `obs_period` FROM cot_t_rating_a_tbl where `user_id` = $user and `sy` = $sy and `school_id` = $school and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function fetchCOTratingMT($conn, $user, $obs_period, $indicator_id, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_mt_rating_a_tbl` WHERE `user_id` = $user AND obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND school_id = $school AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['rating'];
                    }
                }
            }

            function fetchCOTratingT($conn, $user, $obs_period, $indicator_id, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_t_rating_a_tbl` WHERE `user_id` = $user AND obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND school_id = $school AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['rating'];
                    }
                }
            }

            function fetchIndicatorAVGmt($conn, $user, $indicator, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_mt_indicator_ave_tbl` where `user_id` = $user AND indicator_id = $indicator  and `sy` = $sy and `school` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return floatval($res['average']);
                    endforeach;
                else : return false;
                endif;
            }

            function fetchIndicatorAVGt($conn, $user, $indicator, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_t_indicator_ave_tbl` where `user_id` = $user AND indicator_id = $indicator  and `sy` = $sy and `school` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return floatval($res['average']);
                    endforeach;
                else : return false;
                endif;
            }

            function fetchCOTraterMT($conn, $user, $sy, $school, $obs)
            {
                $qry = "SELECT * FROM `cot_mt_rating_a_tbl` where `user_id` = $user AND obs_period = $obs   and `sy` = $sy and `school_id` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    $rater_arr = [];
                    foreach ($result as $res) :
                        $rater1 =  $res['rater_id1'];
                        $rater2 =  $res['rater_id2'];
                        $rater3 =  $res['rater_id3'];
                    endforeach;
                    array_push($rater_arr, $rater1, $rater2, $rater3);
                    return $rater_arr;
                else : return false;
                endif;
            }

            function fetchCOTraterT($conn, $user, $sy, $school, $obs)
            {
                $qry = "SELECT * FROM `cot_mt_rating_a_tbl` where `user_id` = $user AND obs_period = $obs   and `sy` = $sy and `school_id` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    $rater_arr = [];
                    foreach ($result as $res) :
                        $rater1 =  $res['rater_id1'];
                        $rater2 =  $res['rater_id2'];
                        $rater3 =  $res['rater_id3'];

                    endforeach;
                    array_push($rater_arr, $rater1, $rater2, $rater3);
                    return $rater_arr;
                else : return false;
                endif;
            }

            // THIS FUNCTION WILL FETCH THE RATER OF THE USER
            function fetchRatee($conn, $user_id)
            {
                $qry = "SELECT * FROM account_tbl WHERE `rater` = '$user_id' AND `status` = 'Active' AND 'user_id' != $user_id  ORDER BY  FIELD(position,'Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I','Teacher III','Teacher II','Teacher I')";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                } else {
                    return false;
                }
            }


            function displayPosition($conn, $user)
            {
                $qry = "SELECT * FROM `account_tbl` where `user_id` = '$user' AND `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return $res['position'];
                    endforeach;
                else : return false;
                endif;
            }

            function displayMainMOVattachment($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id AND kra_id = $kra AND obj_id = $obj and mov_type = 'main_mov'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['mov_id'];
                    }
                }
            }

            function displayMainMOVstatus($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id and mov_type = 'main_mov' AND kra_id = $kra AND obj_id = $obj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }

            function displaySuppMOVattachment($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE `attach_mov_id` = '$attach_mov_id' and mov_type = 'supp_mov' AND `kra_id` = '$kra' AND `obj_id` = '$obj'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['mov_id'];
                    }
                }
            }

            function displaySuppMOVstatus($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_b_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id and mov_type = 'supp_mov' AND kra_id = $kra AND obj_id = $obj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }
