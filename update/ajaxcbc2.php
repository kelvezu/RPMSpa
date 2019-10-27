

<?php

$connection = mysqli_connect("localhost", "root", "");
mysqli_select_db($connection, "rpms");

$cbc = $_GET["cbc"];


if ($cbc != "") {
    $result3 = mysqli_query($connection, "SELECT * FROM cbc_indicators_tbl WHERE cbc_id=$cbc");
    echo "<select name='cbc_name2' class='form-control'>";
    while ($resultrow = mysqli_fetch_array($result3)) {
        $cbc_id = $resultrow['cbc_ind_id'];
        $cbc_name = $resultrow['indicator'];

        echo "<option value = '$cbc_id'>";
        echo $cbc_name;
        echo "</option>";
    }
    echo "</select>";
}
?>

