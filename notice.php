<?php
  require_once './func/dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Chungbuk Market Place</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./css/main_styles.css" />
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
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet"
  />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
                <form action="./func/login.php" class="form-container">
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
                <form action="./func/register.php" class="form-container">
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
    <table class="table" style="width: 70%; margin: auto; margin-top: 100px;">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">글쓴이</th>
          <th scope="col">제목</th>
          <th scope="col">등록일</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>관리자</td>
          <td>이벤트 공지사항입니다</td>
          <td>2022.11.10</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>관리자</td>
          <td>채팅 공지사항</td>
          <td>2022.11.05</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>관리자</td>
          <td>CBMP 중고거래 플랫폼입니다.</td>
          <td>2022.09.17</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
