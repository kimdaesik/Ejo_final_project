<?php

include "../common_lib/common.php";
session_start();

$id=$_SESSION['id'];

$sql="select * from reserve where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
$reserve_id=$row['id'];

if(empty($reserve_id)){
$sql="delete from membership where id='$id' ";
mysqli_query($con, $sql);
session_destroy();          // 세션삭제
echo"
    <script>
    alert('탈퇴가 완료되었습니다.');
    location.href='../index.php';
    </script>
";
}else if(!empty($reserve_id)){
    echo"
    <script>
    alert('예약건이 있어 탈퇴가 어렵습니다.');
    location.href='./information.php';
</script>
";
}


mysqli_close($con);
?>