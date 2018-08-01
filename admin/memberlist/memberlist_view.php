<?php 
$id = $_GET['id']; 
include "../../common_lib/common.php";

$sql = "select * from membership where id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$birth_month=(int)$row['birth_month'];
$birth_day=(int)$row['birth_day'];

if($birth_month<10){
    $birth_month="0".$birth_month;
}
if($birth_day<10){
    $birth_day="0".$birth_month;
}

$birth=$row['birth_year'].$birth_month.$birth_day;
$address1=explode("+", $row['address'])[0];
$address2=explode("+", $row['address'])[1];
?>

<link type="text/css" rel="stylesheet" href="./css/memberlist_view.css">
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
		<td class="my_info"><?=$row['name']?></td>
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
		<td class="my_info"><?=$row['phone1']."-".$row['phone2']."-".$row['phone3']?></td>
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