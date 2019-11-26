<?php

include_once '../includes/conn.inc.php';
// include_once '../libraries/func.lib.php';
$result_array = [];

if(isset($_POST["tyear1"]))
{
//$tyear2 = $_POST;
$query = "SELECT c.sy_desc,a.CBC_NAME,sum(b.cbc_score)
AS cbc_score FROM core_behavioral_tbl a INNER JOIN 
esat3_core_behavioralmt_tbl b on a.cbc_id = b.cbc_id 
INNER JOIN sy_tbl c on b.sy = c.sy_id
GROUP BY c.sy_desc,a.CBC_NAME";
     
     $result = mysqli_query($conn,$query);

     foreach($result as $row)
     {
          array_push($result_array,$row);
          
     }
   //  pre_r($result_array);
     
 }


 if(isset($_POST["tyear2"]))
{
//$tyear2 = $_POST;
$query = "SELECT c.sy_desc,CONCAT(a.kra_id,'.',a.mtobj_id) 
AS OBJECTIVES, lvlcap, priodev 
FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
INNER JOIN sy_tbl c on a.sy = c.sy_id
group by c.sy_desc,a.mtobj_id,b.mtobj_name";
     
     $result = mysqli_query($conn,$query);

     foreach($result as $row)
     {
          array_push($result_array,$row);
          
     }
   //  pre_r($result_array);
     
 }
?>
