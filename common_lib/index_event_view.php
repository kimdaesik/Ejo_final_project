<script src="//code.jquery.com/jquery.min.js"></script>
<script>

function event_popup(number) {
	window.open("common_lib/event_popup.php?num="+number, "팝업", "left=370, top=100, width=800, height=600, scrollbars=yes, resizable=no,fullscreen=no,location=no");
}
</script>
<div id="index_event_view_frame">
<form>
<?php
include '../common_lib/common.php';

$sql = "select * from event where choice='y'";
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);

for ($j = 0; $j < $total_record; $j ++) {
    $t_r = $total_record;
    mysqli_data_seek($result, $j);
    $row = mysqli_fetch_array($result);
    $num=$row['num'];
    
    $file_name[0] = $row['file_name_0'];
    $file_copied[0] = $row['file_copied_0'];
    
    if ($file_copied[0]) {
        $imageinfo = getimagesize("../common_data/event/" . $file_copied[0]);
        $image_width[0] = $imageinfo[0];
        $image_height[0] = $imageinfo[1];
        if ($image_width[0] > 275 || $image_height[0] > 192) {
            $image_width[0] = 275;
            $image_height[0] = 192;
        } else {
            $image_width[0] = 275;
            $image_height[0] = 192;
        }
    } else {
        $image_width[0] = 275;
        $image_height[0] = 192;
    }
    
    if ($t_r == 1) {
        if ($file_copied[0]) {
            $img_name = $file_copied[0];
            $img_name = "./common_data/event/" . $img_name;
            $img_width = $image_width[0];
            $img_height = $image_height[0];
            echo "<div id='iev1_frame'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
        }
    }
    
    if ($t_r == 2) {
            if ($file_copied[0]) {
                $img_name = $file_copied[0];
                $img_name = "./common_data/event/" . $img_name;
                $img_width = $image_width[0];
                $img_height = $image_height[0];
                if ($j == 0) {
                    echo "<div id='iev2_frame1'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j == 1) {
                    echo "<div id='iev2_frame2'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
            }
        
    }
    
    if ($t_r == 3) {
            if ($file_copied[0]) {
                $img_name = $file_copied[0];
                $img_name = "./common_data/event/" . $img_name;
                $img_width = $image_width[0];
                $img_height = $image_height[0];
                if ($j==0) {
                    echo "<div id='iev3_frame1'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j==1) {
                    echo "<div id='iev3_frame1'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j==2) {
                    echo "<div id='iev3_frame1'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
            }
        
    }
    if ($t_r == 4) {
                $img_name = $file_copied[0];
                $img_name = "./common_data/event/" . $img_name;
                $img_width = $image_width[0];
                $img_height = $image_height[0];
                if ($j==0) {
                    echo "<div class='iev4_frame'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j==1) {
                    echo "<div class='iev4_frame'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j==2) {
                    echo "<div class='iev4_frame'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
                if ($j==3) {
                    echo "<div class='iev4_frame'><img src='$img_name' width='$img_width' height='$img_height' style='cursor: hand' onclick='event_popup($num)'></div>";
                }
            }
        
   
}
?>
</form>
</div>



<!-- <div id="iev1_frame">사진1개일때</div> -->

<!-- <div id="iev2_frame1">사진2개일때</div> -->
<!-- <div id="iev2_frame2">사진2개일때</div> -->


<!-- 	<div id="iev3_frame1">사진3개일때</div> -->
<!-- 	<div id="iev3_frame2">사진3개일때</div> -->
<!-- 	<div id="iev3_frame3">사진3개일때</div> -->


<!-- <div class="iev4_frame">사진4개일때</div> -->
<!-- <div class="iev4_frame">사진4개일때</div> -->
<!-- <div class="iev4_frame">사진4개일때</div> -->
<!-- <div class="iev4_frame">사진4개일때</div> -->