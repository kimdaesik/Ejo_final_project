<?php
include '../common_lib/common.php';

$num = $_GET['num'];

$sql = "select * from event where num=$num";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$subject = $row['subject'];
$content = $row['content'];

$file_name[0] = $row['file_name_0'];
$file_name[1] = $row['file_name_1'];

$file_copied[0] = $row['file_copied_0'];
$file_copied[1] = $row['file_copied_1'];

for ($i = 0; $i < 2; $i ++) {
    if ($file_copied[$i]) {
        $imageinfo = getimagesize("../common_data/event/" . $file_copied[$i]);
        $image_width[$i] = $imageinfo[0];
        $image_height[$i] = $imageinfo[1];
        
        if ($image_width[$i] > 600 || $image_height[$i] > 700) {
            $image_width[$i] = 600;
            $image_height[$i] = 700;
        }
    } else {
        $image_width[$i] = "";
        $image_height[$i] = "";
    }
}

?>

<html>
<head>
<link type="text/css" rel="stylesheet"
	href="../common_css/event_popup.css?v=4">
<title>이조리조트에 오신 것을 환영합니다.</title>
<script>
function event_close(){
	self.close();
}
</script>
</head>
<body>
	<div></div>
	<div id="event_title"><?=$subject?></div>
	<div id="event_content">
	<?php
for ($i = 0; $i < 2; $i ++) {
    if ($file_copied[$i]) {
        $img_name = $file_copied[$i];
        $img_name = "../common_data/event/" . $img_name;
        $img_width = $image_width[$i];
        $img_height = $image_height[$i];
        echo "<img src='$img_name' width='$img_width' height='$img_height' class='img'>" . "<br>";
    }
}
?>
</div>
	<div id="event_button">
		<input type="button" id="event_close" value="닫기"
			onclick="event_close()">
	</div>












</body>
</html>