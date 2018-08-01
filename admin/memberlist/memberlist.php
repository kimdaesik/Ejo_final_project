<?php
session_start();

include "../../common_lib/common.php";
if(isset($_GET['mode'])){             //  mode 아이디가 존재할 경우
    $mode=$_GET['mode'];
    $search = $_POST['search'];       // search 값을 불러와 저장
    $find = $_POST['find'];
}
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$scale = 12;
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/memberlist.css?v=8">
<link type="text/css" rel="stylesheet" href="../../common_css/project_style.css?v=23">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
if (isset($mode) && ($mode == "search")) {
    if (empty($search)) {
        echo ("<script>window.alert('검색할 단어를 입력해 주세요.')
            history.go(-1)
            </script>");
        exit;
    }
    $sql = "select * from membership where $find like '%$search%'";
} else {
    $sql= "select * from membership order by level desc";
}
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);
if($total_record==0){
    echo ("<script>window.alert('검색한 정보가 없습니다.')
            history.go(-1)
            </script>");
    exit;
}



if ($total_record % $scale == 0) {
    $total_page = floor($total_record / $scale);
} else {
    $total_page = floor($total_record / $scale) + 1;
}

$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>

</head>
<script>
$(document).ready(function() {
	$('.subject_click').click(function() {
		var id=$(this).text();
		window.open("memberlist_view.php?id="+id,"회원목록","height=700 width=700");
	});
});
</script>
<body>
	<div id="m">
      <?php
    include "../../common_lib/header3.php";
    ?>
      <div id="sec">
			<section>
				<div id="space">
					<div id="side_menu"></div>
					<div id="content">

						<div id="notice_content">
							<p id="noti">
								<b>──────&nbsp;&nbsp;M E M B E R L I S T
									&nbsp;&nbsp;──────</b>
							</p>
						</div>
								<br><br><br>
						<hr id="clear">
						<div id="noti1">이조리조트 회원들의 리스트 입니다.</div>

						<form name="memberlist_form" action="memberlist.php?mode=search" method="post">
						<div id="sf">
							<select name="find" id="combobox">
								<option value="id">아이디</option>
								<option value="level">등급</option>
							</select>
							<div id="search_find">
								<input type="text" placeholder="search" id="notice_search" name="search">
							</div>
							<div id="find">
								<input type="image" src="./img/check.png" id="check_img">
							</div>
						</div> <!-- sf -->
						</form>
						
						<div class="clear"></div>
						<div id="table_a">
							<table id="table_size">
								<tr style="border: 1px solid black;" id="tr1">
									<td id="no" class="tb">No</td>
									<td id="used_name" class="tb">이름</td>
									<td id="used_id" class="tb">아이디</td>
									<td id="user_used_money" class="tb">결제 금액</td>
									<td id="user_level" class="tb">등급</td>
								</tr>
						<?php
    for ($i = $start; $i < $start + $scale && $i < $total_record; $i ++) {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $user_name=$row['name'];
        $user_id=$row['id'];
        $user_used_money=$row['used_money'];
        $user_level=$row['level'];
        
        echo "<tr style='border: 1px solid black; text-align: center;' class='tr2'>
						<td class='tb1'>$number</td>
						<td class='tb1'>$user_name</td>
						<td class='tb1'><a href='#' class='subject_click'>$user_id</a></td>
						<td class='tb1'>$user_used_money</td>
						<td class='tb1'>$user_level</td>
							</tr>
                    	
                    	<div class='clear'></div>";
        
        $number --;
    }
    ?>
                        </table>
						</div>
						<div id="bottom_background">
                    		<?php
                    $page_block = 5; // 페이지 최대 개수
                    $total_block = ceil($total_page / $page_block); // 전체블록값
                    $block = ceil($page / $page_block); // 현재 페이지 현재 블록
                    $first = ($block - 1) * $page_block; // 현재 블록 시작하는 페이지 위치
                    $last = $block * $page_block; // 현재블록 끝나는 위치
                    
                    if ($block >= $total_block) {
                        $last = $total_page; // 현재블록이 마지막블럭위치라면
                    }
                    echo "<div id=page_num>";
                    if ($page > 1) {
                        // 2블럭이상이라면
                        $go_page = $page - 1;
                        echo "<a href='memberlist.php?page=$go_page' class='link_page'> <&nbsp;&nbsp; </a>";
                    }
                    ?>
                            <?php
                            
                            // 게시판 목록 하단에 페이지 링크 번호
                            for ($i = $first + 1; $i <= $last; $i ++) {
                                if ($page == $i) {
                                    echo "<b id='now_page'> $i </b>";
                                } else {
                                    echo "<a href='memberlist.php?page=$i' class='link_page'> $i </a>";
                                }
                            }
                            ?>
     						<?php 
// 다음 블럭과 마지막블럭으로 이동시켜주는 링크
        if ($total_page > $page) {
            $go_page = $page + 1;
            echo "<a href='memberlist.php?page=$go_page' class='link_page'> &nbsp;&nbsp;></a>";
        }
        echo "</div>";
        ?>
						</div>
					</div>
			</section>
		</div>
       <?php
    include "../../common_lib/footer3.php";
    ?>
   </div>
</body>
</html> 