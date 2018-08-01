<meta charset="utf-8">
<?php 
include "../../common_lib/common.php";

if (empty($_GET['num'])) {$num = "";} else {$num = $_GET['num'];}
if (empty($_GET['select'])){$select = "family";} else {$select = $_GET['select'];}

if (empty($_POST['room_num'])) {$room_num = "";} else {$room_num = $_POST['room_num'];}
if (empty($_POST['people_num'])) {$people_num="";} else {$people_num=$_POST['people_num'];}
if (empty($_POST['area_peung'])) {$area_peung = "";} else {$area_peung = $_POST['area_peung'];}
if (empty($_POST['area_m2'])) {$area_m2 = "";} else {$area_m2 = $_POST['area_m2'];}
if (empty($_POST['component_living'])) {$component_living = "";} else {$component_living = $_POST['component_living'];}
if (empty($_POST['component_room'])) {$component_room = "";} else {$component_room = $_POST['component_room'];}
if (empty($_POST['component_toilet'])) {$component_toilet = "";} else {$component_toilet = $_POST['component_toilet'];}
if (empty($_POST['normal_price'])) {$normal_price = "";} else {$normal_price = $_POST['normal_price'];}
if (empty($_POST['vip_price'])) {$vip_price = "";} else {$vip_price = $_POST['vip_price'];}
if (empty($_POST['normal_price_weekend'])) {$normal_price_weekend = "";} else {$normal_price_weekend = $_POST['normal_price_weekend'];}
if (empty($_POST['vip_price_weekend'])) {$vip_price_weekend = "";} else {$vip_price_weekend = $_POST['vip_price_weekend'];}

$files = $_FILES['upfile'];

$upload_dir = '../common_data/room/';
$upload_dir2= '../../common_data/room/';

$num_checked = count($_POST['del_file']);
$position = $_POST['del_file'];


$sql = "select * from roominfo where type=$select";   // get target record
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

for($i=0; $i<$num_checked; $i++)         // delete checked item
{
    $index = $position[$i];
    $del_ok[$index] = "y";
}
for ($i=0; $i<4; $i++)
{
    $upfile_name[$i]     = $files["name"][$i];
    $upfile_tmp_name[$i] = $files["tmp_name"][$i];
    $upfile_type[$i]     = $files["type"][$i];
    $upfile_size[$i]     = $files["size"][$i];
    $upfile_error[$i]    = $files["error"][$i];
    
    $file = explode(".", $upfile_name[$i]);
    $file_name = $file[0];
    $file_ext  = $file[1];
    
    if ($del_ok[$i] == "y")
    {
        $delete_field = "picture".$i;
        $delete_name = $row[$delete_field];
        $delete_path = "../".$delete_name;
        unlink($delete_path);
    }
    
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

$sql = "update roominfo set normal_price='$normal_price', normal_price_weekend='$normal_price_weekend', vip_price='$vip_price', vip_price_weekend='$vip_price_weekend',";
$sql .= "room_num='$room_num', people_num='$people_num', area_m2='$area_m2', area_peung='$area_peung', component_living='$component_living', component_toilet='$component_toilet', component_room='$component_room',";
$sql .= "picture0='$uploaded_file[0]', picture1='$uploaded_file[1]', picture2='$uploaded_file[2]', picture3='$uploaded_file[3]' where type ='$select'";

mysqli_query($con, $sql);
mysqli_close($con);

echo "
	   <script>
	    location.href = '../admin.php?mode=admin_room_edit&select=$select';
	   </script>
	";

?>