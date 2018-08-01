<?php 
include '../common_lib/common.php'; 

if(isset($_GET['id'])){
    $id= $_GET['id'];
}else{
    $id="";
}

$sql="select * from membership where id='$id'";

$result= mysqli_query($con, $sql);
$row= mysqli_fetch_array($result);
if(strlen($id) >= 6 && strlen($id) <= 12){
    $num_record= mysqli_num_rows($result);
}else{
    $num_record=1;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href=../css/join.css rel=stylesheet>
	<link type="text/css" rel="stylesheet" href="./css/joinform.css?v=12">
</head>
<script>
	// 요소 검사 함수
	function check_exp(elem, exp, msg){
		if(!elem.value.match(exp)){
			alert(msg);
			return true;
		}
	}
	//아이디 검사
	function id_check(){
    	var exp_id= /^[0-9a-zA-Z]{6,12}$/;
    	var id_val= document.id_check_form.id.value;
		if(!id_val){
			alert("ID를 입력해주세요");
			return ;
		}
    	if(check_exp(document.id_check_form.id, exp_id, "ID는 6~12자리 영문 또는 숫자만 입력해주세요!")){
    		document.id_check_form.id.focus();
    		document.id_check_form.id.select();
    		return ;
    	}
    	document.id_check_form.submit();
	}
	
	function id_use(a){
		opener.join_form.hidden.value=a;
		opener.join_form.hidden_ok.value="yes";
		window.close();
	}
	
	function closer(){
		opener.join_form.id.value="";
		window.close();
	}

</script>
<body>
	<div id=wrap style="text-align: center;">
		<?php 
		if($num_record){
		?>
		<div id=text2 align=center>
			<b>입력하신 '<font color=red><?=$id?></font>'는 <font color=red>사용할 수 없는</font> 아이디입니다.<br>
				새로운 아이디로 선택해 주십시오.</b>
		</div>
		<a href="#"><div class="input_div" onclick="closer()">닫기</div></a>
		<?php 
		}else{
		?>
		<div id=text2 align=center>
			<b>입력하신 '<font color=red><?=$id?></font>'는 사용하실 수 있습니다.<br>
				이 아이디를 사용하시겠습니까?</b><br><br>
			<a href="#"><div class="input_div" onclick="id_use('<?=$id?>')">사용하기</div></a>
			<a href="#"><div class="input_div" onclick="closer()">닫기</div></a>
		</div>
		<?php
		}
		?>
	</div>
</body>
</html>
<?php
    mysqli_close($con);
?>


