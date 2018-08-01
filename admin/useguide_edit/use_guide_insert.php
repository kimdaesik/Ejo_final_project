  <?php 
    include '../../common_lib/common.php';
    
    $files = $_FILES['upfile'];
    
    $sql="select * from use_guide";
    $result = mysqli_query($con, $sql);
    $count_file = mysqli_num_rows($result);
    
    if($count_file==1){
        echo("
               <script>
               alert('파일을 삭제한 후에 등록해주세요.');
               history.go(-1)
               </script>
                ");
        exit();
    }

    $upload_dir = "../../common_data/useguide/";

        $upfile_name[0]     = $files["name"][0];
        $upfile_tmp_name[0] = $files["tmp_name"][0];
        $upfile_type[0]     = $files["type"][0];
        $upfile_size[0]     = $files["size"][0];
        $upfile_error[0]    = $files["error"][0];
        $file = explode(".", $upfile_name[0]);
        $file_name = $file[0];
        $file_ext  = $file[1];
        
        //파일 올리는데 오류가 없을시 실행
        if (!$upfile_error[0])
        {
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name."_".$i;
            $copied_file_name[0] = $new_file_name.".".$file_ext;
            $uploaded_file[0] = $upload_dir.$copied_file_name[0];
            }

            //가상에 등록한 파일을 실제 사용자가 지정한 경로에 저장한다  실패시 에러메세지 호출
            if (!move_uploaded_file($upfile_tmp_name[0], $uploaded_file[0]) )
            {
                echo("
               <script>
               alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
               history.go(-1)
               </script>
                ");
                exit;
            }
    
    $sql= "insert into use_guide (file_name) values ('$uploaded_file[0]')";
    mysqli_query($con, $sql) or die ("DB 입력 실패! ".mysqli_error($con));
    mysqli_close($con);
    
    echo ("<script>location.href='../admin.php?mode=admin_useguide_edit';</script>");
    ?>
    