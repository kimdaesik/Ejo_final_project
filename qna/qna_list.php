<?php
session_start();
include '../common_lib/common.php';

if (! empty($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = "facility";
}
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$scale = 12;
$table = "qna";
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/qna.css?v=31">
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=2">
<?php
if (! empty($_GET['mode'])) {
    $mode = $_GET['mode'];
    $find = $_POST['find'];
    $search = $_POST['search'];
} else {
    $mode = "";
}
if (isset($mode) && ($mode == "search")) {
    if (empty($search)) {
        echo ("<script>window.alert('검색할 단어를 입력해 주세요.')
            history.go(-1)
            </script>");
        exit();
    }
    $sql = "select * from qna where $find like '%$search%' order by group_num desc, ord asc";
} else {
    $sql = "select * from qna order by group_num desc, ord asc";
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
								<b>──────&nbsp;&nbsp;Question & Answer&nbsp;&nbsp;──────</b>
							</p>
							<div id="notice2">
								<a href="../customer/notice.php?"><img
									src="./img/16.공지사항(3).png" style="width: 100%; height: 100%;"></a>
							</div>
							<div id="qna2">
								<a href="qna_list.php?"><img src="./img/17.Q&A(3).png"
									style="width: 100%; height: 100%;"></a>
							</div>
						</div>


						<hr id="clear">
						<div id="noti1">이조리조트에 관해 궁금하신점을 질문하세요.</div>

						<form name="search_form"
							action="qna_list.php?table=<?=$table?>&mode=search" method="post">
							<div id="table_find">
								<select name="find" id="combobox">
									<option value="subject">제목</option>
									<option value="id">작성자</option>
									<option value="content">내용</option>
								</select>
								<div id="search_find">
									<input type="text" id="qna_search" name="search">
								</div>
								<div id="find">
									<input type="submit" value="검색" id="find_input">
								</div>
							</div>
						</form>
						<div class="clear"></div>


						<div id="table_qna">
							<table id="table_size">
								<tr style="border: 1px solid black;" id="tr1">
									<td id="no" class="tb">No</td>
									<td id="title" class="tb">제목</td>
									<td id="id" class="tb">작성자</td>
									<td id="day" class="tb">작성일</td>
									<td id="check" class="tb">조회</td>
								</tr>
                  <?php
                $sql1 = "select * from qna where depth='D'";
                $result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
                $num1 = mysqli_num_rows($result1);
                for ($i = $start; $i < $start + $scale && $i < $total_record; $i ++) {
                    mysqli_data_seek($result, $i);
                    mysqli_data_seek($result1, $i);
                    $row = mysqli_fetch_array($result);
                    
                    $sql1 = "select depth from qna where num={$row['num']}";
                    $result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
                    $row1 = mysqli_fetch_array($result1);
                    if ($row1['depth'] == "D") {
                        echo "<tr style='border: 1px solid black; text-align: center;' class='tr2'>
                                <td class='tb1'>$num1</td>";
                        $num1 --;
                    } else {
                        echo "<tr style='border: 1px solid black; text-align: center;' class='tr2'>
                                <td class='tb1'> </td>";
                    }
                    
                    $num = str_replace(" ", "&nbsp", $row['num']);
                    $subject = str_replace(" ", "&nbsp", $row['subject']);
                    $id = str_replace(" ", "&nbsp", $row['id']);
                    $regist_day = str_replace(" ", "&nbsp", $row['regist_day']);
                    $hit = str_replace(" ", "&nbsp", $row['hit']);
                    
                    echo "        
                  <td class='tb1' style='text-align:left;'><a href='./qna_view.php?table=$table&num=$num&page=$page' id='subject_click'>$subject</a></td>
                  <td class='tb1'>$name</td>
                  <td class='tb1'>$regist_day</td>
                  <td class='tb1'>$hit</td>
                     </tr>
                       
                       <div class='clear'></div>";
                    
                    $number --;
                }
                ?>
                        </table>
						</div>
						<div id="page">
                       <?php
                    // 페이지가 1이 아닐 시.
                    if ($page != 1) {
                        $page_back = $page - 1;
                        echo "<a href='qna_list.php?page=$page_back'>< &nbsp;&nbsp;&nbsp;&nbsp</a>";
                    } else {
                        echo "< &nbsp;&nbsp;&nbsp;&nbsp";
                    }
                    // 게시판 목록 하단에 페이지 링크 번호 출력
                    for ($i = 1; $i <= $total_page; $i ++) {
                        // 현재 페이지 번호 링크 안함
                        if ($page == $i) {
                            
                            echo "<b> $i </b>";
                        } else {
                            echo "<a href='qna_list.php?page=$i'> $i </a>";
                        }
                    }
                    if ($page != $total_page && ! empty($total_page)) {
                        $page_after = $page + 1;
                        echo "<a href='qna_list.php?page=$page_after'>&nbsp;&nbsp;&nbsp;&nbsp; ></a>";
                    } else {
                        echo "&nbsp;&nbsp;&nbsp;&nbsp; >";
                    }
                    
                    ?>
                          
                  </div>
						<div id="button_qna">
							<div id="list_id">
								<a href="qna_list.php?table=<?=$table?>&page=<?=$page?>"> <input
									type="image" src="./img/list.png"></a> <a
									href="qna_write_form.php?table=<?=$table?>&page=<?=$page?>"> <input
									type="image" src="./img/write.png"></a>

							</div>
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