<?php session_start();
  require_once 'dbconfig.php';

$URL = '../detail.php';

// Check connection
if($conn->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

$index = $_GET['idx'];  // pid
$contents = $_POST['contents'];                      
$date = date("Y/m/d");      

$sql = "insert into reply (comments,userid,regdate, PID) values('".$contents."','".$_SESSION['UID']."','".$date."','".$index."')";



if (mysqli_query($conn, $sql)) {
?> <script>
      
       history.back();
       document.getElementByid("reply").value = '';
    </script>
<?php
} else {
    echo "댓글 등록에 실패하였습니다.";
}

mysqli_close($connect);
?>