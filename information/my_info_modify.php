<?php 
session_start();

include '../common_lib/common.php';

$id=$_SESSION['id'];


$name=$_POST['name'];
$birth= $year."-".$month."-".$day;
$address= $_POST['address1']."+".$_POST['address2'];
$email=$_POST['email1']."@".$_POST['email2'];
$phone1=$_POST['hp1'];
$phone2=$_POST['hp2'];
$phone3=$_POST['hp3'];
$gender= $_POST['gender'];
$zip= $_POST['zip'];


$sql="update membership set name='$name' , phone1='$phone1' , phone2='$phone2' , phone3='$phone3' ,zip='$zip' ,gender='$gender' , address='$address' , email='$email' where id='$id'";

mysqli_query($con, $sql);
mysqli_close($con);

echo "<script>alert('$name 님의 정보가 변경되었습니다.')</script>";
echo "<script>location.href='information.php'</script>";

?>