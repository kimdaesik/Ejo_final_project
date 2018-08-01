<?php

session_start();
include '../common_lib/common.php';

$id=$_SESSION['id'];
$old_pass=$_POST['old_pass'];

$pw1=$_POST['pass1'];
$pw2=$_POST['pass2'];


$sql="select * from membership where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

if($old_pass!==$row['password']){
    echo "<script>alert('기존 비밀번호가 다릅니다.') 
        history.go(-1);
        </script>";
}else{
    if($pw1!==$pw2){
        echo "<script>alert('비밀번호가 일치하지 않습니다.')
        history.go(-1);
        </script>";
        exit();
    }else{
        $pw=$_POST['pass1'];
        $sql="update membership set password='$pw' where id='$id'";
        mysqli_query($con, $sql);
        
        echo "<script>alert('비밀번호 변경이 완료되었습니다.')
        window.close();
        </script>";
        mysqli_close($con);
     }    
}

?>