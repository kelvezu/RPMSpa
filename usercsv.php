<?php

include 'sampleheader.php';
?>

<!DOCTYPE html>
<html>

<body>

    <div class="container">
        <?php
        if (isset($_GET['notif'])) :
            if (($_GET['notif']) == "success") :
                echo '<div class="green-notif-border">Users has been added successfully!</div>';
            elseif (($_GET['notif']) == "error") :
                echo '<div class="red-notif-border">There was an error adding the users!</div>';
            elseif(($_GET['notif'] == "emailerror")):
                echo '<div class="red-notif-border">Duplicate Email Detected!</div>';
                elseif(($_GET['notif'] == "mailerror")):
                    echo '<div class="red-notif-border">Error Sending Verification Email!</div>';
            else :
                echo 'Error!';
            endif;
        endif;

        //   if(isset($_SESSION['dup_email'])):
        //    foreach($_SESSION['dup_email'] as $dup_email){
        //      echo $dup_email;
        //    }
        //   endif;
        ?>
        <br />
        <h3 align="center">Enter CSV Account Information</h3>
        <hr />

        <div class="card-body">
            <p><strong>Directions:</strong></p>
            <ol type="i">
                <strong>
                    <li>Download CSV file format. Click <a href="download.php?file=usercsv.csv">here</a>.</u></li>
                    <li>If user doesnt have position yet, place <u class="text-danger">N/A.</u></li>
                    <li>The date format must be numeric and must follow the ISO date format: <u class="text-danger">YYYY/MM/DD.</u> </li>
                    <li><u class="text-danger">Email address </u>and <u class="text-danger">Contact Number</u> must be filled up. This will serve as the main part for account retrieval.</li>
                    <li>Excel file must be <u class="text-danger">save as CSV.</u> </li>
                    <li>Position must be <u class="text-danger">Master Teacher IV</u> and <u class="text-danger">Teacher I-III only</u>.</li>

                </strong>
            </ol>


        </div>
    </div>



    <!-- CSV file upload form -->
    <div class="container my-5">
        <div id="buttondiv">
            <input type="file" name="file" id="inputfile" class="btn btn-light btn-sm" />
            <input type="submit" class="btn btn-primary" value="IMPORT" id="viewfile">
        </div>
    </div>


    <div class="container d-flex my-2" id="container">
        <form action="includes/import.php" method="post">
            <input type="hidden" name="adder_name" value="<?php echo $_SESSION['fullname']; ?>" />
            <input type="hidden" name="adder_id" value="<?php echo intval($_SESSION['user_id']); ?>" />
            <input type="hidden" name="adder_position" value="<?php echo $_SESSION['position']; ?>" />
            <input type="hidden" name="sy_id" value="<?php echo $_SESSION['active_sy_id']; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

            <div id="tablemain">

            </div>



            <input type="submit" id="upload_btn" name="upload" value="Upload" />
        </form>
    </div>



    <script>
        document.getElementById('upload_btn').style.display = "none";

        /* function for duplicate array  */
        const isDuplicate = (arr) =>{
         if(!arr.filter(i=>arr.filter(inner => inner === i).length > 1)){
             return false;
         };
        }


        // --------------------------------------------
        $(document).ready(function() {
            $('#viewfile').click(function() {
                let rdr = new FileReader();
                //check if file is CSV
                if (inputfile.value.toLowerCase().lastIndexOf(".csv") == -1) {
                    alert("Please upload only .csv extention file");
                    inputfile.focus();
                    return false;
                }
                rdr.onload = function(e) {
                    //get the rows into an array
                    let therows = e.target.result.split("\n");
                    //loop through the rows
                    let isError = false;
                    let newrow = "";
                    newrow += ` <table class="table table-sm d table-borderless table-striped table-hover table-responsive-sm">
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
                                <tbody>`;

                    for (let row = 1; row < therows.length; row++) {
                        //build a new table row

                        //get the columns into an array
                        let columns = therows[row].split(",");
                        //get number of columns
                        let colcount = columns.length;

                        //console.log(columns)
                        // THIS CONDITION WILL REMOVE THE NULL ROWS



                        // if(columns[0] && columns[1] && columns[2] && columns[3] && columns[4] && columns[5] && columns[6] && columns[7] && columns[8])                   
                        // newrow = "<tr><td>"+ columns[0] + "</td><td>" + columns[1] + "</td><td>"+ columns[2] + "</td><td>"+ columns[3] + "</td><td>"+ columns[4] + "</td><td>"+ columns[5] + "</td><td>" + columns[6] + "</td><td>"+ columns[7] + "</td><td>"+ columns[8] + "</td>";



                        if (columns.length == 9) {

                            /*------------------Validation for PRC ID---------------------------*/
                            if (columns[0]) {
                                // THIS FUNCTION WILL DETECT IF THERE ARE LETTERS IN PRC ID
                                if (!columns[0].match(/^[0-9]+$/)) {
                                    columns[0] = "<p class='text-danger'>PRC id must be numbers</p>";
                                    isError = true;
                                }
                                //     THIS FUNCTION WILL DETECT IF THERE ARE DUPLICATES IN PRC
                                if (columns[0].isDuplicate) {
                                    console.log('there is duplicate ' + columns[0]);
                                    columns[0] = '<p class="text-danger">Duplicate PRC detected!</p>';
                                    isError = true;
                                }
                            } else {
                                columns[0] = "<p class='text-danger'>PRC id is required</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/


                            /*------------------Validation for Surname---------------------------*/
                            if (columns[1]) {
                                toString(columns[1]);
                                 // THIS WILL DETECT IF SURNAME IS LESS THAN 2 
                                 if (columns[1].length < 2) {
                                    columns[1] = "<p class='text-danger'>Surname must be 2 or more letters</p>";
                                    isError = true;
                                }
                                // THIS CONDITION WILL DETECT IF THERE ARE SPECIAL CHARS IN SURNAME
                                else if (!columns[1].match(/^[A-Za-z]+$/)) {
                                    columns[1] = "<p class='text-danger'>Surname must consist of Letters</p>";
                                    isError = true;
                                }
                               

                            } else {
                                columns[1] = "<p class='text-danger'>Surname is required</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/


                            /*------------------Validation for Firstname---------------------------*/
                            if (columns[2]) {
                                // THIS CONDITION WILL DETECT IF THERE ARE SPECIAL CHARS IN FIRSTNAME
                                if (!columns[2].match(/^[A-Za-z ]+$/)) {
                                    columns[2] = "<p class='text-danger'>Firstname must consist of Letters</p>";
                                    isError = true;
                                }
                                // THIS WILL DETECT IF FIRSTNAME IS LESS THAN 2     
                                if (columns[2].length < 2) {
                                    columns[2] = "<p class='text-danger'>Firstname must be 2 or more letters</p>";
                                    isError = true;
                                }

                            } else {
                                columns[2] = "<p class='text-danger'>Firstname is required</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/

                            /*------------------Validation for Middlename---------------------------*/
                            if (columns[3]) {
                                // THIS CONDITION WILL DETECT IF THERE ARE SPECIAL CHARS IN MIDDLENAME
                                if (!columns[3].match(/^[A-Za-z ]+$/)) {
                                    columns[3] = "<p class='text-danger'>Middlename must consist of Letters</p>";
                                    isError = true;
                                }
                                // THIS WILL DETECT IF MIDDLENAME IS LESS THAN 2 
                                if (columns[3].length < 3) {
                                    columns[3] = "<p class='text-danger'>Middlename must be 3 or more letters</p>";
                                    isError = true;
                                }

                            } else {
                                columns[3] = "<p class='text-danger'>Middlename is required</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/

                            /*------------------Validation for Position---------------------------*/
                            if (columns[4]) {
                                // THIS CONDITION WILL DETECT IF THERE ARE SPECIAL CHARS IN POSITION
                                if (!columns[4].match(/^[A-Za-z ]+$/)) {
                                    columns[4] = "<p class='text-danger'>Position must consist of Letters</p>";
                                    isError = true;
                                }
                                // THIS CONDITION WILL CHECK IF THE POSITION IS LESS THAN 4
                                if (columns[4].length < 4) {
                                    columns[4] = "<p class='text-danger'>Position undefined</p>";
                                    isError = true;
                                }
                                // THIS POSITION WILL CHECKED IF POSITIONS ARE VALID 
                                if (columns[4] == 'Master Teacher IV' || columns[4] == 'Master Teacher III' || columns[4] == 'Master Teacher II' || columns[4] == 'Master Teacher I' || columns[4] == 'Teacher III' || columns[4] == 'Teacher II' || columns[4] == 'Teacher I' || columns[4] == 'School Head') {
                                    true;
                                } else {
                                    columns[4] = "<p class='text-danger'>Invalid Position</p>";
                                    isError = true;
                                }
                            } else {
                                columns[4] = "<p class='text-danger'>Position is required</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/

                            /*------------------Validation for Email---------------------------*/
                            if (columns[5]) {
                                //    THIS CONDITION WILL CHECK THE FORMAT OF EMAIL
                                const mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                if (!columns[5].match(mailFormat)) {
                                    columns[5] = "<p class='text-danger'>Invalid Email</p>";
                                    isError = true;
                                }
                                //    THIS CONDITION WILL CHECK IF THERE ARE DUPLICATE EMAIL
                                if (find(columns[5])) {
                                    console.log('there is duplicate ' + columns[5]);
                                    columns[5] = "<p class='text-danger'>Duplicate Email detected!</p>";
                                    isError = true;
                                }
                            } else {
                                columns[5] = "<p class='text-danger'>Email is required.</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/

                            /*------------------Validation for Contact---------------------------*/

                            if (columns[6]) {
                                // THIS WILL CHECK THE FORMAT OF CONTACT
                                if (!columns[6].match(/^[0-9]+$/)) {
                                    columns[6] = "<p class='text-danger'>Contact must be digits</p>";
                                    isError = true;
                                }
                                // THIS CONDITION WILL CHECK IF THE CONTACT LENGTH IS CORRECT
                                if (columns[6].length == 10) {
                                    columns[6] = `+63${columns[6]}`;
                                } else {
                                    columns[6] = "<p class='text-danger'>Invalid Contact Number</p>";
                                    isError = true;
                                }
                                // THIS CONDITION WILL CHECK IF THERE IS DUPLICATE
                                if (find(columns[6])) {
                                    console.log('there is duplicate ' + columns[6]);
                                    columns[6] = "<p class='text-danger'>Duplicate Contact detected!</p>";
                                    isError = true;
                                }


                            } else {
                                columns[6] = "<p class='text-danger'>Contact number is required.</p>";
                                isError = true;
                            }
                            /* ----------------------------------------------------------------------------*/

                            // Validation for Gender 

                            if (columns[7]) {
                                // THIS WILL CHECK IF GENDER IS VALID
                                if ((columns[7] == "Male") || (columns[7] == "Female")) {
                                    true
                                } else {
                                    columns[7] = "<p class='text-danger'>N/A</p>";
                                    isError = true;
                                }

                            } else {
                                columns[7] = "<p class='text-danger'>Gender is required</p>";
                                isError = true;
                            }


                            newrow += `
                              
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
                               
                                `;

                        } else {
                            console.log("Error");
                        }



                        //




                    }
                    newrow += `</tr></tbody></table>`;
                    $('#tablemain').append(newrow);
                    console.log('Error is ' + isError);
                    if (!isError) {
                        document.getElementById('upload_btn').style.display = "block";
                    }








                }
                rdr.readAsText($("#inputfile")[0].files[0]);

            });
        });
    </script>




    <?php

    include 'samplefooter.php';
    ?>