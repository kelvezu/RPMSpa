<?php

namespace FilterUser;

class FilterUser
{
    public static function filterEsatUser($position)
    {
        if (!isset($position)) :
            if (!strpos($position, 'aster') || (!strpos($position, 'eacher'))) :
                echo '<p class="red-notif-border">You dont have to take ESAT!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatT($position)
    {
        if (!isset($position)) :
            if ((!strpos($position, 'eacher'))) :
                echo '<p class="red-notif-border">You dont have to take ESAT!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatMT($position)
    {
        if (!isset($position)) :
            if ((!strpos($position, 'aster'))) :
                echo '<p class="red-notif-border">You dont have to take ESAT!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }
}
