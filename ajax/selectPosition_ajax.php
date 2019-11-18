<?php include '../includes/conn.inc.php';
$qry = "SELECT * FROM position_tbl WHERE position_name NOT IN ('Admin','Asst. Superintendent')";
$result = mysqli_query($conn, $qry);
?>

<select id="sel_opt" class="form-control form-control-md">
    <?php foreach ($result as $res) : ?>
        <option value="<?= $res['position_name'] ?>"><?= $res['position_name'] ?></option>
    <?php endforeach; ?>
</select>