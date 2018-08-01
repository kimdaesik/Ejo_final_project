<?php
session_start();
include '../../common_lib/common.php';

$user_phone=$_POST['pnum'];
$user_id=$_POST['id'];
$mode=$_GET['mode'];
srand((double)microtime()*1000000); //난수값 초기화
$_SESSION['pass']=rand(10000000,99999999);
$pass=$_SESSION['pass'];

$sms_phone=str_replace("-","", $user_phone);
$sms_phone=str_replace(" ","", $user_phone);

$sql="update membership set password='$pass' where id='$user_id'";
mysqli_query($con, $sql);


//건들지 마세요 ///////////////////////////////////////////////////////////////////////////////////////////////////
function SocketPost($posts){
    $host = "jmunja.com";
    $target = "/sms/app/api.php";
    $port = 80;
    $socket  = fsockopen($host, $port);
    if( is_array($posts) ) {
        foreach( $posts AS $name => $value )
            $postValues .= urlencode($name)."=".urlencode( $value )."&";
            $postValues = substr($postValues, 0, -1);
    }
    
    $postLength = strlen($postValues);
    $request = "POST $target HTTP/1.0\r\n";
    $request .= "Host: $host\r\n";
    $request .= "Content-type: application/x-www-form-urlencoded\r\n";
    $request .= "Content-length: ".$postLength."\r\n\r\n";
    $request .= $postValues."\r\n";
    fputs($socket, $request);
    
    $ret = "";
    while( !feof($socket) ){
        $ret .= trim(fgets($socket,4096));
    }
    fclose( $socket );
    $std_bar = ":header_stop:";
    return substr($ret,(strpos($ret,$std_bar)+strLen($std_bar)));
}

//건들지 마세요 ///////////////////////////////////////////////////////////////////////////////////////////////////

if($mode == "send"){
    //UTF-8로 데이터를 전송해야 합니다.
    //$hp = $_POST['hp'];
    //$name = $_POST['name'];
    //$title = $_POST['title'];
    //$message = $_POST['message'];
    
    
    $title = "임시비밀번호"; 
    $message = "임시번호는 [ $pass ] 입니다. 로그인후 꼭 변경 해주세요.";
    
    $array['mode']    = "send"; //'send' 고정
    $array['id']      = "kswoah123"; //제이문자 아이디 입력
    $array['pw']      = "62ac33ff4b43b6f390df291c22a71a"; //제이문자 API 인증키(로그인 비밀번호 아닙니다.!!!)
    $array['title']   = $title; //제목
    $array['message'] = $message; //내용
    $array['reqlist'] = $sms_phone."@".$name; //수신자: 휴대폰번호@이름|휴대폰번호@이름|휴대폰번호@이름
    
    $ret = SocketPost($array);
    if($ret) echo "<script>window.close();</script>";
    else echo "발송 실패";
    exit;
}


?>