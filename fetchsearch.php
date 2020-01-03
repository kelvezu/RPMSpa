
<?php
//fetch.php


$conn = mysqli_connect("localhost", "root", "", "rpms");


$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM account_tbl a left join school_tbl b on a.school_id = b.school_id
  WHERE a.firstname LIKE '%".$search."%' or a.middlename LIKE '%".$search."%' or a.surname LIKE '%".$search."%'
  or a.position LIKE '%".$search."%'
  
 ";
}
else
{
 $query = "
  SELECT *,b.school_name FROM account_tbl a left join school_tbl b on a.school_id = b.school_id ORDER BY a.user_id
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '

 <table class="table table-bordered hover table-sm">

            <thead class="thead-dark text-center">
                <tr>
                    <th>Fullname</th>
                    <th>Position</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>School</th>
                    <th>Username</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
 ';

 
 while($row = mysqli_fetch_array($result))

 {
  $output .= '
   <tr>
    <td>'.$row['firstname'].' ' .$row['middlename']. ' ' .$row['surname']. '</td>
    <td>'.$row["position"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$row["contact"].'</td>
    <td>'.$row["school_name"].'</td>
    <td>'.$row["username"].'</td>
    <td><a href="update/updateusers.php?edit=' . $row["user_id"].'" class="btn-sm btn-outline-primary btn-block text-center text-decoration-none">Update</a></td>
    <td><a href="delete/deleteusers.php?delete='.  $row["user_id"].'" class="btn-sm btn-outline-danger btn-block text-center text-decoration-none">Delete</a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>