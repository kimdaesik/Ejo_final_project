<?php

include '../../common_lib/common.php';

session_start();

$sql2="update event set choice='n'";
mysqli_query($con, $sql2) or die("n값으로 바꾸기 실패 :".mysqli_error($con));

if(isset($_POST['chk'])){
    $chk_count=count($_POST["chk"]);
    $chk_array=$_POST["chk"];
        for($i=0;$i<$chk_count;$i++){
            $index=$chk_array[$i];
            $select[$index]="y";
            $sql3="update event set choice='y' where num='$index'";
            mysqli_query($con, $sql3) or die("y값으로 바꾸기 실패 :".mysqli_error($con));
         }
    
}
    echo "<script>alert('이벤트 창을 변경하였습니다.')
            location.href='../../index.php';
            </script>";
    
?>