<?php 

 include 'includes/conn.inc.php';
 include 'includes/header.php';

                        $conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));
                        $resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);       
                    ?>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">

                     <img src = "img\deped.png" width="100" height="100" class="rounded-circle"><br>
                        <h5>COT-RPMS</h5>
                        
                        <div class = "h3 bg-primary text-white">Master Teacher I-IV
                        </div>
                       
                        <h4> Inter-Observer Agreement Form</h4>
               
    <h5 class="text-left">OBSERVER 1<br>
    OBSERVER 2<br>
    OBSERVER 3DATE<br>
    TEACHER OBSERVED<br>
    SUBJECT<br>
    GRADE LEVEL TAUGHT <br>OBSERVATION PERIOD
        1<input type="checkbox" value="1">
        2<input type="checkbox" value="2">
        3<input type="checkbox" value="3">
        4<input type="checkbox" value="4">
        </h5> 

<table class="table table-bordered" style="background-color: white; table-layout: 10;">
    <thead class="legend-control bg-primary text-white " >
        <tr>
            <th>Indicator No</th>
            <th>Indicator Name</th>
            <th>Final Rating</th>
        </tr>
    </thead>
<?php
    if($resultquery){
        while($row = mysqli_fetch_array($resultquery))
        {
            ?>
                <tbody>
                    <tr>
                        <th><?php echo $row['mtindicator_no'];?></th>
                        <th><?php echo $row['mtindicator_name'];?></th>
						   <th>
                           <select name="rating">
                                <option value="">--select--</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="3">NO*</option>
                            </select>

                            </th>
                         </tr>    
                </tbody>
            <?php     
        }
    }
    else
    {
        echo "No record found";
    }
?>
</table>
<textarea class="form-control" name="comment" rows="5" placeholder="OTHER COMMENTS"></textarea>

</div>
</div>
<br>
<?php
   
    include 'includes/footer.php';
?>