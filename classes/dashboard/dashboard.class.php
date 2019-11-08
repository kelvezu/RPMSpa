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
}
