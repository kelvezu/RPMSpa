<?php

$connection=mysqli_connect("localhost","root","");
mysqli_select_db($connection,"rpms");

$kra = $_GET["kra"]; 


if($kra != ""){ 
    $result3 = mysqli_query($connection,"SELECT * FROM mtobj_tbl WHERE kra_id=$kra");
    echo "<select name='mtobj_name' class='form-control'>";
    while($resultrow = mysqli_fetch_array($result3)){
        $mtobj_id = $resultrow['mtobj_id'];
        $mtobj_name = $resultrow['mtobj_name'];

    echo "<option value = '$mtobj_id'>"; 
    echo $mtobj_name;
    echo "</option>";
}
    echo "</select>";

}
?>