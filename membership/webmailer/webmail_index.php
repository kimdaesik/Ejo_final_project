<?php
require_once("PHPMailer/class.phpmailer.php");
require_once("PHPMailer/class.smtp.php");
$email1=$_GET['email1'];
$email2=$_GET['email2'];

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP(); 		// telling the class to use SMTP
try {
    $mail->CharSet = "utf-8";	// set charset to utf8
    $mail->Host = "smtp.gmail.com"; 	// email 보낼때 사용할 서버를 지정
    $mail->SMTPAuth = true; 	// SMTP 인증을 사용함
    $mail->Port = 465; 		// email 보낼때 사용할 포트를 지정 465 587
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPSecure = "ssl"; 	// SSL을 사용함  tls
    $mail->Username   = "dldbfla524@gmail.com"; 	// gmail 계정
    $mail->Password   = "chfhddl0629^^"; 			// 패스워드
    
    $mail->SetFrom('dldbfla524@gmail.com', '이조 리조트'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    $mail->AddAddress($email1.'@'.$email2, '받는사람'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    $mail->Subject = '회원가입 인증번호'; // 메일 제목
    
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

    $rand=rand(100000,999999);
// 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
    //$mail->MsgHTML(file_get_contents('basic.html'));
    $mail->Body    = '이조리조트 회원가입 인증번호 ['.$rand.']';

$mail->Send();

}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
</head>
<script>
var count=180;
var myVar;
    function check_num(a,b,c){
    	if(a==document.getElementById("number").value){
    		alert("인증되었습니다.");
    		opener.join_form.hidden_e1.value=b;
    		opener.join_form.hidden_e2.value=c;
    		window.close();
    	}else{
    		alert("다시 입력해주세요.");
    	}
    }
    function myFunction() {
	    var min= parseInt(count/60);
	    var sec= count%60;
	   	    count--;
		document.getElementById('conf_time').innerHTML="("+min+":"+sec+")";
	    
	    if(!count){
	       alert('시간초과');
	       window.close();
	    }
	    myVar = setTimeout(myFunction, 1000);
	}
    function close1() {
    	window.close();
    }
</script>
<body onload="myFunction()">
	<div style="background-color: #088a99; width: 100%; text-align: center; height: 38px; font-size: 18pt; color: #FFFFFF;">이메일 인증</div>
	<br>
	<div style="display: inline;">인증번호</div>
	<input style="width: 64%;" type="text" id="number"></input><div id="conf_time" style="color : blue;display: inline;"></div><br>
	<div style="text-align: center;">
		<br>
    	<input type="button" value="인증" onclick="check_num('<?=$rand?>','<?=$email1?>','<?=$email2?>')"></input>
    	<input type="button" value="취소" onclick="close1()"></input>
	</div>
</body>
</html>
