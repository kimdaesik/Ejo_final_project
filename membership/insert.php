<meta charset=utf-8>
<?php

include '../common_lib/common.php';    

// 아이디
$id= $_POST['id'];
// 암호
$pass= $_POST['pass'];
// 이름
$name= $_POST['name'];
// 생년월일
$year= $_POST['year'];
$month= $_POST['month'];
$day= $_POST['day'];

// 성별
$gender= $_POST['gender'];
// 우편번호
$zip= $_POST['zip'];
// 주소
$address= $_POST['address1']."+".$_POST['address2'];
// 연락처
$hp1= $_POST['hp1'];
$hp2= $_POST['hp2'];
$hp3= $_POST['hp3'];
// 이메일
$email=$_POST['email1']."@".$_POST['email2'];
// 문자수신
if(isset($_POST['sms_ok'])){
    $sms_ok= $_POST['sms_ok'];
}else{
    $sms_ok="";
}


$sql= "select * from membership where id='$id'";

$result= mysqli_query($con, $sql);

$exist_id=mysqli_num_rows($result);


if($exist_id){
    echo "<script> window.alert('해당 아이디가 존재합니다.'); history.go(-1); </script>";
    exit();
}else{
    $sql= "insert into membership (id, password, name, phone1, phone2, phone3, zip,gender, address, birth_year, birth_month, birth_day,email,used_money,level) ";
    $sql.= "values ('$id', '$pass', '$name','$hp1','$hp2','$hp3','$zip','$gender', '$address', '$year','$month','$day', '$email','0','normal')";
    

    mysqli_query($con, $sql) or die(mysqli_error($con));
}

mysqli_close($con);

echo "<script>alert('회원가입이 완료되었습니다.')</script>";
echo "<script> location.href='../index.php'; </script>";

?>