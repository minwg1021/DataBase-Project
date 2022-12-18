<?php
  include $_SERVER["DOCUMENT_ROOT"] . "/database-project/func/qna/dbcon.php";

  $index = $_GET["idx"];
  $mid = $_SESSION['MID'];
  
  $query = "INSERT INTO fSave(mid, fid) VALUES ('".$mid."','".$index."');";
  $result=$mysqli->query($query) or die($mysqli->error);

  if($result){
    echo "<script>alert('즐겨찾기에 추가되었습니다.');location.href='/database-project/facility.php';</script>";
    exit;
}
?>