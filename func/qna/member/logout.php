<?php session_start();

session_destroy();

echo "<script>alert('로그아웃 되었습니다.');location.href='database-project/func/qna/qna_main.php';</script>";
exit;

?>