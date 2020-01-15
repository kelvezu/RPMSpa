<?php
include '../includes/conn.inc.php';
include '../libraries/func.lib.php';
$qry = "";
if (isset($_GET['option'])) :
    $option = $_GET['option'];

    if ($option == "main_mov") {
        $qry = "SELECT * FROM mtobj_tbl WHERE classroom_observable = 'No' ";
    } else {
        $qry = "SELECT * FROM mtobj_tbl  ";
    }
endif;

$result = mysqli_query($conn, $qry) or die($conn->error);
// pre_r($result);
foreach ($result as $r) : ?>

    <details>
        <summary> <input type="checkbox" name="obj[]" value="<?= $r['mtobj_id'] ?>"> <?= 'Objective ' . $r['mtobj_id'] ?></summary>
        <p>
            <?= $r['mtobj_name'] ?>
        </p>
    </details>

<?php endforeach;
