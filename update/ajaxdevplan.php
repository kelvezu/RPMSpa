

<?php

$connection = mysqli_connect("localhost", "root", "");
mysqli_select_db($connection, "rpms");

$kra = $_GET["kra"];


if ($kra != "") {
    $result3 = mysqli_query($connection, "SELECT * FROM tobj_tbl WHERE kra_id=$kra");
    echo "<select name='tobj_name1' class='form-control'>";
    while ($resultrow = mysqli_fetch_array($result3)) {
        $tobj_id = $resultrow['tobj_id'];
        $tobj_name = $resultrow['tobj_name'];

        echo "<option value = '$tobj_id'>";
        echo $tobj_name;
        echo "</option>";
    }
    echo "</select>";
}
?>

