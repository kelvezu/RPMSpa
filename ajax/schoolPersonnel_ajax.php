<?php
include '../includes/conn.inc.php';
include '../classes/rpmsdb/rpmsdb.class.php';
include '../libraries/func.lib.php';

use RPMSdb\RPMSdb;

session_start();

$n = 1;
$schPersonnels = RPMSdb::showSchoolPersonnel($conn);
foreach ($schPersonnels as $schp) :
    $schPosition = $schp['position'];
    if ($schPosition == "School Head") :
        $schClass = "tomato-color";
    elseif (stripos($schPosition, "aster")) :
        $schClass = "text-primary";
    elseif (stripos($schPosition, "eacher")) :
        $schClass = "text-success";
    elseif (stripos($schPosition, "uper")) :
        $schClass = "apple-color";
    else :
        $schClass = "text-dark";
    endif;
    ?>
    <tr class="<?= $schClass ?>">
        <td><?= $n++ ?></td>
        <td><?= displayName($conn, $schp['user_id']) ?></td>
        <td><?= $schPosition ?></td>
    </tr>
<?php endforeach ?>