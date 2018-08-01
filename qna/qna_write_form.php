<?php
session_start();
include '../common_lib/common.php';

    //답글
if(isset($_GET['mode']) && $_GET['mode']==="reply"){
    $mode= "reply";
    $group_num= $_GET['group_num'];
    $num= $_GET['num'];
    $sql= "select * from qna where num=$num";
    $result= mysqli_query($con, $sql);
    $row= mysqli_fetch_array($result);
    $depth= $row['depth'];
    if($depth=="D"){
       $subject= "&nbsp;&nbsp;└[Re]".$row['subject'];
    }else{
       $subject= "&nbsp;&nbsp;&nbsp;".$row['subject'];
    }
    
    $content= "\n\n\n\n\n\n==================\n".$row['content'];   
    
    
    //수정일 시
}else if(isset($_GET['mode']) && $_GET['mode']==="update"){
    $mode="update";
    $num= $_GET['num'];
    $sql= "select * from qna where num=$num";
    $result= mysqli_query($con, $sql);
    $row= mysqli_fetch_array($result);
    
    $id= $row['id'];
    $subject= $row['subject'];
    $content= $row['content'];
}

?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/qna.css?v=5">
<link type="text/css" rel="stylesheet"
   href="../common_css/project_style.css?v=1">
   
<script type="text/javascript">
function button_click(){
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
<!-- 여기서부터 시작 -->


	      
	    <?php 
        if(isset($_GET['mode']) && $mode==="reply"){
        ?>
		<form name = "board_form" action="qna_insert.php?num=<?=$num?>&group_num=<?=$group_num?>&mode=<?=$mode?>&page=<?=$page?>&depth=<?=$depth?>" method="post">
		<?php 
        }else if(isset($_GET['mode']) && $mode==="update"){
		?>
		<form name = "board_form" action="qna_insert.php?num=<?=$num?>&mode=<?=$mode?>&page=<?=$page?>" method="post">
		<?php 
        }else{
		?>
		<form name = "board_form" action="qna_insert.php?page=<?=$page?>" method="post">
		<?php 
        }
        ?>
		
	      
	      <table id="qna_input_table" border="0" cellspacing="2" cellpadding="5">
			
			<tr bgcolor="#088a99">
				<td align="center" width="55"  height="30">아이디</td>
				<td width="788" height="20"> <?=$id?> </td>
			</tr>
		
			<tr>
				<td align="center" bgcolor="#088a99" >제목</td>
				<td height="20">
					<input type="text" id="sub" name="subject" size="108" value="<?=$subject?>">
				</td>				
			</tr>
			
			<tr>
				<td align="center" bgcolor="#088a99">내용</td>
				<td><textarea name="content" cols="110" rows="25"><?=$content?></textarea></td>
			</tr>
			
			<tr>
				<td height="30"></td>
				<td>
				</td>
			</tr>
			
        </table>
        <div align="center">
			
			<input type="image" src="./img/write2.png" onclick="button_click()">
			<a href="./qna_list.php"><img src="./img/cancel.png"></a>
   		</div>
               </form>
            
     
     
 <!-- 여기가 끝 -->    
         </section>
      </div>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html>