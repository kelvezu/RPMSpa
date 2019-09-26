<?php
    include 'includes/header.php';
    include 'includes/conn.inc.php';

    $kra_num = 0;   
    $tobj_num = 1;
    $result = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error); 
?>

 
<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <div class="h4 breadcome-list shadow-reset"><strong> Teacher Individual Performance Commitment and Review Rating Sheet </strong></div>
        <form action="includes/processtipcrf.php" method="POST">
            <table id="rating" class="table table-bordered">
                <thead class="bg-success">
                    <tr>
                        <th rowspan="2" class="text-center" width="4%">KRA</th>
                        <th rowspan="2" class="text-center" width="4%">Weight per KRA</th>
                        <th rowspan="2" class="text-center" width="4%">Objective</th>
                        <th rowspan="2" class="text-center" width="4%">Weight per Objective</th>
                        <th colspan="4" class="text-center" width="10%">Numerical Ratings</th>
                        <th rowspan="2" class="text-center" width="1%">Score</th>
                    </tr>
                    <tr>
                        <th class="text-center">Q</th>
                        <th class="text-center">E</th>
                        <th class="text-center">T</th>
                        <th class="text-center" width="1%">A</th>
                    </tr>
                </thead>
                <?php
     while($row = $result->fetch_assoc()):
        $kra_id = $row['kra_id'];
        
?>
            <tr>
                <td rowspan="4"><?php echo "KRA ".$row['kra_id'];?></td>
                
                
                <?php 
                $kra_num++;
                if($kra_num <= 4):
                    ?>
                    <td rowspan="4">22.5%</td>
                    
                <?php
                else:
                ?>

                <td rowspan="2">10%</td>
                <?php
                endif;
                 ?>
            </tr>
<?php
    $objresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
    while($rows = $objresult->fetch_assoc()): 
        $tobj_id = $rows['tobj_id'];
?>
            <tr name="criteria"><td> <?php echo  "Objective " .$rows['tobj_id'];?></td>
            
            <?php 
                    $tobj_num++;
                    if($tobj_num <= 13):
                        ?>
                        <td>7.5%</td>
                    
                    <?php
                    else:
                    ?>

                    <td>10%</td>
                    <?php
                    endif;
                    ?>
                
                <td><select name="num1[]" id="num1" class="form-control">
                    <option value="">Select</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select></td>

                <td><select name="num2[]" id="num2" class="form-control">
                    <option value="">Select</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select></td>
                <td><select name="num3[]" id="num3" class="form-control">
                <option value="">Select</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select></td>
                <td><input type="number" name="ave[]" id="ave" class="input form-control" disabled></td>
                <td><input type="number" name="score[]" id="score" class="input form-control" disabled></td>
                <script src="js/main2.js"></script>
                
            </tr>

<?php endwhile ?>
<?php endwhile ?>
                
            <td colspan="7" class="bg-success"><strong>Final Rating</strong></td>
            <td><input type="number" name="f_rating" id="f_rating" class="input form-control" disabled></td>
           <tr>
            <td colspan="7" class="bg-success"><strong>Adjectival Rating</strong></td>
            <td><input type="number" name="a_rating" id="a_rating" class="input form-control" disabled></td>
           </tr>
                  





            </table>
        
        
        
        </form>
    </div>
</div>


<br>
<?php
    include 'includes/footer.php';
?>