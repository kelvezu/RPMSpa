<?php
include_once 'includes/header.php';
include_once 'includes/constants.inc.php';
include_once 'includes/classautoloader.inc.php';
include_once 'libraries/db.library.php';
include_once 'libraries/func.lib.php';
include_once 'includes/security.php';

$conn = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$queryRater = 'SELECT * FROM account_tbl WHERE rater IS NULL';
$results = fetchAll($conn, $queryRater);

$queryRatee = 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III")';
$rateeResults = fetchAll($conn, $queryRatee);
pre_r($rateeResults);
?>


<body>
    <div class="container p-5">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Fullname</th>
                    <th>Position</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($results)) :
                    foreach ($results as $result) :
                        ?>
                        <tr>
                            <td><?php echo $result['firstname'] . ' ' . $result['surname']; ?></td>
                            <td><?php echo $result['position'] ?></td>
                            <td><?php echo $result['username'] ?></td>
                            <td><?php echo $result['email'] ?></td>
                            <td>Edit</td>
                            <td>Delete</td>
                        <?php
                            endforeach;
                        else :
                            ?>
                        </tr>
                        <tr class="text-center font-weight-bold">
                            <td colspan="6">There are no Records</td>
                        </tr>
                    <?php
                    endif;
                    ?>
            </tbody>
        </table>
    </div>
</body>

</html>