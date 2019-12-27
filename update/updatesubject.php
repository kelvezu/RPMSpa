    <?php
    include 'includes.php';


    if (isset($_GET['edit'])) {
        $subject_id = $_GET['edit'];
        $query = mysqli_query($conn, "SELECT * FROM subject_tbl WHERE subject_id=$subject_id");
        $record = mysqli_fetch_array($query);
        $subject_name = $record['subject_name'];
    }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <br><br>
    <link rel="stylesheet" href="../css/bootstrap4.css">
    <div class="container " style="margin:1%;">
        <div class="breadcome-list  shadow-reset">

            <div class="h4 breadcrumb bg-dark text-white ">Update Subject Option</div>
            <form method="post" action="../includes/processESAT.php">
                <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>" />

                <div class="form-group ">
                    <label for="username">Subject Option</label>
                    <input type="text" class="form-control" id="subj" name="subject_name" value="<?php echo $subject_name;  ?>" required pattern="[A-Za-z ]{4,}" title="Input four or more characters and input should not include numbers and special characters" />
                    <div id="errorNo"></div>
                </div>

                <div class="form-row">
                    <button type="submit" name="updateSUB" class="btn btn-primary btn-block">Update</button>
                    <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
                </div>

        </div>
    </div>

    
    <br>
    </form>

    <script>

$(document).ready(function() {
        $('#subj').on('change', function() {
            var subj = $(this).val(); 
            if (subj) {
                $.ajax({
                    type: 'POST',
                    url: 'validateesat.php',
                    data: 'subj=' + subj,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });
</script>
    <?php

    include '../includes/footer.php';
    ?>