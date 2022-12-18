<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";

$query = "SELECT * FROM members WHERE mid = ".$_SESSION['MID'];


$user = $mysqli->query($query) or die("query error => ".$mysqli->error);
$result = $user->fetch_object();

$query2 = "SELECT * FROM fSave WHERE mid = ".$_SESSION['MID'];
$savedFacility = $mysqli->query($query2) or die("query error => ".$mysqli->error);
while ($frs = $savedFacility->fetch_object()) {
  $printFArray[] = $frs;
}
foreach ($printFArray as $fa) {
  $query3 = "SELECT * FROM facility WHERE fid = ".$fa->fid;
  $result3 = $mysqli->query($query3) or die("query error => ".$mysqli->error);
  $printF = $result3->fetch_object();
}

?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chungbuk Market Place</title>
  <!--페이지 설명-->
  <meta name="description" content="충북대학교 주변 식당 찾아보기">
  <!--네이버 서치 어드바이저-->
  <meta name="naver-site-verification" content="0d3ce23029926376892b30f7482b37563f570b67" />
  <!--소셜미디어(카카오톡)-->
  <meta property="og:type" content="website">
  <meta property="og:title" content="CBMP - 씨비앰피">
  <meta property="og:description" content="충북대학교 주변 식당 찾아보기">
  <!--부가기능-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/93299e9387.js" crossorigin="anonymous"></script>
  <script type="text/javascript"
    src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=4sw4pxi6um&submodules=geocoder"></script>
  <link rel="stylesheet" href="css/map_css/styles.css">
  <link rel="stylesheet" href="./css/main_styles.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="./main.php"><img src="assets/img/logo.png" alt="..." /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
            if (isset($_SESSION['UID'])) {
            ?>
            <span><?php echo $_SESSION['UID']?>님</span>
            <a href="/database-project/myPage.php"><img src="/DataBase-Project/assets/img/myPage.png"></a>
            <a href="/database-project/func/qna/member/logout.php"><button type="button"
                class="btn btn-primary">로그아웃</button><a>
                <?php
            } else {
                ?>
                <a href="/database-project/func/qna/member/login.php"><button type="button"
                    class="btn btn-primary">로그인</button><a>
                    <a href="/database-project/func/qna/member/signup.php"><button type="button"
                        class="btn btn-primary">회원가입</button><a>
                        <?php
            }
                        ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div id="map-container" class="invisible">
    <!-- <div id="map-quit">x</div> -->
    <img id="map-quit" src="./assets/img/107260.png">
    <div id="map-box">
      <div id="map" style="border-radius: 50px;"></div>
    </div>
  </div>

  <main class="main-box" style="margin-top: 200px;">
    <div class="intro">
      <p>아이디: <?php echo $result->userid ?></p>
      <p>이름: <?php echo $result->username ?></p>
      <p>가입일: <?php echo $result->regdate ?></p>
    </div>

    <div class="tag-filters">
      <div class="tag-filter">
        <h4 class="tag-filter__title">찜 목록</h4>
        <div class="tag-filter__tags">
          <span class="tag-filter__tag" data-filter="*">모두</span>
          <span class="tag-filter__tag" data-filter="식당">식당</span>
          <span class="tag-filter__tag" data-filter="카페">카페</span>
          <span class="tag-filter__tag" data-filter="스터디카페">스터디카페</span>
          <span class="tag-filter__tag" data-filter="서점">서점</span>
          <span class="tag-filter__tag" data-filter="술집">술집</span>
          <span class="tag-filter__tag" data-filter="병원">병원</span>
          <span class="tag-filter__tag" data-filter="사진관">사진관</span>
        </div>
      </div>
    </div>

    <div class="restaurant-lists">
      <?php
        foreach ($printFArray as $fa) {
          $query3 = "SELECT * FROM facility WHERE fid = ".$fa->fid;
          $result3 = $mysqli->query($query3) or die("query error => ".$mysqli->error);
          $printF = $result3->fetch_object();
      ?>
       <div class="restaurant-list" address="<?php echo $printF->address ?>" data-type="<?php echo $printF->type ?>">
        <div class="restaurant-list__tags">
        </div>
        <div class="restaurant-list__imgBox">
          <img class="restaurant-list__img" src="<?php echo $printF->image ?>">
        </div>
        <div class="restaurant-list__textBox">
          <span class="restaurant-list__textBox__name">
            <?php echo $printF->name ?>
          </span>
          <span class="restaurant-list__textBox__sub">
            <?php echo $printF->description ?>
          </span>
        </div>
      </div>
      <?php
        }
      ?>

    </div>
    <!--<div class="visitor">
        <script type="text/javascript" src="https://freecountercode.com/service/4HmVR6xtJApelUCf8ow1"></script>
      </div>-->
  </main>
  </div>

  <script src="./js/login.js"></script>
  <script src="./js/register.js"></script>
  <script src="./js/navbar.js"></script>
  <script src="./js/open_loginForm.js"></script>
  <script src="./js/open_RegisterForm.js"></script>
  <script src="js/map_js/filter.js"></script>
  <script src="js/map_js/menubtn.js"></script>
  <script src="js/map_js/map.js"></script>
  <script src="js/map_js/isMobile.js"></script>
</body>