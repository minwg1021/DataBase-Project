<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";

$URL = '../detail.php';

// Check connection
if($mysqli->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

$index = $_GET['idx'];  // pid
$contents = $_POST['contents'];                      
$date = date("Y/m/d");      

$sql = "insert into reply (comments,userid,regdate, PID) values('".$contents."','".$_SESSION['UID']."','".$date."','".$index."')";

if (mysqli_query($mysqli, $sql)) {
?> <script>
      
      alert("<?php echo "댓글이 등록되었습니다." ?>");
      location.replace("/database-project/detail.php?idx=<?=$index?>");
    </script>
<?php
} else {
    echo "댓글 등록에 실패하였습니다.";
}


?>