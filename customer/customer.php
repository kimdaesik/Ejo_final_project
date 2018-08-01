<?php
include '../common_lib/common.php';

$id="admin";

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
$scale = 14;
$table = "notice";
?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="./css/customer.css?v=3">
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
						<div id="side_menu"></div>
					<div id="content">

						<div id="notice_content">
							<p id="noti">
								<b>──────&nbsp;&nbsp;C U S T O M E R &nbsp;&nbsp;C E N T E R&nbsp;&nbsp;──────</b>
							</p>
						</div>
								<br><br><br>
						<hr id="clear">
				
						<div id="notice_select_img"><a href="notice.php"><img src="./img/16.공지사항(1).png" id="notice_trans"></a></div>
						<div id="qna_select_img"><a href="../qna/qna_list.php"><img src="./img/17.Q&A(1).png" id="qna_trans"></a></div>
	
                    </div> <!-- content -->
			</section>
		</div>
       <?php
    include "../common_lib/footer2.php";
    ?>
   </div>
</body>
</html> 