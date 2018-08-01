<?php
session_start();
include '../common_lib/common.php';

$num= $_GET['num'];
$page= $_GET['page'];

$sql= "select * from qna where num=$num";
$result= mysqli_query($con, $sql) or die(mysqli_error($con));
$row= mysqli_fetch_array($result);
$group_num= $row['group_num'];
$item_id= $row['id'];   
$content= $row['content'];
$content=str_replace(" ", "&nbsp;", $content);
$content=str_replace("\n", "<br>", $content);
$regist_day= $row['regist_day'];
$hit= $row['hit']+1; 
$subject=$row['subject'];


$sql= "update qna set hit=$hit where num=$num";
mysqli_query($con, $sql) or die(mysqli_error($con));

$sql2= "select id from qna where group_num=$group_num";
$result2= mysqli_query($con, $sql2) or die(mysqli_error($con));
$row2= mysqli_fetch_array($result2);
$id2= $row2['id'];

?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/qna.css?v=21">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=1">
<script type="text/javascript"></script>
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
<b>──────&nbsp;&nbsp;Question & Answer&nbsp;&nbsp;──────</b>
</p>
<div id="notice2">
<a href="../customer/notice.php?"><img src="./img/16.공지사항(3).png" style="width: 100%; height: 100%;"></a>
</div>
<div id="qna2">
<a href="qna_list.php?"><img src="./img/17.Q&A(3).png" style="width: 100%; height: 100%;"></a>
</div>
</div><br><br>
<div id="noti1">이조리조트에 관해 궁금하신점을 질문하세요.</div>
	<div align="center">
<!-- 여기서부터 시작 -->

        	<div id="qna_view_content"> 	<!-- 글 읽는 전체 틀 -->
<div id="qna_view_main">
	<div id="qna_view_title">
	<img src="./img/제목.jpg" style="width: 100%; height: 100%;">
		</div> <!-- title -->
		<div id="qna_view_title_1">
			<div id="qna_view_title_2">
				<?=$subject?>
			</div><!-- wpahrsodyd -->
			<div id="qna_view_title_name"><?=$row['id']?></div>
			<div id="qna_view_title_hit"><?=$hit?></div>
		<div id="qna_view_day"><?=$regist_day?></div>
		</div> 
	 </div> 
		 
		 <div id="qna_view_content_main">
	 	
	 	<div id="qna_view_content_title">
	 		<img src="./img/내용.jpg" style="width: 100%; height: 100%;">
	 	</div>
	 	<div id="qna_view_content_content">

 		<div id="qna_view_content_1"><?=$content?>
			</div>
        	
        	<br><br></div>
        	<div id="qna_link">
        		<?php 
        		if(isset($_SESSION['id'])){
      
            		if($_SESSION['id']===$item_id || $_SESSION['id']==="admin"){
        		    ?>
            		<a href="qna_delete.php?page=<?=$page?>&num=<?=$num?>"><img src="./img/delete.png"></a>
            		<a href="qna_write_form.php?page=<?=$page?>&num=<?=$num?>&mode=update"><img src="./img/modify.png"></a>
            	<?php 
        		    }
            		if($_SESSION['id']==="admin"){
        		    ?>
            		<a href="qna_write_form.php?page=<?=$page?>&group_num=<?=$group_num?>&num=<?=$num?>&mode=reply"><img src="./img/reply.png"></a>
                 <?php
                    }
        		}
            		?>
                <a href="qna_list.php?page=<?=$page?>"><img src="./img/list.png"></a>
        	</div>
        </div>
    	
    	
	   
     
     
 <!-- 여기가 끝 -->    
         </section>
      </div>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html>