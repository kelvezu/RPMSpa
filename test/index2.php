<?php
// Load the database configuration file
include_once 'conn.php';


?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
  .notnumeric {
              background-color: yellow;
            }


</style>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">

    <!-- CSV file upload form -->
<div id="buttondiv">
        
            <input type="file" name="file" id="inputfile"/>
            <input type="submit" class="btn btn-primary" value="IMPORT" id="viewfile">
   
</div>

<div class="container mx-2" id="container">
    <form action="importData.php" method="post">

    
    <table class="table table-sm table-bordered" id="tablemain" >
        <thead>
            <tr class="tableheader">
                <th>Prc ID</th>
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

        </tbody>
    </table>
    <input type="submit" name="upload" value="Upload">
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>


// --------------------------------------------
    $(document).ready(function(){
        $('#viewfile').click(function() {
            var rdr = new FileReader();
            //check if file is CSV
            if(inputfile.value.toLowerCase().lastIndexOf(".csv")==-1) 
                {
                    alert("Please upload only .csv extention file");
                    inputfile.focus(); 
                    return false;
                }
            rdr.onload = function(e) {
                 //get the rows into an array
                 var therows = e.target.result.split("\n");
                    //loop through the rows
                    for (var row = 1; row < therows.length; row++  ) {
                        //build a new table row
                        var newrow = "";   
                        //get the columns into an array
                        var columns = therows[row].split(",");
                        //get number of columns
                        var colcount  = columns.length;

                      console.log(columns)
                        // THIS CONDITION WILL REMOVE THE NULL ROWS
                        if(columns[0]){


                        }

                        
                        // if(columns[0] && columns[1] && columns[2] && columns[3] && columns[4] && columns[5] && columns[6] && columns[7] && columns[8])                   
                            //newrow = "<tr><td>"+ columns[0] + "</td><td>" + columns[1] + "</td><td>"+ columns[2] + "</td><td>"+ columns[3] + "</td><td>"+ columns[4] + "</td><td>"+ columns[5] + "</td><td>" + columns[6] + "</td><td>"+ columns[7] + "</td><td>"+ columns[8] + "</td>";

                 
                           if(columns.length == 9){

                            //    Validation for PRC ID
                               if(columns[0]){
                                    if(!columns[0].match(/^[0-9]+$/)){columns[0] = "PRC id must be numbers";}
                               }
                               else{
                                   columns[0] ="PRC id is required";                              
                               }
                           
                               
                            //    Validation for Surname
                            if(columns[1]){
                                    if(!columns[1].match(/^[A-Za-z ]+$/)){columns[1] = "Surname must consist of Letters";}
                                    if(columns[1].length < 2){columns[1] = "Surname must be 2 or more letters";}
                                    
                               }else{
                                   columns[1] ="Surname is required";
                               }

                            //    Validation for Firstname
                            if(columns[2]){
                                    if(!columns[2].match(/^[A-Za-z ]+$/)){columns[2] = "Firstname must consist of Letters";}
                                    if(columns[2].length < 2){columns[2] = "Firstname must be 2 or more letters";}
                                    
                               }else{
                                   columns[2] ="Firstname is required";
                               }

                               //    Validation for Middlename
                            if(columns[3]){
                                    if(!columns[3].match(/^[A-Za-z ]+$/)){columns[3] = "Middlename must consist of Letters";}
                                    if(columns[3].length < 3){columns[3] = "Middlename must be 3 or more letters";}
                                    
                               }else{
                                   columns[3] ="Middlename is required";
                               }

                               //    Validation for Position
                            if(columns[4]){
                                    if(!columns[4].match(/^[A-Za-z ]+$/)){columns[4] = "Position must consist of Letters";}
                                    if(columns[4].length < 4){columns[4] = "Position must be 4 or more letters";}
                                    if(columns[4] =='Master Teacher IV' || columns[4] =='Master Teacher III' || columns[4] =='Master Teacher II' || columns[4] =='Master Teacher I' || columns[4] =='Teacher III' || columns[4] =='Teacher II' || columns[4] =='Teacher I' || columns[4] =='School Head'){
                                        true
                                    }else{
                                        columns[4] = "N/A";
                                    }
                               }else{
                                   columns[4] ="Position is required";  
                               }

                            //  Validation for Email 
                               if(columns[5]){
                                   let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                   if(!columns[5].match(mailFormat)){
                                    columns[5] = "Invalid Email";
                                   }
                               }else{
                                   columns[5] = "Email is required."    
                               }

                            //    Validation for Contact

                            if(columns[6]){
                                if(columns[6].match(/^[0-9]+$/)){
                                    // If contact is correct
                                    if(columns[6].length == 10){ 
                                        columns[6] = `+63${columns[6]}`
                                        }
                                        else{ columns[6] = "Invalid Contact Number"}
                                }else{
                                    columns[6] = "Contact must be digits";
                                }
     
                               }else{
                                   columns[6] = "Contact number is required."
                                }

                                // Validation for Gender 

                                if(columns[7]){
                                    if(columns[7] == "Male" || columns[7] == "Female"  ){
                                        true;
                                    }else{
                                        columns[7] = "N/A";
                                    }

                                }else{
                                    columns[7] = "Gender is required";
                                }

                        
                               newrow=`
                                <tr>
                                    <td><input type="hidden" name="prc_id[]" value="${columns[0]}"/>${columns[0]}</td>
                                    <td><input type="hidden" name="surname[]" value="${columns[1]}"/>${columns[1]}</td>
                                    <td><input type="hidden" name="firstname[]" value="${columns[2]}"/>${columns[2]}</td>
                                    <td><input type="hidden" name="middlename[]" value="${columns[3]}"/>${columns[3]}</td>
                                    <td><input type="hidden" name="position[]" value="${columns[4]}"/>${columns[4]}</td>
                                    <td><input type="hidden" name="email[]" value="${columns[5]}"/>${columns[5]}</td>
                                    <td><input type="hidden" name="contact[]" value="${columns[6]}"/>${columns[6]}</td>
                                    <td><input type="hidden" name="gender[]" value="${columns[7]}"/>${columns[7]}</td>
                                    <td><input type="hidden" name="bday[]" value="${columns[8]}"/>${columns[8]}</td>
                                </tr>`;
                           }
                           else{
                               
                            console.log(columns);
                           
                           }
                              
                            
                      
                        //
                        
                        
            $('#tablemain').append(newrow);
                        
            }
          
            }
            rdr.readAsText($("#inputfile")[0].files[0]);
            
        });
    });

</script>

