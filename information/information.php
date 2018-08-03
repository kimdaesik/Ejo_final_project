<?php
include '../common_lib/common.php';

session_start();

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
}

$sql="select * from membership where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

$birth=$row['birth_year']."-".$row['birth_month']."-".$row['birth_day'];
$phone=$row['phone1']."-".$row['phone2']."-".$row['phone3'];

$name=$row['name'];

$email=explode("@",$row['email']);
$email1=$email[0]; //$email[0] 을 $email1변수에 저장
$email2=$email[1]; //$email[1] 을 $email2변수에 저장

$address=explode("+",$row['address']);
$address1=$address[0]; //$address[0] 을 $address1변수에 저장
$address2=$address[1]; //$address[1] 을 $address2변수에 저장

?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/information.css?v=13">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=5">
<script type="text/javascript">
function pw_change(){
   window.open("pw_modify.php", "팝업", "left=200, top=200, width=500, height=300, scrollbars=no, resizable=no,fullscreen=no,location=no");
}
</script>
</head>
<body>

   <div id="m">
      <?php
    include "../common_lib/header2.php";
    ?>
         <section>
         <div id="section_1">

            <div id="myinfo_edit">
               <p id="info_edit">
                  <b>──────&nbsp;&nbsp; I N F O R M A T I O N &nbsp;&nbsp;──────</b>
               </p>
               <div id="info_modify">
                  <a href="./my_info_edit.php"><img src="./img/회원정보수정2.png" style="width: 100%; height: 100%;"></a>
               </div>
               <div id="pw_modify" onclick="pw_change()">
                  <a href="#" ><img src="./img/비밀번호 변경(버튼).png" style="width: 100%; height: 100%;"></a>
               </div>
               <div id="my_reserve">
                  <a href="./my_reserve.php"><img src="./img/내 예약현황(버튼).png" style="width: 100%; height: 100%;"></a>
               </div>
            </div><br><br><br>
         <hr class="clear">
         <div id="my_info_frame">
            <table id="my_info_table">
               <tr style="border: 1px solid black;">
                  <th id="my_info_th" colspan="2">회&nbsp;&nbsp;원&nbsp;&nbsp;정&nbsp;&nbsp;보</th>
               </tr>
               <tr>
                  <td class="category">아 이 디</td>
                  <td class="my_info"><?=$row['id']?></td>
               </tr>
               <tr>
                  <td class="category">성 명</td>
                  <td class="my_info"><?=$name?></td>
               </tr>
               <tr>
                  <td class="category">생 년 월 일</td>
                  <td class="my_info"><?=$birth?></td>
               </tr>
               <tr>
                  <td class="category">주 소</td>
                  <td class="my_info" style="font-size: 10pt;"><?=$address1." ".$address2?></td>
               </tr>
               <tr>
                  <td class="category">연 락 처</td>
                  <td class="my_info"><?=$phone?></td>
               </tr>
               <tr>
                  <td class="category">이메일 주소</td>
                  <td class="my_info"><?=$row['email']?></td>
               </tr>
               <tr>
                  <td class="category">등 급</td>
                  <td class="my_info"><?=$row['level']?></td>
               </tr>
            </table>
<?php 


$sql="select * from reserve where id='$id' order by reserve_start";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
$total_record=mysqli_num_rows($result);

$year=(int)date("Y");
$month=(int)date("m");
if($month<10){
    $month="0".$month;
}
$day=(int)date("d");
if($day<10){
    $day= "0".$day;
}
$date=$year.$month.$day;


$scale=8;

if($total_record%$scale==0){
    $total_page=floor($total_record/$scale);
}

$page=1;
$start=($page-1)*$scale;
$number=$total_record-$start;

?>         
         </div> <!-- 내정보 -->
         <div id="my_reserve_frame">
               <table id="info_reserve_table">
                  <tr id="tr_1">
                     <th colspan="4" id="info_my_reserve">나의 예약정보</th>
                  </tr>
                  <tr class="tr_2">
                     <td class="table_type">예약일자</td>
                     <td class="table_type">객실타입</td>
                     <td class="table_type">결제방법</td>
                     <td class="table_type">예약상태</td>
                  </tr>
               </table>
               <?php ?>
               <table id='my_table'>
               <?php 
                   for($i=$start;$start+$scale&&$i<$total_record;$i++){
                       mysqli_data_seek($result, $i);
                       $row = mysqli_fetch_array($result);
                       $num1= mysqli_num_rows($result1);
                       $room_type=$row['room_type'];
                       $payment=$row['payment'];
                       $money=$row['money']."원";
                       $reserve_start=(int)$row['reserve_start'];
                       $year=substr($reserve_start, 0,4);
                       $month=substr($reserve_start, 4,2);
                       $day=substr($reserve_start, 6,2);
                       
                       $reserve_day=$year."-".$month."-".$day;
                   if($date<$reserve_start){
                      echo "<tr>
                     <td class='my_td1'>$reserve_day</td>
                     <td class='my_td'>$room_type</td>
                     <td class='my_td1'>$payment</td>
                     <td class='my_td'>$money</td>
                  </tr>";
                   $number--;
                      }
                   }
                   if(!$num1){
                       echo"<tr>
                                    <td class='reserve_none'>$name 님의 <br>
                                    예약건이 없습니다.</td>
                                </tr>";
                   }
                   ?>
                  </table>
         </div><!-- 예약정보 -->

         </div>
      </section>
      <div id="foot">
    <?php
    mysqli_close($con);
    include "../common_lib/footer2.php";
    ?>
    </div>
   </div>
</body>
</html>