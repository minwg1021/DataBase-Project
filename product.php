<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/dbcon.php";
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
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Jua&family=Square+Peg&family=Water+Brush&family=Yanone+Kaffeesatz:wght@700&display=swap"
    rel="stylesheet"
  />
    <link href="./css/product.css" rel="stylesheet" />
    <link href="./css/main_styles.css" rel="stylesheet" />
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
    <div class="container mt-3" id="item_list">
<!-- 제품 나오는 목록  -->
                <?php
                //$sql = "select * post from Post order by pid desc ";
                //$result = mysqli_query($mysqli, $sql);
                

                $q = "select members.userid, post.PID, post.pName, post.Image, post.description, 
                post.price, post.regdate  from members,post where members.mid= post.uploader order by post.pid desc;";

                
                $result2 = mysqli_query($mysqli, $q);


    while($row = mysqli_fetch_array($result2)){
      //$row2 = mysqli_fetch_array($result2)?>
  
  <div class="product">
    <a href="detail.php?idx=<?=$row['PID']?>">
    <div class="thumbnail" style="background- image: "> <?php 
    echo '<img src="data:image;base64,'.base64_encode($row['Image']).'" alt="Image" style="width: 200px; height: 200px; border-radius: 15%;">';?>
    </div>
    <div class="flex-grow-1 p-4">           
            <h3 class="title">  <?php echo $row['pName'];?></h5> 
            <h5 class="title">  <?php echo $row['userid'];?></h5> 
            <p class="date"><?php echo $row['regdate'];?></p>
            <p class="price"> <?php echo $row['price'];?> 원</p>
            </a>
      </div>
      </div>


<?php
                }
                ?>
    </div> 
    <div style="text-align: center; margin-bottom: 20px">
      <a type="button" class="btn btn-primary" href="/DataBase-Project/upload.php">등록하기</a>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <script src="./js/login.js"></script>
    <script src="./js/open_loginForm.js"></script>
    <script src="./js/open_registerForm.js"></script>   
    <script src="./js/navbar.js"></script>
     <script src="./js/product.js"></script>
  </body>
</html>
