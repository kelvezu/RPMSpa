<?php
session_start();

if (!empty($_FILES['csv_file']['name'])) {
    $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
    $column = fgetcsv($file_data);
    if (count($column) >= 8)
        while ($row = fgetcsv($file_data)) {
            $row_data[] = array(
                'prcid'  => $row[0],
                'surname'  => $row[1],
                'firstname'  => $row[2],
                'middlename'  => $row[3],
                'position' => $row[4],
                'email'  => $row[5],
                'contact'  => $row[6],
                'gender' => $row[7],
                'birthdate' => $row[8]
            );
        }
    $output = array(
        'column'  => $column,
        'row_data'  => $row_data
    );

    echo json_encode($output);
}
