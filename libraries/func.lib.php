
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


            function directToDashboard(string $position)
            {
                try {
                    switch ($position) {
                        case 'Admin':
                            header('location:../dbAdmin.php');
                            exit();
                            break;

                        case 'Asst. Superintendent':
                            header('location:../dbAsstSuperintendent.php');
                            exit();
                            break;

                        case 'Principal':
                            header('location:../dbPrincipal.php');
                            exit();
                            break;

                        case 'School Head':
                            header('location:../dbSchoolHead.php');
                            exit();
                            break;

                        case 'Master Teacher IV':
                        case 'Master Teacher Iv':
                        case 'Master Teacher III':
                        case 'Master Teacher Iii':
                        case 'Master Teacher II':
                        case 'Master Teacher Ii':
                        case 'Master Teacher I':
                            header('location:../dbMasterTeacher.php');
                            exit();
                            break;

                        case 'Teacher III':
                        case 'Teacher Iii':
                        case 'Teacher II':
                        case 'Teacher Ii':
                        case 'Teacher I':
                            header('location:../dbTeacher.php');
                            exit();
                            break;

                        default:
                            header('location:../loginpage.php');
                            exit();
                            break;
                    }
                } catch (\Throwable $th) {
                    echo 'Error', $th->getMessage();
                }
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
                        echo 'Error in isTakenEsat function';
                    endif;

                    //CHECK IF user has esat!
                    $dbcon->query($esatForm1qry);
                    $esat1 = fetchAll($dbcon, $esatForm1qry);
                    if (!$esat1) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 1 yet!</li>');
                    else :
                        foreach ($esat1 as $esat1user) :
                            $esat1user['user_id'] . '<br/>';
                        endforeach;
                    endif;

                    //THIS WILLCHECK IF THE USER TAKEN ESAT 1
                    $esat2 = fetchAll($dbcon, $esatForm2qry);
                    if (!$esat2) :
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 2 yet!</li>');
                    else :
                        foreach ($esat2 as $esat2user) :
                            $esat2user['user_id'] . '<br/>';
                        endforeach;
                    endif;

                    $esat3 = fetchAll($dbcon, $esatForm3qry);
                    if (!$esat3) :
                        //echo '<p class="red-notif-border">No Result!</p>';
                        array_push($notif_array, '<li>You\'ve not taken the E-SAT PART 3 yet!</li>');
                    else :
                        foreach ($esat3 as $esat3user) :
                            $esat3user['user_id'] . '<br/>';
                        endforeach;
                    endif;

                    return $notif_array;
                endif;
            }

            function hasDevplan(mysqli $dbcon, $position, $user_id)
            {
                $notif_array = [];
                //THIS WILL CHECK THE POSITION OF THE USER
                if (!empty($position)) :
                    if (strpos(($position), 'aster')) :
                    //$devplanmt_a1_strength_tbl = 'SELECT * FROM `devplanmt_a1_strength_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_a2_devneeds_tbl = 'SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_a3_actionplan_tbl = 'SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_b1_strength_tbl = 'SELECT * FROM `devplanmt_b1_strength_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_b2_devneeds_tbl = 'SELECT * FROM `devplanmt_b2_devneeds_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_b3_actionplan_tbl = 'SELECT * FROM `devplanmt_b3_actionplan_tbl` WHERE `user_id`= "' . $user_id . '"';
                    //$devplanmt_c_tbl = 'SELECT * FROM `devplan_c_tbl` WHERE `user_id`= "' . $user_id . '"';

                    elseif (strpos(($_SESSION['position']), 'eacher')) :
                    //$devplan_t_strength = 'SELECT * FROM `esat2_objectivest_tbl` WHERE `user_id` ="' . $user_id . '"';
                    else :
                        echo 'Error in isTakenEsat function';
                    endif;
                endif;
            }
