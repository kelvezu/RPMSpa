<?php

include('includes/conn.inc.php');

if(isset($_POST["reg_id"]) && !empty($_POST["reg_id"])){
   
    $query = $conn->query("SELECT * FROM division_tbl WHERE reg_id = ".$_POST['reg_id']."");
  
    $rowCount = $query->num_rows;
    
    if($rowCount > 0){
        echo '<option value="">Select Division</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['div_id'].'">'.$row['divi_name'].'</option>';
        }
    }else{ 
        echo '<option value="">Division not available</option>';
    }
}

if(isset($_POST["div_id"]) && !empty($_POST["div_id"])){

    $query = $conn->query("SELECT * FROM municipality_tbl WHERE div_id = ".$_POST['div_id']." ");
    
    $rowCount = $query->num_rows;
    
    if($rowCount > 0){
        echo '<option value="">Select Municipality</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['muni_id'].'">'.$row['muni_name'].'</option>';
        }
    }else{
        echo '<option value="">Municipality not available</option>';
    }
}
?>