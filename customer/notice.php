<?php
include '../common_lib/common.php';


if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
if(isset($_GET['mode'])){             //  mode 아이디가 존재할 경우
    $mode=$_GET['mode'];
    $search = $_POST['search'];       // search 값을 불러와 저장
    $find = $_POST['find'];
}else{
    $table="notice";           // mode 변수가 존재하지 않을 경우 table에 communication 저장
}
$scale = 13;
$table = "notice";
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/notice.css?v=5">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=13">

<?php
if (isset($mode) && ($mode == "search")) {
    if (empty($search)) {
        echo ("<script>window.alert('검색할 단어를 입력해 주세요.')
            history.go(-1)
            </script>");
        exit;
    }
    $sql = "select * from $table where $find like '%$search%' order by num desc";
} else {
    $sql = "select * from $table order by num desc";
}
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);



if ($total_record % $scale == 0) {
    $total_page = floor($total_record / $scale);
} else {
    $total_page = floor($total_record / $scale) + 1;
}

if (empty($page)) {
    $page = 1;
}
$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>

</head>
<body>

	<div id="m">
      <?php
    include "../common_lib/header2.php";
    ?>
      <div id="sec">
			<section>
				<div id="space">
					<div id="side_menu"></div>
					<div id="content">

						<div id="notice_content">
							<p id="noti">
								<b>──────&nbsp;&nbsp;N O T I C E
									&nbsp;&nbsp;──────</b>
							</p>
							<div id="notice2">
								<a href="notice.php?type=notice"><img src="./img/16.공지사항(3).png" style="width: 100%; height: 100%;"></a>
							</div>
							<div id="qna2">
								<a href="../qna/qna_list.php"><img src="./img/17.Q&A(3).png" style="width: 100%; height: 100%;"></a>
							</div>
						</div>
								<br><br><br>
						<hr id="clear">
						<div id="noti1">이조리조트의 공지사항을 확인하실 수 있습니다.</div>


						<form name="search_form" action="notice.php?table=<?=$table?>&mode=search" method="post">

						<div id="sf">
							<select name="find" id="combobox">
								<option value="subject">제목</option>
								<option value="content">내용</option>
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
									<td id="division" class="tb">구분</td>
									<td id="title" class="tb">제목</td>
									<td id="day" class="tb">작성일</td>
									<td id="check" class="tb">조회</td>
								</tr>
						<?php
    for ($i = $start; $i < $start + $scale && $i < $total_record; $i ++) {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $num = str_replace(" ", "&nbsp", $row['num']);
        $division = str_replace(" ", "&nbsp", $row['division']);
        $subject = str_replace(" ", "&nbsp", $row['subject']);
        $regist_day = str_replace(" ", "&nbsp", $row['regist_day']);
        $hit = str_replace(" ", "&nbsp", $row['hit']);
        
        echo "<tr style='border: 1px solid black; text-align: center;' class='tr2'>
						<td class='tb1'>$number</td>
						<td class='tb1'>$division</td>
						<td class='tb1' style='text-align:left;'><a href='notice_view.php?table=$table&num=$num&page=$page' id='subject_click'>$subject</a></td>
						<td class='tb1'>$regist_day</td>
						<td class='tb1'>$hit</td>
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
                        echo "<a href='notice.php?page=1' class='link_page'> << &nbsp;&nbsp;</a>";
                        $go_page = $page - 1;
                        echo "<a href='notice.php?page=$go_page' class='link_page'> <&nbsp;&nbsp; </a>";
                    }
                    ?>
                            <?php
                            
                            // 게시판 목록 하단에 페이지 링크 번호
                            for ($i = $first + 1; $i <= $last; $i ++) {
                                if ($page == $i) {
                                    echo "<b id='now_page'> $i </b>";
                                } else {
                                    echo "<a href='notice.php?table=$table&page=$i' class='link_page'> $i </a>";
                                }
                            }
                            ?>
     						<?php 
// 다음 블럭과 마지막블럭으로 이동시켜주는 링크
        if ($total_page > $page) {
            $go_page = $page + 1;
            echo "<a href='notice.php?page=$go_page' class='link_page'> &nbsp;&nbsp;></a>";
            echo "<a href='notice.php?page=$total_page' class='link_page'> &nbsp;&nbsp;>></a>";
        }
        echo "</div>";
        ?>
						</div>

						<div id="list_id">
							<a href="notice.php?table=<?=$table?>&page=<?=$page?>"><img src="./img/7.목록.png"></a>
      
                          <?php
                        if (isset($id) && $id == "admin") {
                            // id 변수가 있고, id의 값이 admin이면 글쓰기 버튼을 활성화
                            ?>
                          <a href="notice_write_form.php?table=<?=$table?>&page=<?=$page?>"><img src="./img/8.글쓰기.png"></a>
                          	
                          <?php
                        }
                        ?>
                         </div>
					</div>
			
			</section>
		</div>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html> 