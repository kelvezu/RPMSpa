<?php 
use RPMSdb\RPMSdb;


if(isset($_POST["tyear1"]))
{
     $query = "SELECT c.sy_desc,a.CBC_NAME,sum(b.cbc_score)
           AS cbc_score FROM core_behavioral_tbl a INNER JOIN 
            esat3_core_behavioralt_tbl b on a.cbc_id = b.cbc_id 
            INNER JOIN sy_tbl c on b.sy = c.sy_id
            GROUP BY c.sy_desc,a.CBC_NAME";
     
     $result = mysqli_query($conn,$query);
     $resut_array = [];
     foreach($result as $row)
     {
          array_push($result_array,$row);
     }
     echo json_encode($result_array);
}
    

if(isset($_POST["tyear2"]))
{
     $query2 = "SELECT c.sy_desc,CONCAT(a.kra_id,'.',a.tobj_id) 
     AS OBJECTIVES, lvlcap, priodev 
     FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
     INNER JOIN sy_tbl c on a.sy = c.sy_id
     WHERE c.sy_desc = '".$_POST["tyear2"]."' 
     group by c.sy_desc,a.tobj_id,b.tobj_name";
     
     $result2 = mysqli_query($conn,$query2);
     foreach($result2 as $row)
     {
      $output2[] = array(
       'OBJECTIVES'   => $row["OBJECTIVES"],
       'lvlcap'  => floatval($row["lvlcap"]),
       'priodev'  => floatval($row["priodev"])
      );
     }
     echo json_encode($output2);
}
    

if(isset($_POST["mtyear1"]))
{
     $query = "SELECT c.sy_desc,a.CBC_NAME,sum(b.cbc_score)
           AS cbc_score FROM core_behavioral_tbl a INNER JOIN 
            esat3_core_behavioralmt_tbl b on a.cbc_id = b.cbc_id 
            INNER JOIN sy_tbl c on b.sy = c.sy_id
            GROUP BY c.sy_desc,a.CBC_NAME";
     
     $result = mysqli_query($conn,$query);
     foreach($result as $row)
     {
      $output[] = array(
       'CBC_NAME'   => $row["CBC_NAME"],
       'cbc_score'  => floatval($row["cbc_score"])
      );
     }
     echo json_encode($output);
}
    

if(isset($_POST["mtyear2"]))
{
     $query2 = "SELECT c.sy_desc,CONCAT(a.kra_id,'.',a.mtobj_id) 
     AS OBJECTIVES, lvlcap, priodev 
     FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
     INNER JOIN sy_tbl c on a.sy = c.sy_id
     
     group by c.sy_desc,a.mtobj_id,b.mtobj_name";
     
     $result2 = mysqli_query($conn,$query2);
     foreach($result2 as $row)
     {
      $output2[] = array(
       'OBJECTIVES'   => $row["OBJECTIVES"],
       'lvlcap'  => floatval($row["lvlcap"]),
       'priodev'  => floatval($row["priodev"])
      );
     }
     echo json_encode($output2);
}
  
if(isset($_POST["sy_esat"]))
{
     $query = "SELECT school_name, (With_ESAT/total_teacher) as Percentage,School_Year from tbl_rptwithesat WHERE School_Year IS NOT NULL group by school_name";
     $result = mysqli_query($conn,$query);

     foreach($result as $row)
     {
      $output[] = array(
       'school_name'   => $row["school_name"],
       'Percentage'  => floatval($row["Percentage"]),
      );
     }
     echo json_encode($output);

}

?>




