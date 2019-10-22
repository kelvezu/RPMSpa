<!-- <?php

        namespace FilterUser;

        class FilterUser
        {
            public static function filterEsatDemo($position)
            {
                if (isset($position)) :
                    if (!strpos($position, 'aster') || (!strpos($position, 'eacher'))) :
                        echo '<p class="green-notif-border">
                ESAT is only avaible for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';

                        directLastPage();
                        include 'includes/footer.php';
                        die();

                    elseif (strpos($position, 'aster') || (strpos($position, 'eacher'))) :


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
                if (isset($position)) :
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
                if (isset($position)) :
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
