<?php
session_start();
include '../common_lib/common.php';
$id=$_SESSION['id'];

$reserve_startday=$_POST["reserve_startday"];
$yyyy=substr($reserve_startday,0,4);
$mm=substr($reserve_startday,4,2);
$day=substr($reserve_startday,6,2);
$price=$_POST['price'];
$days=(int)$_POST['days'];
$reserve_type=$_POST['reserve_type'];

$compare=($yyyy.$mm.$day);
$reserve_start2=(int)$compare;
$reserve_end2=0;
$a=0;
$count=0;
$count2=0;
$room_num=0;

$sql = "select * from room where room_type='$reserve_type'";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
$total_room_num=mysqli_num_rows($result);



for($i=1;$i<=$total_room_num;$i++){
    $sql = "select reserve_start,reserve_end from reserve where room_type='$reserve_type' and room_num='$i'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $num=mysqli_num_rows($result);
    $count=0;
    $count2=0;
    
    if($num==0){
        $a++;
        $room_num=$i;
        $reserve_end2=date("Ymd",(mktime(0,0,0,$mm,$day,$yyyy)+(86400*($days-1))));
        break;
    }else{
        $sql = "select * from reserve where reserve_start<='$compare' and reserve_end>='$compare' and room_type='$reserve_type' and room_num='$i'";
        $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
        $num=mysqli_num_rows($result);
        
        if($num==0){//true
            for($j=0;$j<$days;$j++){
                $compare=date("Ymd",(mktime(0,0,0,$mm,$day,$yyyy)+(86400*$j)));
                //$compare=(((int)$compare)+$j); //날짜 증가하며 비교
                $sql = "select * from reserve where reserve_start<='$compare' and reserve_end>='$compare' and room_type='$reserve_type' and room_num='$i'";
                $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
                $num=mysqli_num_rows($result);
                if($num==0){
                    $count2++;
                    if($days==1){$count2=1; break;}
                    continue;
                }else{
                    $count++; break;
                }
            }
            if($count!=0)continue;
        }else{
            continue;
        }
    }
    if($count2==$days){
        $reserve_end2=$compare;
        $room_num=$i;
        break;
    }
}




if($a!=0){
    $sql= "insert into reserve (id, reserve_start, reserve_end, room_type, room_num, payment, money) ";
    $sql.= "values ('$id', '$reserve_start2', '$reserve_end2', '$reserve_type', '$room_num', '카카오', '$price')";
    mysqli_query($con, $sql) or die("1".mysqli_error($con));
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    $sql= "insert into sales (id, place, money, regist_day) ";
    $sql.= "values ('$id', '$reserve_type', '$price', '$reserve_start2')";
    mysqli_query($con, $sql) or die("1".mysqli_error($con));
    
    $sql = "select used_money from membership where id='$id'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $row=mysqli_fetch_array($result);
    $used_money=$row['used_money'];
    $used_money+=$price;
    
    $sql = "UPDATE membership SET used_money='$used_money' WHERE id='$id';";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    
    $sql = "UPDATE membership SET level='vip' WHERE used_money>=5000000;";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    echo "<script>alert('예약이 완료되었습니다.')</script>";
    echo "<script> location.href='../index.php'; </script>";
}
if(($count2)==$days){
    $sql= "insert into reserve (id, reserve_start, reserve_end, room_type, room_num, payment, money) ";
    $sql.= "values ('$id', '$reserve_start2', '$reserve_end2', '$reserve_type', '$room_num', '카카오', '$price')";
    mysqli_query($con, $sql) or die("2".mysqli_error($con));
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql= "insert into sales (id, place, money, regist_day) ";
    $sql.= "values ('$id', '$reserve_type', '$price', '$reserve_start2')";
    mysqli_query($con, $sql) or die("1".mysqli_error($con));
    
    $sql = "select used_money from membership where id='$id'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $row=mysqli_fetch_array($result);
    $used_money=$row['used_money'];
    $used_money+=$price;
    
    $sql = "UPDATE membership SET used_money='$used_money' WHERE id='$id';";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    
    $sql = "UPDATE membership SET level='vip' WHERE used_money>=1500000;";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    echo "<script>alert('예약이 완료되었습니다.')</script>";
    echo "<script> location.href='../index.php'; </script>";
}else{
    echo "<script>alert('예약가능한 불가능한날이 있습니다.')</script>";
    echo "<script> location.href='../index.php'; </script>";
}

$sql="select phone1,phone2,phone3 from membership where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

$phone=$row['phone1'].$row['phone2'].$row['phone3'];

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

//UTF-8로 데이터를 전송해야 합니다.
//$hp = $_POST['hp'];
//$name = $_POST['name'];
//$title = $_POST['title'];
//$message = $_POST['message'];


$title = "예약정보";
$message = "[이조 리조트]";
$message .= "예약일 :$reserve_start2 / 방 타입 : $reserve_type / 입실 : 14:00 / ";
$message .= "오시는길 : ";
$message .= "[ https://hoy.kr/1Ox0 ]";

$array['mode']    = "send"; //'send' 고정
$array['id']      = "kswoah123"; //제이문자 아이디 입력
$array['pw']      = "62ac33ff4b43b6f390df291c22a71a"; //제이문자 API 인증키(로그인 비밀번호 아닙니다.!!!)
$array['title']   = $title; //제목
$array['message'] = $message; //내용
$array['reqlist'] = $phone."@".$name; //수신자: 휴대폰번호@이름|휴대폰번호@이름|휴대폰번호@이름

$ret = SocketPost($array);
if($ret) echo "<script> location.href='../index.php'; </script>";
else echo "발송 실패";
exit;
?>






