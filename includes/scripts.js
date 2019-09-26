function confirmDelete()
{
  var msg = confirm('Are you sure you want to delete this record?');
  if(msg === true){
    window.location.href = "includes/processusers.php";
  }else{
   window.close();
  }
}