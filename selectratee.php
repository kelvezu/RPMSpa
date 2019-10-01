<?php

include_once 'includes/header.php';
include_once 'includes/constants.inc.php';
include_once 'includes/classautoloader.inc.php';
include_once 'libraries/db.library.php';
include_once 'libraries/func.lib.php';
include_once 'includes/security.php';
?>

<form action="includes/processratee.php" method="POST">
    <div class="container">
        <input type="text" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
        <div class="breadcome-list shadow-reset">
            <div class="bg-info"><strong>SELECT YOUR RATEE:</strong></div>
            <div class="card-body text-dark">
                <?php
                $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $query = 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III") AND rater IS NULL';
                $teacherresults = fetchAll($dbcon, $query);
                if (count($teacherresults)) :
                    foreach ($teacherresults as $teacher) :
                        ?>
                        <input type="checkbox" class=" form-check-input" name="teacher[]" value="<?php echo $teacher['user_id'] ?>" /> <?php echo '- ' . $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname']; ?><br>
                <?php
                    endforeach;
                else :
                    echo 'No Record!';
                endif;
                ?>
            </div>
        </div>
    </div>
    <button name="btn">Submit</button>

</form>





<body>

</body>

</html>