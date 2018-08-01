  <?php 
  session_start();
  include "../common_lib/common.php";
    
  $id=mysqli_real_escape_string($con,$_POST['id']);
  $pw=mysqli_real_escape_string($con,$_POST['pw']);
  $save_id=$_POST['save_id'];
  
  $sql = "select * from membership where id='$id'";
  $result = mysqli_query($con,$sql) or die("실패원인:".mysqli_error($con));
  $num = mysqli_num_rows($result); 
  if(!$num){
    echo "<script>
      alert('등록되지 않은 회원입니다.');
      history.go(-1);
    </script>";
    exit();
  }else{
    $row = mysqli_fetch_array($result);
    if($pw!==$row['password']){
      echo "<script>
        alert('비밀번호가 틀립니다.');
        history.go(-1);
      </script>";
      exit();
    }else{
      $_SESSION['name'] = $row['name'];
      $_SESSION['id'] = $row['id'];
      $id = $row['id'];
      if(!empty($save_id)){
        setcookie('cookie_id', $id, time()+(86400*30),"/");
      }
      echo "<script>
        location.href='../index.php';
      </script>";
    }
    
  }
?>