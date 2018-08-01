<meta charset="utf-8">
<?php
include "../../common_lib/common.php";

if (empty($_GET['num'])) {$num = "";} else {$num = $_GET['num'];}
if (empty($_GET['select'])){$select = "facility";} else {$select = $_GET['select'];}
if (empty($_GET['page'])) {$page = 1;} else {$page = $_GET['page'];}


if (empty($_POST['action'])) {$action = "";} else {$action = $_POST['action'];}
if (empty($_POST['select_name'])) {$select_name="";} else {$select_name=$_POST['select_name'];}
if (empty($_POST['select_time'])) {$select_time = "";} else {$select_time = $_POST['select_time'];}
if (empty($_POST['select_phone_num'])) {$select_phone_num = "";} else {$select_phone_num = $_POST['select_phone_num'];}
if (empty($_POST['select_location'])) {$select_location = "";} else {$select_location = $_POST['select_location'];}
if (empty($_POST['select_explanation'])) {$select_explanation = "";} else {$select_explanation = $_POST['select_explanation'];}
if (empty($_FILES['upfile'])) {$files = "";} else {$files = $_FILES['upfile'];}

///////////////////삭제///////////////////////////////////////////////////////
if($action=='delete'){
    $sql = "delete from resortinfo where num=$num";
}
///////////////////추가///////////////////////////////////////////////////////
if($action=='add'){
    $upload_dir = '../common_data/resort/';
    $upload_dir2= '../../common_data/resort/';
    $count = count($files["name"]);
    
    for ($i=0; $i<$count; $i++)
    {
        $upfile_name[$i]     = $files["name"][$i];
        $upfile_tmp_name[$i] = $files["tmp_name"][$i];
        $upfile_type[$i]     = $files["type"][$i];
        $upfile_size[$i]     = $files["size"][$i];
        $upfile_error[$i]    = $files["error"][$i];
        
        $file = explode(".", $upfile_name[$i]);
        $file_name = $file[0];
        $file_ext  = $file[1];
        
        if (!$upfile_error[$i])
        {
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name."_".$i;
            $copied_file_name[$i] = $new_file_name.".".$file_ext;
            $uploaded_file[$i] = $upload_dir.$copied_file_name[$i];
            $uploaded_file2[$i] = $upload_dir2.$copied_file_name[$i];
            
            if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file2[$i]) )
            {
                echo("
    					<script>
    					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
    					history.go(-1)
    					</script>
    				");
                exit;
            }
        }
    }
 
    $sql = "insert into resortinfo (type, name, time, phone_num, location, explanation, picture)";
    $sql .= "values('$select', '$select_name', '$select_time', '$select_phone_num', '$select_location', '$select_explanation', '$uploaded_file[0]')";
 
}
///////////////////수정///////////////////////////////////////////////////////
if($action=='update'){
    $upload_dir = '../common_data/resort/';
    $upload_dir2= '../../common_data/resort/';
    $count = count($files["name"]);
    
    for ($i=0; $i<$count; $i++)
    {
        $upfile_name[$i]     = $files["name"][$i];
        $upfile_tmp_name[$i] = $files["tmp_name"][$i];
        $upfile_type[$i]     = $files["type"][$i];
        $upfile_size[$i]     = $files["size"][$i];
        $upfile_error[$i]    = $files["error"][$i];
        
        $file = explode(".", $upfile_name[$i]);
        $file_name = $file[0];
        $file_ext  = $file[1];
        
        $delete_field = "picture";
        $delete_name = $row[$delete_field];
        $delete_path = "../../common_data/resort/".$delete_name;
        
        unlink($delete_path);
        
        if (!$upfile_error[$i])
        {
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name."_".$i;
            $copied_file_name[$i] = $new_file_name.".".$file_ext;
            $uploaded_file[$i] = $upload_dir.$copied_file_name[$i];
            $uploaded_file2[$i] = $upload_dir2.$copied_file_name[$i];

            if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file2[$i]) )
            {
                echo("
    					<script>
    					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
    					history.go(-1)
    					</script>
    				");
                exit;
            }
        }
    }
    
    $sql = "update resortinfo set name = '$select_name', time= '$select_time', phone_num='$select_phone_num', location='$select_location', explanation='$select_explanation', picture='$uploaded_file[0]'  where num=$num";
}
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
mysqli_query($con, $sql);
mysqli_close($con);

echo "
	   <script>
	    location.href = '../admin.php?mode=admin_resort_edit&select=$select&page=$page';
	   </script>
	";

?>