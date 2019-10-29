<?php
include 'includes/conn.inc.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>



<style>
  .box {
    max-width: 600px;
    width: 100%;
    margin: 0 auto;
    ;
  }
</style>

<body>
  <script src="js/jquery.min.js"></script>
  <script src='css/bootstrap3.min.js'></script>
  <div class="container">
    <br />
    <h3 align="center">Enter CSV Account Information</h3>
    <hr />
    <div class="card col-md-6 m-4 p-5">
      <div class="card-body">
        <p><strong>Directions:</strong></p>
        <ol type="i">
          <strong>
            <li>If user doesnt have position yet, place <u class="text-danger">N/A.</u></li>
            <li>The date format must be numeric and must follow the ISO date format: <u class="text-danger">YYYY/MM/DD.</u> </li>
            <li><u class="text-danger">Email address </u>and <u class="text-danger">Contact Number</u> must be filled up. This will serve as the main part for account retrieval.</li>
            <li>Excel file must be <u class="text-danger">save as CSV.</u> </li>
            <li>Position must be <u class="text-danger">Master Teacher IV</u> and <u class="text-danger">Teacher I-III only</u>.</li>
          </strong>
        </ol>


      </div>
    </div>





    <div>
      <form id="upload_csv" method="post" enctype="multipart/form-data">
        <input type="hidden" name="adder_name" value="<?php $_SESSION['fullname']; ?>" />
        <input type="hidden" name="adder_id" value="<?php $_SESSION['user_id']; ?>" />
        <input type="hidden" name="adder_position" value="<?php $_SESSION['position']; ?>" />
        <input type="hidden" name="sy_id" value="<?php $_SESSION['active_sy_id']; ?>" />
        <input type="hidden" name="school_id" value="<?php $_SESSION['school_id']; ?>" />
        <div class="col-md-3">
          <br />
          <?php

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
    </div>

    <br />
    <br />
    <div id="csv_file_data"></div>

  </div>
</body>

</html>

<script>
  $(document).ready(function() {
    $('#upload_csv').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: "includes/fetch.php",
        method: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          var html = '<table class="table table-striped table-bordered table-sm">';






          if (data.column) {
            html += '<tr>';
            for (var count = 0; count < data.column.length; count++) {
              html += '<th>' + data.column[count] + '</th>';
            }
            html += '</tr>';
          }



          if (data.row_data) {
            for (var count = 0; count < data.row_data.length; count++) {
              html += '<tr>';
              html += '<td class="prcid" contenteditable>' + data.row_data[count].prcid + '</td>';
              html += '<td class="surname" contenteditable>' + data.row_data[count].surname + '</td>';
              html += '<td class="firstname" contenteditable>' + data.row_data[count].firstname + '</td>';
              html += '<td class="middlename" contenteditable>' + data.row_data[count].middlename + '</td>';
              html += '<td class="position" contenteditable>' + data.row_data[count].position + '</td>';
              html += '<td class="email" contenteditable>' + data.row_data[count].email + '</td>';
              html += '<td class="contact" contenteditable>' + data.row_data[count].contact + '</td>';
              html += '<td class="gender" contenteditable>' + data.row_data[count].gender + '</td>';
              html += '<td class="birthdate" contenteditable>' + data.row_data[count].birthdate + '</td></tr>';
            }
          }
          html += '<table>';
          html += '<div align="center"><button type="submit" id="import_data" class="btn btn-success">Import Data</button></div>';

          $('#csv_file_data').html(html);
          $('#upload_csv')[0].reset();


        }
      })
    });

    $(document).on('click', '#import_data', function() {
      var prcid = [];
      var surname = [];
      var firstname = [];
      var middlename = [];
      var position = [];
      var email = [];
      var contact = [];
      var gender = [];
      var birthdate = [];


      $('.prcid').each(function() {
        prcid.push($(this).text());
      });

      $('.surname').each(function() {
        surname.push($(this).text());
      });

      $('.firstname').each(function() {
        firstname.push($(this).text());
      });

      $('.middlename').each(function() {
        middlename.push($(this).text());
      });

      $('.position').each(function() {
        position.push($(this).text());
      });

      $('.email').each(function() {
        email.push($(this).text());
      });

      $('.contact').each(function() {
        contact.push($(this).text());
      });

      $('.gender').each(function() {
        gender.push($(this).text());
      });

      $('.birthdate').each(function() {
        birthdate.push($(this).text());
      });


      $.ajax({
        url: "includes/import.php",
        method: "post",
        data: {
          prcid: prcid,
          surname: surname,
          firstname: firstname,
          middlename: middlename,
          position: position,
          email: email,
          contact: contact,
          gender: gender,
          birthdate: birthdate
        },
        success: function(data) {
          $('#csv_file_data').html('<div class="alert alert-success"><strong> Data Imported Successfully</strong></div>');

        }
      });
    });
  });
</script>
<br>
<?php
include('includes/footer.php');
?>