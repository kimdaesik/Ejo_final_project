  <?php 
    include '../../common_lib/common.php';
    
    $useguidefile = $_GET['filename'];
    
    $sql = "select * from use_guide";
    $result=mysqli_query($con, $sql) or die("레코드 로딩 실패" . mysqli_error($con));
    $row=mysqli_fetch_array($result);
    $file_name = $row[file_name];
    
    unlink($file_name);
    
    $sql = "delete from use_guide where file_name='$file_name'";
    mysqli_query($con, $sql);
    
/*     var_dump($unlink_check, $file_name);
    exit(); */
    
    mysqli_close($con);
    
    echo ("<script>location.href='../admin.php?mode=admin_useguide_edit';</script>");
    ?>
    