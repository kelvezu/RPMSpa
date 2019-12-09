
            <?php


            //GET THE START

            use Dashboard\Dashboard;

            function percent($number)
            {
                return $number * 100 . '%';
            }

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
                $syResult = mysqli_query($dbcon, $syQry) or die($dbcon->error . $syQry);

                if (mysqli_num_rows($syResult) > 0) :
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
                    $_SESSION['active_sy_id'] = false;
                    $_SESSION['start_date'] =  false;
                    $_SESSION['end_date'] =  false;
                    $_SESSION['active_sy'] = false;
                    $_SESSION['sy_status'] =  false;
                    $startdate = false;
                    $_SESSION['start_year'] = false;
                    $_SESSION['start_month'] = false;
                    $_SESSION['start_day'] = false;
                    console_log('no active sy');
                endif;
            }

            function endSchoolYear($conn, $sy_id)
            {
                //SET THE DATABASE TO INACTIVE IF THE END DATE IS EQUAL TO END_DATE
                if (!empty($sy_id)) :
                    // echo $_SESSION['end_date'];
                    if (!empty($_SESSION['end_date'])) :
                        $today_date = strtotime(intval(date('Y-m-d')));
                        $enddate = strtotime(intval($_SESSION['end_date']));
                        if ($today_date >= $enddate) :

                            $qry = 'UPDATE sy_tbl SET `status` = "Inactive"';
                            mysqli_query($conn, $qry);

                            // $qry_account = 'UPDATE account_tbl SET `status` = "Inactive" , rater = null, approving_authority = null WHERE `status` = "Active"';
                            // mysqli_query($conn, $qry_account);

                            $qry_subject = 'UPDATE subject_tbl SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_subject) or die($conn->error);

                            $qry_age = 'UPDATE age_tbl SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_age) or die($conn->error);

                            $qry_totalyr = 'UPDATE totalyear_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_totalyr) or die($conn->error);

                            $qry_glt = 'UPDATE gradelvltaught_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_glt) or die($conn->error);

                            $qry_kra = 'UPDATE kra_tbl  SET `status` = "Inactive" WHERE `status` = "Active"';
                            mysqli_query($conn, $qry_kra) or die($conn->error);
                            exit();
                        else : return console_log('wala kang nakaset ng sy');
                        endif;
                    else :
                        $qry = 'UPDATE sy_tbl SET `status` = "Inactive"';
                        mysqli_query($conn, $qry)  or die($conn->error . $qry);
                        return false;
                        console_log('inaupdate ko to hihi');
                    endif;
                else :
                    // session_unset();
                    // session_destroy();
                    console_log("no school year!");
                endif;
            }

            function showRatee($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'rincipal')) :
                        return   'SELECT * FROM account_tbl WHERE rater = "' . $_SESSION['user_id'] . '"  AND school_id = "' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV","Teacher I", "Teacher II", "Teacher III") AND status = "Active"';
                    elseif (strpos($position, 'Head')) :
                        return   'SELECT * FROM account_tbl WHERE rater = "' . $_SESSION['user_id'] . '"  AND school_id = "' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV","Teacher I", "Teacher II", "Teacher III") AND status = "Active"';
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
                        return   'SELECT * FROM account_tbl WHERE position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV", "Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $_SESSION['school_id'] . '"  AND `user_id` <> " ' . $_SESSION['user_id'] . ' " AND status = "Active"';
                    elseif (strpos($position, 'Head')) :
                        return 'SELECT * FROM account_tbl WHERE position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV", "Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $_SESSION['school_id'] . '"  AND `user_id` <> " ' . $_SESSION['user_id'] . '" AND status = "Active"';
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

            function displayCBCname($conn, $cbc_id)
            {
                $qry = "SELECT * FROM `core_behavioral_tbl` WHERE cbc_id = $cbc_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['cbc_name'];
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

            function displayCBCind($conn, $cbc_ind_id)
            {
                $qry = "SELECT * FROM `cbc_indicators_tbl` where cbc_ind_id = $cbc_ind_id";
                $results = mysqli_query($conn, $qry) or die($conn->error);
                $count_res = mysqli_num_rows($results);

                if ($count_res > 0) {

                    foreach ($results as $res) {
                        return $res['indicator'];
                    }
                }
            }

            function displayObjectiveMT($conn, $mtobj_id)
            {
                $qry = "SELECT * FROM mtobj_tbl WHERE mtobj_id = '$mtobj_id'";
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

            // function showMainAttachmentMT($conn, $objective_id, $user, $school, $sy, $kra)
            // {
            //     $attach_arr = [];
            //     $sql_mov_b = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE kra_id = $kra AND obj_id = '$objective_id' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy' AND `status` = 'Active'";
            //     $result_b = mysqli_query($conn, $sql_mov_b) or die($conn->error . $sql_mov_b);
            //     if (mysqli_num_rows($result_b) > 0) :
            //         foreach ($result_b as $res) :
            //             $mov_id = $res['mov_id'];
            //             $sql_mov_a = " SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id =' $mov_id' AND  `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy'";
            //             $result_a = mysqli_query($conn, $sql_mov_a) or die($conn->error . $sql_mov_a);
            //             if (mysqli_num_rows($result_a) > 0) :
            //                 foreach ($result_a as $re) :
            //                     array_push($attach_arr, $re);
            //                 endforeach;
            //             endif;
            //         endforeach;
            //     endif;
            //     return $attach_arr;
            // }

            function showSuppAttachmentMT($conn, $objective_id, $user, $school, $sy, $kra)
            {
                $attach_arr = [];
                $sql_mov_b = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE kra_id = $kra AND obj_id = '$objective_id' AND `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy' AND `status` = 'Active'";
                $result_b = mysqli_query($conn, $sql_mov_b) or die($conn->error . $sql_mov_b);
                if (mysqli_num_rows($result_b) > 0) :
                    foreach ($result_b as $res) :
                        $mov_id = $res['mov_id'];
                        $sql_mov_a = " SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id =' $mov_id' AND  `user_id` = '$user' AND school_id = '$school' AND sy_id = '$sy'";
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

            function showMainMOVidMT($conn, $sy, $school, $mov_id, $obj_id, $mov_type, $kra)
            {
                $qry = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE kra_id = $kra and sy_id = $sy and school_id = $school AND mov_id = $mov_id AND obj_id = $obj_id";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['attach_mov_id'];
                    }
                }
            }

            function showSuppMOVidMT($conn, $sy, $school, $mov_id, $obj_id, $kra)
            {
                $qry = "SELECT * FROM `mov_supp_mt_attach_tbl` WHERE kra_id = $kra and sy_id = $sy and school_id = $school AND mov_id = $mov_id AND obj_id = $obj_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['attach_mov_id'];
                    }
                }
            }

            // this function will show the main mov status
            function showMainMovStatusMT($conn, $attach_mov_id)
            {
                $qry = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }

            // this function will show the supp mov status
            function showSuppMovStatusMT($conn, $attach_mov_id)
            {
                $qry = "SELECT * FROM `mov_supp_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }

            function displayAttachmentStatusMT($conn, $attach_mov_id, $mov_type, $kra, $obj, $user)
            {
                $res_arr = [];
                $qry = "SELECT * FROM `mov_supp_mt_attach_tbl` WHERE `user_id` = '$user' AND attach_mov_id = $attach_mov_id AND kra_id = $kra AND obj_id = $obj AND `mov_type` = '$mov_type' AND doc_status = 'For Approval'";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {

                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                } else {
                    return false;
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

            function displayFileT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_t_attach_tbl` WHERE mov_id = '$mov_id'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) :
                        $type = $res['file_type'];
                        if ($type == "jpg" || $type == "png") :
                            return "<img src='attachments/Teacher/" . $res['attachment'] . "' class='rounded'  width='400' height='400' alt='" . $res['file_name'] . "' />";
                        elseif ($type == "pdf") :
                            return "<embed src='attachments/Teacher/" . $res['attachment'] . "' width='700px' height='400px' />";
                        else :
                            return "<a href='downloadt.php?file=" . $res['attachment'] . "'><b class='text-danger'>Click to download File:</b> " . $res['file_name'] . "</a>";
                        endif;
                    endforeach;
                }
            }

            function displayFileDescMT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id = '$mov_id'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) :
                        return $res['file_desc'];
                    endforeach;
                }
            }

             function displayFileDescT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_t_attach_tbl` WHERE mov_id = '$mov_id'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $res) :
                        return $res['file_desc'];
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

            // failed
            function displayMainMOVattachment($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id AND kra_id = $kra AND obj_id = $obj ";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['mov_id'];
                    }
                }
            }


            function displayMainMOVstatus($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_main_mt_attach_tbl` WHERE attach_mov_id = $attach_mov_id and mov_type = 'main_mov' AND kra_id = $kra AND obj_id = $obj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['doc_status'];
                    }
                }
            }

            function displaySuppMOVattachment($conn, $attach_mov_id, $kra, $obj)
            {
                $qry  = "SELECT * FROM `mov_supp_mt_attach_tbl` WHERE `attach_mov_id` = '$attach_mov_id' and mov_type = 'supp_mov' AND `kra_id` = '$kra' AND `obj_id` = '$obj'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return $r['mov_id'];
                    }
                }
            }

            function displaySuppMOVstatus($conn, $attach_mov_id, $mov_id, $mov_type, $kra, $obj, $school, $sy)
            {
                $res_arr = [];
                $qry  = "SELECT * FROM `mov_b_mt_attach_tbl` where attach_mov_id =  $attach_mov_id AND mov_id = $mov_id and mov_type = '$mov_type' AND school_id = $school and sy_id = $sy and kra_id = $kra and obj_id = $obj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        $res_arr[] = $r;
                    }
                    return $res_arr;
                }
            }

            function fetchAllMT($conn, $school)
            {
                $qry = "SELECT * FROM account_tbl WHERE position IN ('Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I') AND school_id = $school";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function fetchAllt($conn, $school)
            {
                $qry = "SELECT * FROM account_tbl WHERE position IN ('Teacher III','Teacher II','Teacher I') AND school_id = $school";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }




            function fetchTindicator($conn)
            {
                $qry  = 'SELECT * FROM `tindicator_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function fetchMTindicator($conn)
            {
                $qry  = 'SELECT * FROM `mtindicator_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }



            // ISSUE: DISPLAY NULL
            function fetchTindicatorRate($conn, $user, $indicator, $sy, $school, $obs_period)
            {
                $qry = "SELECT * FROM `cot_t_rating_a_tbl` where  `user_id` = $user AND `indicator_id` = $indicator AND `sy` = $sy AND `school_id` = $school AND obs_period = $obs_period";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                foreach ($result as $res) {
                    return $res['rating'];
                }
            }

            function ViewAdminCOTAveT($conn, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_t_indicator_ave_tbl` where sy = $sy and school = $school";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }


            function viewAdminratingT($conn, $school, $obs_period, $indicator_id, $sy)
            {
                $qry = "SELECT AVG(rating) AS T_RATING FROM `cot_t_rating_a_tbl` WHERE obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND school_id = $school AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return round(floatval($r['T_RATING']), 3);
                    }
                }
            }

            function viewAdminratingMT($conn, $school, $obs_period, $indicator_id, $sy)
            {
                $qry = "SELECT AVG(rating) AS MT_RATING FROM `cot_mt_rating_a_tbl` WHERE obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND school_id = $school AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return round(floatval($r['MT_RATING']), 3);
                    }
                }
            }

            function showObsPeriodAveAdminT($conn, $sy, $school)
            {
                $qry = "SELECT `obs_period` FROM cot_t_rating_a_tbl where `sy` = $sy and `school_id` = $school and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }


            function showObsPeriodAveAdminMT($conn, $sy, $school)
            {
                $qry = "SELECT `obs_period` FROM cot_mt_rating_a_tbl where `sy` = $sy and `school_id` = $school and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function fetchIndicatorAVGAdmint($conn, $indicator, $sy, $school)
            {
                $qry = "SELECT AVG(average) AS T_AVERAGE FROM `cot_t_indicator_ave_tbl` where indicator_id = $indicator  and `sy` = $sy and `school` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return round(floatval($res['T_AVERAGE']), 3);
                    endforeach;
                else : return false;
                endif;
            }

            function fetchIndicatorAVGAdminMt($conn, $indicator, $sy, $school)
            {
                $qry = "SELECT AVG(average) AS MT_AVERAGE FROM `cot_mt_indicator_ave_tbl` where indicator_id = $indicator  and `sy` = $sy and `school` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return round(floatval($res['MT_AVERAGE']), 3);
                    endforeach;
                else : return false;
                endif;
            }

            function viewAveIndAdminT($conn, $indicator, $sy, $school)
            {
                $qry = "SELECT AVG(average) FROM `cot_t_indicator_ave_tbl` where indicator_id = $indicator  and `sy` = $sy and `school` = $school and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return floatval($res['average']);
                    endforeach;
                else : return false;
                endif;
            }

            function displayMOVfileMT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id = $mov_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        return $r['file_name'];
                    endforeach;
                }
            }

             function displayMOVfileT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_t_attach_tbl` WHERE mov_id = $mov_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        return $r['file_name'];
                    endforeach;
                }
            }

            function displayMOVstatusMT($conn, $mov_id)
            {
                $qry = "SELECT * FROM `mov_a_mt_attach_tbl` WHERE mov_id = $mov_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        return $r['doc_status'];
                    endforeach;
                }
            }

            function getNotifmov($getnotif, $mov, $conn, $mov_type)
            {
                if ($mov_type == "main") :
                    $mtype = "Main";
                elseif ($mov_type == "supp") :
                    $mtype = "Supporting";
                else : return false;
                endif;


                switch ($getnotif) {
                    case 'approve':
                        echo '<p class="green-notif-border">' . $mtype . ' Mov ' . displayMOVfileMT($conn, $mov) . ' Approved!</p>';
                        break;

                    case 'disapproved':
                        echo '<p class="red-notif-border">' . $mtype . ' Mov ' . displayMOVfileMT($conn, $mov) . ' Declined!</p>';
                        break;

                    case 'revision':
                        echo '<p class="yellow-notif-border">' . $mtype . ' Mov ' . displayMOVfileMT($conn, $mov) . ' set to For Revision!</p>';
                        break;

                    case 'approval':
                        echo '<p class="red-notif-border">' . $mtype . ' MOV ' . displayMOVfileMT($conn, $mov) . ' removed from Approved!</p>';
                        break;
                    default:
                        return false;
                        break;
                }
            }

            /* this function will display the kra weight */
            function AgeDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `age_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function GenderDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `gender_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function EmployDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `employment_status`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function PositionDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `position_tbl`';
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function HighestDegreeDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `highest_degree`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function TotalYearDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `totalyear_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function SubjectDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `subject_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }

            function CurriclassDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `curriclass_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }
            function RegionDemoFetch($conn)
            {
                $qry  = 'SELECT * FROM `region_tbl`';
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_arr = [];
                foreach ($result as $res) {
                    array_push($res_arr, $res);
                }
                return $res_arr;
            }
            function displayKRAweight($conn, $kra_id)
            {
                $qry = "SELECT * FROM `kra_weight` WHERE kra_id = $kra_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        return $r['weight'];
                    endforeach;
                }
            }


            /* 
            this function will display the kra_id objective which divided to its objectives
            ex. 22.5% the output will be 7.5 in decimal value
            */

            function displayOBJweightMT($conn, $kra_id)
            {
                $qry = "SELECT * FROM `kra_weight` WHERE kra_id = $kra_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        $qry1 = "SELECT COUNT(kra_id) as count_kra FROM `mtobj_tbl` WHERE kra_id = " . $r['kra_id'] . "";
                        $w_obj = mysqli_query($conn, $qry1) or die($conn->error . $qry1);
                        if ($w_obj) :
                            foreach ($w_obj as $w) :
                                return floatval($r['weight'] / $w['count_kra']);
                            endforeach;
                        endif;
                    endforeach;
                }
            }

            function displayOBJweightT($conn, $kra_id)
            {
                $qry = "SELECT * FROM `kra_weight` WHERE kra_id = $kra_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) {
                    foreach ($result as $r) :
                        $qry1 = "SELECT COUNT(kra_id) as count_kra FROM `tobj_tbl` WHERE kra_id = " . $r['kra_id'] . "";
                        $w_obj = mysqli_query($conn, $qry1) or die($conn->error . $qry1);
                        if ($w_obj) :
                            foreach ($w_obj as $w) :
                                return floatval($r['weight'] / $w['count_kra']);
                            endforeach;
                        endif;
                    endforeach;
                }
            }

            function showPercent($num)
            {
                return floatval($num * 100);
            }

            // this function will count the total COT of the master teacher
            function countCOTforMT($conn, $user_id, $sy, $school)
            {
                $qry = "SELECT * FROM `cot_mt_rating_a_tbl` WHERE `user_id` = $user_id AnD sy = $sy AND school_id = $school GROUP BY obs_period";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    $count_arr = [];
                    foreach ($result as $r) :
                        array_push($count_arr, $r);
                    endforeach;
                    return intval(count($count_arr));
                endif;
            }

            function AVGofTIndicatorAVG($conn, $sy, $school, $indicator)
            {
                $qry = " SELECT ROUND(AVG(average),3) as AVE,sy FROM `cot_t_indicator_ave_tbl` WHERE sy = $sy and school = $school AND indicator_id = $indicator";
                $result = mysqli_query($conn, $qry);
                if ($result) {
                    foreach ($result as $r) {
                        return $r['AVE'];
                    }
                }
            }

            /* THIS FUNCTION WILL CONVERT THE RPMS 5-point scale TO RAW RATE */
            function rawRate($raw_rate, $position)
            {
                if ($position == "Master Teacher IV" or $position == "Master Teacher III" or $position == "Master Teacher II" or $position == "Master Teacher I") :
                    if ($raw_rate == 0) :
                        return $raw_rate = 0;
                    else :
                        return floatval($raw_rate) + floatval(3);
                    endif;
                elseif ($position == "Teacher III" or $position == "Teacher II" or $position == "Teacher I") :
                    if ($raw_rate == 0) :
                        return $raw_rate = 0;
                    else :
                        return floatval($raw_rate) + floatval(2);
                    endif;
                else : return false;
                endif;
            }

            function syIsNotSet($sy)
            {
                if (!empty($sy)) :
                    include 'samplefooter.php';
                    exit();
                else : false;
                endif;
            }


            function FetchSchoolRegion($conn, $school)
            {
                $qry = "SELECT * FROM school_tbl WHERE school_id = $school ";
                $result = mysqli_query($conn, $qry);
                if ($result) {
                    foreach ($result as $r) {
                        return $r['reg_id'];
                    }
                }
            }
            // this function will check if there is an duplicate in an array 
            function array_has_dupes($array)
            {
                return count($array) !== count(array_unique($array));
            }

            function KRA_tobjList($conn, $kra_id)
            {
                $qry = "SELECT * FROM `tobj_tbl` where kra_id =  $kra_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    $count_arr = [];
                    foreach ($result as $r) :
                        array_push($count_arr, $r);
                    endforeach;
                    return $count_arr;
                endif;
            }

            function kra_tbl($conn)
            {
                $qry = "SELECT * FROM `kra_tbl`";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    $count_arr = [];
                    foreach ($result as $r) :
                        array_push($count_arr, $r);
                    endforeach;
                    return $count_arr;
                endif;
            }

            function displayCBC($conn)
            {
                $qry = "SELECT * FROM core_behavioral_tbl";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    $count_arr = [];
                    foreach ($result as $r) :
                        array_push($count_arr, $r);
                    endforeach;
                    return $count_arr;
                endif;
            }

            function showCBCindicators($conn, $cbc_id)
            {
                $qry = "SELECT * FROM `cbc_indicators_tbl` where cbc_id =  $cbc_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    $count_arr = [];
                    foreach ($result as $r) :
                        array_push($count_arr, $r);
                    endforeach;
                    return $count_arr;
                endif;
            }
            function dateNow()
            {
                return date("Y-m-d H:i:s");
            }

            function displayLVLcapObjT($conn, $sy, $school)
            {
                $qry = "SELECT  SUM(lvlcap),SUM(priodev) ,kra_id,tobj_id FROM `esat2_objectivest_tbl` WHERE `status` = 'Active' and sy = $sy and school = $school group by tobj_id ORDER by SUM(lvlcap) desc,SUM(priodev) desc";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayLVLcapObjMT($conn, $sy, $school)
            {
                $qry = "SELECT  SUM(lvlcap),SUM(priodev) ,kra_id,mtobj_id FROM `esat2_objectivesMt_tbl` WHERE `status` = 'Active' and sy = $sy and school = $school group by mtobj_id ORDER by SUM(lvlcap) desc,SUM(priodev) desc";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayPrioDevObjT($conn, $sy, $school)
            {
                $qry = "SELECT  SUM(lvlcap),SUM(priodev), kra_id,tobj_id FROM `esat2_objectivest_tbl` WHERE `status` = 'Active' and sy = $sy and school = $school group by tobj_id ORDER by SUM(lvlcap) ,SUM(priodev) desc";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayPrioDevObjMT($conn, $sy, $school)
            {
                $qry = "SELECT  SUM(lvlcap),SUM(priodev), kra_id,mtobj_id FROM `esat2_objectivesMt_tbl` WHERE `status` = 'Active' and sy = $sy and school = $school group by mtobj_id ORDER by SUM(lvlcap) ,SUM(priodev) desc";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayCBCstrT($conn, $sy, $school)
            {
                $qry = " SELECT SUM(cbc_score),cbc_ind_id,cbc_id FROM `esat3_core_behavioralt_tbl` where cbc_score = 1 and sy = $sy and school = $school and status = 'active' GROUP by cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayCBCstrMT($conn, $sy, $school)
            {
                $qry = " SELECT SUM(cbc_score),cbc_ind_id,cbc_id FROM `esat3_core_behavioralmt_tbl` where cbc_score = 1 and sy = $sy and school = $school and status = 'active' GROUP by cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayCBCdevneedT($conn, $sy, $school)
            {
                $qry = " SELECT SUM(cbc_score),cbc_ind_id,cbc_id FROM `esat3_core_behavioralt_tbl` where cbc_score = 0 and sy = $sy and school = $school and status = 'active' GROUP by cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayCBCdevneedMT($conn, $sy, $school)
            {
                $qry = " SELECT SUM(cbc_score),cbc_ind_id,cbc_id FROM `esat3_core_behavioralmt_tbl` where cbc_score = 0 and sy = $sy and school = $school and status = 'active' GROUP by cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }

            function displayDPstr($conn, $sy, $school)
            {
                $qry = " SELECT * FROM `devplanmt_a1_strength_tbl` WHERE sy = $sy and school = $school AND status = 'Submit' ORDER BY a_strengths";
                $result = mysqli_query($conn, $qry) or die($conn->error);

                if ($result) {
                    $res_arr = [];
                    foreach ($result as $r) {
                        array_push($res_arr, $r);
                    }
                    return $res_arr;
                }
            }




            function displayCBCdescription($conn, $cbc_id)
            {
                $qry = "SELECT * FROM core_behavioral_tbl WHERE cbc_id = $cbc_id";
                $result = mysqli_query($conn, $qry);
                if ($result) :
                    foreach ($result as $r) :
                        return $r['cbc_name'];
                    endforeach;

                endif;
            }

            /*
            FETCH THE DEV A_STRENTHS
            */

            function mt_fetch_DEV_STR($conn, $sy, $school)
            {
                $qry = " SELECT * FROM `devplanmt_a1_strength_tbl` WHERE `status` = 'Submit' AND sy = '$sy' AND school = '$school' group by a_strengths";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_DEV_STR($conn, $sy, $school)
            {
                $qry = " SELECT * FROM `devplant_a1_strength_tbl` WHERE `status` = 'Submit' AND sy = '$sy' AND school = '$school' group by a_strengths";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_STR_OBJ($conn, $sy, $school, $a_str)
            {
                $qry = " SELECT * FROM `devplanmt_a1_strength_tbl` WHERE `status` = 'Submit' AND a_strengths = $a_str AND sy = '$sy' AND school = '$school' group by strengths_mtobj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_STR_OBJ($conn, $sy, $school, $a_str)
            {
                $qry = " SELECT * FROM `devplant_a1_strength_tbl` WHERE `status` = 'Submit' AND a_strengths = $a_str AND sy = '$sy' AND school = '$school' group by strengths_mtobj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_DEV_NEEDS($conn, $sy, $school)
            {
                $qry = " SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `status` = 'Submit' AND sy = '$sy' AND school = '$school' group by a_devneeds";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_DEV_NEEDS($conn, $sy, $school)
            {
                $qry = " SELECT * FROM `devplant_a2_devneeds_tbl` WHERE `status` = 'Submit' AND sy = '$sy' AND school = '$school' group by a_devneeds";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_DEVNEEDS_OBJ($conn, $sy, $school, $a_str)
            {
                $qry = " SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `status` = 'Submit' AND a_devneeds = $a_str AND sy = '$sy' AND school = '$school' group by devneeds_mtobj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_DEVNEEDS_OBJ($conn, $sy, $school, $a_str)
            {
                $qry = " SELECT * FROM `devplant_a2_devneeds_tbl` WHERE `status` = 'Submit' AND a_devneeds = $a_str AND sy = '$sy' AND school = '$school' group by devneeds_mtobj";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_STR_KRA($conn, $sy, $school)
            {
                $qry = "SELECT * FROM `devplanmt_b1_strength_tbl` WHERE sy = $sy and school = $school group by strength_cbc_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_STR_KRA($conn, $sy, $school)
            {
                $qry = "SELECT * FROM `devplant_b1_strength_tbl` WHERE sy = $sy and school = $school group by strength_cbc_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_STR_IND_CBC($conn, $sy, $school, $cbc_id)
            {
                $qry = " SELECT * FROM `devplanmt_b1_strength_tbl` WHERE `status` = 'Submit' AND strength_cbc_id = $cbc_id AND sy = '$sy' AND school = '$school' group by strength_cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_STR_IND_CBC($conn, $sy, $school, $cbc_id)
            {
                $qry = " SELECT * FROM `devplant_b1_strength_tbl` WHERE `status` = 'Submit' AND strength_cbc_id = $cbc_id AND sy = '$sy' AND school = '$school' group by strength_cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_DEVNEED_KRA($conn, $sy, $school)
            {
                $qry = "SELECT * FROM `devplanmt_b2_devneeds_tbl` WHERE sy = $sy and school = $school group by devneed_cbc_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_DEVNEED_KRA($conn, $sy, $school)
            {
                $qry = "SELECT * FROM `devplant_b2_devneeds_tbl` WHERE sy = $sy and school = $school group by devneed_cbc_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function mt_fetch_DEVNEED_IND_CBC($conn, $sy, $school, $cbc_id)
            {
                $qry = " SELECT * FROM `devplanmt_b2_devneeds_tbl` WHERE `status` = 'Submit' AND devneed_cbc_id = $cbc_id AND sy = '$sy' AND school = '$school' group by devneed_cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }

            function t_fetch_DEVNEED_IND_CBC($conn, $sy, $school, $cbc_id)
            {
                $qry = " SELECT * FROM `devplant_b2_devneeds_tbl` WHERE `status` = 'Submit' AND devneed_cbc_id = $cbc_id AND sy = '$sy' AND school = '$school' group by devneed_cbc_ind_id";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) :
                        array_push($res_array, $r);
                    endforeach;
                    return $res_array;
                }
            }





            function showObsPeriodAveAdminTGeneral($conn, $sy)
            {
                $qry = "SELECT `obs_period` FROM cot_t_rating_a_tbl where `sy` = $sy and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function viewAdminratingTGeneral($conn, $obs_period, $indicator_id, $sy)
            {
                $qry = "SELECT AVG(rating) AS T_RATING FROM `cot_t_rating_a_tbl` WHERE obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return round(floatval($r['T_RATING']), 3);
                    }
                }
            }

            function viewAdminratingMTGeneral($conn, $obs_period, $indicator_id, $sy)
            {
                $qry = "SELECT AVG(rating) AS T_RATING FROM `cot_mt_rating_a_tbl` WHERE obs_period = $obs_period and indicator_id =$indicator_id  AND SY= $sy AND status = 'Active'";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);

                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        return round(floatval($r['T_RATING']), 3);
                    }
                }
            }

            function fetchIndicatorAVGAdmintGeneral($conn, $indicator, $sy)
            {
                $qry = "SELECT AVG(average) AS T_AVERAGE FROM `cot_t_indicator_ave_tbl` where indicator_id = $indicator  and `sy` = $sy and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return round(floatval($res['T_AVERAGE']), 3);
                    endforeach;
                else : return false;
                endif;
            }

            function fetchIndicatorAVGAdminMtGeneral($conn, $indicator, $sy)
            {
                $qry = "SELECT AVG(average) AS T_AVERAGE FROM `cot_mt_indicator_ave_tbl` where indicator_id = $indicator  and `sy` = $sy and `status` = 'Active'";
                $result  = mysqli_query($conn, $qry) or die($conn->error . $qry);
                if ($result) :
                    foreach ($result as $res) :
                        return round(floatval($res['T_AVERAGE']), 3);
                    endforeach;
                else : return false;
                endif;
            }

            function showObsPeriodAveAdminMTGeneral($conn, $sy)
            {
                $qry = "SELECT `obs_period` FROM cot_mt_rating_a_tbl where `sy` = $sy and `status` = 'Active' GROUP by `obs_period`";
                $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
                $res_array = [];
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $r) {
                        array_push($res_array, $r);
                    }
                    return $res_array;
                }
            }

            function generateAVG($num1, $num2, $num3)
            {
                intval($num1);
                intval($num2);
                intval($num3);
                if ($num1 && $num2 && $num3) :
                    return  floatval(($num1 + $num2 + $num3) / 3);
                elseif ($num1 || $num2 || $num3) :
                    return  floatval(($num1 + $num2 + $num3) / 2);
                endif;
            }
