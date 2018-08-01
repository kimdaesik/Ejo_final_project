<?php
include "../common_lib/common.php";
$id=mysqli_real_escape_string($con,$_POST['id']);
$pnum=mysqli_real_escape_string($con,$_POST['pnum']);
if(!empty($id) && !empty($pnum)){
    $sql = "select * from membership where id='$id'";
    $result = mysqli_query($con,$sql) or die("실패원인 : ".mysqli_error($con));
    if(mysqli_num_rows($result)==0){
        echo "<script>
          alert('회원님의 정보가 존재하지 않습니다.');
        </script>";
    }else{
        $row = mysqli_fetch_array($result);
        $phone=$row['phone1'].$row['phone2'].$row['phone3'];
        if($phone==$pnum){
            $pw = $row['password'];
        }else{
            echo "<script>
          alert('회원님의 정보가 존재하지 않습니다.');
          </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>비밀번호 찾기</title>
    <link rel="stylesheet" href="./css/find_id.css?v=1">
    <script>
      function input_check(){
        if(!document.login_form.id.value){
          alert('아이디를 입력해주세요!');
          document.login_form.id.focus();
          return;
        }
        if(!document.login_form.pnum.value){
          alert('전화번호를 입력해주세요!');
          document.login_form.pw.focus();
          return;
        }
        document.login_form.submit();
      }
      function button_close(){
          window.close();
      }
    </script>
  </head>
  <body>
    <table width="580">
      <tr>
        <td id="main"> 
              <form name="login_form" action="./sms/sms_send.php?mode=send" method="post">
                <table>
                  <tr>
                    <td colspan="5" width="800"></td>
                  </tr>
                  <tr height="8"></tr>
                  <tr>
                    <td border-top width="120" id="first"></td>
                    <td><label size="30">아이디</label></td>
                    <td><input type="text" name="id" size="30"></td>
                    <td width="80"></td>
                    <td width="120"></td>
                  </tr>
                  <tr>
                    <td width="120"></td>
                    <td align="left" width="80"><label >전화번호</label></td>
                    <td width="180"><input type="text" name="pnum" size="30"></td>
                    <td></td>
                    <td width="120"></td>
                  </tr>
                  <tr height="20"></tr>
                  <tr height="20"></tr>
                </table>
                <div style="width:580; text-align: center;">
                    <input type="button" value="확인" style="width:70pt; height:30pt" onclick="input_check()">
                    <input type="button" value="취소" style="width:70pt; height:30pt; margin-left: 70px;" onclick="button_close()">
                </div>
                <br>
          </form> 
        </td>
      </tr>
    </table>

  </body>
</html>

