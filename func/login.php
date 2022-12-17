<?php
  require_once 'dbconfig.php';

  error_reporting(E_ALL);
  ini_set("display_errors", 0);

  // Check connection
  if($conn->connect_error){
    die("Connection failed: " + $conn->connect_error);
  }

  error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
  //입력 받은 id와 password
  $id = $_POST['id'];
  $pw = $_POST['pw'];

  //아이디가 있는지 검사
  $query = "select * from user where Email='$id'";
  $result = $conn->query($query);
  $row = mysqli_fetch_assoc($result);


  if ($row != NULL) {
      //비밀번호가 맞다면 세션 생성
      if ($row['Password'] == $pw) {    //password 평문비교 취약!
          $_SESSION['Email'] = $id;
          $_SESSION['UID'] = $row['UID'];
          if (isset($_SESSION['Email'])) {
        echo "<script>
      alert('로그인 성공');
      location.href='../main.php';</script>";
      } 
      } else {
          echo "<script>
          alert('로그인 실패');
          location.href='../main.php';</script>";
      }
  }
  else{
      echo "<script>
          alert('row 안들어감');
          location.href='../main.php';</script>";
  }
?>
