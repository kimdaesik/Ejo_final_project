<meta charset="utf-8">
<?php

include "./common_lib/common.php";

//=====================회원가입==================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인: ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="membership"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table membership(
    id char(12) not null primary key,
    password char(16) not null,
    name char(10) not null,
    phone1 char(13) not null,
    phone2 char(13) not null,
    phone3 char(13) not null,
    zip char(10) not null,
    gender char(10) not null,
    address char(200) not null,
    birth_year int(4) not null,
    birth_month int(2) not null,
    birth_day int(2) not null,
    email char(30) not null,
    used_money int(10) not null,
    level varchar(20) not null
    )charset utf8";
    if(mysqli_query($con, $sql)){
//         echo "<script>alert('membership 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

//======================공지사항====================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="notice"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table notice(
   num int not null auto_increment,
   id char(12) not null,
   name char(12) not null,
   division varchar(20) not null,
   subject varchar(200) not null,
   content varchar(200) not null,
   regist_day char(20) not null,
   hit int default 0,
   file_name_0 varchar(100),
   file_copied_0 varchar(100),
   file_name_1 varchar(100),
   file_copied_1 varchar(100),
   primary key(num)
   )charset utf8";
   if(mysqli_query($con, $sql)){
       //         echo "<script>alert('notice 테이블 생성성공')</script>";
   }else{
       echo "실패원인 : ".mysqli_error($con);
   }
}

//===============Q&A===============================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="qna"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table qna(
   num int not null auto_increment,
   group_num int not null default 0,
   depth char(10) default 'D',
   ord char(10) not null,
   id char(12) not null,
   subject varchar(20) not null,
   content text not null,
   regist_day char(20) not null,
   hit int default 0,
   primary key(num)
   )charset utf8";
    if(mysqli_query($con, $sql)){
//         echo "<script>alert('qna 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

  //==============매출========================================
  $flag = "NO";
  $sql = "show tables from projectDB";
  $result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
  while($row = mysqli_fetch_row($result)){
    if($row[0]=="sales"){
      $flag = "OK";
      break;
    }
  }
  if($flag!=="OK"){
    $sql = "create table sales(
    num int not null auto_increment,
    id varchar(30) not null,
    place varchar(15) not null,
    money int not null default 0,
    regist_day char(20),
    item_year char(20),
    item_month char(20),
    item_day char(20),
    primary key(num)
    )charset utf8";
    if(mysqli_query($con, $sql)){
//       echo "<script>alert('sales 테이블 생성성공')</script>";
    }else{
      echo "실패원인 : ".mysqli_error($con);
    }
  }

  //=======================객실===========================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="room"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table room(
    num int not null auto_increment, 
    room_type varchar(10) not null,
    primary key(num)
    )charset utf8";
    if(mysqli_query($con, $sql)){
//         echo "<script>alert('room 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}


//=======================객실정보===========================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="roominfo"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table roominfo(
    num int not null auto_increment,
    type varchar(20) not null,
    normal_price int(20) not null,
    normal_price_weekend int(20) not null,
    vip_price int(20) not null,
    vip_price_weekend int(20) not null,
    room_num int(15),
    people_num varchar(15),
    area_m2 int(10),
    area_peung int(10),
    component_living int(10),
    component_toilet int(10),
    component_room int(10),
    picture0 varchar(100),
    picture1 varchar(100),
    picture2 varchar(100),
    picture3 varchar(100),
    primary key(num)
    )charset utf8";
    if(mysqli_query($con, $sql)){
//         echo "<script>alert('roominfo 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

//=======================부대시설정보===========================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="resortinfo"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table resortinfo(
    num int not null auto_increment,
    type varchar(10) not null,
    name varchar(30) not null,
    time varchar(200),
    phone_num varchar(20) not null,
    location varchar(30) not null,
    explanation varchar(1000),
    picture varchar(100),
    primary key(num)
    )charset utf8";
    if(mysqli_query($con, $sql)){
//         echo "<script>alert('resortinfo 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

//======================이벤트(수정)====================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="event"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table event(
   num int not null auto_increment,
   id char(12) not null,
   name char(12) not null,
   division varchar(20) not null,
   subject varchar(200) not null,
   content varchar(200) not null,
   regist_day char(20) not null,
   choice varchar(3) not null,
   file_name_0 varchar(100),
   file_copied_0 varchar(100),
   file_name_1 varchar(100),
   file_copied_1 varchar(100),
   primary key(num)
   )charset utf8";
    if(mysqli_query($con, $sql)){
        //         echo "<script>alert('notice 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

//=======================예약하기===========================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="reserve"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table reserve(
    num int not null auto_increment,
    id varchar(20) not null,
    reserve_start varchar(20) not null,
    reserve_end varchar(20) not null,
    room_type varchar(20) not null,
    room_num varchar(10) not null,
    payment varchar(15) not null,
    money varchar(10) not null,
    primary key(num)
    )charset utf8";
    if(mysqli_query($con, $sql)){
        //         echo "<script>alert('resortinfo 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}

//=======================이용안내===========================
$flag = "NO";
$sql = "show tables from projectDB";
$result = mysqli_query($con, $sql) or die("실패원인: ".mysqli_error($con));
while($row = mysqli_fetch_row($result)){
    if($row[0]=="use_guide"){
        $flag = "OK";
        break;
    }
}

if($flag!=="OK"){
    $sql = "create table use_guide(
    num int auto_increment primary key,
    file_name varchar(30)
    
    )charset utf8";
    if(mysqli_query($con, $sql)){
        //         echo "<script>alert('use_guide 테이블 생성성공')</script>";
    }else{
        echo "실패원인 : ".mysqli_error($con);
    }
}
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
mysqli_close($con);
?>