<?php
include '../common_lib/common.php';

if (! empty($_GET['mode'])) {
    $mode = $_GET['mode'];
} else {
    $type = "facility";
}
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$scale = 12;
$table = "notice";
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/admin.css?v=20">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=3">

</head>
<body>

   <div id="m">
      <?php
    include "../common_lib/header2.php";
    ?>
       <section>
		<div id="intro">
			<div id="view_title"><b>──────&nbsp;&nbsp;R E G I S T R A T I O N&nbsp;&nbsp;──────</b></div>
			<div id="resort_edit"><a href="admin.php?mode=admin_resort_edit"><img style="height:100%;width:100%;" alt="" src="./img/리조트안내등록.png"></a></div>
            <div id="room_edit"><a href="admin.php?mode=admin_room_edit"><img style="height:100%;width:100%;" alt="" src="./img/객실안내등록.png"></a></div>
            <div id="event_edit"><a href="admin.php?mode=admin_event_edit"><img style="height:100%;width:100%;" alt="" src="./img/이벤트등록.png"></a></div>
            <div id="useguide_edit"><a href="admin.php?mode=admin_useguide_edit"><img style="height:100%;width:100%;" alt="" src="./img/이용안내등록.png"></a></div>
    		<br>
    		<hr id="clear">

    		<div id="content">
    		
			<?php 
			if ($mode=='admin_resort_edit'){
			    include './resort_edit/resort_edit.php';
			}elseif ($mode=='admin_room_edit'){
			    include './room_edit/room_edit.php';
			}elseif ($mode=='admin_useguide_edit'){
			    include './useguide_edit/useguide_edit.php';
			}elseif ($mode=='admin_event_edit'){
			    include './event_edit/event_edit.php';
			}elseif(empty($mode)){
			    echo "<img src='./img/관리자님 환영합니다.png' style='height:100%;width:100%;'>";
			}
			?>
			</div>
		
		</div>
       </section>
    <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html>