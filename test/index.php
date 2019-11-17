<?php
// Load the database configuration file
include_once 'conn.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">

    <!-- CSV file upload form -->

        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
  

    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>PRC ID</th>
                <th>Surname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Position</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Birthdate</th>
           
            </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $result = $db->query("SELECT * FROM members");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['prc_id']; ?></td>
                <td><?php echo $row['surname']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['middlename']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['birthdate']; ?></td>
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>

