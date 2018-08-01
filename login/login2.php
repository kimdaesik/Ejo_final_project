<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=4">
<link type="text/css" rel="stylesheet" href="./css/login.css?v=4">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    	$("#login_click").hover(function(){
    		$("#login").css("visibility","visible");
		});
    	$("#login_click").mouseleave(function(){
    		$("#login").css("visibility","hidden");
		});
    	$("#login").hover(function(){
    		$("#login").css("visibility","visible");
		});
    	$("#login").mouseleave(function(){
    		$("#login").css("visibility","hidden");
		});
    });
    function find_id(){
		window.open("../login/find_id.php", "findid", "left=600, top=200, width=750, height=300, scrollbars=no, resizable=yes");
	}
    function find_pass(){
		window.open("../login/find_pw.php", "findid", "left=600, top=200, width=750, height=300, scrollbars=no, resizable=yes");
	}
    function input_check(){
        if(!document.login_form.id.value){
          alert('아이디를 입력해주세요!');
          document.login_form.id.focus();
          return;
        }
        if(!document.login_form.pw.value){
          alert('비밀번호를 입력해주세요!');
          document.login_form.pw.focus();
          return;
        }
        document.login_form.submit();
    }
</script>
</head>
<body>   
   <div id="login">
      		<form name="login_form" action="../login/login_db.php" method="post">
                              <table width="354px;" style="text-align: center;">
                                <tr>
                                  <?php
                                    if(isset($_COOKIE['cookie_id'])){
                                      echo "<td colspan='3'><input autocomplete='off' placeholder='아이디' type='text' name='id' style='width: 340px;height: 33px;' value={$_COOKIE['cookie_id']}></td>";
                                    }else{
                                      echo "<td colspan='3'><input autocomplete='off' placeholder='아이디' type='text' name='id' style='width: 340px;height: 33px;'></td>";
                                    }
                                  ?>
                                </tr>
                                <tr>
                                  <td colspan="3"><input placeholder='비밀번호' type='password' name='pw' style="width: 340px;height: 33px; margin : 8px 0 8px 0;"></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><input type='button' onclick="input_check()" value="로그인" style='border-radius : 5px; outline:none; width: 340px;height: 33px;margin-bottom : 8px;'></td>
                                </tr>
                                <tr height="20">
                                <td><input type='checkbox' name='save_id' value='1' checked>아이디저장</td>
                                <td align="center">
                                <a href="#" onclick="find_id()">▷아이디찾기</a>
                                </td>
                                <td>
                                <a href="#" onclick="find_pass()">▷비밀번호찾기</a>
                              	</td>
                                </tr>
                              </table>
             </form>
      </div>
</body>
</html>