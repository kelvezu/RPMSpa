        <?php
        include_once 'conn.inc.php';
        include_once '../libraries/func.lib.php';

        //ESAT FORM 1

        if (isset($_POST['submitESAT1'])) :
            $user_id = $_POST['user_id'];
            $sy = $_POST['sy'];
            $school = $_POST['school_id'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
            $position = $_POST['position'];
            $highest_degree  = $_POST['hdo'];
            $course  = $_POST['course'];
            $totalyear  = $_POST['totalyear'];
            $areaspec = implode(",", $_POST['areaspec']);
            $subject = implode(",", $_POST['subject']);
            $gradelvltaught = implode(",", $_POST['glt']);
            $curriclass = $_POST['curriclass'];
            $region = $_POST['region'];

            $query = "INSERT INTO esat1_demographics_tbl(`user_id`, age, gender, employment_status, position, highest_degree, course_taken, totalyear, area_specialization, subject_taught, grade_lvl_taught, curri_class, region,sy,school) VALUES ('$user_id','$age','$gender','$status','$position','$highest_degree','$course','$totalyear','$areaspec','$subject','$gradelvltaught','$curriclass','$region','$sy','$school')";
            if ($query_run = mysqli_query($conn, $query)) :
                if ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :
                    header('location:../esatform2t.php');
                    exit();
                elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                    header('location:../esatform2mt.php');
                    exit();
                else :
                    echo "You are not required to take ESAT!";
                endif;
            else :
                echo 'Mysql Error!' . mysqli_error($conn);
            endif;
        endif;

        //-------ESAT FORM 2 teacher objectives------//
        $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

        if (isset($_POST['submitESAT2t'])) :
            $user_id = $_POST['user_id'];
            $sy = $_POST['sy'];
            $school = $_POST['school_id'];
            $kra_id = $_POST['kra_id'];
            $tobj_id = $_POST['tobj_id'];
            $lvlcap = $_POST['lvlcap'];
            $priodev = $_POST['priodev'];
            $position = $_POST['position'];

            for ($count = 0; $count < count($kra_id); $count++) {
                $conn->query('INSERT INTO esat2_objectivest_tbl(user_id,kra_id, tobj_id, lvlcap, priodev,sy,position,school)VALUES("' . $user_id[$count] . '","' . $kra_id[$count] . '","' . $tobj_id[$count] . '","' . $lvlcap[$count] . '","' . $priodev[$count] . '","' . $sy . '","' . $position . '","' . $school . '")') or die($conn->error);
            }
            header('location:../ESATform3.php');
        endif;

        //-------ESAT FORM 2 master teacher objectives------//
        $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

        if (isset($_POST['submitESAT2mt'])) :
            $user_id = $_POST['user_id'];
            $sy = $_POST['sy'];
            $school = $_POST['school_id'];
            $kra_id = $_POST['kra_id'];
            $mtobj_id = $_POST['mtobj_id'];
            $lvlcap = $_POST['lvlcap'];
            $priodev = $_POST['priodev'];
            $position = $_POST['position'];

            for ($count = 0; $count < count($kra_id); $count++) {
                $conn->query('INSERT INTO esat2_objectivesmt_tbl(user_id,kra_id, mtobj_id, lvlcap, priodev,sy,position,school)VALUES("' . $user_id[$count] . '","' . $kra_id[$count] . '","' . $mtobj_id[$count] . '","' . $lvlcap[$count] . '","' . $priodev[$count] . '","' . $sy . '","' . $position . '","' . $school . '")') or die($conn->error);
            }
            header('location:../ESATform3.php');
        endif;

        //-------ESAT FORM 3 Core Behavioral Competencies------//
        $cbc_score = 0;
        if (isset($_POST['submitESAT3'])) :
            $user_id = $_POST['user_id'];
            $sy = $_POST['sy'];
            $school = $_POST['school_id'];
            $cbc_id = $_POST['cbc_id'];
            $cbc_ind_id = $_POST['cbc_ind_id'];
            $cbc_score = $_POST['cbc_score'];
            $position = $_POST['position'];

            for ($count = 0; $count < count($user_id); $count++) {
                $conn->query('INSERT INTO esat3_core_behavioral_tbl(user_id,cbc_id,cbc_ind_id,cbc_score,sy,position,school)VALUES("' . $user_id[$count] . '","' . $cbc_id[$count] . '","' . $cbc_ind_id[$count] . '","' . $cbc_score[$count] . '","' . $sy . '","' . $position . '","' . $school . '")') or die($conn->error);
            }
            directToCharts($position);
        endif;
