<?php

include 'includes/conn.inc.php';

if(isset($_POST["schoollevel_id"]) && !empty($_POST["schoollevel_id"])){
   
    $query = $conn->query("SELECT * FROM curriclass_tbl WHERE school_level = ".$_POST['schoollevel_id']."");
  
    $rowCount = $query->num_rows;
    
    if($rowCount > 0){
        echo '<option value="">Select Curricular Classification</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['curriclass_id'].'">'.$row['curriclass_name'].'</option>';
        }
    }else{ 
        echo '<option value="">Curricular classification not available</option>';
    }
}

?>