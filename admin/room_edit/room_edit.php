		<?php
		if(!empty($_GET['select'])){
		    $select=$_GET['select'];
		}else{$select="family";}
		
		 include '../common_lib/common.php';
		 
		 $sql = "select * from roominfo where type='$select'";
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
			$picture0  = $row['picture0'];
			$picture1  = $row['picture1'];
			$picture2  = $row['picture2'];
			$picture3  = $row['picture3'];
		?>
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="./css/room_edit.css?v=10">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=4">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
function update_room_info()
{
	document.room_info_form.submit();
}
	
</script>
</head>
<div id="btn_family"><a href="admin.php?mode=admin_room_edit&select=family"><img alt="" src="./img/3.패밀리.png" style="height:5%;width:100%;"></a></div>
<div id="btn_suite"><a href="admin.php?mode=admin_room_edit&select=suite"><img alt="" src="./img/4.스위트.png" style="height:5%;width:100%;"></a></div>
<div id="btn_royalsuite"><a href="admin.php?mode=admin_room_edit&select=royalsuite"><img alt="" src="./img/5.로얄스위트.png" style="height:5%;width:100%;"></a></div>
			<form  name="room_info_form" method="post" action="./room_edit/room_edit_update.php?select=<?=$select?>" enctype="multipart/form-data">
				<div id="room_picture">
					<div class="picture_chage">
					<input style="margin-top:9%;margin-left:3%;" type="file" name="upfile[]"><input class="del_file" type="checkbox" name="del_file[]" value="0"> 삭제
					</div>
					
					<div class="picture_chage">
					<input style="margin-top:9%;margin-left:3%;" type="file" name="upfile[]"><input class="del_file" type="checkbox" name="del_file[]" value="1"> 삭제
					</div>
					
					<div class="picture_chage">
					<input style="margin-top:9%;margin-left:3%;" type="file" name="upfile[]"><input class="del_file" type="checkbox" name="del_file[]" value="2"> 삭제
					</div>
					
					<div class="picture_chage">
					<input style="margin-top:9%;margin-left:3%;" type="file" name="upfile[]"><input class="del_file" type="checkbox" name="del_file[]" value="3"> 삭제
					</div>
				</div>
				<div id="pictures">
					<?php
					echo "
    				<div id='picture1' ><img id='picture_img1' style='width: 100%; height: 100%' src='$picture0'></img>
                        <input id='one' type='hidden' value='".$select."'></div>
    				<div id='picture2' ><img id='picture_img2' style='width: 100%; height: 100%' src='$picture1'></img>
                        <input id='two' type='hidden' value='".$select."'></div>
    				<div id='picture3' ><img id='picture_img3' style='width: 100%; height: 100%' src='$picture2'></img>
                        <input id='three' type='hidden' value='".$select."'></div>
    				<div id='picture4' ><img id='picture_img4' style='width: 100%; height: 100%' src='$picture3'></img>
                        <input id='four' type='hidden' value='".$select."'></div>
				    "; 
					?>
                </div>
				
				<div id="information">
					&lt;객실 정보&gt;
						<table style="text-align:center;border-collapse: collapse;height:90%;width:100%;">
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">객실 수</td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="room_num" size="3" value="<?=$room_num?>"></td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">투숙인원</td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="people_num" size="3" value="<?= $people_num?>">인</td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">전용면적</td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="area_m2" size="1" value="<?=$area_m2?>">m2(구<input type="text" name="area_peung" size="1" value="<?=$area_peung?>">평형)</td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">구성</td>
								<td style="border:1px solid black;width:20%;">거실:<input type="text" name="component_living" id="asearch" size="1" value="<?=$component_living?>">, 방:<input type="text" name="component_room" id="asearch" size="1" value="<?=$component_room?>">, 욕실:<input type="text" name="component_toilet" id="asearch" size="1" value="<?=$component_toilet?>"></td>
							</tr>
						
						</table>
				</div>
				<div id="pricetable">&lt;가격표&gt;
						<table style="text-align:center;border-collapse: collapse;height:90%;width:100%;">
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">요일</td>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">일반요금</td>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">VIP요금</td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">일 - 목</td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="normal_price" size="5" value="<?=$normal_price?>"></td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="vip_price" size="5" value="<?=$vip_price?>"></td>
							</tr>
							<tr>
								<td style="border:1px solid black;width:20%;background-color:#e8e8e8;">금-토</td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="normal_price_weekend" size="5" value="<?=$normal_price_weekend?>"></td>
								<td style="border:1px solid black;width:20%;"><input type="text" name="vip_price_weekend" size="5" value="<?=$vip_price_weekend?>"></td>
							</tr>
						</table>
				</div>
			</form>
				<div id="btn_room_update"><a href="#" onclick="update_room_info()"><img alt="" src="./img/11.수정.png" style="height:5%;width:100%;"></a></div>
</html>