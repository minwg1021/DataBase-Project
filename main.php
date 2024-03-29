<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Chungbuk Market Place</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script
      src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700"
      rel="stylesheet"
      type="text/css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet"
  />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <link href="css/main_styles.css" rel="stylesheet" />
  </head>
  <body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#page-top"
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
              <a class="nav-link" href="#introduce">소개</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#item">물건 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">커뮤니티</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/database-project/func/qna/qna_main.php">Q&A</a>
            </li>
            <li class="nav-item">
            <?php
                if(isset($_SESSION['UID'])){
            ?>
              <span><?php echo $_SESSION['UID']?>님</span>
              <a href="/database-project/myPage.php"><img src="/DataBase-Project/assets/img/myPage.png"></a>
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
    <header class="masthead">
      <div class="container">
        <div class="masthead-subheading text-uppercase">CBNU</div>
        <div class="masthead-heading text-uppercase">Flea Market</div>
      </div>
    </header>
    <section class="page-section" id="introduce">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">CBMP 소개</h2>
          <h3 class="section-subheading text-muted">
            CBMP에서는 무슨 일을 하죠?
          </h3>
        </div>
        <div class="row text-center">
          <div class="col-md-6">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="my-3">충대생을 위한 장터</h4>
            <p class="text-muted">
              버려지는 자취 물품들을 중고로 사고 팔 수 있어요!<br />
              생필품부터 강의교재까지 다양한 품목을 저렴한 가격으로 거래
              가능해요!
            </p>
          </div>
          <div class="col-md-6" style="text-align: center">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="my-3">우리동네 방방곡곡</h4>
            <p class="text-muted">
              우리 동네에 무슨 가게들이 있을까 서로 정보를 공유할 수 있는
              공간이에요
            </p>
          </div>
        </div>
      </div>
    </section>
    <section class="page-section bg-light" id="item">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">충대생을 위한 장터</h2>
          <h3 class="section-subheading text-muted">
            우리 동네에는 어떤 물품들이 올라왔을까요?
          </h3>
          <a type="button" class="btn btn-primary" href="./product.php" style="margin-bottom: 20px">둘러보기</a>
        </div>
        <div class="row" id="main_product"></div>
      </div>
    </section>
    <div id="main_product_info"></div>
    <section class="page-section" id="about">
      <div class="container">
        <div class="text-center">
          
          <h2 class="section-heading text-uppercase">우리동네 방방곡곡</h2>
           <a type="button" class="btn btn-primary" href="./facility.php" style="margin-bottom: 20px">둘러보기</a>
          <h3 class="section-subheading text-muted"></h3>
        </div>
        <ul class="timeline">
          <li>
            <div class="timeline-image">
              <img
                class="rounded-circle img-fluid"
                src="assets/img/cafe.jpg"
                alt="..."
              />
            </div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="subheading">이런 카페도 있었어?</h4>
              </div>
              <div class="timeline-body">
                <p class="text-muted">
                  #감성카페 #카페맛집 #예쁜카페 <br />
                  #디저트맛집#분위기맛집
                </p>
              </div>
            </div>
          </li>
          <li class="timeline-inverted">
            <div class="timeline-image">
              <img
                class="rounded-circle img-fluid"
                src="assets/img/restaurant.jpg"
                alt="..."
              />
            </div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="subheading">뭐 먹을지 고민이야?</h4>
              </div>
              <div class="timeline-body">
                <p class="text-muted">
                  #혼밥 #제육볶음 #돈까스 <br />
                  #삼겹살 #가성비 갑 #곱창
                </p>
              </div>
            </div>
          </li>
          <li>
            <div class="timeline-image">
              <img
                class="rounded-circle img-fluid"
                src="assets/img/bookstore.jpg"
                alt="..."
              />
            </div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="subheading">이런 서점 어때?</h4>
              </div>
              <div class="timeline-body">
                <p class="text-muted">
                  #옛날책방 #서점카페 #서점여행 <br />
                  #자기계발 #힐링도서
                </p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <footer class="footer py-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 my-3 my-lg-0">
            <a
              class="btn btn-dark btn-social mx-2"
              href="#!"
              aria-label="Twitter"
              ><i class="fab fa-twitter"></i
            ></a>
            <a
              class="btn btn-dark btn-social mx-2"
              href="#!"
              aria-label="Facebook"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a
              class="btn btn-dark btn-social mx-2"
              href="#!"
              aria-label="LinkedIn"
              ><i class="fab fa-linkedin-in"></i
            ></a>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <script src="./js/register.js"></script>
    <script src="./js/navbar.js"></script>
    <script src="./js/scroll.js"></script>
    <script src="./js/open_loginForm.js"></script>
    <script src="./js/open_RegisterForm.js"></script>
    <script src="./js/main_product.js"></script>
  </body>
</html>
