<?php
if(!empty($_GET['mode'])){
    $mode=$_GET['mode'];
}else{$mode="family";}

if(!empty($_GET['pic'])){
    $pic=$_GET['pic'];
}else{$pic=1;}
?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=6">
<link type="text/css" rel="stylesheet" href="./css/room_intro.css?v=21">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
	$(document).ready(function(){
		$("#picture1").mouseup(function(){
			var mode= $("#picture1").children("#one").val();
			var pic=1;
			$.ajax({
				type :"post",
				url : "./room_picture.php",
				data : "type="+mode+"&pic="+pic,
				success : function(result){
					$("#room_picture").html(result);
      			}
			});
		});
		
		$("#picture2").mouseup(function(){
			var mode= $("#picture2").children("#two").val();
			var pic=2;
			$.ajax({
				type :"post",
				url : "./room_picture.php",
				data : "type="+mode+"&pic="+pic,
				success : function(result){
					$("#room_picture").html(result);
      			}
			});
		});
		
		$("#picture3").mouseup(function(){
			var mode= $("#picture3").children("#three").val();
			var pic=3;
			$.ajax({
				type :"post",
				url : "./room_picture.php",
				data : "type="+mode+"&pic="+pic,
				success : function(result){
					$("#room_picture").html(result);
      			}
			});
		});
		
		$("#picture4").mouseup(function(){
			var mode= $("#picture4").children("#four").val();
			$.ajax({
				type :"post",
				url : "./room_picture.php",
				data : "type="+mode+"&pic=4",
				success : function(result){
					$("#room_picture").html(result);
      			}
			});
		});
	});
	
</script>
</head>

<body id="m">
	<div>
      <?php
         include "../common_lib/header2.php";
      ?>
       <section>
		<?php
		 include '../common_lib/common.php';
		 
		 $sql = "select * from roominfo where type='$mode'";
			$result = mysqli_query($con,$sql)or die("실패원인1:".mysqli_error($con));
			$row = mysqli_fetch_array($result);
			$normal_price = $row['normal_price'];
			$normal_price_weekend = $row['normal_price_weekend'];
			$vip_price = $row['vip_price'];
			$vip_price_weekend = $row['vip_price_weekend'];
			$room_num = $row['room_num'];
			$people_num = $row['people_num'];
			$area_m2= $row['area_m2'];
			$area_peung= $row['area_peung'];
			$component_living = $row['component_living'];
			$component_toilet = $row['component_toilet'];
			$component_room = $row['component_room'];
			$picture1  = $row['picture0'];
			$picture2  = $row['picture1'];
			$picture3  = $row['picture2'];
			$picture4  = $row['picture3'];
		?>

		<div id="room_test">
			<div id="view_title"><b>────── R O O M&nbsp;&nbsp;&nbsp;I N F O ──────</b></div>
			<div id="btn_family"><a href="room_intro.php?mode=family"><img style="width: 100%; height: 100%;" alt="#" src="./img/3.패밀리.png"></a></div>
			<div id="btn_suite"><a href="room_intro.php?mode=suite"><img style="width: 100%; height: 100%;" alt="#" src="./img/4.스위트.png"></a></div>
			<div id="btn_royalsuite"><a href="room_intro.php?mode=royalsuite"><img style="width: 100%; height: 100%;" alt="#" src="./img/5.로얄스위트.png"></a></div>
    		<br>
    		<hr id="clear">

    		<div id="room_content">
				<div id="room_picture"><img src='<?=$picture1?>' style='width :100%; height : 100%;'></img></div>
				<div id="pictures">
					<?php
					
					echo "
    				<div id='picture1' ><img id='picture_img1' style='width: 100%; height: 100%' src='$picture1'></img>
                        <input id='one' type='hidden' value='".$mode."'></div>
    				<div id='picture2' ><img id='picture_img2' style='width: 100%; height: 100%' src='$picture2'></img>
                        <input id='two' type='hidden' value='".$mode."'></div>
    				<div id='picture3' ><img id='picture_img3' style='width: 100%; height: 100%' src='$picture3'></img>
                        <input id='three' type='hidden' value='".$mode."'></div>
    				<div id='picture4' ><img id='picture_img4' style='width: 100%; height: 100%' src='$picture4'></img>
                        <input id='four' type='hidden' value='".$mode."'></div>
				    "; 
					?>
                </div>
				<div id="information">
					&lt;객실 정보&gt;
						<table style="text-align:center;border-collapse: collapse;height:85%;width:100%;">
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">객실 수</td>
								<td style="border:1px solid black;width:20%;"><?= $room_num ?></td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">투숙인원</td>
								<td style="border:1px solid black;width:20%;"><?= $people_num.인?></td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">전용면적</td>
								<td style="border:1px solid black;width:20%;"><?=$area_m2?>m2(구<?=$area_peung?>평형)</td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">구성</td>
								<td style="border:1px solid black;width:20%;">거실:<?=$component_living?>, 방:<?=$component_room?>, 욕실:<?=$component_toilet?></td>
							</tr>
						
						</table>
				</div>
				<div id="pricetable">&lt;가격표&gt;
						<table style="text-align:center;border-collapse: collapse;height:85%;width:100%;">
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">요일</td>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">일반요금</td>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">VIP요금</td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">일 - 목</td>
								<td style="border:1px solid black;width:20%;"><?=$normal_price?></td>
								<td style="border:1px solid black;width:20%;"><?=$vip_price?></td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">금-토</td>
								<td style="border:1px solid black;width:20%;"><?=$normal_price_weekend?></td>
								<td style="border:1px solid black;width:20%;"><?=$vip_price_weekend?></td>
							</tr>
						</table>
				</div>
			</div>
		</div>
       </section>

       <?php
             include "../common_lib/footer2.php";
       ?>
       </div>
</body>
</html>