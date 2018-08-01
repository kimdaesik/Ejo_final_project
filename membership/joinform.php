<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css">
<link type="text/css" rel="stylesheet" href="./css/joinform.css?v=9">
<script>
		function check_exp(elem, exp, msg){
			if(!elem.value.match(exp)){
				alert(msg);
				return true;
			}
		}
		function check_id(){
			window.open("check_id.php?id="+document.join_form.id.value, "IDcheck", "left=200, top=200, width=420, height=150, scrollbars=no, resizable=yes");
		}
		
		function check_email_conf(){
			var exp_email1= /^[0-9a-zA-Z~!@#$%^&*()]+$/;
			var exp_email2= /^[a-z]+\.[a-z]+$/;
			var email1=document.join_form.email1.value;
			var email2=document.join_form.email2.value;
			if(!document.join_form.email1.value){
				alert("이메일을 정확히입력해주세요");
				document.email_check_form.email1.focus();
				return ;
			}
			if(!document.join_form.email2.value){
				alert("이메일을 정확히입력해주세요");
				document.email_check_form.email2.focus();
				return ;
			}
			if(check_exp(document.join_form.email1,exp_email1, "이메일을 정확히 입력해주세요!")){
				document.email_check_form.email1.focus();
				document.email_check_form.email1.select();
				return ;
			}
			if(check_exp(document.join_form.email2,exp_email2, "이메일을 정확히 입력해주세요!")){
				document.email_check_form.email2.focus();
				document.email_check_form.email2.select();
				return ;
			}
			window.open("./webmailer/webmail_index.php?email1="+email1+"&email2="+email2, "IDEmail", "left=200, top=200, width=420, height=200, scrollbars=no, resizable=yes");
		}
		
		function check_input(){
			console.log("12");
			if(document.join_form.email1.value!=document.join_form.hidden_e1.value){
				alert("이메일 인증을해주세요");
				return ;
			}
			if(document.join_form.email2.value!=document.join_form.hidden_e2.value){
				alert("이메일 인증을해주세요");
				return ;
			}
			if(document.join_form.id.value!=document.join_form.hidden.value){
				alert("인증된아이디를 사용해주세요");
				return ;
			}
			// 아이디 검사
			var exp_id= /^[0-9a-zA-Z]{6,12}$/;
			if(!document.join_form.id){
				alert("ID를 입력해주세요");
				return ;
			}
			if(check_exp(document.join_form.id, exp_id, "ID는 6~12자리 영문 또는 숫자만 입력해주세요!")){
				document.join_form.id.focus();
				document.join_form.id.select();
				return ;
			}
			// 암호 검사
			var exp_pass= /^[0-9a-zA-Z~!@#$%^&*()]{8,12}$/;
			if(!document.join_form.pass.value){
				alert("암호를 입력해주세요");
				document.join_form.pass.focus();
				return ;
			}			
			if(check_exp(document.join_form.pass, exp_pass, "암호는 8~12자리 영문 또는 숫자만 입력해주세요!")){
				document.join_form.pass.focus();
				document.join_form.pass.select();
				return ;
			}
			
			// 이름 검사
			var exp_name= /^[가-힣]{2,5}$/;
			if(!document.join_form.name.value){
				alert("이름을 입력해주세요");
				document.join_form.name.focus();
				return ;
			}
			if(check_exp(document.join_form.name, exp_name, "이름을 정확히 입력해주세요!(한글 입력!)")){
				document.join_form.name.focus();
				document.join_form.name.select();
				return ;
			}
			
			if(!document.join_form.gender.value){
				alert("성별을 선택해주세요");
				document.join_form.gender.focus();
				return ;
			}
			
 			if(!document.join_form.zip.value){
				alert("주소를 선택해주세요");
				document.join_form.zip.focus();
				return ;
			}
			
			if(!document.join_form.address1.value){
				alert("주소를 입력해주세요");
				document.join_form.address1.focus();
				return ;
			}
			
			// 연락처 검사
			var exp_hp1= /^0[1-9][0-9]?$/;
			var exp_hp2= /^[0-9]{4}$/;
			if(!document.join_form.hp1.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp1.focus();
				return ;
			}			
			if(!document.join_form.hp2.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp2.focus();
				return ;
			}			
			if(!document.join_form.hp3.value){
				alert("연락처를 입력해주세요");
				document.join_form.hp3.focus();
				return ;
			}
			// 연락처 유효성 검사
			if(check_exp(document.join_form.hp1, exp_hp1, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp1.focus();
				document.join_form.hp1.select();
				return ;
			}
			if(check_exp(document.join_form.hp2, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp2.focus();
				document.join_form.hp2.select();
				return ;
			}
			if(check_exp(document.join_form.hp3, exp_hp2, "연락처를 정확히 입력해주세요!")){
				document.join_form.hp3.focus();
				document.join_form.hp3.select();
				return ;
			}
			
			// 암호 일치 확인
			if(document.join_form.pass.value != document.join_form.pass_conf.value){
				alert("암호가 일치하지 않습니다. 다시 입력해주세요");
				document.join_form.pass.focus();
				document.join_form.pass.select();
				return ;
			}
			
			// 이메일 확인
			if(!document.join_form.email1.value){
				alert("e-mail 인증을 해주세요");
				document.join_form.pass.focus();
				document.join_form.pass.select();
				return ;
			}
			
			
			document.join_form.submit();
		}
	</script>
	<!-- 우편번호 검색API -->
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
	<script>
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
                    document.getElementById('postcode').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('address1').value = fullAddr;
    
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById('address2').focus();
                }
            }).open();
        }
    </script>
</head>
<body>


<body id="m">
	<div id="all">
      <?php
    include "../common_lib/header2.php";
    ?>
       <section>
			<!-- 여기서부터 작성시작 -->
			<div id="join_form_allframe">
				<div id="join_form_frame">
					<div id="join_form_div">
						<div id="join_form_member_info">
							<h2>회 원 가 입</h2>
						</div>
						<div id="info_message">
							<b>*</b> 표시가 된 항목은 필수 항목입니다.
						</div>
						<div id="table_frame_div">
							<form name=join_form method=post action="insert.php">
							<table id="joinform_table">
								<tr>
									<td id="id_form"><b>*</b> 회원 ID</td>
									<td id="id_value"><input type="text" id="id_input" name="id"><div id="id_confirm" onclick="check_id()"><img src="./img/9.아이디인증.png" style="cursor: hand"></div>
									<div id="id_message"><b>*</b>아이디는 6~12자리의 영문 또는 숫자 혼용, 특수문자 제외</div>
                        			<input type="hidden" name="hidden"></input>
                        			<input type="hidden" name="hidden_ok"></input>
									</td>
								</tr>
								<tr>
									<td id="pw_form1"><b>*</b> 비밀번호</td>
									<td id="pw_value1"><input type="password" id="pw_input1" name="pass">
									<div id="pw_message1"><b>*</b>비밀번호는 8~12자리의 영문/숫자 또는 영문/숫자/특수문자[!@#$%^&*()] 혼용</div>
									</td>
								</tr>
								<tr>
									<td id="pw_form2"><b>*</b> 비밀번호 확인</td>
									<td id="pw_value2"><input type="password" id="pw_input2" name="pass_conf">
									<div id="pw_message2"><b>*</b>비밀번호를 한번 더 입력하세요.</div>
									</td>
								</tr>
								<tr>
									<td id="name_form"><b>*</b> 성명</td>
									<td id="name_value"><input type="text" id="name_input" name="name"></td>
								</tr>
								<tr>
									<td id="birth_form"><b>*</b> 생년월일</td>
									<td id="birth_value"> 
        								<select name="year" class="input_space">
                            				<?php 
                            				for($i=0; $i<60;$i++){
                            				    $year=2010-$i;
                            			        echo "<option value=$year>$year</option>";
                                            }
                            				?>
                        				</select> <p>년</p>
                        				<select name="month" class="input_space">
                            				<?php 
                            				for($i=1; $i<=12;$i++){
                            			        echo "<option value=$i>$i</option>";
                                            }
                            				?>
                        				</select> <p>월</p>
                        				<select name="day" class="input_space">
                            				<?php 
                            				for($i=1; $i<=31;$i++){
                            			        echo "<option value=$i>$i</option>";
                                            }
                            				?>
                        			</select> <p>일</p>
									</td>
								</tr>
								<tr>
									<td id="gender_form"><b>*</b> 성별</td>
									<td id="gender_value">
										<input type="radio" name="gender" value="male" id="male_input"><label for="male_input" style="margin-right: 5%;">&nbsp;&nbsp;남자</label>
    									<input type="radio" name="gender" value="female" id="female_input"><label for="female_input">&nbsp;&nbsp;여자</label>
									</td>
								</tr>
								<tr>
									<td  id="add_form"><b>*</b> 주소</td>
									<td id="add_value1">
										<input type="text" id="postcode" name="zip" placeholder="우편번호" readonly><div id="post_confirm" onclick="execDaumPostcode()"><img src="./img/8.우편번호인증.png" style="cursor: hand;"></div><div class="clear"></div>
										<input type="text" id="address1" name="address1" placeholder="주소" readonly><div class="clear"></div>
										<input type="text" id="address2" name="address2" placeholder="나머지 주소"><div id="add_message"><b>*</b>나머지 주소를 입력하세요</div>
									</td>
								</tr>
								<tr>
									<td id="phone_form"><b>*</b> 연락처</td>
									<td id="phone_value"><input type="text" id="phont_input1" name="hp1"> <p>&nbsp;&nbsp;-&nbsp;&nbsp;</p> <input type="text" id="phont_input2" name="hp2"><p>&nbsp;&nbsp;-&nbsp;&nbsp;</p><input type="text" id="phont_input3" name="hp3"></td>
								</tr>
								<tr>
									<td id="email_form"><b>*</b> 이메일 주소</td>
									<td id="email_value">
									<input type=text name="email1" size=10 id="email1"><p> @ </p>
									<input type=text name="email2" size=10 id="email2">
									<div id="email_confirm" onclick="check_email_conf()"><img src="./img/10.이메일인증.png" style="cursor: hand;"></div>
                  					<input type="hidden" name="hidden_e1"></input>
                    				<input type="hidden" name="hidden_e2"></input>							
									</td>
								</tr>
							</table>
							</form>
							<div id="image_bottom">
								<div id="join_submit"><a href="#" onclick="check_input()"><img src="./img/11.회원가입.png"></a></div>
								<div id="cancel"><a href="../index.php"><img src="./img/12.취소.png"></a></div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 여기 밑으로는 나가지 마세요 -->

		</section>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html>