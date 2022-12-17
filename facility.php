<?php
  require_once './func/dbconfig.php';
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
  <meta name="naver-site-verification" content="0d3ce23029926376892b30f7482b37563f570b67"/>
  <!--소셜미디어(카카오톡)-->
  <meta property="og:type" content="website">
  <meta property="og:title" content="CBMP - 씨비앰피">
  <meta property="og:description" content="충북대학교 주변 식당 찾아보기">
  <!--부가기능-->
<script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
  <script src="https://kit.fontawesome.com/93299e9387.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=4sw4pxi6um&submodules=geocoder"></script>    <link rel="stylesheet" href="css/map_css/styles.css">
  <link rel="stylesheet" href="./css/main_styles.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap" rel="stylesheet"/>
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
            <a class="nav-link" href="./qna.php">Q&A</a>
          </li>
          <li class="nav-item">
            <input
              class="btn btn-primary"
              type="button"
              id="btn-login"
              value="로그인"
              onclick="openLoginForm()"
            />
            <div class="form-popup" id="myForm_login">
              <form action="/action_page.php" class="form-container">
                <h1>로그인</h1>
                <label for="email"><b>아이디</b></label>
                <input
                  type="email"
                  placeholder="Enter ID"
                  name="email"
                  id="email"
                  required
                />
                <label for="psw"><b>비밀번호</b></label>
                <input
                  type="password"
                  placeholder="Enter Password"
                  name="psw"
                  id="pw"
                  required
                />
                <input type="button" class="btn" id="login" value="로그인"></button>
                <button
                  type="button"
                  class="btn cancel"
                  onclick="closeLoginForm()"
                >
                  Close
                </button>
              </form>
            </div>
            <input
              class="btn btn-primary"
              type="button"
              id="btn-logout"
              value="로그아웃"
            />
            <input
              class="btn btn-primary"
              type="button"
              id="btn-register"
              value="회원가입"
              onclick="openRegisterForm()"
            />
            <div class="form-popup" id="myForm_register">
              <form action="/action_page.php" class="form-container">
                <h1>회원가입</h1>
                <label for="name-new"><b>이름</b></label>
                <input
                  type="text"
                  placeholder="Enter Name"
                  name="name"
                  id="name-new"
                  required
                />
                <label for="email-new"><b>아이디</b></label>
                <input
                  type="email"
                  placeholder="Enter ID"
                  name="email"
                  id="email-new"
                  required
                />
                <label for="pw-new"><b>비밀번호</b></label>
                <input
                  type="password"
                  placeholder="Enter Password"
                  name="psw"
                  id="pw-new"
                  required
                />
                <input type="button" class="btn" id="register" value="회원가입"></button>
                <button
                  type="button"
                  class="btn cancel"
                  onclick="closeRegisterForm()"
                >
                  Close
                </button>
              </form>
            </div>
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

    <main class="main-box">
      <div class="intro">
        <h1 class="intro--title">우리 동네 방방곡곡</h1>
        <h2 class="intro--sub">충북대학교 주변 이용할만한 시설을 소개합니다.</h2>
      </div>

      <div class="tag-filters">
        <div class="tag-filter">
          <h4 class="tag-filter__title">충북대학교 주변 시설 종류</h4>
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
        <div class="restaurant-list" address="1순환로648번길 58" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxODA2MDlfMjAg%2FMDAxNTI4NDg3NzcwNjc1.Pt-X6tlbmgCKbqXccrn4Zd4lgveRp4-plVfweX7og4Qg.Ribh795yC9qkGnHp9T6J6EwPCf87IkmbE92xazQ48hog.JPEG.wwee09%2FIMG_1395.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">우주식탁</span>
            <span class="restaurant-list__textBox__sub">차돌된장찌개이 맛있는 한식집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로704번길 20" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjAxMDJfMjQ0%2FMDAxNjQxMTIxMzQzMDgz.vVZsW8W0hFGgLhLswj9T5eXQwMdsznwDYScm7S1uh_sg.BkY00lbHJXzaf_an_6ivIo6sHZBFdMW52rdlv0_ZAwog.JPEG.uqkwl%2F20210618%25A3%25DF185501%25A3%25DFIMG%25A3%25DF1450.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">헤이밀</span>
            <span class="restaurant-list__textBox__sub">크로플이 맛있는 중문 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로82번길 14" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#양식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjA0MjNfMTMy%2FMDAxNjUwNjk1NDk3NjY0.RiJM4Nc1NNaqKZVwEPGTkvsovEu69Ogm8o5Ls_wq4g8g.NtXlr-BZbV64IEBCjRegYAwI3aI6TwEp16_Xu1OOZOsg.JPEG.sawon9k%2FKakaoTalk_20220323_235550450_02.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">파파돈</span>
            <span class="restaurant-list__textBox__sub">돈까스 맛집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로674번길 26" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#후문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxOTEwMTVfMjA5%2FMDAxNTcxMTMzMjUyNDM2.g9DsXqDL5-S4N3URB9vkEbSLUjWtl5XkFSk38hAjWRUg.xRpnE-m4RwrVB7v5ois2K5cMcPcSd-gErMzsr9tZYbgg.JPEG.kys960206%2FIMG_1515.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">소주신랑 보쌈부인</span>
            <span class="restaurant-list__textBox__sub">저렴한 가격의 보쌈정식</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 43" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxOTAzMTRfMTY4%2FMDAxNTUyNDkxMTYzMjgz.pMAd3xKQbjhOs306L_xRD2cd_LXT4_7Ag_evferza7wg.uPfGscTKqJohH0TAhTjBOMamuz_4jzpqv3mUwrpyAvog.JPEG.dgd1231%2FIMG_5299.JPG&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">요리조리 쿡쿡</span>
            <span class="restaurant-list__textBox__sub">알밥, 비빔밥 맛있는 가게</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 51" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#양식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTAyMTlfMTI1%2FMDAxNjEzNzA5ODAwOTY1.gUVvCjwzLbQBQ-RzMexvo8GrIExTsaEySYZ8X6H3v5Qg.FphQ5zbEdXqXpfVvhBJJxNCCosK5ULMYecyI83HWJ7Yg.JPEG.lhseop0710%2FKakaoTalk_Image_2021-02-19-13-33-11_010.jpeg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">자연을 담은 돈까스</span>
            <span class="restaurant-list__textBox__sub">양이 많고 맛있는 양식 돈까스</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로242번길 43" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#서문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA1MTlfMjAg%2FMDAxNjIxMzk2MDk5ODgy.s3TGhnFWh1b2QJNmYAcMxtwU3FqBG9jopSMqQ51pcQAg.q9y87wnGyQSn3x-hf4eFww7Se6MhMOx1O_LjR8KjoEog.JPEG.chogyungjoo%2FIMG_2687.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">보통의 국수집</span>
            <span class="restaurant-list__textBox__sub">양 많은 제육덮밥과 칼국수</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로674번길 48" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#일식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTAyMDlfMjMz%2FMDAxNjEyODczMDcyMTU2.Je83uA25N_pkOlLsUdb33nGrm2ywhF8Mg494AiTayn4g.5ZIy_1IFIk0oBV4ENpvcGiuWucXE7Jrdsi1x3lIIxBog.JPEG.oheesu12%2FIMG_3374.JPG&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">쿡메시야</span>
            <span class="restaurant-list__textBox__sub">돈까스와 카레가 맛있는 일식당</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로114번길 51" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#빙수</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA3MjdfOTgg%2FMDAxNjI3MzY0MTAyNjQ5.DZeVkQ6k-_mpN6vEkGRSAgXmTObr0J6iZEwBDUSBH04g.Sb5jFHpLAaIb2DSWtV231fRS775Cr2X0dMrIip2jtCcg.JPEG.dnj0528%2FKakaoTalk_20210726_092828939_03.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">화이트스노우</span>
            <span class="restaurant-list__textBox__sub">신선한 과일이 가득 담긴 빙수집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 47" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDEwMjhfMTg2%2FMDAxNjAzODQ5MTA1MzM0.o32BgVUC_3WWv5uiaRmrSEWhP7Bq_c4qMMsWdzolyHEg.q565e1Lb6wadhLV3hXt_T7w9x0CKkcui4c1CXmY2-bMg.JPEG.yn0819%2FIMG_9989.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">로이의 작업실</span>
            <span class="restaurant-list__textBox__sub">중문 분위기 좋고 공부하기 좋은 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 22" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjAxMjVfMjgw%2FMDAxNjQzMTEyNzA1NTQx.T-rBO2uEP6ZtdOfM5cE0q-_mwfwq6zchhH0HyzIAnSMg.RXvBYIdz_ibTbPWuqdsK7zhtPsifVWSnEBUmsUGoo2Ug.JPEG.175286%2FIMG_9701.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">동래집</span>
            <span class="restaurant-list__textBox__sub">안주가 맛있고 서비스를 많이 주는 술집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로42번길 19" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDExMDFfMTc2%2FMDAxNjA0MjI0MzY3MDcw.IzAT19GJOv6Wb_hQdGFRG0axAfKY270jOTmrUGHKG0Ig.Ndsk9BybPFyfoQCb-Wy7NNBHqNvKmzTljj7Fg0EkB8og.JPEG.lillie91%2FIMG_5989.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">이가네 전집</span>
            <span class="restaurant-list__textBox__sub">정문에 위치한 전집</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로 299" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjA0MDlfNTYg%2FMDAxNjQ5NTA4MTIwODA3.lH5mgzx5Zxx8poV9_mmkMvNMC8S8WoN2L0UMn2YdK-4g.kdOkjGbb6Jcpv-K1rKJy5KD1SpROKP-CpwdDVVMapsAg.JPEG.bttrsng%2F20210412_200215.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">민속주점지리산</span>
            <span class="restaurant-list__textBox__sub">주막 분위기의 전통주점</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로114번길 60" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDA1MjdfMjE3%2FMDAxNTkwNTUzNzc0NTU0.6WOsTW9pR6bTRMupq6EB8c4wYIImVtoWZe0-YKUKRNMg.5BfKTWdOg3O0gyTeFzg1at3DWU06vF4CvCMrT1fI4q0g.JPEG.wjddls7449%2F1590553775014.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">초장집</span>
            <span class="restaurant-list__textBox__sub">신선한 해산물이 맛있는 술집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로102번길 32" data-type="서점">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#서점</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzAzMjVfMTgz%2FMDAxNDkwNDUyMzUyOTcz.ywH5lNX6woXTFPLGaZPMUQTnzKHlyHu__vkEbpNd2BIg.AbZ6PeRNAeafGHh53PTep2QTDBTKvW3jbOw5T9Mi25Mg.JPEG.cbnu_eca%2F%25BB%25E7%25C1%25F81.jpg&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">북메이커</span>
            <span class="restaurant-list__textBox__sub">책도 사고 스터디도 할 수 있는 서점</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로 319" data-type="서점">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#서점</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxOTA1MDlfMjE1%2FMDAxNTU3NDEyNzQ1Nzc3.R5R_eh2q65fNhb2c-s71fLestODAwSkbUaAWxD5N-wEg.tUq301Mi1X3vmC_Fj-B4-Gg2K5TgM4ca6KXr6lA6XGUg.JPEG.thddudwns422%2FIMG_2412.JPG&type=a340">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">민사랑서점</span>
            <span class="restaurant-list__textBox__sub">정문에 위치한 작은 서점</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 52" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fnaverbooking-phinf.pstatic.net%2F20220221_242%2F16454514360558x0n1_JPEG%2Fimage.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">에이블 스튜디오</span>
            <span class="restaurant-list__textBox__sub">취업 사진 잘찍는 중문 사진관</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로704번길 78" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20211114_112%2F16368779000479bPqn_JPEG%2F1636875252284.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">인생네컷</span>
            <span class="restaurant-list__textBox__sub">요즘 핫한 셀프 사진관</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로114번길 32" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200924_217%2F1600935793795yuUM8_JPEG%2FjCDC1-PfTnkU4xB74bTP8_uP.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">셀픽스</span>
            <span class="restaurant-list__textBox__sub">다양한 소품이 있는 셀프 사진관</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 26" data-type="병원">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#병원</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjAzMTVfNDUg%2FMDAxNjQ3MzA1MDMyNDM4.5SdC6KcSW_fekuuj1y7i10AjQ2-UGObWiR2hTm6OlM4g.tik0UGxzVe1u8h9uO8w5Iq3zg0m6FXXa8CNrpXkO6gMg.JPEG.cicpx09olo1mo%2FKakaoTalk_20220314_093523564_13.jpg&type=sc960_832">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">마이크로병원</span>
            <span class="restaurant-list__textBox__sub">사창 사거리에 위치한 병원</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 41" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxOTA1MTFfMjM2%2FMDAxNTU3NTczMTQyNDIw.fkKOPRWqbmByV3yBtJR2bRVrHdcRPkg92dx8-YR5eQEg.vBz1TVkMq_Po4-gnDkaVNHTnF0WIbQ95fWakEgqDPQUg.JPEG.xortl26%2FIMG_1637.JPG&type=sc960_832">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">파라다이스</span>
            <span class="restaurant-list__textBox__sub">중문 분위기 좋은 맥주 펍</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 27" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#고기</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20200526_272%2F1590452240416n5rKy_JPEG%2FdZIQiF8oSlPDUNTtePlAqB7C.jpeg.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">삼춘네 삼겹살</span>
            <span class="restaurant-list__textBox__sub">맛있는 무한리필 삼겹살집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로674번길 21" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTEyMDJfMTAx%2FMDAxNjM4NDMxMjE3NDE0.XlYonOpXGp4jDEDSl2yYRzKf8O7OwTCAknPJUU21SRUg.-mucn8MM00yEUKdnJ2AL0A6KbwixEgh8GmnqIhOv10Ug.JPEG.jbang98%2FIMG_3458.JPG">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">무니</span>
            <span class="restaurant-list__textBox__sub">브런치와 디저트가 맛있는 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로 289" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMjAzMzBfMTYz%2FMDAxNjQ4NjIwNTI2NzUy.XLMrk3FQISBcrhVYlxvWuhh-OogmIiHxcTbPjH8jVYkg.c7_dlFO4xIYP7uzR-MqUWMvBTUPaZCpGm48Ha311TlMg.JPEG.gkrckd88%2Foutput_3143549905.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">카페더얼</span>
            <span class="restaurant-list__textBox__sub">분위기 좋고 인스타 감성 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로82번길 14" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#식당</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fpup-review-phinf.pstatic.net%2FMjAyMjA1MDlfMjM4%2FMDAxNjUyMTAwNDkyNTY5.8g35Co8s0MsyGwHpXkLPzRr_1fWqSkMWcEmDTfwzkAcg.oXu_1KczhVXzr7dDqrqnq0liUrTCNvZC_7YrsQCB_pwg.JPEG%2Fupload_34fecf548479f9a9099b4f686a75a420.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">바니시버거</span>
            <span class="restaurant-list__textBox__sub">비주얼부터 맛있는 수제버거 맛집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로694번길 16-1" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#식당</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fpup-review-phinf.pstatic.net%2FMjAyMjA1MTNfMTc3%2FMDAxNjUyNDA1NzYwMTA1.WUPcwdBtGbta3UxhT-ZK1lV0ziHjD7M0D1btmmpfT9gg.FGHUK1hsKrETNPTBy5MrjKIpXtQeHrrz7E6tRxBH8-wg.JPEG%2Fupload_1318e7eb48fa48b698dd8a2833ef7983.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">모퉁이파스타</span>
            <span class="restaurant-list__textBox__sub">저렴하고 맛있는 파스타 가게</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로674번길 3" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20210222_59%2F1613991858229grG30_JPEG%2Fupload_809693aaeccf93d37c55c09f0a1bf4b9.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">그릭오</span>
            <span class="restaurant-list__textBox__sub">청주 최초 그릭요거트 전문점</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 108" data-type="병원">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#병원</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20180425_151%2F1524632009678HR0e4_PNG%2FM0txj8XEjRA73YXt1r5hucev.png">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">코아 이비인후과의원</span>
            <span class="restaurant-list__textBox__sub">사창 사거리에 위치한 이비인후과의원</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 88" data-type="병원">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#병원</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20210831_197%2F1630378431446qJ2Qj_JPEG%2F5vXS3JcmmztYyzIqbJ--EZrr.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">김안과의원</span>
            <span class="restaurant-list__textBox__sub">사창 사거리에 위치한 안과의원</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로694번길 4" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTEyMzFfMTEw%2FMDAxNjQwOTUyNTA0MzM1.ptUaMjeyF33HNu-soJSv7_MAl7NCyDhcc_VGgysKlecg.8GHPt80jhNko6G2s50sM6nBuB3rDB3qdjeA-a3gJ8Qog.JPEG.esm2128%2Frandom_FB78D312-6886-4969-99EB-8E04204A9A3A.jpeg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">단성무이</span>
            <span class="restaurant-list__textBox__sub">깔끔한 돈까스&스테이크 맛집</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로 247" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#중식</span>
            <span class="restaurant-list__tag">#서문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20211213_217%2F16393777583097b7uK_JPEG%2Fupload_c87dda3b82878bd7232d3009ca41a1b9.jpeg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">홍등</span>
            <span class="restaurant-list__textBox__sub">짬뽕이 맛있는 중국집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로 125-1" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20220107_144%2F1641529198391PLx2i_JPEG%2Fupload_93f4df3b1c9cf0d840d23ba9f06d8544.jpeg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">장날순대</span>
            <span class="restaurant-list__textBox__sub">순대와 순대국밥이 맛있는 식당</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로 713-1" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20220215_73%2F1644919171024g8O0s_JPEG%2Fupload_7ac6f72bef1c0a64cd8ea363fac5cbc9.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">읍천리 382</span>
            <span class="restaurant-list__textBox__sub">레트로한 분위기의 샐러드와 샌드위치가 맛있는 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="모충로 15" data-type="스터디카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#스터디</span>
            <span class="restaurant-list__tag">#후문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20220226_266%2F1645869703855gjjBb_JPEG%2FIMG_4507.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">플랜에이스터디카페</span>
            <span class="restaurant-list__textBox__sub">후문에 위치한 스터디카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 51" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20211210_271%2F16391308566947qGKg_JPEG%2FKakaoTalk_20211209_182812506_16.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">포토플렉스</span>
            <span class="restaurant-list__textBox__sub">스티커로 꾸밀 수 있는 셀프 사진관</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로680번길 11" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20201118_105%2F1605699263670gbpAs_JPEG%2Fupload_9dd76ae82fad67ea5e3860306a9e5ebe.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">스케치</span>
            <span class="restaurant-list__textBox__sub">청주 분위기 좋고 올타임 브런치가 맛있는 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address=" 1순환로674번길 38" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#식당</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA3MjFfMTk1%2FMDAxNjI2ODQ5MjIwNDA1.G2N5Hcw9kNHMGbqHLRkocoWBQSg63M2xn4ekM86LpsQg.Sxi06IBW2x6l5YiT6P9jUK5zoWrRJ_18D3EjykSk-xcg.JPEG.hongyu5%2FIMG_3914.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">피자웨이브</span>
            <span class="restaurant-list__textBox__sub">충북대 분위기 좋은 피자집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 63" data-type="스터디카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#스터디</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20220220_93%2F1645346584080jE4cM_JPEG%2F9.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">비채스터디카페</span>
            <span class="restaurant-list__textBox__sub">중문에 위치한 깔끔하고 넓은 스터디카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로102번길 54" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA5MDRfMjk4%2FMDAxNjMwNzYzOTYxNjMz.dBkwDydYKK0Wx75H29bg4j9KV8tCMFISXryBppS9q6wg.RECH-FhfphXT0a8KB9NRlVK4jvCw2_6NgjDgHlYuXg8g.JPEG.ddalgi7782%2FIMG_8106.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">아르떼</span>
            <span class="restaurant-list__textBox__sub">중문 새벽 4시까지 여는 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 96" data-type="스터디카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#스터디</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20220526_214%2F16535500404211Ymrm_JPEG%2FKakaoTalk_20220526_113938012_13.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">직지화랑 스터디카페</span>
            <span class="restaurant-list__textBox__sub">충북대 근처 사창사거리에 위치한 스터디카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 100" data-type="스터디카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#스터디</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20211002_30%2F1633168878308kvSXt_JPEG%2FmZ5VOhM6ezBZdoHiKT66EsJq.jpeg.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">스터디카페 봄</span>
            <span class="restaurant-list__textBox__sub">사창사거리에 위치한 깔끔한 스터디카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로114번길 59" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#양식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20211123_89%2F1637650168029eKiFo_JPEG%2Fupload_d79f87751e16e329fb1160ab4071b189.jpeg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">설희</span>
            <span class="restaurant-list__textBox__sub">분위기 좋은 파스타 집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로709번길 4" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#양식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20220305_91%2F1646481644916yl3Py_JPEG%2Fupload_7ef20213ade656d40573c5ea9d6b8e72.jpeg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">커드</span>
            <span class="restaurant-list__textBox__sub">중문에 위치한 분위기 좋은 요리주점</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 50" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20220206_261%2F1644116865968uUBNT_JPEG%2FKakaoTalk_20220206_120713548.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">3PIC</span>
            <span class="restaurant-list__textBox__sub">사진이 뽀샤시하게 이쁜색감으로 나와요</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로102번길 40" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#식당</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTEyMjlfMTAx%2FMDAxNjQwNzg1Mzc2NDQ3.XKVcg7lSGUg5-GAssGEUtBgnGjcZXA2y-wXo0b6DOaQg.AHXmZ4pBsj3dqC8_ixUDdOEhWkSwntIq70cKltttrBkg.JPEG.moglly030%2F81075601-3A62-444F-8C9B-4936F26839E4.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">은화수식당</span>
            <span class="restaurant-list__textBox__sub">돈까스 파는 양식당</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 16" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20180905_209%2F1536138934863ncd2A_JPEG%2F2015-05-19-23-17-31_deco.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">쿠쉬</span>
            <span class="restaurant-list__textBox__sub">칵테일이 맛있는 BAR</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로 128" data-type="병원">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#병원</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20190125_214%2F1548382609630FWzsJ_JPEG%2F37-s84SIJooC_BzX_lbo78fX.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">가톨릭피부과의원</span>
            <span class="restaurant-list__textBox__sub">신속하고 정확한 진료 가능한 피부과</span>
          </div>
        </div>
        <div class="restaurant-list" address="복대로 32" data-type="서점">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#서점</span>
            <span class="restaurant-list__tag">#서문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20211012_10%2F16340311633174Ol8k_JPEG%2FBq8XaSbD_gWRbfObRGRMqXJu.jpeg.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">열린문고</span>
            <span class="restaurant-list__textBox__sub">서문에 위치한 조그마한 서점</span>
          </div>
        </div>
        <div class="restaurant-list" address="충대로 1" data-type="서점">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#서점</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://mblogthumb-phinf.pstatic.net/MjAxNzA2MDJfMTU4/MDAxNDk2MzY0MDUxNDAz._mn0IVruztiDSgQOdP5ZeZZQ3fGBcacD-61lQhi5W7Mg.cOtWsJuQk7lYSKzyKa_bBpbNjaGJuetEDGW6Tim2iscg.JPEG.cbnu_eca/image_4524865231496363750336.jpg?type=w800">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">개신문화관 서점</span>
            <span class="restaurant-list__textBox__sub">학교 안 개신문화관에 위치한 서점</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 5" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#한식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fpup-review-phinf.pstatic.net%2FMjAyMjA1MDdfMjE4%2FMDAxNjUxODUwNTc2Njc3.3dGRGCoHilmcS0ejYjIxSqDzNwg6qf9r5uHrUUwWGVEg.kfhSOmJyIFTnyMa1y6bjq6eWXlMGkL8LznZNzyzn-KAg.JPEG%2Fupload_a4a9c4a5eab6e2675620e451fd6486fd.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">안녕, 닭</span>
            <span class="restaurant-list__textBox__sub">찜닭과 닭볶음탕이 맛있는 식당</span>
          </div>
        </div>
        <div class="restaurant-list" address="성봉로220번길 156" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#고깃집</span>
            <span class="restaurant-list__tag">#서문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2F20150116_203%2Fsweet_fl0wer_1421386203278nuUMQ_JPEG%2F20150115_182726.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">장군집</span>
            <span class="restaurant-list__textBox__sub">백종원도 방문한 뒷고기 구이집</span>
          </div>
        </div>
        <div class="restaurant-list" address="서원구 내수동로108번길 46" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#디저트</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA4MThfOTUg%2FMDAxNjI5Mjk0NDMwODYw.ugLJ4QGbVaZa-ErpeynrEGi2Zbt27exH5QIg-goHG9wg.MBQ7x31Uo5M3krpCMQazTYoM9AmQ2f0sNvN6oJcw7NQg.JPEG.ye4061%2F80348ACA-1796-4366-8181-912F807E5C5B.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">총각와플</span>
            <span class="restaurant-list__textBox__sub">다양한 와플을 파는 와플가게</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 25" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDA1MDdfMTI0%2FMDAxNTg4ODM0ODQ5NTk1.zCBr5TNDvfihtBfuELGG1gq732NH9-PwHJ7Fa7PhPf4g.ypUJe6lhJg_gwQapdiSt2nRLiAtA5W9ZybI3YPuob_og.JPEG.tlawlstjs123%2FIMG_4517.JPG">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">경성호텔</span>
            <span class="restaurant-list__textBox__sub">분위기 좋고 안주가 맛있는 술집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로672번길 25" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTA0MDNfMjk2%2FMDAxNjE3MzgyNTE2MDM2.F6hmBej3X_fwzCRObo2VP9LGMQ5K7LGgrm_6L1W3tAsg.qqMbCPGQJijBtVE2Se0onTdH_7FJSpux_J_GzTsvWeQg.JPEG.thdfks6139%2Foutput_2623705276.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">원잔허지</span>
            <span class="restaurant-list__textBox__sub">인테리어가 이쁘고 넓은 술집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로102번길 40" data-type="사진관">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#사진관</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20210805_209%2F1628130887426ECdwL_JPEG%2FaPF-UsTj7UrkhWJZK4wI53IP.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">포토이즘</span>
            <span class="restaurant-list__textBox__sub">셀프로 사진을 찍을 수 있는 사진관</span>
          </div>
        </div>
        <div class="restaurant-list" address="창직로 28" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#디저트</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20210513_288%2F16209057262498VSVh_JPEG%2FSRv-HUC4A-dGu7vrJ01t6IKd.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">동백과자점</span>
            <span class="restaurant-list__textBox__sub">쿠키, 휘낭시에, 마들렌 등이 맛있는 빵집</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로34번길 4" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#곱창집</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDAyMDhfNDIg%2FMDAxNTgxMTMyNDU3MzQz.dXcfBf91pzsjdcE-QmhSco6OGWCaLAJh8-dIWAexKdYg.YO4ns3IaVuHsSfVn9KS9A1Q3hITOmzG_eJLP4tpWfMkg.JPEG.vlrm36%2F1581132456616.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">대구전봇대막창</span>
            <span class="restaurant-list__textBox__sub">충북대 주변 막창구이 맛집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로 759" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#후문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxODAxMDZfMTE3%2FMDAxNTE1MjM5MDU4MzEx.w4hlyfxxU900tbqTYqFxz1Z8pCBQvz3-DOx66VUSHA0g.oFGHBC6-DIoBMza5VC6oU9RnHuWa9G_G8rdfWizG7Lsg.JPEG.sosmart2%2FIMG_6215.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">루틴759</span>
            <span class="restaurant-list__textBox__sub">마카롱이 맛있는 충북대학교 후문에 위치한 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="사직대로62번길 10" data-type="카페">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#카페</span>
            <span class="restaurant-list__tag">#정문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fmyplace-phinf.pstatic.net%2F20211224_59%2F1640316732633kHwQP_JPEG%2Fupload_20653739769b1783dd645fb4a01d5ecd.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">버몬트하우스</span>
            <span class="restaurant-list__textBox__sub">파이와 커피가 맛있는 카페</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로653번길 10-1" data-type="식당">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#양식</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=https%3A%2F%2Fpup-review-phinf.pstatic.net%2FMjAyMjA2MDVfMjIy%2FMDAxNjU0NDI1NjE0Mzg5.yTHEeEuieb1vktaG82lK1kzgNgO7PASa-HXqwmiryrUg.6-ObhvNrOB9ay_sKQLU4f6GKUyFd-PEU1B1pRvLzYlog.JPEG%2Fupload_e3418c0882be3b00a3e062e1dea176fb.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">어스테이블</span>
            <span class="restaurant-list__textBox__sub">뇨끼와 파스타와 스테이크가 맛있는 분위기 좋은 맛집</span>
          </div>
        </div>
        <div class="restaurant-list" address="1순환로674번길 26" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxODA1MThfNTYg%2FMDAxNTI2NjE2MzMwNDAy.9Fz9-YXzuwcdkaCTj1xMTtOoroNi9YeHMMQZphePhNgg.xkNmF3HV1WX-R_jsJOMIPj8ro0J6SOCwSDePszQ2qD0g.JPEG.won1004a%2FKakaoTalk_20180518_114610327.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">동래관</span>
            <span class="restaurant-list__textBox__sub">충북대생이 사랑하는 두루치기와 닭떡볶이</span>
          </div>
        </div>
        <div class="restaurant-list" address="내수동로108번길 27" data-type="술집">
          <div class="restaurant-list__tags">
            <span class="restaurant-list__tag">#술집</span>
            <span class="restaurant-list__tag">#중문</span>
          </div>
          <div class="restaurant-list__imgBox">
            <img class="restaurant-list__img" src="https://search.pstatic.net/common/?autoRotate=true&quality=95&type=w750&src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMDA5MThfMzkg%2FMDAxNjAwMzkwNjcxNTgy.4l_-McnVfnWPkAeDcWrrZSSi2V9ln5mo6ucwLLkBXX4g.WLIRYvBH0qGsZomwxeKYQiPx1yRJKlvptWK9Nkh_1kAg.JPEG.eushil01%2F20200910_175429.jpg">
          </div>
          <div class="restaurant-list__textBox">
            <span class="restaurant-list__textBox__name">이쁘롬</span>
            <span class="restaurant-list__textBox__sub">충북대학교 중문에 위치한 분위기 좋은 술집</span>
          </div>
        </div>
      </div>
      <!--<div class="visitor">
        <script type="text/javascript" src="https://freecountercode.com/service/4HmVR6xtJApelUCf8ow1"></script>
      </div>-->
    </main>
  </div>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-storage.js"></script>
  <script>
      const firebaseConfig = {
        apiKey: "AIzaSyC4C5jIAH_dzNQzc-gSXLrfcyR7k0IUG2g",
        authDomain: "cbmp-17038.firebaseapp.com",
        databaseURL:
          "https://cbmp-17038-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "cbmp-17038",
        storageBucket: "cbmp-17038.appspot.com",
        messagingSenderId: "742707500532",
        appId: "1:742707500532:web:d7796138ddd0463832d5a1",
      };

      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
    </script>

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
</html>