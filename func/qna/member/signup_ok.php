<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";

$userid=$_POST["userid"];
$username=$_POST["username"];
$email=$_POST["email"];
$passwd=$_POST["passwd"];
$passwd=hash('sha512',$passwd);

$sql="INSERT INTO members
        (userid, email, username, passwd)
        VALUES('".$userid."', '".$email."', '".$username."', '".$passwd."');
";
$result=$mysqli->query($sql) or die($mysqli->error);


if($result){
    echo "<script>alert('회원가입에 성공했습니다.');location.href='/database-project/main.php';</script>";
    exit;
}else{
    echo "<script>alert('회원가입에 실패했습니다.');history.back();</script>";
    exit;
}
?>