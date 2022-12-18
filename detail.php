<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";
  $index = $_GET['idx']; 


  /// 1 = 게시판 정보를 가져오는 sql 코드
  // 2 = 게시글에 mid가 들어있기 때문에 작성자에 userid를 넣기 위한 코드
$sql = "select * from Post Where PID = $index";
$sql2 = "select * from members Where mid = (select uploader from Post Where PID = $index)";  
$result = mysqli_query($mysqli, $sql);
$result2 = mysqli_query($mysqli, $sql2);
$row = mysqli_fetch_array($result);
$row2 = mysqli_fetch_array($result2);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet"
  />
    <link rel="stylesheet" href="./css/detail.css" />
    <link rel="stylesheet" href="./css/main_styles.css" />
    <title>Chungbuk Market Place</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="./main.php"
          ><img src="assets/img/logo.png" alt="..."
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          Menu
          <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./product.php">물건 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./facility.php">시설 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./notice.php">공지사항</a>
            </li>
            <li class="nav-item">
             <a class="nav-link" href="/database-project/func/qna/qna_main.php">Q&A</a>
            </li>
            <li class="nav-item">
            <?php
                if(isset($_SESSION['UID'])){
            ?>
                <a href="/database-project/func/qna/member/logout.php"><button type="button" class="btn btn-primary">로그아웃</button><a>
            <?php
                }else{
            ?>
                <a href="/database-project/func/qna/member/login.php"><button type="button" class="btn btn-primary">로그인</button><a>
                <a href="/database-project/func/qna/member/signup.php"><button type="button" class="btn btn-primary">회원가입</button><a>
            <?php
                }
            ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-3" id="item-info">
      <button class="btn btn-outline-secondary" id="edit" ><a  href="/database-project/edit.php?idx=<?=$row['PID']?>">수정</a></button>
      <div
        class="detail-pic my-4"
        style="background-image: "
      ><?php 
echo '<img src="data:image;base64,'.base64_encode($row['Image']).'" alt="Image" style="width: 400px; height: 400px;">';?></div>
      <div>
        <h4 class="author"><?php echo $row2['userid'];?> <?php ?></h5> <!-- 순서대로 넣으면 됨 -->
        <p class="date" style="font-size : 12px"><?php echo $row['regdate'];?></p>
        <hr />
        <h4 class="title"><?php echo $row['pName'];?></h5>
        <p class="content"><?php echo $row['description'];?></p>
        <p class="price"><?php echo $row['price'];?> 원</p>
      </div>
    </div>

<!--댓글 등록-->
    <div style="margin-top:20px;">
        <form class="row g-3" method="post" action="/database-project/func/reply.php?idx=<?=$row['PID']?>">
          <div class="col-md-10">
            <textarea name = "contents" class="form-control" placeholder="댓글을 입력해주세요." id="reply" style="height: 60px"></textarea>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-secondary" id="memo_button">댓글등록</button>
          </div>
        </form>
      </div>
<!-- 댓글 내용 보이기-->
<?php
              $sql = "select * from reply Where PID = $index";
              $result3 = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_array($result3)) {
?>

      <div class="card mb-4"  style="max-width: 100%;margin-top:20px;">
          <div class="row g-0">
            <div class="col-md-12">
              <div class="card-body">
                <p class="card-text"><?php echo $row['comments'];?></p>
                <p class="card-text"><small class="text-muted"><?php echo $row['userid'];?>/<?php echo $row['regdate'];?></small></p>

              </div>
            </div>
          </div>
        </div>
        <?php
                }
                ?>
      </div>

    <script src="./js/detail.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/open_loginForm.js"></script>
    <script src="./js/open_registerForm.js"></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>