<?php
session_start();
include "../common_lib/common.php";


$num=$_GET['num'];
$table=$_GET["table"];
$page=$_GET['page'];



$sql="delete from $table where num=$num";
$result = mysqli_query($con,$sql);
if(!$result){
    echo "오류원인 : ".mysqli_error($con);
}
mysqli_close($con);


echo "<script>
    location.href='notice.php';
  </script>";
?>





