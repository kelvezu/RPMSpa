<?php
// don't use intval if your select value is not numberic


include 'includes/conn.inc.php';

if (isset($_GET['period'])) :
    $period = $_GET['period'];
    if ($period == 1) :
        $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period1=1';
    elseif ($period == 2) :
        $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period2=1';
    elseif ($period == 3) :
        $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period3=1';
    elseif ($period == 4) :
        $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period4=1';
    else :
        echo 'invalid period!';
    endif;
else :
    $periodqry = 'SELECT * FROM mtindicator_tbl';
endif;

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultqry = $conn->query($periodqry)  or die($conn->error);

?>

<table class="table table-bordered" style="background-color: white; table-layout: 10;">
    <thead class="legend-control bg-info text-white ">
        <tr>
            <th>Indicator No</th>
            <th>Indicator Name</th>
            <th>COT Rating</th>
        </tr>
    </thead>

    <?php
    $indicator_no = 1;
    while ($row = $resultqry->fetch_assoc()) :
        ?>


        <input type="hidden" name="mtindicator_id[]" value="<?php echo $row['mtindicator_id']; ?>" />
        <input type="hidden" name="mtindicator_name[]" value="<?php echo $row['mtindicator_name']; ?>" />

        <tbody>
            <tr>
                <td><?php echo $row['mtindicator_id']; ?></td>
                <td><?php echo $row['mtindicator_name']; ?></td>
                <td>
                    <select name="mtrating[]" required="required" class="form-control-sm">
                        <option value="" disabled selected>--Select--</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                        <option value="3">6</option>
                        <option value="4">7</option>
                        <option value="5">8</option>
                        <option value="1">NO*</option>
                    </select>

                </td>


            <?php
                $indicator_no++;
            endwhile;
            ?>
        </tbody>
        </tr>
</table>