<?php
include '../common_lib/common.php';

$mode=$_POST["type"];
$pic= $_POST['pic'];

$sql = "select * from roominfo where type='$mode'";
$result = mysqli_query($con,$sql)or die("실패원인1:".mysqli_error($con));
$row = mysqli_fetch_array($result);
$picture1  = $row['picture0'];
$picture2  = $row['picture1'];
$picture3  = $row['picture2'];
$picture4  = $row['picture3'];

if($pic==1){
    echo "<img style='width :100%; height : 100%' src='$picture1'>";
}

if($pic==2){
    echo "<img style='width :100%; height : 100%' src='$picture2'></img>";
}
if($pic==3){
    echo "<img style='width :100%; height : 100%' src='$picture3'></img>";
}
if($pic==4){
    echo "<img style='width :100%; height : 100%' src='$picture4'></img>";
}


?>