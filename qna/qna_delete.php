<?php
include "../common_lib/common.php";

if(!empty($_GET['num'])){
    $num = $_GET['num'];
}

$sql = "select * from qna where num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$depth1 = strlen($row['depth']);
$group_num = $row['group_num'];
$ord1 = $row['ord'];

if($depth1==1){
    
    $sql = "delete from qna where group_num= $group_num";
    mysqli_query($con, $sql) or die("실패원인 : " . mysqli_error_list($con));
    
}else{
    $sql = "select depth, ord from qna where group_num= $group_num and ord > $ord1 order by ord";
    $result = mysqli_query($con, $sql) or die("실패원인1 : " . mysqli_error_list($con));
    $total_record = mysqli_num_rows($result);
    if($total_record==0){
        $sql = "delete from qna where ord= $ord1";
        mysqli_query($con, $sql) or die("실패원인2 : " . mysqli_error_list($con));
    }else{
        for ($i = 0; $i <= $total_record; $i++) {
            $row = mysqli_fetch_array($result);
            if (strlen($row['depth']) <= $depth1) {
                $sql = "delete from qna where group_num = $group_num and ord=$ord1";
                mysqli_query($con, $sql) or die("실패원인3 : " . mysqli_error_list($con));
                break;
            }
            $sql = "delete from qna where ord = {$row['ord']}";
            mysqli_query($con, $sql) or die("실패원인4 : " . mysqli_error_list($con));
        }
    }
}
mysqli_close($con);


echo "
      <script>
       location.href = './qna_list.php';
      </script>
   ";

?>