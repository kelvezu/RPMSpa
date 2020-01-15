<?php

use IPCRF\IPCRF;

// include 'sampleheader.php';
session_start();
include 'classes/ipcrf/ipcrf.class.php';
include 'includes/conn.inc.php';
$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$school = $_SESSION['school_id'];
$position = $_SESSION['position'];
$ipcrf = new IPCRF($user, $sy, $school, $position);



if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $qry = "SELECT *
    FROM account_tbl
    WHERE surname LIKE '$name%' ORDER BY surname";
    $account_tbl = mysqli_query($conn, $qry);
} else {
    $account_tbl = $ipcrf->api_account_tbl();
}

// else {
//    
//}



?>
<?php
$count_sql = mysqli_num_rows($account_tbl);
if ($count_sql === 0) : ?>
    <p>No Result!</p>
<?php else : ?>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <td>
                        <p>id</p>
                    </td>

                    <td>
                        <p>Surname</p>
                    </td>

                    <td>
                        <p>Firstname</p>
                    </td>

                    <td>
                        <p>Middlename</p>
                    </td>

                    <td>
                        <p>Email Address</p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($account_tbl as $acc) : ?>
                    <tr>
                        <td>
                            <p>
                                <?= $acc['user_id']; ?>
                            </p>
                        </td>

                        <td>
                            <p>
                                <?= $acc['surname']; ?>
                            </p>
                        </td>

                        <td>
                            <p>
                                <?= $acc['firstname']; ?>
                            </p>
                        </td>

                        <td>
                            <p>
                                <?= $acc['middlename']; ?>
                            </p>
                        </td>

                        <td>
                            <p>
                                <?= $acc['email']; ?>
                            </p>
                        </td>

                    <?php endforeach; ?>
                    </tr>
            </tbody>

        </table>
    </div>
<?php endif; ?>


<script>
    const sampleID = document.getElementById("sample-id");
    console.log(sampleID.innerText = "tite");
</script>