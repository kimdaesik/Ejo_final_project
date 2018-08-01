<?php 
  include "../common_lib/common.php";
  $name=mysqli_real_escape_string($con,$_POST['name']);
  $pnum=mysqli_real_escape_string($con,$_POST['pnum']);
  if(!empty($name) && !empty($pnum)){
    $sql = "select * from membership where name='$name'";
    $result = mysqli_query($con,$sql) or die("실패원인 : ".mysqli_error($con));
    if(mysqli_num_rows($result)==0){
      echo "<script>
          alert('회원님의 정보가 존재하지 않습니다.');
        </script>";
    }else{
      $row = mysqli_fetch_array($result);
      $phone=$row['phone1'].$row['phone2'].$row['phone3'];
      if($phone==$pnum){
          $id = $row['id'];
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
    <title>아이디 찾기</title>
    <link rel="stylesheet" href="./css/find_id.css?v=1">
    <script>
      function input_check(){
        if(!document.login_form.name.value){
          alert('이름을 입력해주세요!');
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
          <?php  
            if(!empty($id)){?>
                        <table>
                          <tr>
                            <td colspan="5" width="800"></td>
                          </tr>
                          <tr height="8"></tr>
                          <tr>
                            <td border-top width="120" id="first"></td>
                            <td><label size="30"></label></td>
                            <td align="center"><?php echo $row['name']."님!" ?></td>
                            <td width="80"></td>
                            <td width="120"></td>
                          </tr>
                          <tr>
                            <td width="120"></td>
                            <td align="left" width="80"><label > </label></td>
                            <td width="180">아이디는 <?php echo $row['id']." 입니다." ?></td>
                            <td></td>
                            <td width="120"></td>
                          </tr>
                          <tr height="20"></tr>
                          <tr>
                            <td colspan="5" align="center"><input onclick="button_close()" type="button" value="확인" style="width:100pt; height:30pt"></td>
                          </tr>
                          <tr height="20"></tr>
                        </table>
          <?php    
            }else{?>
              <form name="login_form" action="find_id.php" method="post">
                <table>
                  <tr>
                    <td colspan="5" width="800"></td>
                  </tr>
                  <tr height="8"></tr>
                  <tr>
                    <td border-top width="120" id="first"></td>
                    <td><label size="30">이름</label></td>
                    <td><input type="text" name="name" size="30"></td>
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
          <?php  
            }
          ?>
        </td>
      </tr>
    </table>

  </body>
</html>



<!-- <table> -->
<!--     <tr> -->
<!--     	<td><p>이름 : </p></td> -->
<!--     	<td colspan="2"><input type="text"></td> -->
<!--     </tr> -->
<!--     <tr> -->
<!--     	<td><p>이메일 : </p></td> -->
<!--     	<td><input type="text"></td> -->
<!--     	<td>@<input type="text"></td> -->
<!--     </tr> -->
<!--     <tr> -->
<!--         <td><button>확인</button></td> -->
<!--         <td><button>취소</button></td> -->
<!--     </tr> -->
<!-- </table> -->
