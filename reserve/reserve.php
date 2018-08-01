<?php
session_start();
include '../common_lib/common.php';
$id=$_SESSION['id'];

$day=$_POST['day'];
$mm=$_POST['mm'];
$yyyy=$_POST['yyyy'];
$reserve_type=$_POST['reserve_type'];
if($mm<10){
    $mm="0".$mm;
}
if($day<10){
    $day="0".$day;
}
$w=date("w", mktime(0, 0, 0, $mm, $day, $yyyy));

$sql = "select level from membership where id='$id'";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
$row=mysqli_fetch_array($result);
$level=$row['level'];
?>
<form action="payment.php?flag=reserve" method="post">
<table style="width: 30%; text-align: center;">
    <tr>
       <td style="color:#FFFFFF; background-color:#088a99; width: 30%;"><p>시작일 :</p></td>
       <?php $asd?>
       <td style="background-color:#FFFFFF; border:1px solid #d2d2d2; width: 50%;"><div><?=$yyyy?>년 <?= $mm?>월 <?= $day?>일</div></td>
       <input type="hidden" name="yyyy" value="<?=$yyyy?>">
       <input type="hidden" name="mm" value="<?=$mm?>">
       <input type="hidden" name="day" value="<?=$day?>">
       <input type="hidden" name="reserve_type" value="<?=$reserve_type?>">
    </tr>
    <tr>
       <td style="color:#FFFFFF; background-color:#088a99; width: 30%;"><p>숙박일 : </p></td>
       <td style="background-color:#FFFFFF; border:1px solid #d2d2d2; width: 50%;">
           <select onclick="select_click('<?=$reserve_type?>',<?=$w?>,'<?=$level?>')" id="select_option" style="width: 40%; margin-top: -0.1%;">
               <option value="1">1박</option>
               <option value="2">2박</option>
               <option value="3">3박</option>
           </select>
       </td>
    </tr>
    <tr>
       <td style="color:#FFFFFF; background-color:#088a99; width: 30%;"><p>금&nbsp;&nbsp;&nbsp;액 :</p></td>
       <td style="background-color:#FFFFFF; border:1px solid #d2d2d2; width: 50%;"><div id="price"></div><input type="hidden" id="price2" name="price"></td>
      <input type="hidden" id="days" name="days">       
    </tr>
    <tr><td colspan="2"><button id="selectbutton" style="width: 40%;" disabled>다음</button></td></tr>
</table>
</form>