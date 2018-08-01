<?php
include '../common_lib/common.php';

session_start();


?>
<html>
<head>
<meta charset="UTF-8">
<title>비밀번호 변경</title>
<link type="text/css" rel="stylesheet" href="./css/pw_modify.css?v=4">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=3">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
function check_exp2(elem, exp, msg ){
	if(!exp.test(elem)){	
		$("#pw_check_text1").text(msg);
		return true;
	}
}
$(document).ready(function() {
    $("#change_input_1").keyup(function(){
    	var exp_pass= /^[0-9a-zA-Z~!@#$%^&*()]{8,16}$/;
    	if(check_exp2($(this).val(), exp_pass, "적절한 비밀번호가 아닙니다.")){
    		return ;
    	}
    		$("#pw_check_text1").text(" 비밀번호 가능");
    })
    
    $("#change_input_2").keyup(function(){
    	
    	if($("#change_input_1").val() === $("#change_input_2").val()){	
    		$("#pw_check_text2").text(" 비밀번호 일치");
    		return;
    	}
    		$("#pw_check_text2").text(" 비밀번호 불일치");
    })
});


function check_exp(elem, exp, msg){
	if(!elem.value.match(exp)){
		alert(msg);
		return true;
	}
}


function check_input(){
	if(!document.pw_modify.current_input.value){
		alert("현재 비밀번호를 입력하세요!");
		return;
	}
	if(!document.pw_modify.pass1.value){
		alert("변경하실 비밀번호를 입력하세요!");
	    document.pw_modify.pass1.focus();
	    document.pw_modify.pass1.select();
		return;
	}	
	if(!document.pw_modify.pass2.value){
		alert("변경하실 비밀번호를 입력하세요!");
	    document.pw_modify.pass2.focus();
	    document.pw_modify.pass2.select();
		return;
	}

	var exp_pass= /^[0-9a-zA-Z~!@#$%^&*()]{8,12}$/;
	if(check_exp(document.pw_modify.pass1, exp_pass, "암호는 8~12자리 영문 또는 숫자만 입력해주세요!")){
		document.pw_modify.pass1.focus();
		document.pw_modify.pass1.select();
		return ;
	}
	if(check_exp(document.pw_modify.pass2, exp_pass, "암호는 8~12자리 영문 또는 숫자만 입력해주세요!")){
		document.pw_modify.pass2.focus();
		document.pw_modify.pass2.select();
		return ;
	}
	
    if(document.pw_modify.pass1.value != document.pw_modify.pass2.value) {
      alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
      document.pw_modify.pass2.focus();
      document.pw_modify.pass2.select();
      return;
    }	  
    document.pw_modify.submit();

}
</script>
</head>
<body>
	<div id="pw_frame">
		<div id="pw_change_logo"><h2>비 밀 번 호 변 경</h2></div>
	<form name="pw_modify" method="post" action="./pw_form.php" >
		<div id="current_pw_name">현재비밀번호</div>
		<div id="current_pw">
			<input type="password" id="current_input" name="old_pass">
		</div>
		<div id="pw_space"></div>
		<div id="pw_limit">8~12자리의 영문/숫자 또는 영문/숫자/특수문자 혼용</div>
		<div id="change_pw_name_1">변경할 비밀번호</div>
		<div id="change_pw_1"><input type="password" id="change_input_1" name="pass1"><span id="pw_check_text1"></span></div>
		<div id="change_pw_name_2">비밀번호 확인</div>
		<div id="change_pw_2"><input type="password" id="change_input_2" name="pass2"><span id="pw_check_text2"></span></div>

		</form>
		<button id="change_pw_submit" onclick="check_input()">비밀번호 변경</button>

	</div>
</body>
</html>
