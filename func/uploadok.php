<?php
  require_once 'dbconfig.php';

$URL = '../product.php';

// Check connection
if($conn->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

$index = $_GET['idx']; 

$pName = $_POST['pName'];                 
$description = $_POST['description'];              
$price = $_POST['price'];                    
$date = date("Y/m/d");      



//$query = "INSERT INTO Post (pName, Image, description, price, regdate, UID) values(null,'$title', '$content', '$date', 0, '$id', '$pw')";
$sql = "insert into Post(pName,Image, description,price,regdate,uploader) values('".$pName."','".$file."','".$description."','".$price."','".$date."','".$_SESSION['MID']."')";



if (mysqli_query($conn, $sql)) {
?> <script>
        alert("<?php echo "게시글이 등록되었습니다." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
} else {
    echo "게시글 등록에 실패하였습니다.";
}

mysqli_close($connect);
?>