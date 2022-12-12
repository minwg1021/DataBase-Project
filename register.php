<?php


$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "CBMP";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if($conn->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

mysqli_select_db($conn, $dbname) or die('DB selection failed');

$name = $_POST['name'];
$email = $_POST['email'];
$pw = $_POST['psw']; //$pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$address = $_POST['address'];
$phoneNumber = $_POST['pn'];
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
$sql = "insert into user(Email,Password,uName,address,tel) values('".$email."','".$pw."','".$name."','".$address."','".$phoneNumber."')";
if($conn->query($sql) === TRUE){
	echo "<script>
    alert('회원가입이 완료되었습니다.');
    location.href='main.html';</script>";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>