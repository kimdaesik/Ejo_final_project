<?php
session_start();

include '../common_lib/common.php';

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    $name=$_SESSION['name'];
}else{
    echo "<script>
      alert('로그인하고 이용하세요!');
      history.go(-1);
      </script>";
    exit();
}

$flag=$_GET['flag'];

$sql = "select level from membership where id='$id'";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
$row=mysqli_fetch_array($result);
$level=$row['level'];

if($flag == "fast"){
    if(empty($_POST['fast_date'])){
        echo "
	   <script>
        alert('날짜를 선택해주세요.')
	    location.href = '../index.php';
	   </script>
	";
    }

    //빠른예약을 통해 넘어온 변수
    $reserve_type = $_POST['fast_reserve_type'];
    $days = (int)$_POST['fast_days'];
    $fast_date = $_POST['fast_date'];
    
    $fast_date=explode("-",$fast_date);
    $yyyy=$fast_date[0];
    $mm = $fast_date[1];
    $day = $fast_date[2];
    $fast_date = $yyyy.$mm.$day;
    
    if($fast_date <= date(Ymd)){
        echo "
	       <script>
            alert('날짜를 다시 선택해주세요.')
	        location.href = '../index.php';
	       </script>
	   ";
    }
    
    $fast_w=date("w", mktime(0, 0, 0, $mm, $day, $yyyy));
    $days2=$days+1;
    
}else{
    //예약페이지에서 넘어온 변수
    $day=$_POST['day'];
    $mm=$_POST['mm'];
    $yyyy=$_POST['yyyy'];
    
    $price=$_POST['price'];
    $days=(int)$_POST['days'];
    $reserve_type=$_POST['reserve_type'];
    
    $reserve_start = $yyyy.$mm.$day;
    $days2 = $days+1;
    
    
    $w=date("w", mktime(0, 0, 0, $mm, $day, $yyyy));
}

$fast_price=array();
$sql = "select normal_price,normal_price_weekend,vip_price,vip_price_weekend from roominfo order by normal_price asc";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
while($row=mysqli_fetch_array($result)){
    $fast_price[]=$row['normal_price'];
    $fast_price[]=$row['normal_price_weekend'];
    $fast_price[]=$row['vip_price'];
    $fast_price[]=$row['vip_price_weekend'];
}

$reserve_total_price=0;

for($i=0;$i<$days;$i++){
    $fast_w=date("w", mktime(0, 0, 0, $mm, $day, $yyyy)+(86400*$i));
    if($flag=='fast'){
        if($reserve_type == 'family'){
            if($level=="vip"){
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[3];}else{$reserve_total_price += $fast_price[2];}
            }else{
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[1];}else{$reserve_total_price += $fast_price[0];}
            }
        }else if($reserve_type == 'suite'){
            if($level=="vip"){
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[7];}else{$reserve_total_price += $fast_price[6];}
            }else{
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[5];}else{$reserve_total_price += $fast_price[4];}
            }
        }else{
            if($level=="vip"){
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[11];}else{$reserve_total_price += $fast_price[10];}
            }else{
                if($fast_w == 5 || $fast_w == 6){$reserve_total_price += $fast_price[9];}else{$reserve_total_price += $fast_price[8];}
            }
        }
    }
}

$compare=($yyyy.$mm.$day);
$reserve_start2=(int)$compare;
$reserve_end2=0;
$a=0;
$count=0;
$count2=0;
$room_num=0;

$sql = "select * from room where room_type='$reserve_type'";
$result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
$total_room_num=mysqli_num_rows($result);

for($i=1;$i<=$total_room_num;$i++){
    $sql = "select reserve_start,reserve_end from reserve where room_type='$reserve_type' and room_num='$i'";
    $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
    $num=mysqli_num_rows($result);
    $count=0;
    $count2=0;
    
    if($num==0){
        $a++;
        $room_num=$i;
        $reserve_end2=date("Ymd",(mktime(0,0,0,$mm,$day,$yyyy)+(86400*($days-1))));
        break;
    }else{
        $sql = "select * from reserve where reserve_start<='$compare' and reserve_end>='$compare' and room_type='$reserve_type' and room_num='$i'";
        $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
        $num=mysqli_num_rows($result);
        
        if($num==0){//true
            for($j=0;$j<$days;$j++){
                $compare=date("Ymd",(mktime(0,0,0,$mm,$day,$yyyy)+(86400*$j)));
                $sql = "select * from reserve where reserve_start<='$compare' and reserve_end>='$compare' and room_type='$reserve_type' and room_num='$i'";
                $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
                $num=mysqli_num_rows($result);
                if($num==0){
                    $count2++;
                    if($days==1){$count2=1; break;}
                    continue;
                }else{
                    $count++; break;
                }
            }
            if($count!=0)continue;
        }else{
            continue;
        }
    }
    if($count2==$days){
        $reserve_end2=$compare;
        $room_num=$i;
        break;
    }
}
if($a==0){
    if($count2!=$days){
        echo "
        <script>
            alert('해당 날짜로 예약이 불가능합니다. 예약페이지에서 날짜를 확인해주세요.');
            history.go(-1);
        </script>
        ";
    }
}
?>


<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/payment.css?v=11">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=3">
<script type="text/javascript"
	src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script type="text/javascript"
	src="https://cdn.iamport.kr/js/iamport.payment-x.y.z.js"></script>
	<script  src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">


function payment_form_submit(){
	var IMP = window.IMP; // 생략가능
	IMP.init('imp62568004');
	IMP.request_pay({
			    pg : 'kakaopay',
	    pay_method : 'card',
	    merchant_uid : 'merchant_' + new Date().getTime(),
	    name : '이조리조트',
	    amount : <?php if($flag=="reserve"){echo "$price";}else{echo "$reserve_total_price";}; ?>,
	    buyer_email : 'iamport@siot.do',
	    buyer_name : '구매자이름',
	    buyer_tel : '010-1234-5678',
	    buyer_addr : '서울특별시 강남구 삼성동',
	    buyer_postcode : '123-456',
	    kakaoOpenApp : true
	}, function(rsp) {
	    if ( rsp.success ) {
	    	var msg = '결제에 성공하였습니다.'; 
	        alert(msg);
	        document.payment_form.submit();
	    	//[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
	    	jQuery.ajax({
	    		url: "/payments/complete", //cross-domain error가 발생하지 않도록 주의해주세요
	    		type: 'POST',
	    		dataType: 'json',
	    		data: {
		    		imp_uid : rsp.imp_uid
		    		//기타 필요한 데이터가 있으면 추가 전달
	    		}
	    	}).done(function(data) {
	    		//[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
	    		if ( everythings_fine ) {
	    			var msg = '결제가 완료되었습니다.';
	    			msg += '\n고유ID : ' + rsp.imp_uid;
	    			msg += '\n상점 거래ID : ' + rsp.merchant_uid;
	    			msg += '\결제 금액 : ' + rsp.paid_amount;
	    			msg += '카드 승인번호 : ' + rsp.apply_num;
	    			
	    			alert(msg);
	    		} else {
	    			//[3] 아직 제대로 결제가 되지 않았습니다.
	    			//[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
	    		}
	    	});
	    } else {
	        var msg = '결제를 취소하였습니다.'; 
	        alert(msg);
	    }
	});
	}

</script>
</head>
<body>

	<div id="m">
       <?php
    include "../common_lib/header2.php";
    ?>
       <section>
			<div id="intro">
				<div id="view_title">
					<b>──────&nbsp;&nbsp;P A Y M E N T&nbsp;&nbsp;──────</b>
				</div>
				<br>
				<hr id="clear">

				<div id="content">
				<form name="payment_form" action="insert.php" method="post">
						<div id="payment_info">
							<div id="payment_level">
								<div id="payment_level_1"><p>등급</p></div>
								<div id="payment_level_2"><p style="margin-top: 4%;"><?= $level ?></p></div>
							</div>
							<div id="payment_name">
								<div id="payment_name_1"><p>예약자</p></div>
								<div id="payment_name_2"><p style="margin-top: 4%;"><?= $name ?></p></div>
							</div>
							<div id="payment_roomtype">
								<div id="payment_roomtype_1"><p>방타입</p></div>
								<div id="payment_roomtype_2"><p style="margin-top: 4%;"><?= $reserve_type ?></p><input type="hidden" name="reserve_type" value="<?= $reserve_type ?>"></div>
							</div>
							<div id="payment_startday">
								<div id="payment_startday_1"><p>시작날짜</p></div>
								<div id="payment_startday_2"><input type="hidden" name="reserve_startday" value="<?php if($flag=="fast"){ echo "$fast_date";}else{echo "$reserve_start";} ?>"><p style="margin-top: 4%;"><?php if($flag=="fast"){ echo "$fast_date";}else{echo "$reserve_start";} ?></p></div>
							</div>
							<div id="payment_endday">
								<div id="payment_endday_1"><p>숙박일</p></div>
								<div id="payment_endday_2"><input type="hidden" id="days" name="days" value="<?= $days ?>"><p style="margin-top: 4%;"><?= $days ?>박 <?= $days2 ?>일</p></div>
							</div>
						</div>
						<div id="payment_result">
							<div id="payment_amount">
								<div id="payment_amount_1"><p>결제금액</p><div id="payment_amount_2"><input type="hidden" id="price" name="price" value="<?php if($flag=="reserve"){echo "$price";}else{echo "$reserve_total_price";} ?>"><p style="margin-top: 4%;">\<?php if($flag=="reserve"){echo "$price";}else{echo "$reserve_total_price";} ?></p></div></div>
								<div id="payment_protocol"><img src="./img/유의사항.PNG" style="margin:1%;width:98%;height:98%;"></div>
							</div>
						</div>
				</form>
						<div id="payment_btnpay" style="margin-top:28%;width:20%;">
							<button style="width:100%;height:100%;" onclick="payment_form_submit()"><p style="font-size:20pt;margin-top:0%;">결제</p></button>
						</div>

				</div>

				</div>
		</section>
		<div id="payment_fy">
    <?php
    include "../common_lib/footer2.php";
    ?>
    </div>
   </div>
</body>
</html>