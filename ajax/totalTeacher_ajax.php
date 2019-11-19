<?php
include "../includes/conn.inc.php";
include "../classes/rpmsdb/rpmsdb.class.php";
include "../libraries/func.lib.php";

use RPMSdb\RPMSdb;

$result = RPMSdb::totalTeacherPerSchool($conn);

$obj = new stdClass(); // <- this will instantiate the object variable
foreach ($result as $value) {
    $obj->school = displaySchool($conn, $value['school_id']);
    $obj->t_count = $value['T'];
    $obj->mt_count = $value['MT'];
    echo ($obj_json = json_encode($obj));
}
mysqli_close($conn);
