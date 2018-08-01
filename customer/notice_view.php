<?php

session_start();
include '../common_lib/common.php';

if(isset($_GET['table'])){
    $table=$_GET['table'];
}
if(isset($_GET['num'])){
    $num=$_GET['num'];
    $page=$_GET['page'];
    $table=$_GET['table'];
    $subject=$_POST['subject'];
    $content=$_POST['content'];
}
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $name=$_SESSION['name'];
}

$sql="select * from $table where num=$num";

$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);


$item_num=$row["num"];
$item_id=$row["id"];
$item_name=$row["name"];
$item_hit=$row["hit"];
$item_regist_day = $row["regist_day"];

$file_name[0]=$row['file_name_0'];
$file_name[1]=$row['file_name_1'];

$file_copied[0]=$row['file_copied_0'];
$file_copied[1]=$row['file_copied_1'];

$item_date=$row['regist_day'];
$item_subject=str_replace(" ","&nbsp;",$row["subject"]);
$item_content=str_replace(" ","&nbsp;",$row["content"]);
$item_content=str_replace("\n","<br>",$item_content);



for($i=0 ; $i<2 ; $i++){
    if($file_copied[$i]){
        $imageinfo = getimagesize("./data/".$file_copied[$i]);
        $image_width[$i] = $imageinfo[0];
        $image_height[$i] = $imageinfo[1];
       
        if($image_width[$i]>785||$image_height[$i]>700){
            $image_width[$i] = 785;
            $image_height[$i] = 700;
        }else{
            $image_width[$i]=400;
        }
    }else{
        $image_width[$i]="";
        $image_height[$i]="";
    }
}
$new_hit=$item_hit+1;

/* var_dump($item_subject,$item_content,$item_date,$num,$name);
 */
$sql="update $table set hit=$new_hit where num=$num";
mysqli_query($con, $sql);
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/view.css?v=10">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=12">
<script type="text/javascript">
	function del(href){
		if(confirm("한번 삭제한 자료는 복구가 어렵습니다. 정말 삭제하시겠습니까?")){
			document.location.href=href;
		}
	}
</script>
</head>
<body>

	<div id="m">
      <?php
    include "../common_lib/header2.php";
    ?>
      <div id="sec">
			<section>
				<div id="space">
					<div id="side_menu"></div>
					<div id="content">

						<div id="notice_content">
							<p id="noti">
								<b>──────&nbsp;&nbsp;&nbsp;&nbsp;R E A D
									&nbsp;&nbsp;&nbsp;&nbsp;──────</b>
							</p>
							<div id="notice2">
								<a href="notice.php?type=notice"><img src="./img/16.공지사항(3).png" style="width: 100%; height: 100%;"></a>
							</div>
							<div id="qna2">
								<a href="../qna/qna_list.php"><img src="./img/17.Q&A(3).png" style="width: 100%; height: 100%;"></a>
							</div>
						</div>
								<br><br><br>
						<hr id="clear">
			<!-- 여 기 부 터 -->
						<div id="title_content"> 	<!-- 글 읽는 전체 틀 -->
						 <div id="title_main">
							<div id="title">
								<img src="./img/제목.jpg" style="width: 100%; height: 100%;">
							</div> <!-- title -->
							<div id="title_1">
								<div id="title_2">
									<?=$item_subject?>
								</div><!-- wpahrsodyd -->
								<div id="day"><?=$item_date?></div>
							</div> <!-- title_sodyd -->
						 </div> <!-- wpahr -->

						 <div id="content_main">
						 	<div id="content_title">
						 		<img src="./img/내용.jpg" style="width: 100%; height: 100%;">
						 	</div>
						 	<div id="content_content">
						 			<!-- 내용과 사진 -->
						 		<div id="content_1">
<?php 
for($i=0;$i<2;$i++){
if($file_copied[$i]){
$img_name = $file_copied[$i];
$img_name = "./data/".$img_name;
$img_width = $image_width[$i];
echo "<img src='$img_name' width='$img_width'>"."<br><br>";
						 			    }
						 			}
echo $item_content;?></div>
						 	</div>
						 </div>
						</div> <!-- rmf -->
						
						
						
						
						<div id="ahrfhr">
							<?php 
							if(isset($id)&&($id==="admin")){
							?>
							<div id="modify"><a href="notice_write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><img src="./img/11.수정.png" style="width: 100%; height: 100%;"></a></div>
							<div id="del_rmf"><a href="javascript:del('notice_delete.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>')"><img src="./img/9.삭제.png" style="width: 100%; height: 100%;"></a></div>
							<?php 
							}
						    ?>
							<div id="list"><a href="notice.php?table=<?=$table?>&page=<?=$page?>"><img src="./img/7.목록.png" style="width: 100%; height: 100%;"></a></div>
						</div>

			<!-- 여 기 까 지 -->				
                         </div>
					</div>
			
			</section>
		</div>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html> 