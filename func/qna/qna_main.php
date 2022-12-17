<?php session_start();
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


$sql = "select b.*, if((now() - regdate)<=86400,1,0) as newid
,(select count(*) from memo m where m.status=1 and m.bid=b.bid) as memocnt
,(select m.regdate from memo m where m.status=1 and m.bid=b.bid order by m.memoid desc limit 1) as memodate
from board b where 1=1";
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

if($firstPageNumber > $totalPage) {
    echo "<script>alert('더 이상 페이지가 없습니다.');history.back();</script>";
    exit;
}


?>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav"> <!-- 네브바-->
      <div class="container"> <!--  페이지 전체 div -->
        <a class="navbar-brand" href="/database-project/main.php"  
          ><img src="/database-project/assets/img/logo.png" alt="..."
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
              <a class="nav-link" href="/database-project/product.php">물건 보기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/database-project/facility.php">시설 보기</a>
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
                <a href="/database-project/func/qna/write.php"><button type="button" class="btn btn-primary">등록</button><a>
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
        <!-- 더보기 버튼을 클릭하면 다음 페이지를 넘겨주기 위해 현재 페이지에 1을 더한 값을 준비한다. 더보기를 클릭할때마다 1씩 더해준다. -->
        <input type="hidden" name="nextPageNumber" id="nextPageNumber" value="<?php echo $pageNumber+1;?>">
        <table class="table" style="margin-top: 100px;">
        <thead>
            <tr>
            <th scope="col">번호</th>
            <th scope="col">글쓴이</th>
            <th scope="col">제목</th>
            <th scope="col">등록일</th>
            </tr>
        </thead>
        <tbody id="board_list">
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
                    <a href="/database-project/func/qna/view.php?bid=<?php echo $r->bid;?>"><?php echo $subject?></a>
                    <?php if($r->memocnt){?>
                        <span <?php if((time()-strtotime($r->memodate))<=86400){ echo "style='color:red;'";}?>>
                            [<?php echo $r->memocnt;?>]
                        </span>
                    <?php }?>
                    <?php if($r->newid){?>
                        <span class="badge bg-danger">New</span>
                    <?php }?>
                </td>
                    <td><?php echo $r->regdate?></td>
                </tr>
            <?php }?>
        </tbody>
        </table>
        <div class="d-grid gap-2" style="margin:20px;">
            <button class="btn btn-secondary" type="button" id="more_button">더보기</button>
        </div>
        <form method="get" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="input-group mb-12" style="margin:auto;width:50%;">
                <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="제목과 내용에서 검색합니다." value="<?php echo $search_keyword;?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="search">검색</button>
        </div>
        </form>
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
<script>
    $("#more_button").click(function () {
       
        var data = {//more_list_page.php에 넘겨주는 파라미터 값이다.
            pageNumber : $('#nextPageNumber').val() ,
            pageCount : <?php echo $pageCount;?>,
            totalCount : <?php echo $totalCount;?>,
            search_keyword : <?php echo $search_keyword;?>
        };
            $.ajax({
                async : false ,
                type : 'post' ,//post방식으로 넘겨준다. ajax는 반드시 post로 해준다.
                url : 'more_list_page.php' ,
                data  : data ,//위에서 만든 파라미터들을 넘겨준다.
                dataType : 'html' ,//리턴받을 형식이다. html말고 text난 json도 있다. json을 가장 많이 쓴다.
                error : function() {} ,
                success : function(return_data) {
                    if(return_data==false){
                        alert('마지막 페이지입니다.');
                        return;
                    }else{
                        $("#board_list").append(return_data);//table 마지막에 붙여준다. 반대는 prepend가 있다.
                        $("#nextPageNumber").val(parseInt($('#nextPageNumber').val())+1);//다음페이지를 위해 1씩 증가해준다.
                    }
                }
        });
    });
</script>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/database-project/func/qna/footer.php";
?>