<?php
  require_once 'dbconfig.php';

$URL = '../product.php';

// Check connection


$index = $_GET['idx'];  // pid
$pName = $_POST['pName'];                 
$description = $_POST['description'];              
$price = $_POST['price'];                    
$date = date("Y/m/d");      



//$query = "INSERT INTO Post (pName, Image, description, price, regdate, UID) values(null,'$title', '$content', '$date', 0, '$id', '$pw')";
$sql = "update Post set pName='$pName', description='$description',
  regdate='$date', price = '$price' where PID='$index'";

if (mysqli_query($conn, $sql)) {
?> <script>
        alert("<?php echo "게시글이 수정되었습니다." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
} else {
    echo "게시글 수정에 실패하였습니다.";
}

mysqli_close($connect);
?>