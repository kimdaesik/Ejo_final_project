<?php
session_start();
include "../../common_lib/common.php";

$num=$_GET['num'];
$page=$_GET['page'];

$sql="delete from event where num=$num";
$result = mysqli_query($con,$sql);
if(!$result){
    echo "오류원인 : ".mysqli_error($con);
}
mysqli_close($con);


echo "<script>
    location.href='../admin.php?mode=admin_event_edit&mode=admin_event_edit&page=$page';
  </script>";
?>





