
<?php

include 'includes/conn.inc.php';

if(isset($_POST['telno2']) && isset($_POST['telno'])):
    $telno = $_POST['telno'];
    $telno2 = $_POST['telno2'];
    $query = $conn->query("SELECT * FROM school_tbl WHERE tel_no = '$telno2' OR tel_no2 = '$telno2' OR tel_no = '$telno' OR tel_no2 = '$telno'");

    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Telephone Number is taken.</div>";
    elseif($telno === $telno2):
         echo "<div class='tomato-color'>Duplicate Number.</div>";
    elseif((strlen($telno2)) < 8):
        echo "<div class='tomato-color'>Telephone Number should be contain 8 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;

endif;

?>