<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";

$userid=$_POST["userid"];
$passwd=$_POST["passwd"];
$passwd=hash('sha512',$passwd);

$query = "select * from members where userid='".$userid."' and passwd='".$passwd."'";

$result = $mysqli->query($query) or die("query error => ".$mysqli->error);
$rs = $result->fetch_object();

if($rs){
    $_SESSION['UID']= $rs->userid;
    $_SESSION['UNAME']= $rs->username;
    $_SESSION['MID'] = $rs->mid;
    echo "<script>alert('로그인에 성공하였습니다.');location.href='/database-project/main.php';</script>";
    exit;

}else{
    echo "<script>alert('아이디나 암호가 틀렸습니다.');history.back();</script>";
    exit;
}

?>