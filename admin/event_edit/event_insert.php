<?php
session_start();
include "../../common_lib/common.php";


if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
    $num = $_GET["num"];
    $page = $_GET["page"];
    $table = $_GET["table"];
    $division = $_POST['division'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
}

if(isset($_POST['subject'])){
    $subject=$_POST['subject'];
}
if(isset($_POST['content'])){
    $content=$_POST['content'];
}
if(isset($_POST['division'])){
    $division=$_POST['division'];
}
if(isset($_GET['table'])){
    $table = $_GET["table"];
}
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $name=$_SESSION['name'];
}
if(!$id){
    echo ("
        <script>
        window.alert('로그인 후 이용해 주세요')
        history.go(-1)
        </script>
");
    exit();
}
$regist_day = date("Y-m-d");       // 날짜를 받아옴.
if(isset($_FILES["upfile"])){           // 파일이 있을 경우
    $files=$_FILES["upfile"];
    
    $count = count($files["name"]); //파일의 갯수를 가지고 옴
    $upload_dir='../../common_data/event/';         // 데이터를 저장시켜줄 경로를 지정
    for($i=0;$i<$count;$i++){       // 파일의 갯수만큼 반복함.
        $upfile_error=null;         // 초기값 설정
        if(!empty($files["name"][$i])){             // 파일의 값이 있을경우
            $upfile_name[$i]=$files["name"][$i];    // 업로드된 파일명
            $upfile_tmp_name[$i] = $files["tmp_name"][$i];  // 복사될 값을 넣어줌
            $upfile_type[$i]=$files["type"][$i];        // 파일의 타입
            $upfile_size[$i]=$files["size"][$i];        // 파일의 사이즈
            $upfile_error[$i]=$files["error"][$i];      // 오류
            
            $file=explode(".",$upfile_name[$i]);//.을 기점으로 배열로 나누겠다
            $file_name=$file[0];        // 파일명
            $file_ext=$file[1];         // 파일 확장자
            if(!$upfile_error[$i]){     // 해당 변수의 값이 없을 경우
                $new_file_name=date("Y_m_d_h_i_s");     // 날짜와 시간을 저장
                $new_file_name=$new_file_name."_".$i;   // 날짜와 i의 값을 저장함.
                $copied_file_name[$i]=$new_file_name.".".$file_ext; // 새로운 파일명과 확장자명을 저장
                $upload_file[$i]=$upload_dir.$copied_file_name[$i]; // 파일의 경로에 저장
             
                if(!move_uploaded_file($upfile_tmp_name[$i],$upload_file[$i])){
                   echo ("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.')
                history.go(-1);
               </script> 
                "); 
                   
                }
                
            }
        }
    }
}else{
    $file_name="";
    $file_ext="";
}
if(isset($mode) && $mode === "modify"){ //글수정
    if(isset($_POST["del_file"])){ //그림을 삭제하려고 체크
        $num_checked=count($_POST["del_file"]); //체크한 개수
        $position=$_POST["del_file"]; //체크된것들이 배열형태로 저장
        for($i=0 ; $i<$num_checked ; $i++){     // 체크된 값만큼 반복한다.
            $index = $position[$i];             // 해당 배열의 값을 저장시킴
            $del_ok[$index]="y";
        }
        
    }
    $sql = "select * from event where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
    for($i=0 ; $i<$count ; $i++){ //파일전체개수 만큼 반복 , 테이블에 업뎃하기위해
        $field_org_name="file_name_".$i;
        $field_real_name="file_copied_".$i;
        
        if(!empty($copied_file_name[$i])){
            $org_real_value=$copied_file_name[$i];
        }
        if(isset($del_ok) && $del_ok[$i] == "y"){
            $delete_field = "file_copied_".$i;
            $delete_name = $row[$delete_field];
            $delete_path = "../../common_data/event".$delete_name;
            unlink($delete_path); //data폴더에서 제거
            $sql="update event set $field_org_name='',$field_real_name='' where num=$num";
            mysqli_query($con, $sql);
        }else{
            if(!$upfile_error[$i] && isset($upfile_name[$i])){
                $sql = "update event set $field_org_name='$upfile_name[$i]',$field_real_name='$org_real_value' where num=$num";
                mysqli_query($con, $sql);
            }
        }
    }
    $sql="update event set subject='$subject',content='$content' where num=$num";
    mysqli_query($con, $sql);
    
}else{
    $sql="insert into event (id,name,division,subject,content,regist_day,choice,file_name_0,file_name_1,file_copied_0,file_copied_1)";
    $sql.="values('$id','$name','$division','$subject','$content','$regist_day','n',";
    for($i=0;$i<$count;$i++){
        if($files["name"][$i]!=""){
            $sql.= "'{$upfile_name[$i]}', ";
        }else{
            $sql.= "'', ";
        }
    }
    for($i=0;$i<$count;$i++){
        if($files["name"][$i]!=""){
            if($i==$count-1){
                $sql.= "'$copied_file_name[$i]')";
            }else{
                $sql.= "'$copied_file_name[$i]', ";
            }
            
        }else{
            if($i==$count-1){
                $sql.= "'')";
            }else{
                $sql.= "'', ";
            }
        }
    }
    
    mysqli_query($con, $sql) or die("실패원인123 :".mysqli_error($con));
}
mysqli_close($con);

echo "
	   <script>
	    location.href = '../admin.php?mode=admin_event_edit&page=$page';
	   </script>
	";
?>