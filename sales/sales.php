<?php
include "../common_lib/common.php";
if(!empty($_GET['type'])){
    $type=$_GET['type'];
}else{$type="facility";}
if(empty($_GET['page'])){
    $page=1;
}else{$page=$_GET['page'];}

$current_year=date("20y");

?>

<html>
<head>
<meta charset="UTF-8">
<title>이조리조트에 오신것을 환영합니다.</title>
<link type="text/css" rel="stylesheet" href="../common_css/project_style.css?v=1">
<link type="text/css" rel="stylesheet" href="./css/sales.css?v=3">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
function time_interval(){
	setInterval('window.location.reload()', 5000);
}
</script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);
  
    
    <?php
    $jan_total=0;$feb_total=0;$mar_total=0;
    $apr_total=0;$may_total=0;$jun_total=0;
    $jul_total=0;$aug_total=0;$sep_total=0;
    $oct_total=0;$nov_total=0;$dec_total=0;
    
    
    		//그래프 값
    		    
    	        $sql = "select * from sales order by num";
    	        $result = mysqli_query($con, $sql) or die('123');
    	        $total_record = mysqli_num_rows($result);
    	        
    	      

    	    for ($i=0;$i<=$total_record;$i++){
    	        mysqli_data_seek($result, $i);
    	        $row = mysqli_fetch_array($result);
    	        
    	        $num = $row['num'];
    	        $regist_day = $row['regist_day'];
    	        $item_year = substr($regist_day, 0, 4);
    	        $item_month = substr($regist_day, 4, 2);
    	        $item_day = substr($regist_day, 6, 2);

    	        $sql = "update sales set item_year = '$item_year', item_month = '$item_month', item_day = '$item_day' where num='$num'";
    	        mysqli_query($con, $sql);
    	    }

    	    $sql = "select SUM(money) as money from sales where item_month='01'";
    	    $result = mysqli_query($con, $sql);
       	    $row=mysqli_fetch_array($result);
       	    $jan_total=$row["money"];
       	    
       	    


    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='02'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
       	    $feb_total=$row["money"];

    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='03'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $mar_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='04'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $apr_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='05'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $may_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='06'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $jun_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='07'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $jul_total=$row["money"];
    	    
            $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='08'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $aug_total=$row["money"];

    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='09'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $sep_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='10'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $oct_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='11'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $nov_total=$row["money"];
    	    
    	    $sql = "select SUM(money) as money from sales where item_year = $current_year and item_month='12'";
    	    $result = mysqli_query($con, $sql);
    	    $row=mysqli_fetch_array($result);
    	    $dec_total=$row["money"];

    ?>
    	
    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'month');
        data.addColumn('number', '매출');

        data.addRows([
          [01,  <?= (int)$jan_total ?>],
          [02,  <?= (int)$feb_total ?>],
          [03,  <?= (int)$mar_total ?>],
          [04,  <?= (int)$apr_total ?>],
          [05,  <?= (int)$may_total ?>],
          [06,  <?= (int)$jun_total ?>],
          [07,  <?= (int)$jul_total ?>],
          [08,  <?= (int)$aug_total ?>],
          [09,  <?= (int)$sep_total ?>],
          [10,  <?= (int)$oct_total ?>],
          [11,  <?= (int)$nov_total ?>],
          [12,  <?= (int)$dec_total ?>]
        ]);

        var options = {
          chart: {
            title: '월별 리조트 매출현황',
            subtitle: '(단위:만원)'
          },
          width: 900,
          height: 500
        };
        var chart = new google.charts.Line(document.getElementById('linechart_material'));
        chart.draw(data, google.charts.Line.convertOptions(options));
      }
</script>

<!-- 객실별 이용율 파이차트 -->
<script type="text/javascript">
	google.charts.load("current", {packages:['corechart']});
	google.charts.setOnLoadCallback(drawChart);
   	<?php
    		//파이차트 값
    		$sql = "select * from reserve where room_type='family'";
    		$family = mysqli_query($con,$sql);
    		$family = mysqli_num_rows($family);
    		
    		$sql = "select * from reserve where room_type='suite'";
    		$suite = mysqli_query($con,$sql);
    		$suite = mysqli_num_rows($suite);
    		
    		$sql = "select * from reserve where room_type='royalsuite'";
    		$royalsuite = mysqli_query($con,$sql);
    		$royalsuite = mysqli_num_rows($royalsuite);
    ?>
    
	function drawChart() {	
		var data = google.visualization.arrayToDataTable([
		['Task', 'using per reserve'],
		['family',     <?= $family; ?>],
		['suite',      <?= $suite; ?>],
		['royalsuite', <?= $royalsuite; ?>]
		]);
		
		var options = {
			title: '객실별 이용률'
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
	}
</script>
</head>
<body id="m">
   <div>
      <?php
         include "../common_lib/header2.php";
      ?>
       <section>
          <div id="view">
            <div id="view_title"><b>────── S A L E S&nbsp;&nbsp;&nbsp;I N F O ──────</b></div>
            
            <br>
            <hr id="clear"></hr>
            <div id="sales_view_content">
 
 			<div id="linechart_material" style="width: 700px; height: 1000px; float:left;"></div>
 			<div id="piechart" style="width: 400px; height: 500px; float:left;"></div>
 
          	</div>
          </div>
       </section>
       <?php
          include "../common_lib/footer2.php";
       ?>
   </div>
</body>
</html>