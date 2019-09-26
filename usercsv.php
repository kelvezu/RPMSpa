<?php
include 'includes/conn.inc.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>

 
    
  <style>
  .box  
  {
   max-width:600px;
   width:100%;
   margin: 0 auto;;
  }
  </style>

 <body>
 <script
          src="https://code.jquery.com/jquery-2.2.4.min.js"
          integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
          crossorigin="anonymous"></script>
 <!-- <script src="js/jquery-3.4.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <div class="container">
   <br/>
   <h3 align="center">Enter CSV information</h3>
   <br />
   <form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="col-md-3">  
     <br />
     <?php 
     //
      ?>
     <label>Select CSV File</label>
    </div>  
                <div class="col-md-4">  
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
   </form>
   <br />
   <br />
   <div id="csv_file_data"></div>
   
  </div>
 </body>
</html> 

<script>

$(document).ready(function(){
 $('#upload_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"includes/fetch.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(data)
   {
    var html = '<table class="table table-striped table-bordered table-sm">';
    
    
            



            if(data.column)
            {
                html += '<tr>';
                for(var count = 0; count < data.column.length; count++)
                {
                html += '<th>'+data.column[count]+'</th>';
                }
             html += '</tr>';   
            }
           
        

    if(data.row_data)
    {
     for(var count = 0; count < data.row_data.length; count++)
     {
      html += '<tr>';
      html += '<td class="surname" contenteditable>'+data.row_data[count].surname+'</td>';
      html += '<td class="firstname" contenteditable>'+data.row_data[count].firstname+'</td>';
      html += '<td class="middlename" contenteditable>'+data.row_data[count].middlename+'</td>';
      html += '<td class="position" contenteditable>'+data.row_data[count].position+'</td>';
      html += '<td class="email" contenteditable>'+data.row_data[count].email+'</td>';
      html += '<td class="contact" contenteditable>'+data.row_data[count].contact+'</td>';
      html += '<td class="gender" contenteditable>'+data.row_data[count].gender+'</td>';
      html += '<td class="birthdate" contenteditable>'+data.row_data[count].birthdate+'</td></tr>';
     }
    }
    html += '<table>';
    html += '<div align="center"><button type="submit" id="import_data" class="btn btn-success">Import Data</button></div>';

    $('#csv_file_data').html(html);
    $('#upload_csv')[0].reset();

    
   }
  })
 });

 $(document).on('click', '#import_data', function(){
  var surname = [];
  var firstname = [];
  var middlename = [];
  var position = [];
  var email = [];
  var contact = [];
  var gender = [];
  var birthdate =[];
 
 
  

  $('.surname').each(function(){
   surname.push($(this).text());
  });

  $('.firstname').each(function(){
   firstname.push($(this).text());
  });

  $('.middlename').each(function(){
   middlename.push($(this).text());     
  });

  $('.position').each(function(){
   position.push($(this).text());
  });

  $('.email').each(function(){
   email.push($(this).text());
  });

  $('.contact').each(function(){
   contact.push($(this).text());
  });

  $('.gender').each(function(){
    gender.push($(this).text());
  });

  $('.birthdate').each(function(){
    birthdate.push($(this).text());
  });


  $.ajax({
   url:"includes/import.php",
   method:"post",
   data:{surname:surname,firstname:firstname,middlename:middlename,position:position,email:email,contact:contact,gender:gender,birthdate:birthdate},
   success:function(data)
   {
    $('#csv_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
 
   }
  });
 });
});

</script>
<br>
<?php
include('includes/footer.php');
?>
