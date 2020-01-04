
<?php
include 'sampleheader.php';


if (isset($_GET['usertype'])) :
    $usertype = $_GET['usertype'];
    if ($usertype == 'sh') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Principal" OR position = "School Heads"';
    elseif ($usertype == 'as') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Asst. Superintendent" OR position = "Superintendent"';
    elseif ($usertype == 'mt') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Master Teacher IV" OR position = "Master Teacher III" OR position = "Master Teacher II" OR position = "Master Teacher I"';
    elseif ($usertype == 't') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Teacher III" OR position = "Teacher II" OR position = "Teacher I"';
    elseif ($usertype == 'n') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = 10';
    elseif ($usertype == 'a') :
        $userqry = 'SELECT * from account_tbl';
    endif;
else :
    $userqry = 'SELECT * FROM account_tbl';
endif;
?>


  <script src="includes/scripts.js"></script>
  
<main>


 <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
    <?php endif ?>


<!--View User Records modal -->


    
<div class="container">
    <!-- <div class="d-flex justify-content-center">
        
        <div class="d-inline-flex p-2 bd-highlight">
            <a href="?usertype=a" class="btn btn-sm btn-success">View All Users</a>&nbsp
            <a href="?usertype=as" class=" btn btn-sm btn-success">View All Asst. Superintendent</a>&nbsp
            <a href="?usertype=sh" class=" btn btn-sm btn-success">View All School Heads</a>&nbsp
            <a href="?usertype=mt" class=" btn btn-sm btn-success">View All Master Teacher</a>&nbsp
            <a href="?usertype=t" class="btn btn-sm btn-success">View All Teacher</a>&nbsp
            <a href="?usertype=n" class="btn btn-sm btn-success">View Users with No position</a>

        </div>
    </div> -->
    <div class="d-flex justify-content-between bg-dark">
        <div class="p-2"></div>
        <div class="p-2 h4 text-white"> Account Informations</div>
        <div class="p-2"><a href="signup2.php" class="btn btn-primary">Add User</a></div>
        
    </div>
    <div class="form-group">
          <div class="input-group">
                 <span class="input-group-text" >Search</span>
                <input type="text" name="search_text" id="search_text" placeholder="Type Name, Position, School..." class="form-control" />
     </div>
    </div>
   <div id="result"></div>
 
</main>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetchsearch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<?php

include 'samplefooter.php';
?>
