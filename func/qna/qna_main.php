<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/header.php";

$search_keyword = $_GET['search_keyword'];

if($search_keyword){
    $search_where = " and (subject like '%".$search_keyword."%' or content like '%".$search_keyword."%')";
}

$pageNumber  = $_GET['pageNumber']??1;//현재 페이지, 없으면 1
if($pageNumber < 1) $pageNumber = 1;
$pageCount  = $_GET['pageCount']??10;//페이지당 몇개씩 보여줄지, 없으면 10
$startLimit = ($pageNumber-1)*$pageCount;//쿼리의 limit 시작 부분
$firstPageNumber  = $_GET['firstPageNumber'];


$sql = "select * from board where 1=1";
$sql .= " and status=1";
$sql .= $search_where;
$order = " order by ifnull(parent_id, bid) desc, bid asc";
$limit = " limit $startLimit, $pageCount";
$query = $sql.$order.$limit;
//echo "query=>".$query."<br>";
$result = $mysqli->query($query) or die("query error => ".$mysqli->error);
while($rs = $result->fetch_object()){
    $rsc[]=$rs;
}

//전체게시물 수 구하기
$sqlcnt = "select count(*) as cnt from board where 1=1";
$sqlcnt .= " and status=1";
$sqlcnt .= $search_where;
$countresult = $mysqli->query($sqlcnt) or die("query error => ".$mysqli->error);
$rscnt = $countresult->fetch_object();
$totalCount = $rscnt->cnt;//전체 게시물 갯수를 구한다.
$totalPage = ceil($totalCount/$pageCount);//전체 페이지를 구한다.

if($firstPageNumber < 1) $firstPageNumber = 1;
$lastPageNumber = $firstPageNumber + $pageCount - 1;//페이징 나오는 부분에서 레인지를 정한다.
if($lastPageNumber > $totalPage) $lastPageNumber = $totalPage;


?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="./main.php"
          ><img src="/database-project/assets/img/logo.png" alt="..."
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
              <a class="nav-link" href="/database-project/product.php">물건 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/database-project/facility.php">시설 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/database-project/notice.php">공지사항</a>
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
        <table class="table" style="margin-top: 100px;">
        <thead>
            <tr>
            <th scope="col">번호</th>
            <th scope="col">글쓴이</th>
            <th scope="col">제목</th>
            <th scope="col">등록일</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $idNumber = $totalCount - ($pageNumber-1)*$pageCount;
                foreach($rsc as $r){
                    //검색어만 하이라이트 해준다.
                    $subject = str_replace($search_keyword,"<span style='color:red;'>".$search_keyword."</span>",$r->subject);
                   
            ?>

                <tr>
                    <th scope="row"><?php echo $idNumber--;?></th>
                    <td><?php echo $r->userid?></td>
                    <td>
                        <?php
                            if($r->parent_id){
                                echo "&nbsp;&nbsp;";
                            }
                        ?>  
                    <a href="/database-project/func/qna/view.php?bid=<?php echo $r->bid;?>"><?php echo $subject?></a></td>
                    <td><?php echo $r->regdate?></td>
                </tr>
            <?php }?>
        </tbody>
        </table>
        <form method="get" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="input-group mb-12" style="margin:auto;width:50%;">
                <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="제목과 내용에서 검색합니다." value="<?php echo $search_keyword;?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">검색</button>
        </div>
        </form>
        <p>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']?>?pageNumber=<?php echo $firstPageNumber-$pageCount;?>&firstPageNumber=<?php echo $firstPageNumber-$pageCount;?>&search_keyword=<?php echo $search_keyword;?>">Previous</a>
                    </li>
                    <?php
                        for($i=$firstPageNumber;$i<=$lastPageNumber;$i++){
                    ?>
                        <li class="page-item <?php if($pageNumber==$i){echo "active";}?>"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF']?>?pageNumber=<?php echo $i;?>&firstPageNumber=<?php echo $firstPageNumber;?>&search_keyword=<?php echo $search_keyword;?>"><?php echo $i;?></a></li>
                    <?php
                        }
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']?>?pageNumber=<?php echo $firstPageNumber+$pageCount;?>&firstPageNumber=<?php echo $firstPageNumber+$pageCount;?>&search_keyword=<?php echo $search_keyword;?>">Next</a>
                    </li>
                </ul>
            </nav>
        </p>

        <p style="text-align:right;">

            <?php
                if($_SESSION['UID']){
            ?>
                <a href="/database-project/func/qna/write.php"><button type="button" class="btn btn-primary">등록</button><a>
            <?php
                }
            ?>
        </p>

       

<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/footer.php";
?>