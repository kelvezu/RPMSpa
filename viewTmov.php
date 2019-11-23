<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';
$num = 1;
 $t_attach = RPMSdb::fetch_B_T_MOV_ATT($conn,$_SESSION['user_id'],$_SESSION['school_id'],$_SESSION['active_sy_id']);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-sm table-responsive-sm">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
</div>
<?php include 'samplefooter.php'; ?>
