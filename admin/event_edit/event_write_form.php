<?php
session_start();

include '../../common_lib/common.php';

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
}
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
    $num = $_GET["num"];
    $table = $_GET["table"];
    $page = $_GET["page"];
}
if(isset($_GET['table'])){
    $table=$_GET['table'];
}
if(isset($_GET['page'])){
    $page=$_GET['page'];
}

if(isset($mode) && $mode == "modify"){
    $sql = "select * from event where num=$num";
    // 해당 테이블에서 num값을 기준으로 모든 정보를 가져오도록 함.
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $item_regist_day = $row["regist_day"];
    $item_subject = $row['subject'];
    $item_content = $row['content'];
    $item_file0 = $row['file_name_0'];
    $item_file1 = $row['file_name_1'];
    $copied_file_0=$row['file_copied_0'];
    $copied_file_1=$row['file_copied_1'];
}else{
    $item_subject = null;
    $item_content = null;
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../css/event_write_form.css?v=3">
<link type="text/css" rel="stylesheet" href="../../common_css/project_style.css?v=2">
<script>
function keydown(){
	$("input:text").keydown(function(evt){
		if (evt.keyCode===13)
			return false;
	});
}
function check_input(){
    if(!document.board_form.subject.value){
       alert("제목을 입력하세요!");
       document.board_form.subject.focus();
       return;
    }
    if(!document.board_form.content.value){
       alert("내용을 입력하세요!");
       document.board_form.content.focus();
       return;
    }
    document.board_form.submit();
 }
</script>
</head>
<body>

   <div id="m">
      <?php
    include "../../common_lib/header3.php";
    ?>
       <section>
      <div id="intro_write_form">
         <div id="view_title"><b>────── &nbsp;M A N A G E R &nbsp; W R I T E &nbsp;──────</b></div>
          <br>
          <hr id="clear">      
<?php 
if(isset($mode) && $mode === "modify"){
?>
<form name="board_form" action="event_insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" method="post" enctype="multipart/form-data" onsubmit="return false">
<?php 
}else{
?>
<form name="board_form" action="event_insert.php?table=<?=$table?>&page=<?=$page?>" method="post" enctype="multipart/form-data" onsubmit="return false">
<?php 
}
?>
<!-- ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ -->
<!-- 제목 -->
	<div id="content3">
			<div id="title_logo">
				<img src="./img/제목.jpg" style="width: 100%; height: 100%;">
			</div> <!-- title_logo -->
			<div id="title_input">
				<input type="text" name="subject" id="title_text" value="<?=$item_subject?>" onkeydown="keydown()">
				<select name="division" id="select_division">
					<option value="공통">공통</option>
				</select>
			</div> <!-- title_input -->
			<div id="title_date">
			 <div id="date"><?=$item_regist_day?></div>
			</div><!-- title_date -->
	</div> <!-- content -->
	
<!-- 내용 -->		
		<div id="content_frame">
			<div id="content_logo">
				<img src="./img/내용.jpg" style="width: 100%; height: 100%;">
			</div> <!-- content_logo -->
			<div id="content_input">
				<textarea rows="33%" cols="110%" name="content" id="content_text"><?=$item_content?></textarea>
			</div> <!-- content_input -->
		</div> <!-- content_frame -->



<!-- 이미지 -->
		<div id="image_whole">
<!-- 이미지1 -->
			<div id="image_logo1"><img src="./img/이미지1.jpg" style="width: 100%; height: 100%;"></div> <!-- image_logo1 -->
			<div id="iamge_input1">
        	<?php 
            if((isset($mode) && $mode==="modify") && $item_file0){
            ?>
				<div id="hide_file1"><input type="file" name="upfile[]"></div> <!-- hide_file1 --><div class="clear"></div> 
				<div class="delete_ok"><?=$item_file0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0">삭제</div> <!-- delete_ok -->
			<?php 
            }else{
			?>
			<div id="hide_file1"><input type="file" name="upfile[]"></div>
			<?php 
            }
			?>
			</div> <!-- iamge_input1 -->
<!-- 이미지2 -->			
			<div id="image_logo2"><img src="./img/이미지2.jpg" style="width: 100%; height: 100%;"></div> <!-- image_logo1 -->
			<div id="iamge_input2">
			<?php 
            if((isset($mode) && $mode==="modify") && $item_file1){
            ?>
				<div id="hide_file2"><input type="file" name="upfile[]"></div> <!-- hide_file1 --><div class="clear"></div> 
				<div class="delete_ok"><?=$item_file1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0">삭제</div> <!-- delete_ok -->
			<?php 
            }else{
			?>
			<div id="hide_file2"><input type="file" name="upfile[]"></div>
			<?php 
            }
			?>
			</div> <!-- iamge_input1 -->
		</div> <!-- image_whole -->
      </form>
<!-- 끝 -->		
<!-- ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ -->
   
	<div id="register_n_list">
	<a href="#"><input type="button" value="작 성" id="register" onclick="check_input()"></a>
	<a href="../admin.php?mode=admin_event_edit&table=<?=$table?>&page=<?=$page?>"><input type="button" value="목 록" id="list1"></a>
	</div>
      </div>
       </section>
    <?php
    include "../../common_lib/footer3.php";
    ?>
   </div>
</body>
</html>