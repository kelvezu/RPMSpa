<?php
include "../includes/conn.inc.php";
include "../classes/rpmsdb/rpmsdb.class.php";
include "../libraries/func.lib.php";

use RPMSdb\RPMSdb;

$result = RPMSdb::totalTeacherPerSchool($conn);
// pre_r($result);
$obj = new stdClass();
foreach ($result as $value) {
    $obj->school = displaySchool($conn, $value['school_id']);
    $obj->t_count = $value['T'];
    $obj->mt_count = $value['MT'];
    pre_r($obj_json = json_encode($obj));
}
