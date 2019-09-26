<?php
include_once 'includes/conn.inc.php';

$conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));

$qry = "SELECT * FROM esat2_objectivet_tbl";

$result = $conn->query("SELECT esat2_objectivest_tbl.*,kra_tbl.*,tobj_tbl.* FROM (esat2_objectivest_tbl INNER JOIN kra_tbl ON esat2_objectivest_tbl.kra_id = kra_tbl.kra_id) INNER JOIN tobj_tbl ON esat2_objectivest_tbl.tobj_id = tobj_tbl.tobj_id GROUP BY kra_tbl.kra_name, tobj_tbl.tobj_name  HAVING COUNT(kra_tbl.kra_name) > 1 AND COUNT(tobj_tbl.tobj_name) > 1  ORDER BY kra_tbl.kra_id ") or die($conn->error);

// SELECT 
//     first_name, COUNT(first_name),
//     last_name,  COUNT(last_name),
//     email,      COUNT(email)
// FROM
//     contacts
// GROUP BY 
//     first_name , 
//     last_name , 
//     email
// HAVING  COUNT(first_name) > 1
//     AND COUNT(last_name) > 1
//     AND COUNT(email) > 1;

// echo $row['kra_name'].'<br>'; // <- CODE TO DISPLAY ALL THE OBJECTIVE NAME 

// while ($row = mysqli_fetch_array($result)):
//  ('this is KRA => '.$row['kra_id'].' '.$row['kra_name']);
// ('this is Objective => '.$row['tobj_name']);
// ('Level for Capability =>'.$row['lvlcap'].'     Priority for Development =>'.$row['priodev']);
// ('<hr>');



        
//  $kra_id = $row['kra_id'];
//  $kra_name = $row['kra_name'];
//  $tobj_name = $row['tobj_name'];
//  $lvlcap = $row['lvlcap'];    
//  $priodev = $row['priodev'];
//  $i = 0;

while ($row = mysqli_fetch_array($result)): 

?>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>



<div class="col-sm-6 offset-md-8 my-5">

<div class="card">
    <div class="card-body">
        <canvas id="myChart">
    
        </canvas>
    </div>
</div>
</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        
        labels: ['<?php echo $kra_name = $row['kra_name'];?>','<?php echo $kra_name = $row['kra_name'];?>'],
        datasets: [
           
            {
            label: 'Level of Capabilities',
            data: [<?php echo $row['lvlcap'] ?>,<?php echo $row['lvlcap'] ?>,0,10],
            backgroundColor: 'blue',
            borderWidth: 2,
            borderColor: 'black'
            
        },
        
        {
            label: 'Priority for Development',
            data: [<?php echo $row['priodev'] ?>,6,0,10],
            backgroundColor:'red' ,
            borderWidth: 2,
            borderColor: 'black'
        }]

        
        
       
            
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false,
                }
            }]
        }
    }
});



// <?php   endwhile ?>
</script>


