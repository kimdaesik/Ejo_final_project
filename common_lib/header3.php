<?php
session_start();
$id=$_SESSION['id'];
?>
<header id="header">
      <div id="logo">
         <a href="../../index.php"><img style="width:100%;height: 100%;"src="../../common_img/logo_3.png" id="logo"></a>
      </div>
      <div  id="top_menu">
         <?php
        include "../login/login2.php";
        ?>
       <table id="top">
         <tr>
         <?php 
            if($id=="admin"){
         ?>
         <td class="header_top_logo"><a href="../../login/logout.php"><img src="../../common_img/로그아웃.png" style="width: 100%; height: 62%; float: right;"></a></td>
         <td class="header_top_logo"><a href="../../admin/memberlist/memberlist.php"><img src="../../common_img/회원리스트.png" style="width: 100%; height: 62%; float: right;"></a></td>
         <td class="header_top_logo"><a href="../../sales/sales.php"><img src="../../common_img/매출.png" style="width: 110%; height: 60%; float: left;"></a></td>
         <td class="header_top_logo"><a href="../../admin/admin.php"><img src="../../common_img/supervise.png" style="width: 70%; height: 62%; float: left;"></a></td>
        <?php 
            }else if(!empty($id)){
         ?>
         <td><a href="../../login/logout.php"><img src="../common_img/로그아웃.png" style="width: 70; height: 60%; float: right;"></a></td>
         <td><a href="../../information/information.php"><img src="../../common_img/내정보.png" style="width: 70; height: 60%; float: left;"></a></td>
         <?php 
            }else{
         ?>
         <td id="login_click"><img src="../../common_img/login.png" style="width: 70%; height: 60%; float: right;"></td>
         <td><a href="../../membership/joinform.php"><img src="../../common_img/join.png" style="width: 70%; height: 60%; float: left;"></a></td>
         <?php 
            }
         ?>
         </tr>
      </table>
      </div>
      <div id="main_menu">
         <div class="in"><a href="../../resort_intro/resort_intro.php"><img src="../../common_img/1.jpg" style="width: 100%; height: 90%;"></a></div>
         <div class="in"><a href="../../room_intro/room_intro.php"><img src="../../common_img/2.jpg" style="width: 100%; height: 90%;"></a></div>
         <div class="in"><a href="../../reserve/reserveform.php"><img src="../../common_img/3.jpg" style="width: 100%; height: 90%;"></a></div>
         <div class="in"><a href="../../use_guide/use_guide.php"><img src="../../common_img/4.jpg" style="width: 100%; height: 90%;"></a></div>
         <div class="in"><a href="../../customer/customer.php"><img src="../../common_img/5.jpg" style="width: 100%; height: 90%;"></a></div>
      </div>
</header>