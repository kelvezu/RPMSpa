<?php
session_start();

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 $column = fgetcsv($file_data);
 if(count($column) >= 8)
 while($row = fgetcsv($file_data))
 {
  $row_data[] = array(
   'surname'  => $row[0],
   'firstname'  => $row[1],
   'middlename'  => $row[2],
   'position' => $row[3],
   'email'  => $row[4],
   'contact'  => $row[5],
   'gender' => $row[6],
   'birthdate' => $row[7]
  );
 }
 $output = array(
  'column'  => $column,
  'row_data'  => $row_data
 );

 echo json_encode($output);

}



?>