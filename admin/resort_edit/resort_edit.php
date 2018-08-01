<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/resort_edit.css?v=21">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function change_resort_info(act)
{
	$(".action").val(act);

	if (!document.resort_info_form.select_name.value)
	{
		alert("이름을 입력하세요!");    
		document.resort_info_form.select_name.focus();
		return;
	}
	document.resort_info_form.submit();
}
	
</script>
</head>
<?php
if (! empty($_GET['mode'])) {$mode = $_GET['mode'];} else {$mode = "admin_resort_edit";}
if (! empty($_GET['select'])) {$select = $_GET['select'];} else {$select = "facility";}
if (empty($_GET['page'])) {$page = 1;} else {$page = $_GET['page'];}
if (empty($_GET['num'])) {$num = "";} else {$num = $_GET['num'];}


$location = $row['location'];
$explanation = $row['explanation'];
$picture = $row['picture'];

if (isset($mode) && ($mode == "search")) {
    if (empty($search)) {
        echo ("<script>window.alert('검색할 단어를 입력해 주세요.')
            history.go(-1)
            </script>");
        exit();
    }
    $sql = "select * from resortinfo where $find like '%$search%' order by num desc";
} else {
    $sql = "select * from resortinfo where type='$select' order by num desc";
}
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);

$scale = 7;

if ($total_record % $scale == 0) {
    $total_page = floor($total_record / $scale);
} else {
    $total_page = floor($total_record / $scale) + 1;
}

$start = ($page - 1) * $scale;
$number = $total_record - $start;

?>
<div id="btn_facility">
	<a href="admin.php?mode=admin_resort_edit&select=facility"><img src="./img/f1.png" style="width: 100%; height: 6%;"></a>
</div>
<div id="btn_restaurant">
	<a href="admin.php?mode=admin_resort_edit&select=restaurant"><img src="./img/f2.png" style="width: 100%; height: 6%;"></a>
</div>
<div id="content_table">
	<div id="table">
	<table id="table_size">
		<tr style="border: 1px solid black;" id="tr1">
			<td id="no" class="tb">No</td>
			<td id="type" class="tb">구분</td>
			<td id="name" class="tb">이름</td>
			<td id="location" class="tb">위치</td>
		</tr>
                  <?php
                for ($i = $start; $i < $start + $scale && $i < $total_record; $i ++) {
                    mysqli_data_seek($result, $i);
                    $row = mysqli_fetch_array($result);
                    $item_num = str_replace(" ", "&nbsp", $row['num']);
                    $item_name = $row['name'];
                    $item_type = $row['type'];
                    $item_time = $row['time'];
                    $item_phone_num = $row['phone_num'];
                    $item_location = $row['location'];
                    $item_explanation = $row['explanation'];
                    $item_picture = $row['picture'];

                    
                    echo "<tr style='border: 1px solid black; text-align: center;' class='tr2'>
                  <td class='tb1'>$number</td>
                  <td class='tb1'>$item_type</td>
                  <td class='tb1' style='text-align:left;'><a href='admin.php?mode=admin_resort_edit&select=$select&num=$item_num&page=$page' id='subject_click'>$item_name</a></td>
                  <td class='tb1'>$item_location</td>
                     </tr>
                       
                  <div class='clear'></div>";
                    
                  $number --;
                }
                ?>
                        </table>
           </div>

                    <?php
                    $page_block = 5; // 페이지 최대 개수
                    $total_block = ceil($total_page / $page_block); // 전체블록값
                    $block = ceil($page / $page_block); // 현재 페이지 현재 블록
                    $first = ($block - 1) * $page_block; // 현재 블록 시작하는 페이지 위치
                    $last = $block * $page_block; // 현재블록 끝나는 위치
                    
                    if ($block >= $total_block) {
                        $last = $total_page; // 현재블록이 마지막블럭위치라면
                    }
                    echo "<div id='page_num'>";
                    if ($page > 1) {
                        // 2블럭이상이라면
                        echo "<a href='admin.php?mode=admin_resort_edit&page=1' class='link_page'> << &nbsp;&nbsp;</a>";
                        $go_page = $page - 1;
                        echo "<a href='admin.php?mode=admin_resort_edit&select=facility&page=$go_page' class='link_page'> <&nbsp;&nbsp; </a>";
                    }
                    
                    // 게시판 목록 하단에 페이지 링크 번호
                    for ($i = $first + 1; $i <= $last; $i ++) {
                        if ($page == $i) {
                            echo "<b id='now_page'> $i </b>";
                        } else {
                            echo "<a href='admin.php?mode=admin_resort_edit&select=facility&page=$i' class='link_page'> $i </a>";
                        }
                    }
                    
                    // 다음 블럭과 마지막블럭으로 이동시켜주는 링크
                    if ($total_page > $page) {
                        $go_page = $page + 1;
                        echo "<a href='admin.php?mode=admin_resort_edit&select=$select&page=$go_page' class='link_page'> &nbsp;&nbsp;></a>";
                        echo "<a href='admin.php?mode=admin_resort_edit&select=$select&page=$total_page' class='link_page'> &nbsp;&nbsp;>></a>";
                    }
                    echo "
		              <div id='list_id'>
			             <a href='admin.php?mode=admin_resort_edit&select=$select&page=$page'><img style='width: 100%; height: 10%;' src='./img/7.목록.png'></a>
					  </div>
                    </div>
                    ";
                    ?>


</div>
<div id="content_edit">
	<?php 
	$sql = "select * from resortinfo where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$select_num = $row['num'];
	$select_name = $row['name'];
	$select_type = $row['type'];
	$select_time = $row['time'];
	$select_phone_num = $row['phone_num'];
	$select_location = $row['location'];
	$select_explanation = $row['explanation'];
	$select_picture = $row['picture'];
	
	
	?>

	<form  name="resort_info_form" method="post" action="./resort_edit/resort_edit_change.php?num=<?=$select_num?>&select=<?=$select?>&page=<?=$page?>" enctype="multipart/form-data"> 
	<div class='image' style='margin: 1%;'>
		<img style='width:100%; height:100%;' src='<?=$select_picture?>' alt ='이미지 준비중입니다.'>
		<input style="float:left;margin-top:1%;" type="file" name="upfile[]">
	</div>
	<div class='info' style='margin: 1%;'>
		<table style='width: 100%; height: 100%;'>
			<tr>
				<td class='td1'>이름</td>
				<td class='td3'><input type="text" id="select_name" name="select_name" size="60" value="<?=$select_name?>"></td>
			</tr>
			<tr>
				<td class='td1'>영업시간</td>
				<td class='td3'><input type="text" id="select_time" name="select_time" size="60" value="<?= $select_time?>"></td>
			</tr>
			<tr>
				<td class='td1'>문의처</td>
				<td class='td3'><input type="text" id="select_phone_num" name="select_phone_num" size="60" value="<?=$select_phone_num?>"></td>
			</tr>
			<tr>
				<td class='td1'>위치</td>
				<td class='td3'><input type="text" id="select_location" name="select_location" size="60" value="<?=$select_location?>"></td>
			</tr>
			<tr>
				<td class='td2'>상세설명</td>
				<td class='td4'><textarea rows="6" cols="63" id="explanation" name="select_explanation"><?=$select_explanation?></textarea></td>
			</tr>
		</table>
	</div>
	<input name="action" class='action' type="hidden"> 
	</form>
	<div id="btn_div">
		<div id="btn_edit"><a href="#" onclick="change_resort_info('update')"><img style="width: 100%; height: 10%;" alt="#" src="./img/resort/11.수정.png"></a></div>
		<div id="btn_delete"><a href="#" onclick="change_resort_info('delete')"><img style="width: 100%; height: 10%;" alt="#" src="./img/resort/9.삭제.png"></a></div>
	    <div id="btn_add"><a href="#" onclick="change_resort_info('add')"><img style="width: 100%; height: 10%;" alt="#" src="./img/resort/10.작성.png"></a></div>
	    <div id="btn_refresh"><a href="admin.php?mode=admin_resort_edit&select=<?=$select?>&page=<?=$page?>"><img style="width: 100%; height: 10%;" alt="#" src="./img/resort/3.취소.png"></a></div>
	</div>
</div>