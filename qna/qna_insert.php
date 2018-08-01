<?php
session_start();
include '../common_lib/common.php';

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

$id= $_SESSION['id'];


$subject= $_POST['subject'];
$content= $_POST['content'];

$page= $_GET['page'];

$regist_day= date("Y-m-d (H:i)");
$mode=$_GET['mode'];
$group_num= $_GET['group_num'];
$depth= $_GET['depth'];
$num=$_GET['num'];



// 답글 쓰기

if(isset($_GET['mode']) && $_GET['mode']==="reply"){
    // 부모 글 가져오기
    $sql = "select * from qna where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
    $group_num=$row['group_num'];
    $depth = $row['depth'];
    
    // 부모 글로 부터 group_num, depth, ord 값 설정
    $depth = $depth."D";
    $ord = $row[ord] + 1;
    
    // 해당 그룹에서 ord 가 부모글의 ord($row[ord]) 보다 큰 경우엔
    // ord 값 1 증가 시킴
    $sql = "update qna set ord = ord + 1 where group_num = $group_num and ord > $row[ord]";
    mysqli_query($con, $sql);
    
    // 레코드 삽입
    $sql = "insert into qna (group_num, depth, ord, id, subject, content, regist_day, hit) ";
    $sql .= "values($group_num, '$depth', $ord, '$id', '$subject', '$content', '$regist_day', 0)";
 
            // 글 수정일 때
}else if(isset($_GET['mode']) && $_GET['mode']==="update"){
    $num= $_GET['num'];
        

    $sql= "update qna set subject='$subject', content='$content' where num=$num";    
    $mode="수정";    
    
    // 새글 쓰기 일 때
}else{

    $sql= "select max(group_num) from qna";
    $result= mysqli_query($con, $sql) or die("2");
    $row=mysqli_fetch_array($result);
    $group_num=$row[0]+1;
    $depth= "D";
   
    $sql= "insert into qna (group_num, depth, ord, id , subject, content, regist_day, hit) values";
    $sql.= " ({$group_num}, '{$depth}', '1', '{$id}' , '{$subject}','{$content}', '{$regist_day}', 0)";
    
    

    
    
    $mode="새";
}


$result= mysqli_query($con, $sql) or die("adsfasdf".mysqli_error($con));

mysqli_close($con);

echo "<script> alert('$mode 글이 등록되었습니다. 페이지로 이동합니다.'); location.href='qna_list.php?page=$page'; </script>";

?>