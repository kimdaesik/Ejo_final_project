<?php
include '../../common_lib/common.php';
$sql="select * from use_guide";
$result = mysqli_fetch_array($con, $sql);
$useguidefile = $row['file_name'];
?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=1">
<link type="text/css" rel="stylesheet" href="./css/useguide_edit.css?v=9">
</head>
      <?php
      $sql = "select * from use_guide";
      $result=mysqli_query($con, $sql) or die("레코드 로딩 실패" . mysqli_error($con));
      $row=mysqli_fetch_array($result);
      $useguidefile = $row[file_name];
      
      $useguidefile2 = explode("/", $useguidefile);
      $useguidefile3 = $useguidefile2[1]."/".$useguidefile2[2]."/".$useguidefile2[3]."/".$useguidefile2[4];
/*        var_dump($useguidefile3);
      exit(); */
      
      ?>
<div id="useguide_img">
	<img style="width: 100%;height:100%;" src="<?=$useguidefile3?>" alt ="이미지 준비중입니다.">
</div>

<form name="picture_board" method="post" enctype="multipart/form-data" action="./useguide_edit/use_guide_insert.php">
					<div id="use_guide_controller">
						<input type="file" name="upfile[]">&nbsp;
						<input type="submit" value="업로드" style="margin-left:20%;">
						<a href="./useguide_edit/use_guide_delete.php">현재 이용안내 삭제</a>			
					</div>
</form>
<?php 
mysqli_close($con);
?>                  
</html>