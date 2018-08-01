<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet"
	href="../common_css/project_style.css?v=3">
<link type="text/css" rel="stylesheet" href="./css/use_guide.css?v=12">
<?php include '../common_lib/common.php';?>

</head>
<body id="m">
	<div>
      <?php
    include "../common_lib/header2.php";
    $sql = "select * from use_guide";
    $result=mysqli_query($con, $sql) or die("레코드 로딩 실패" . mysqli_error($con));
    $row=mysqli_fetch_array($result);
    $file_name = $row[file_name];
    
    $file_name = explode("/", $file_name);

    ?>
       <section>

			<div id="useguide_intro">
				<div id="view_title">
					<b>────── U S E R&nbsp;&nbsp;&nbsp;G U I D E ──────</b>
				</div>
				<br>
				<hr id="clear">
					<div id="noti"><img src="./img/오시는길.png" style="width: 100%; height: 100%;">
 					<div onclick="maps(event)" id="maps_div"><img src="./img/jpg.jpg" style="cursor: hand;"></div>					
 					<script>
 					function maps(e){
 					window.open("./maps.php","다음지도","height=600 width=550");
 					}
					</script> 					
				</div>
			
					
				
				<!-- 여기서부터 작성시작 -->


				<div id="view">
					<img style="width: 100%;height:100%;" src="../common_data/useguide/<?=$file_name[4]?>">
				</div>
			

				<!-- 여기 밑으로는 나가지 마세요 -->
			</div>
		</section>
       <?php
    include "../common_lib/footer2.php";
       ?>
   </div>
</body>
</html>