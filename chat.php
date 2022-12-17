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
    <link rel="stylesheet" href="./css/chat.css" />
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
    <div class="container p-4 detail mt-3">
      <div class="row">
        <div class="col-3 p-0">
          <ul class="list-group chat-list">
          </ul>
        </div>
        <div class="col-9 p-0">
          <div class="chat-room">
            <ul class="list-group chat-content">
            </ul>
            <div class="input-group">
              <input class="form-control" id="chat-input" />
              <button class="btn btn-primary" id="send">전송</button>
            </div>
          </div>
        </div>
      </div>
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

    <script src="./js/chat.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/open_loginForm.js"></script>
    <script src="./js/open_registerForm.js"></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
