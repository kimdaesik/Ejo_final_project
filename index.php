<?php include './common_lib/create_table.php';
    include './common_lib/common.php';
?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./common_css/project_style.css?v=23">
<link type="text/css" rel="stylesheet" href="./common_css/index_table.css?v=7">
<link type="text/css" rel="stylesheet" href="./common_css/index_event_view.css?v=2">
<script type="text/javascript">
function fast_reserve_submit(){
	document.fast_reserve.submit();
}


</script>
</head>
<body id="m">
   <div>
   <?php include './common_lib/header.php';?>
      <section>
         <div id="b">
         
			<form name="fast_reserve" action="./reserve/payment.php?flag=fast" method="post">
            <div id="reserve" style="background-image: url('./common_img/13.빠른예약(2).png'); background-size: 100% 100%;">
               <div class="t" id="start_day"><input type="date" class="day" name="fast_date"/></div>
               <div class="t" id="last_day">
               <select name="fast_days" style="width: 130%; margin-top: -0.1%;" class = "day">
                   <option value="1">1박</option>
                   <option value="2">2박</option>
                   <option value="3">3박</option>
               </select>
               </div>
               <select name="fast_reserve_type" class="s" id="room_type_select">
               <option value="family">패밀리</option>
               <option value="suite">스위트</option>
               <option value="royalsuite">로얄스위트</option>
               </select>
               <!-- button_reserve -->
               <br><br>
              <div id="submit_reserve"><a href="#"><img onclick="fast_reserve_submit()" src="./common_img/14.입력완료(2).png" style="width: 100%;"></a></div>
          </form>   
               
            </div>
            <div id="image-slide"><div id="slide"><?php include './slide/slide_img.php';?></div></div>
            <div class="clear"></div>
         </div>
         
         <div id="event"><div id="in_event">
         <img src="./common_img/12.EVENT.png" id="event_img">
         </div>
            <?php include './common_lib/index_event_view.php'?>
         </div>
               <div id="c">
            <div id="notice"><img src="./common_img/notice_1_1.png" class="main_img_size"><div id="more1"><a href="./customer/notice.php"><img src="./common_img/more.png"></a></div>
               <hr class="img_bottom">
               <div id="notice_go">
            <?php include 'common_lib/notice_func.php'?>
                
                <?php latest_article(notice, 7, 24)?>       
                  
               </div> <!-- notice_go -->
            </div> <!-- notice -->
           
           
            <div id="qna"><img src="./common_img/qna_1_1.png" class="main_img_size">  <div id="more2"><a href="./qna/qna_list.php"><img src="./common_img/more.png"></a></div>
          <hr class="img_bottom">
               <div id="qna_go">
               <?php include 'common_lib/qna_func.php'?>
                 
               <?php latest_article1(qna, 7, 24)?>   
             
               </div> <!-- notice_go -->
            </div> <!-- notice -->        
            <div id="customer"><img src="./common_img/고객센터.png" style="width: 100%; height: 93%;"><hr></div>
         </div>
         <div class="clear"></div>
      </section>
     <?php include './common_lib/footer.php';?>
   </div>
</body>
</html>