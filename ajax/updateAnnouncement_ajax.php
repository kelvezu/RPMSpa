<?php if (isset($_GET['ann_id'])) :
    $ann_id = $_GET['ann_id'];
    $qry = "SELECT * FROM announcement_tbl WHERE id= $ann_id";
    $results = mysqli_query($conn, $qry);
    $result_arr = [];
    foreach ($results as $res) :
        array_push($result_arr, $res);
    endforeach;
    echo json_encode($result_arr);
endif;
