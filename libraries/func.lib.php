
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
                        array_push($notif_array, '<li class="green-notif-border">Tae ka!</li>');
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
                    $esatForm1qry = 'SELECT * FROM `esat1_demographics_tbl` WHERE `user_id` = "' . $user_id . '"';
                    $esatForm3qry = 'SELECT * FROM `esat3_core_behavioral_tbl` WHERE `user_id`= "' . $user_id . '"';
                    if (strpos(($position), 'aster')) :
                        $esatForm2qry = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE `user_id`= "' . $user_id . '"';
                    elseif (strpos(($_SESSION['position']), 'eacher')) :
                        $esatForm2qry = 'SELECT * FROM `esat2_objectivest_tbl` WHERE `user_id` ="' . $user_id . '"';
                    else :
                        return false;
                    endif;

                    //CHECK IF user has esat!
                    $dbcon->query($esatForm1qry);
                    $esat1 = fetchAll($dbcon, $esatForm1qry);
                    if (!$esat1) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 1 yet!</li>');
                    // else :
                    //     // foreach ($esat1 as $esat1user) :
                    //     //     $esat1user['user_id'] . '<br/>';
                    //     // endforeach;
                    //     return true;
                    endif;

                    //THIS WILLCHECK IF THE USER TAKEN ESAT 1
                    $esat2 = fetchAll($dbcon, $esatForm2qry);
                    if (!$esat2) :
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 2 yet!</li>');
                    // else :
                    //     // foreach ($esat2 as $esat2user) :
                    //     //     $esat2user['user_id'] . '<br/>';
                    //     // endforeach;
                    //     return true;
                    endif;

                    $esat3 = fetchAll($dbcon, $esatForm3qry);
                    if (!$esat3) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 3 yet!</li>');
                    // else :
                    //     // foreach ($esat3 as $esat3user) :
                    //     //     $esat3user['user_id'] . '<br/>';
                    //     // endforeach;
                    //     return true;
                    endif;

                    return $notif_array;
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
                    elseif (strpos($position, 'rincipal') || strpos($position, 'uper') || strpos($position, 'heads')) :
                        echo 'Master Teachers';
                    else :
                        echo 'Employees';
                    endif;
                else :
                    'You dont have a Position Yet';
                endif;
            }

            function activeSY(mysqli $dbcon)
            {
                $syQry = 'SELECT * FROM sy_tbl WHERE `status` = "Active" ';
                $syResult = fetchAll($dbcon, $syQry);

                if ($syResult) :
                    foreach ($syResult as $sy_item) :
                        $_SESSION['active_sy_id'] = $_SESSION['sy_id'];
                        $_SESSION['start_date'] = $sy_item['startDate'] . '<br>';
                        $_SESSION['end_date'] = $sy_item['end_date'] . '<br>';
                        $_SESSION['active_sy'] = $sy_item['sy_desc'] . '<br>';
                        $_SESSION['sy_status'] = $sy_item['status'] . '<br>';
                    endforeach;
                    $startdate = $_SESSION['start_date'];

                    $_SESSION['start_year'] = substr($startdate, 0, 4) . BR;
                    $_SESSION['start_month'] = substr($startdate, 5, 2) . BR;
                    $_SESSION['start_day'] = substr($startdate, 8, 2) . BR;
                else :
                    echo '<p class="red-notif-border" >No Active School Year!</p> ';
                endif;
            }

            function showRatee($position)
            {
                if (isset($position)) :
                    if (strpos($position, 'rincipal') ||strpos($position, 'heads') ) :
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
                        return 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $_SESSION['school_id'] . '"  AND `user_id` <> " ' . $_SESSION['user_id'] . ' " AND status = "Active"';
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
                echo '<center/><form><input type="button" class="btn btn-danger" value="Go back" onClick="javascript:history.go(-1)"></form>' . BR;
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
