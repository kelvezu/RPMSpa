<?php

include_once '../includes/conn.inc.php';
// include_once '../libraries/func.lib.php';
$result_array = [];

if(isset($_POST["tyear2"]))
{
$query = "SELECT c.sy_desc,CONCAT(a.kra_id,'.',a.tobj_id) 
AS OBJECTIVES, lvlcap, priodev 
FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
INNER JOIN sy_tbl c on a.sy = c.sy_id
WHERE c.sy_desc = '".$_POST["tyear2"]."' 
group by c.sy_desc,a.tobj_id,b.tobj_name";
     
     $result = mysqli_query($conn,$query);

     foreach($result as $row)
     {
          array_push($result_array,$row);
          
     }
     pre_r($result_array);
     
}
?>
