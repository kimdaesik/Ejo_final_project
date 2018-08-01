<?php
include '../common_lib/common.php';
session_start();

$select_room=$_GET['select_room'];
$total_week=$_GET['total_week'];
if(empty($_SESSION['id'])){
    echo "<script>
      alert('로그인하고 이용하세요!');
      history.go(-1);
      </script>";
    exit();
}

$price=array();
$sql = "select normal_price,normal_price_weekend,vip_price,vip_price_weekend from roominfo order by normal_price asc";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
while($row=mysqli_fetch_array($result)){
    $price[]=$row['normal_price'];
    $price[]=$row['normal_price_weekend'];
    $price[]=$row['vip_price'];
    $price[]=$row['vip_price_weekend'];
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css">
<link type="text/css" rel="stylesheet" href="./css/reserve.css?v=31">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
<script>
function select_click(reserve_type,w,level){
   $("#selectbutton").prop("disabled", false);
   var value=Number($("#select_option").val());
   var reserve_total_price=0;
   
   for(var i=0;i<value;i++){
      if(w==7){
         w=0;
      }
      console.log(reserve_type,w,level);
        if(reserve_type == 'family'){
            if(level=="vip"){
                if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[3])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[2])?>);
                }
            }else{
               if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[1])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[0])?>);
                }
            }
        }else if(reserve_type == 'suite'){
           if(level=="vip"){
                if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[7])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[6])?>);
                }
            }else{
               if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[5])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[4])?>);
                }
            }
        }else{
           if(level=="vip"){
                if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[11])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[10])?>);
                }
            }else{
               if(w == 5 || w == 6){
                    reserve_total_price += Number(<?=json_encode($price[9])?>);
                }else{
                    reserve_total_price += Number(<?=json_encode($price[8])?>);
                }
            }
        }
        w=w+1;
   }
    $("#price").html(reserve_total_price);
   $("#price2").val(reserve_total_price);
    $("#days").val(value);
}

function reserve_click1(day,mm,yyyy){
   var reserve_input=$(".reserve_input1").val();
   $.ajax({
      type :'post',
      url : "./reserve.php",
      data : "day="+day+"&mm="+mm+"&yyyy="+yyyy+"&reserve_type="+reserve_input,
      success : function(result){
         $("#select_day").html(result);
         }
   });
}
function reserve_click2(day,mm,yyyy){
   var reserve_input=$(".reserve_input2").val();
   $.ajax({
      type :'post',
      url : "./reserve.php",
      data : "day="+day+"&mm="+mm+"&yyyy="+yyyy+"&reserve_type="+reserve_input,
      success : function(result){
         $("#select_day").html(result);
         }
   });
}
function reserve_click3(day,mm,yyyy){
   var reserve_input=$(".reserve_input3").val();
   $.ajax({
      type :'post',
      url : "./reserve.php",
      data : "day="+day+"&mm="+mm+"&yyyy="+yyyy+"&reserve_type="+reserve_input,
      success : function(result){
         $("#select_day").html(result);
         }
   });
}

</script>
</head>
<body id="m">
   <div>
      <?php
         include "../common_lib/header2.php";
      ?>
       <section>
          <div id="view">
            <div id="calendar">
            <?php
               include "./calender.php";
            ?>
            </div>
            <div id="select_day"></div>
          </div>
       </section>
       <?php
             include "../common_lib/footer2.php";
       ?>
   </div>
</body>
</html>