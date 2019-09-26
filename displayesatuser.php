<?php
include_once 'includes/conn.inc.php';
include_once 'includes/header.php';

    $conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));
    $result = $conn->query("SELECT account_tbl.*,esat3_core_behavioral_tbl.* FROM (account_tbl INNER JOIN esat3_core_behavioral_tbl ON account_tbl.user_id = esat3_core_behavioral_tbl.user_id)") or die($conn->error);


?>

<div class="container ">

<div class="breadcome-list shadow-reset">
    <h1>ESAT List of School Year: <?php echo $_SESSION['sy'] ?></h1>
    <hr>
        <div class="row">
        <div class="col-sm-6">
        <h4>Master Teacher List</h4>
        <table class="table">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Position</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                        <?php  while($row = mysqli_fetch_array($result)): ?>
                            <td><?php echo $row['firstname'].' '.$row['surname']; ?></td>
                            <td><?php echo $row['position'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                       
                        
                    </tbody>
        </table>
        </div>

        <div class="col-sm-6">
        <h4>Teacher List</h4>
        <table class="table">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Position</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Sample Body</td>
                            <td>Sample Body</td>
                        </tr>
                    </tbody>
        </table>
        </div>
                  
        </div><!-- row -->
    </div>
    
</div> <!-- End tag of container -->
<br>
<?php
    include 'includes/footer.php';
?>