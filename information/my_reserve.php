<?php
session_start();

include '../common_lib/common.php';

if(!isset($_SESSION['id'])){
    echo "<script>
        alert('로그인을 먼저 해주세요!');
        document.location.href='../index.php';
        </script>";
}else{
    $id=$_SESSION['id'];
    $name=$_SESSION['name'];
}

if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$sql="select * from membership where id='$id'";
$result= mysqli_query($con, $sql);


if(!isset($result)){
    echo "<script>alert('$name 님의 예약건이 없습니다!')
                location.href='./information.php';
                </script>";
}



?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/my_reserve.css?v=6">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=2">
<script type="text/javascript">
function btn_cancel(num){
	var cancel= confirm("취소 시 복구가 어렵습니다.취소하시겠습니까?");
	if (cancel==true){ 
		location.href="./my_reserve_delete.php?num="+num;
	}else{  
	    return;
	}
}
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

				<div id="myinfo">
					<p id="info">
						<b>──────&nbsp;&nbsp; M Y &nbsp;R E S E R V E &nbsp;&nbsp;──────</b>
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
			<hr id="clear">
			<div id="my_reserve_situation"><img src="./img/나의 예약현황(1).png" style="width: 100%; height: 100%;"></div>
			<div class="clear"></div>
			<?php 
		  // 결제방식, 예약여부
		    $sql="select * from membership where id='$id'";
		    $result= mysqli_query($con, $sql);
		    $row=mysqli_fetch_array($result);
			

			    mysqli_data_seek($result, $i);
			    $row=mysqli_fetch_array($result);

			    $level=$row['level'];
			    $name=$row['name'];

			    echo "<div id='my_class'>이름 : $name &nbsp;&nbsp;&nbsp;&nbsp;┃&nbsp;&nbsp;&nbsp;&nbsp;등급 : $level</div>";
/*			    $num = str_replace(" ", "&nbsp", $row['num']);
			    $regist_day= str_replace(" ", "&nbsp", $row['regist_day']);
			    $room_type= str_replace(" ", "&nbsp", $row['place']);
			    $money= str_replace(" ", "&nbsp", $row['money']);*/
			
			?>
			<div id="reserve_frame">
				<div id="my_frame"><img src="./img/객실예약내역.png" style="width: 100%; height: 100%;"></div>
				<table id="reserve_table">
					<tr id="reserve_tr">

						<th class="reserve_th">예약일자</th>
						<th class="reserve_th">객실타입</th>
						<th class="reserve_th">결제방법</th>
						<th class="reserve_th">가격</th>
						<th class="reserve_th">현재상태</th>
					</tr>
				</table>
	

		
			<table id="my_reserve_table">
				
			<?php 
			
		  // 결제방식, 예약여부
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

			
			$sql="select * from reserve where id='$id' and reserve_start>=$date order by reserve_start";
			$result= mysqli_query($con, $sql);
			$row=mysqli_fetch_array($result);
			$total_record = mysqli_num_rows($result);
			
			$scale= 7;
			
			if($total_record%$scale==0){
			    $total_page = floor($total_record/$scale);
			}else{
			    $total_page = floor($total_record/$scale)+1;
			}
			if(empty($page)){
			    $page=1;
			}
			$start=($page-1)*$scale;
			$number=$total_record-$start;
			
			

			for($i=$start;$i<$start+$scale && $i < $total_record; $i++){
			    mysqli_data_seek($result, $i);
			    $row=mysqli_fetch_array($result);
                
			    $room_type=$row['room_type'];
			    $payment=$row['payment'];
			    $money=$row['money']."원";
			    $reserve_start=(int)$row['reserve_start'];
			    $num=$row['num'];
			    

                $year=substr($reserve_start, 0,4);
			    $month=substr($reserve_start, 4,2);
			    $day=substr($reserve_start, 6,2);
			    
			    $reserve_day=$year."-".$month."-".$day;

			     if($date==$reserve_start){
			            echo"<tr id='my_reserve_tr'>
                        <td class='my_reserve_td'>$reserve_day</td>
						<td class='my_reserve_td'>$room_type</td>
						<td class='my_reserve_td'>$payment</td>
						<td class='my_reserve_td'>$money</td>
						<td class='my_reserve_td'>취소불가</td>
                        </tr>";
			        }
			   
			    if($date<$reserve_start){
			        echo"<tr id='my_reserve_tr'>
                        <td class='my_reserve_td'>$reserve_day</td>
						<td class='my_reserve_td'>$room_type</td>
						<td class='my_reserve_td'>$payment</td>
						<td class='my_reserve_td'>$money</td> 
						<td class='my_reserve_td'>예약<input type='button' value='취소' id='btn_cancle' onclick='btn_cancel($num)'></td>                
                        </tr>";
			    }
			    $number--;
			   
			}
			?>
				</table>
			<?php 
			$page_block = 3; // 페이지 최대 개수
			$total_block = ceil($total_page / $page_block); // 전체블록값
			$block = ceil($page / $page_block); // 현재 페이지 현재 블록
			$first = ($block - 1) * $page_block; // 현재 블록 시작하는 페이지 위치
			$last = $block * $page_block; // 현재블록 끝나는 위치
			
			if ($block >= $total_block) {
			    $last = $total_page; // 현재블록이 마지막블럭위치라면
			}
			echo "<div id='reserve_page'>";
			if ($page > 1) {
			    // 2블럭이상이라면
			    echo "<a href='my_reserve.php?page=1' class='link_page'> << &nbsp;&nbsp;</a>";
			    $go_page = $page - 1;
			    echo "<a href='my_reserve.php?page=$go_page' class='link_page'> <&nbsp;&nbsp; </a>";
			}
			for($i=$first+1;$i<=$last;$i++){ // 페이지 링크번호
			    if($page==$i){
			        echo "<b> $i</b>";
			    }else{
			        echo "<a href='my_reserve.php?table=reserve&page=$i'>$i</a>";
			    }
			}
			if($total_page>$page){    // 다음 블럭과 마지막블럭으로 이동시켜주는 링크
			    $go_page=$page+1;
			    echo "<a href='my_reserve.php?page=$go_page' class='link_page'> &nbsp;&nbsp;></a>";
			    echo "<a href='my_reserve.php?page=$total_page' class='link_page'> &nbsp;&nbsp;>></a>";
			}
			echo "</div>";
			?>
			</div>		
			</div>
		</section>
		<div id="foot">
    <?php
    include "../common_lib/footer2.php";
    ?>
    </div>
	</div>
</body>
</html>
