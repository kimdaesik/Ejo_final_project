<?php
session_start();

include "../common_lib/common.php";
$id=$_SESSION['id'];
$num=$_GET['num'];

$sql="select * from reserve where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

$money=$row['money'];
$room_type=$row['room_type'];
$start_day=$row['reserve_start'];

$sql="delete from reserve where id='$id' and num='$num'";
$result1=mysqli_query($con, $sql);

$sql="delete from sales where id='$id' and place='$room_type' and regist_day='$start_day'";
$result1=mysqli_query($con, $sql);

$sql="update membership set used_money=used_money-'$money' where id='$id'";
$result1=mysqli_query($con, $sql);


$sql="update membership set level='normal' where id='$id' and used_money<50000000";
$result1=mysqli_query($con, $sql);

if($result){
    echo " <script>
    alert('취소가 완료되었습니다.');
    location.href='./my_reserve.php';
    </script>";    
}else{
    echo " <script>
    alert('취소가 되지 않았습니다.');
    location.href='./my_reserve.php';
    </script>";
}

?>