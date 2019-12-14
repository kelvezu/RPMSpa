<?php

use RPMSdb\RPMSdb;

include_once 'sampleheader.php';
$num = 1;
?>

<!-- <div class="container">
    <div class="card">
        <div class="card-header">
            <p>Master Teacher with MOV's</p>
        </div>
        <div class="card-body overflow-auto">
            <form action="viewattachment.ratermt.php" method="post">
                <input type="hidden" id="sy_id" name="sy_id" value="<?= $_SESSION['active_sy_id'] ?>">
                <input type="hidden" id="school_id" name="school_id" value="<?= $_SESSION['school_id'] ?>">
                <input type="hidden" id="rater_id" name="rater_id" value="<?= $_SESSION['user_id'] ?>">
                <select id="user_id" name="user_id">
                    <?php
                    foreach (rpmsdb::showBmovMTrater($conn, $_SESSION['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id'], 'For Approval') as $ratees) : ?>
                        <option value=" <?php echo intval($ratees['user_id']) ?>"><?php echo displayName($conn, $ratees['user_id']) ?> </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">View MOV</button>
            </form>
        </div>
    </div>
</div> -->
<!-- <div id="post_here">

    </div> -->
<script>
    // const fetchmov = document.getElementById('fetch-mov');
    // const user_id = document.getElementById('user_id').value;
    // const sy_id = document.getElementById('sy_id').value;
    // const school_id = document.getElementById('school_id').value;
    // const rater_id = document.getElementById('rater_id').value;


    // function showMOV() {

    //     if (window.XMLHttpRequest) {
    //         // code for IE7+, Firefox, Chrome, Opera, Safari
    //         xmlhttp = new XMLHttpRequest();
    //     }
    //     xmlhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             console.log(this.responseText);
    //             document.getElementById("post_here").innerHTML = this.responseText;
    //         }
    //     };


    //     xmlhttp.open("GET", `ajax/ratemov_ajax.php?user_id=${user_id}&sy_id=${sy_id}&school_id=${school_id}&rater_id= ${rater_id}`, true);
    //     xmlhttp.send();

    // }
</script>









<?php include_once 'samplefooter.php'; ?>