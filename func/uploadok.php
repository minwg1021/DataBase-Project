<?php
  require_once 'dbconfig.php';

$URL = '../product.php';

// Check connection
if($conn->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

$pName = $_POST['pName'];                   //Writer
$Image = $_POST['Image'];                     //Password
$description = $_POST['description'];               //Title
$price = $_POST['price'];                    //Content
$today = date("Y/m/d");       //Date

//$query = "INSERT INTO Post (pName, Image, description, price, regdate, UID) values(null,'$title', '$content', '$date', 0, '$id', '$pw')";
$query = "insert into Post(pName,Image, description,price,regdate,UID) values('".$pName."','".$Image."','".$description."','".$price."','".$date."','".$_SESSION['UID']."')";

$result = $connect->query($query);
if ($result) {
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