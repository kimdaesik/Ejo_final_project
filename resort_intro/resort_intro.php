<?php
include "../common_lib/common.php";
if(!empty($_GET['type'])){
    $type=$_GET['type'];
}else{$type="facility";}
if(empty($_GET['page'])){
    $page=1;
}else{$page=$_GET['page'];}


?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css">
<link type="text/css" rel="stylesheet" href="./css/resort_intro.css?v=11">
</head>
<body id="m">
   <div>
      <?php
         include "../common_lib/header2.php";
      ?>
       <section>
          <div id="view">
            <div id="view_title"><b>────── R E S O R T&nbsp;&nbsp;&nbsp;I N F O ──────</b></div>
            <div id="view_list1"><a href="resort_intro.php?type=facility"><img src="./img/f1.png" style="width: 100%; height: 100%;"></a></div>
            <div id="view_list2"><a href="resort_intro.php?type=restaurant"><img src="./img/f2.png" style="width: 100%; height: 100%;"></a></div>
            <br>
            <hr id="clear"></hr>
            <div id="view_content">
               <?php 
                   $page_per_resortinfo = 2;
                   $sql = "select * from resortinfo where type='$type'";
                   $result = mysqli_query($con,$sql)or die("실패원인1:".mysqli_error($con));
                   $count=0;
                   $total = mysqli_num_rows($result);
                   if($total){
                       $total_pages = ceil($total/$page_per_resortinfo);
                       $page_per_start = $page_per_resortinfo * ($page - 1);
                       for($i=$page_per_start; $i<$page_per_start+$page_per_resortinfo && $i<$total; $i++){
                           mysqli_data_seek($result,$i);
                           $row = mysqli_fetch_array($result);
                           $name = $row['name'];
                           $time = $row['time'];
                           $phone_num= $row['phone_num'];
                           $location = $row['location'];
                           $explanation = $row['explanation'];
                           $picture  = $row['picture'];
                           if($count%2==0){
                               echo "<div class='image' style='margin : 1%;'><img style='width :100%; height : 100%' src='$picture'></img></div>";
                               echo "<div class='info' style='margin : 1%;'>
                                        <table style='width :100%; height : 100%;'>
                                        <tr><td class='td1'>이름</td><td class='td3'>$name</td></tr>
                                        <tr><td class='td1'>영업시간</td><td class='td3'>$time</td></tr>
                                        <tr><td class='td1'>문의처</td><td class='td3'>$phone_num</td></tr>
                                        <tr><td class='td1'>위치</td><td class='td3'>$location</td></tr>
                                        <tr><td class='td2'>상세설명</td><td class='td4'>$explanation</td></tr>
                                        </table>
                                        </div>";
                           }else{
                               echo "<div class='info' style='margin : 0.5% 1% 1% 1%;'>
                                        <table style='width :100%; height : 100%;'>
                                        <tr><td class='td1'>이름</td><td class='td3'>$name</td></tr>
                                        <tr><td class='td1'>영업시간</td><td class='td3'>$time</td></tr>
                                        <tr><td class='td1'>문의처</td><td class='td3'>$phone_num</td></tr>
                                        <tr><td class='td1'>위치</td><td class='td3'>$location</td></tr>
                                        <tr><td class='td2'>상세설명</td><td class='td4'>$explanation</td></tr>
                                        </table>
                                        </div>";
                               echo "<div class='image' style='margin : 0.5% 1% 1% 1%;'><img style='width :100%; height : 100%' src='$picture'></img></div>";
                           }
                           $count++;
                       }
                       echo "</div>";
                       $block_per_page_num = 3;
                       $total_blocks = ceil($total_pages/$block_per_page_num);
                       $current_block = ceil($page/$block_per_page_num);
                       $current_block_start_page = $block_per_page_num * ($current_block - 1);
                       $current_block_end_page = ($current_block == $total_blocks)?$total_pages:$block_per_page_num * $current_block;
                       $pre_page = $page > 1 ?$page - 1 : NULL;
                       $next_page = $page < $total_pages ? $page + 1 : NULL;
                       echo "<div id=page_num>";
                       if($pre_page){
                               echo ("<a style='text-decoration: none;' href='resort_intro.php?page=$pre_page&type=$type'>&nbsp; < &nbsp;</a>");
                       }
                       for($i = $current_block_start_page+1; $i <= $current_block_end_page; $i++){
                           if($i == $page){
                               echo ("<b> $i </b>");
                           }else{
                               echo ("<a style='text-decoration: none;' href='resort_intro.php?page=$i&type=$type'> $i </a>");
                           }
                       }
                       if($next_page){
                           echo ("<a style='text-decoration: none;' href='resort_intro.php?page=$next_page&type=$type'>&nbsp; > &nbsp;</a>");
                       }
                       echo "</div>";
                   }
               ?>
             </div>
          </div>
       </section>
       <?php
             include "../common_lib/footer2.php";
       ?>
   </div>
</body>
</html>