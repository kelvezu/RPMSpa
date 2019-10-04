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


    function selectSubject(mysqli $conn)
    {
        $output = "";

        $query = "SELECT * FROM subject_tbl";
        $subjectResults = fetchAll($conn, $query);

        pre_r($subjectResults);
    }
