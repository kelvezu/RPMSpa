    

<?php
    include 'includes/conn.inc.php';
    include 'includes/header.php';
 
   $connection=mysqli_connect("localhost","root","");
   mysqli_select_db($connection,"rpms");
 ?>


<div class="modal fade" id="mov-modal" tabindex="-1" role="dialog" aria-labelledby="movModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title " id="exampleModalLabel">Add MOV</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    
                <div class="modal-body">
                        <form action="includes/processtmov.php" method="POST">  
                            <div class="form-group row">   
                                <div class="col-lg">
                                    <label for="sel-kra" class="col-form-label"><strong>Select Key Result Areas</strong></label>
                                    <select name="kra_name" id="kradd" onChange = "change_kra()" class ="form-control">
                                        <option >Select KRA</option>
                                        <?php
                                            $query = mysqli_query($connection,"SELECT * from kra_tbl");
                                            while($row = mysqli_fetch_array($query)){
                                                $kra_id = $row['kra_id'];
                                                $kra_name = $row['kra_name'];
                                        ?>        
                                            <option value="<?php echo $kra_id ?>"><?php echo $kra_name; ?></option>
                                        <?php    
                                            }
                                        ?>
                                        </select>
                                </div>
                            
                                <div class="col-lg">
                                    <label for="sel-mov" class=" col-form-label"><strong>Select Objective</strong></label>
                                    <div id="objective">
                                        <select class="form-control">
                                            <option>Select Objective</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <label for="main-mov" class="col-form-label"><strong>Main MOV</strong></label>
                                    <textarea name="main_mov" id="main-mov" cols="3" rows="3" class="form-control" placeholder="Enter the main mov..."></textarea>
                                </div>
                                <div class="col-lg">
                                    <label for="supp-mov" class="col-form-label"><strong>Supporting MOV</strong></label>
                                    <textarea name="supp_mov" id="supp-mov" cols="3" rows="3" class="form-control" placeholder="Enter the supporting mov..."></textarea>
                                </div>
                                <div class="m-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="save">Add MOV</button>
                                </div>
                        </form>     
                        </div>
                </div>
        </div>
    </div>   
    </div>   
   
     

    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
            <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
<?php endif ?>

<div class="container">
    <div class="breadcome-list shadow-reset">

    <div class="right">
    <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#mov-modal">Add MOV<i class="fas fa-truck-moving    "></i> </button>

    <script type="text/javascript">
    function change_kra()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","ajaxmov.php?kra="+document.getElementById("kradd").value,false);
        xmlhttp.send(null);
        document.getElementById("objective").innerHTML=xmlhttp.responseText;
        
    }
    </script>



    <div class="h4 breadcrumb bg-dark text-white "><strong>Teacher Means of Verification</strong> </div>
  

<main>
    <div class="container">
        <div class="col-sm-10">
                 <?php 
                    
                    $query2 = mysqli_query($connection,"SELECT kra_tbl.kra_name,tobj_tbl.tobj_name,tmov_tbl.* FROM (tmov_tbl INNER JOIN kra_tbl ON tmov_tbl.kra_id = kra_tbl.kra_id) 
                    INNER JOIN tobj_tbl ON tmov_tbl.tobj_id = tobj_tbl.tobj_id") 
                    or die($connection->error); 
                    
                ?>

            <table class="table table-responsive-sm">
                <caption>Teacher Means of Verification</caption>
                <thead class="bg-success text-white ">
                <tr>
                    <th>KRA Name</th>
                    <th>Objective Name</th>
                    <th>Main MOV</th>
                    <th>Supporting MOV</th>
                    <th colspan="2" >Action</th>
                </tr>
                </thead>
                <?php
                    while($rows = mysqli_fetch_array($query2)){
                ?>
                <tbody class="text-justify">
                    <tr>
                        <td><?php echo $rows['kra_name']; ?></td>
                        <td><?php echo $rows['tobj_name']; ?></td>
                        <td><?php echo $rows['main_mov']; ?></td>
                        <td><?php echo $rows['supp_mov']; ?></td>
                        <td><a href="update/updatetmov.php?edit=<?php echo $rows['tmov_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                        <td><a href="delete/deletetmov.php?delete=<?php echo $rows['tmov_id'];?>" class="btn btn-outline-danger" >Delete</a>
                                                    
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>              
            </table>
        </div>
    </div>
    </div>
    </div>
    </div>
    <br>
    <?php
 
    include 'includes/footer.php';
?>
