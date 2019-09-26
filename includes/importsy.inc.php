<?php

    if (isset($_POST["sy-set"])){
        include_once "conn.inc.php";
      
        
        $startMonth =$_POST["start-month"];
        $startDay = implode(",",$_POST["start-day"]);
        $endMonth = $_POST["end-month"];
        $endDay =  implode(",",$_POST["end-day"]);

       $sdate = getStartYear()."/".$startMonth."/".$startDay;
       $edate = getEndYear()."/".$endMonth."/".$endDay;
        $sy_desc = getStartYear()."-".getEndYear();


        $query2 = 'UPDATE sy_tbl SET status = "inactive"';
        $query = "INSERT INTO sy_tbl(startDate,end_date,sy_desc,status) VALUES ('$sdate','$edate','$sy_desc','active')";
        mysqli_query($conn,$query2);
        

        if(mysqli_query($conn,$query)){
            header("location:../dashboard.php");

        } else {
            echo "Error: ".mysqli_error($conn);
        }
       
    }

    
    
 
    

        
      