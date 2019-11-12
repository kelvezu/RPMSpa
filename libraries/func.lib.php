
            <?php


            //GET THE START
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
                    elseif (strpos($position, 'chool Heads')) :
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
                        return ucwords($raw_title) . ' ' . strtoupper($raw);

                    elseif (stripos(($position), 'eacher')) :
                        $raw = substr($position, 7);
                        $raw_title = substr($smallcaps, 0, 7);
                        return ucwords($raw_title) . ' ' . strtoupper($raw);
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
                    return $result_arr;
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
