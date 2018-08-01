<?php
include '../common_lib/common.php';

session_start();

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
}else{
    echo "<script>alert('로그인 후 이용해 주세요!')</script>";
}

$sql="select * from membership where id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);

$phone=explode("-", $row['phone']);
$ph1=$phone[0];
$ph2=$phone[1];
$ph3=$phone[2];

$email=explode("@",$row['email']);
$email1=$email[0]; //$email[0] 을 $email1변수에 저장
$email2=$email[1]; //$email[1] 을 $email2변수에 저장

$address=explode("+",$row['address']);
$address1=$address[0]; //$address[0] 을 $address1변수에 저장
$address2=$address[1]; //$address[1] 을 $address2변수에 저장

mysqli_close($con);
?>
<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/my_info_edit.css?v=10">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=2">
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
function pw_change(){
	window.open("pw_modify.php", "팝업", "left=200, top=200, width=500, height=300, scrollbars=no, resizable=no,fullscreen=no,location=no");
}
//////////////////////////////////////////////////////////////////////////////////////////////
function check_exp(elem, exp, msg){
	if(!elem.value.match(exp)){
		alert(msg);
		return true;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////
function check_input(){
			// 이름 검사
			var exp_name= /^[가-힣]{2,5}$/;
			if(!document.my_info_modify.name.value){
				alert("이름을 입력해주세요");
				document.my_info_modify.name.focus();
				return ;
			}
			if(check_exp(document.my_info_modify.name, exp_name, "이름을 정확히 입력해주세요!(한글 입력!)")){
				document.my_info_modify.name.focus();
				document.my_info_modify.name.select();
				return ;
			}
			
			if(!document.my_info_modify.gender.value){
				alert("성별을 선택해주세요");
				document.my_info_modify.gender.focus();
				return ;
			}
			
 			if(!document.my_info_modify.zip.value){
				alert("주소를 선택해주세요");
				document.my_info_modify.zip.focus();
				return ;
			}
			
			if(!document.my_info_modify.address1.value){
				alert("주소를 입력해주세요");
				document.my_info_modify.address1.focus();
				return ;
			}
			
			// 연락처 검사
			var exp_hp1= /^0[1-9][0-9]?$/;
			var exp_hp2= /^[0-9]{4}$/;
			if(!document.my_info_modify.hp1.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp1.focus();
				return ;
			}			
			if(!document.my_info_modify.hp2.value){
				alert("연락처를 입력해주세요");
				document.my_info_modify.hp2.focus();
				return ;
			}			
			if(!document.my_info_modify.hp3.value){
				alert("연락처를 입력해주세요");
				document.my_info_modify.hp3.focus();
				return ;
			}
			// 연락처 유효성 검사
			if(check_exp(document.my_info_modify.hp1, exp_hp1, "연락처를 정확히 입력해주세요!")){
				document.my_info_modify.hp1.focus();
				document.my_info_modify.hp1.select();
				return ;
			}
			if(check_exp(document.my_info_modify.hp2, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.my_info_modify.hp2.focus();
				document.my_info_modify.hp2.select();
				return ;
			}
			if(check_exp(document.my_info_modify.hp3, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.my_info_modify.hp3.focus();
				document.my_info_modify.hp3.select();
				return ;
			}
			
			document.my_info_modify.submit();
		}
///////////////////////////////////////////////////////////////////////////////////////////////
function execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                fullAddr = data.roadAddress;

            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                fullAddr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
            if(data.userSelectedType === 'R'){
                //법정동명이 있을 경우 추가한다.
                if(data.bname !== ''){
                    extraAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('post_code').value = data.zonecode; //5자리 새우편번호 사용
            document.getElementById('address1').value = fullAddr;

            // 커서를 상세주소 필드로 이동한다.
            document.getElementById('address2').focus();
        }
    }).open();
}
</script>
</head>
<body>

	<div id="m">
      <?php
    include "../common_lib/header2.php";
    ?>
			<section>
			
			<div id="section_1">

				<div id="myinfo">
					<p id="info">
						<b>──────&nbsp;&nbsp; I N F O R M A T I O N &nbsp;&nbsp;──────</b>
					</p>
					<div id="info_modify">
						<a href="./my_info_edit.php"><img src="./img/회원정보수정2.png" style="width: 100%; height: 100%;"></a>
					</div>
					<div id="pw_modify" onclick="pw_change()">
						<a href="#" ><img src="./img/비밀번호 변경(버튼).png" style="width: 100%; height: 100%;"></a>
					</div>
					<div id="my_reserve">
						<a href="./my_reserve.php"><img src="./img/내 예약현황(버튼).png" style="width: 100%; height: 100%;"></a>
					</div>
				</div><br><br><br>
			<hr id="clear">
	<form name="my_info_modify" method="post" action="./my_info_modify.php">
				<div id="my_info_frame">
					<div id="my_info_title"><h2 id="member_edit_title">회 원 정 보 수 정</h2></div>
					
					<div id="id_frame">
						<div id="id_title"><p class="my_info_p">아 이 디</p></div>
						<div id="id_value"><input type="text" id="id_text" name="id" value="<?=$row['id']?>" readonly><div id="my_info_level">등급:<?=$row['level']?></div></div>
					</div> <!-- 아이디 -->

					<div id="name_frame">
						<div id="name_title"><p class="my_info_p">이 름</p></div>
						<div id="name_value"><input type="text" id="name_text" name="name" value="<?=$row['name']?>"></div>
					</div> <!-- 이름 -->

					<div id="birth_frame">
						<div id="birth_title"><p class="my_info_p">생 년 월 일</p></div>
						<div id="birth_value">
						<select name="year" id="birth_select_year">
                				<option><?=$row['birth_year']?></option>
                			</select> 년
                			<select name="month" id="birth_select_month">
                				<option><?=$row['birth_month']?></option>
                			</select> 월
                			<select name="day" id="birth_select_day">
                				<option><?=$row['birth_day']?></option>
                			</select> 일
						</div>
					</div> <!-- 생일 -->

					<div id="gender_frame">
						<div id="gender_title"><p class="my_info_p">성 별</p></div>
						<div id="gender_value">
							<?php 
							if($row['gender']=="male"){
							echo "<input type='radio' name='gender' value='male' id='male' checked><label for='male'>남자</label>&nbsp;&nbsp;&nbsp;";
							echo "<input type='radio' name='gender' value='female' id='female'><label for='female'>여자</label>";
							}else{
							echo "<input type='radio' name='gender' value='male' id='male'><label for='male'>남자</label>&nbsp;&nbsp;&nbsp;";
							echo "<input type='radio' name='gender' value='female' id='female' checked><label for='female'>여자</label>";							    
							}
							?>
   						</div>
					</div> <!-- 성별 -->
			
					<div id="post_frame">
						<div id="post_title"><p class="my_info_p">우 편 번 호</p></div>
						<div id="post_value"><input type="text" id="post_code" name="zip" value="<?=$row['zip']?>" placeholder="우편번호" readonly>
						<div id="input_div" onclick="execDaumPostcode()">
						<a href="#"><img src="./img/8.우편번호인증.png"></a></div></div>
					</div> <!-- 우편번호 -->
					
					<div id="address1_frame">
						<div id="address1_title"><p class="my_info_p">주 소</p></div>
						<div id="address1_value"><input type="text" id="address1" name="address1" placeholder="주소" value="<?=$address1?>" readonly>
						</div>
					</div> <!-- 주소1 -->

					<div id="address2_frame">
						<div id="address2_title"><p class="my_info_p">주 소</p></div>
						<div id="address2_value"><input type="text" id="address2" name="address2" value="<?=$address2?>" placeholder="상세주소" >
						</div>
					</div> <!-- 주소2 -->
					
					<div id="phone_frame">
						<div id="phone_title"><p class="my_info_p">연 락 처</p></div>
						<div id="phone_value">
							<input type="text" name="hp1" id="hp1" value="<?=$row['phone1']?>">&nbsp;-&nbsp;<input type="text" name="hp2" id="hp2" value="<?=$row['phone2']?>">&nbsp;-&nbsp;<input type="text" name="hp3" id="hp3" value="<?=$row['phone3']?>">
						</div>
					</div><!-- 폰번 -->
					
					<div id="email_frame">
						<div id="email_title"><p class="my_info_p">이 메 일</p></div>
						<div id="email_value">
							<input type="text" name="email1" id="email1" value="<?=$email1?>"> @ 
							<input type="text" name="email2" id="email2" value="<?=$email2?>"> 
						</div>
					</div><!-- 이메일 -->
					
				<div id="member_drop"><a href="./delete_membership.php" id="delete_a">회원탈퇴</a></div>
				</div>
				<div id="my_info_submit"><img src="./img/17.수정.png" onclick="check_input()" style="cursor: hand;"></div>
			</form>
			</div>
		</section>
		<div id="foot">
    <?php
    include "../common_lib/footer2.php";
    ?>
    </div>
	</div>
</body>
</html>
