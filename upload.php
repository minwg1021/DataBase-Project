<?php
  require_once './func/dbconfig.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chungbuk Market Place</title>
  
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet"
  />
    <link href="./css/main_styles.css" rel="stylesheet" />
    <link href="./css/upload.css" rel="stylesheet" />
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav"> <!-- 네브바-->
      <div class="container"> <!--  페이지 전체 div -->
        <a class="navbar-brand" href="./main.php"  
          ><img src="assets/img/logo.png" alt="..."
        /></a><!--  로고를 통해 메인페이지 이동  -->
        
        <!--  부트스트랩 메뉴 버튼-->
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
        <div class="collapse navbar-collapse" id="navbarResponsive"> <!--  네브바에 있는 버튼들  -->
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
    </nav><!--  네브바 끝 -->
    <div class="container mt-3"> 
      <!--  본문 시작 -->
      <form method="post" action="upload.php">
      <h2 style="padding-bottom: 40px;">게시물 등록</h2>
      <input
        name = "pName"
        type="text"
        class="form-control mt-2"
        id="title"
        placeholder="제목"
        style="padding-bottom: 15px;"
      />
      <textarea
        name = "description"
        class="form-control mt-2"
        id="content"
        placeholder="내용"
        style="padding-bottom: 100px;"
      ></textarea>
      <input
      name = "price"
        type="text"
        class="form-control mt-2"
        id="price"
        placeholder="가격"
        style="padding-bottom: 15px;"
      />
      <!-- <ul style="padding-top: 50px; padding-left : 10px;"> -->
        <!-- <li class="upload_image"> -->
          <!-- 이미지 등록 -->
          <input class="form-control mt-2" type="file" id="image"/>
          <!-- <img src="" id="preview"/> -->
        <!-- </li> -->
      <!-- </ul> -->
      <button class="btn btn-primary mt-3" id="upload" type = "submit">올리기</button>
    </form>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/login.js"></script>
    <script src="./js/open_loginForm.js"></script>
    <script src="./js/open_registerForm.js"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/preview_image.js"></script>
  </body>
</html>
