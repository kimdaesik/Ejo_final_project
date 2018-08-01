<?php
include '../common_lib/common.php';

$MM=$_GET['MM'];
$YYYY=$_GET['YYYY'];
if($YYYY =="") {
    $YYYY = date("Y");
}

if($MM =="") {
    $MM = substr(date("m"),1,1);
}

if($MM == 13) {
    $MM = 1;
    $YYYY++;
}
if($MM == 0) {
    $MM = 12;
    $YYYY--;
}
$MM2=date("m");
$day2=date("d");
$before = $MM - 1;
$after = $MM + 1;
$firstday_weeknum = date("w", mktime(0, 0, 0, $MM, 1, $YYYY));
$lastday = date("t", mktime(0, 0, 0, $MM, 1, $YYYY));
$total_week = ceil(($lastday+$firstday_weeknum) / 7);

if($MM == 2) {
    if(($YYYY % 4) == 0 && ($YYYY % 100) != 0 || ($YYYY % 400) == 0) { $lastday = 29; }
}
?>
<table style=" margin-top:5.3%; width : 14%; height : 65%; float: left;">
               <?php 
               if($total_week==5){
               ?>
               <tr><td style="height : 6%;"></td></tr>
               <?php for($i=0;$i<5;$i++){?>
               <tr><td><div class="first2">family</div><div class="second">suite</div><div class="second">royalsuite</div></td></tr>
               <?php }}else{?>
               <tr><td style="height : 6%;"></td></tr>
               <?php for($i=0;$i<6;$i++){?>
               <tr><td><div class="first">family</div><div class="second">suite</div><div class="second">royalsuite</div></td></tr>
               <?php }}?>
</table>

<table width=600><tr>
<td align=center><a href="reserveform.php?total_week=<?=$total_week?>&MM=<?=$before?>&YYYY=<?=$YYYY?>"><img src="./img/이전달.png"></a> <font color="deepink" size="10pt;"><?php echo "$YYYY";?>년<?php echo "$MM"?>월 </font> <a href="reserveform.php?total_week=<?=$total_week?>&MM=<?=$after?>&YYYY=<?=$YYYY?>"><img src="./img/다음달.png"></a>
</td></tr>
</table>
<?php
echo("<table id='calender_tb' cellspacing=0 cellpadding=2><tr>\n");
echo(
    "<td align='center' class='calender_td2'><font color='red'><b>일</b></font></td>
    <td align='center' class='calender_td2'><b>월</b></td>
    <td align='center' class='calender_td2'><b>화</b></td>
    <td align='center' class='calender_td2'><b>수</b></td>
    <td align='center' class='calender_td2'><b>목</b></td>
    <td align='center' class='calender_td2'><b>금</b></td>
    <td align='center' class='calender_td2'><font color='red'><b>토</font></td>"
    );
echo("</tr><tr>");
$week = 0;
for ($i=0; $i < $firstday_weeknum; $i++){ echo("<td>&nbsp;</td>"); $week++; }
for($d=1; $d <= $lastday; $d++){
    if ($week == 7) { echo("</tr></tr>"); $week = 0; }
    $day = (date("j") == $d)? "<font color='deepink'><b>".$d."</b></font>":$d;
    echo("<td style='border:1px solid #d2d2d2;' id='td_size' align='center'><font size=2>".$day."</font><br>");
    $week++;
    ////////////////////////////////////////////////////////////////
    if($MM<10){
        $compare=$YYYY."0".$MM;
    }else{
        $compare=$YYYY.$MM;
    }
    if((date("j") == $d)){
        if($d<10){
            $compare=$compare."0".$d;
        }else{
            $compare=$compare.$d;
        }
    }else{
        if($day<10){
            $compare=$compare."0".$day;
        }else{
            $compare=$compare.$day;
        }
    }
    ////////////////////////////////////////////////////////////////
    $count1=0;
    $sql= "select reserve_start,reserve_end from reserve where room_type='family'";
    $result= mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $reserve_start=(int)$row['reserve_start'];
        $reserve_end=(int)$row['reserve_end'];
        if($reserve_start <= (int)$compare && (int)$compare <= $reserve_end){
            $count1++;
        }
    }
    $sql = "select * from room where room_type='family'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $total_room_num=mysqli_num_rows($result);
    
    if($MM<$MM2 || ($MM==$MM2&&$day<$day2) || ($MM==$MM2&&(date("j") == $d))){
        echo "<div class='reserve_status5'>&nbsp;</div>";
    }elseif($count1==$total_room_num){
        echo "<div class='reserve_status4'>예약마감</div>\n";
    }else{
        echo "<button class='reserve_status1' onclick='reserve_click1($d,$MM,$YYYY)'><input class='reserve_input1' type='hidden' value='family'>예약가능</button>\n";
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $count2=0;
    $sql= "select reserve_start,reserve_end from reserve where room_type='suite'";
    $result= mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $reserve_start=$row['reserve_start'];
        $reserve_end=$row['reserve_end'];
        if($reserve_start <= (int)$compare && (int)$compare <= $reserve_end){
            $count2++;
        }
    }
    $sql = "select * from room where room_type='suite'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $total_room_num=mysqli_num_rows($result);
    
    if($MM<$MM2 || ($MM==$MM2&&$day<$day2) || ($MM==$MM2&&(date("j") == $d))){
        echo "<div class='reserve_status5'>&nbsp;</div>";
    }elseif($count2==$total_room_num){
        echo "<div class='reserve_status4'>예약마감</div>\n";
    }else{
        echo "<button class='reserve_status1' onclick='reserve_click2($d,$MM,$YYYY)'><input class='reserve_input2' type='hidden' value='suite'>예약가능</button>\n";
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $count3=0;
    $sql= "select reserve_start,reserve_end from reserve where room_type='royalsuite'";
    $result= mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $reserve_start=$row['reserve_start'];
        $reserve_end=$row['reserve_end'];
        if($reserve_start <= (int)$compare && (int)$compare <= $reserve_end){
            $count3++;
        }
    }
    $sql = "select * from room where room_type='royalsuite'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $total_room_num=mysqli_num_rows($result);
    
    if($MM<$MM2 || ($MM==$MM2&&$day<$day2) || ($MM==$MM2&&(date("j") == $d))){
        echo "<div class='reserve_status5'>&nbsp;</div></td>";
    }elseif($count3==$total_room_num){
        echo "<div class='reserve_status4'>예약마감</div></td>\n";
    }else{
        echo "<button class='reserve_status1' onclick='reserve_click3($d,$MM,$YYYY)'><input class='reserve_input3' type='hidden' value='royalsuite'>예약가능</button></td>\n";
    }
  ///////////////////////////////////////////////////////////////////
    
}
for ($i=$week; $i < 7; $i++) { echo("<td>&nbsp;</td>\n"); }
echo("</tr>\n");
echo("</table><br>\n"); 

?>








