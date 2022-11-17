const db = firebase.firestore();
const storage = firebase.storage();

$("#upload").click(function () {
  var file = document.querySelector("#image").files[0];
  var storageRef = storage.ref();
  var 저장할경로 = storageRef.child("image/" + file.name); // 파일경로 저장 하는 부분
  var 업로드작업 = 저장할경로.put(file);
  var NOWdate = new Date();

  function dateFormat(date) {
    let month = date.getMonth() + 1;
    let day = date.getDate();

    month = month >= 10 ? month : "0" + month;
    day = day >= 10 ? day : "0" + day;

    return date.getFullYear() + "년 " + month + "월 " + day + "일";
  }

  업로드작업.on(
    "state_changed", // 변화시 동작하는 함수
    null,

    (error) => {
      //에러시 동작하는 함수
      console.error("실패사유는", error);
    },

    () => {
      // 성공시 동작하는 함수
      업로드작업.snapshot.ref.getDownloadURL().then((url) => {
        console.log("업로드된 경로는", url);

        var item = {
          제목: $("#title").val(),
          가격: $("#price").val(),
          내용: $("#content").val(),
          날짜: dateFormat(NOWdate),
          이미지: url,
          uid : JSON.parse(localStorage.getItem('user')).uid,//지금 로그인한 유저의 uid
          이름 : JSON.parse(localStorage.getItem('user')).displayName //지금 로그인한 유저의저이름
        };
        db.collection("product")
          .add(item)
          .then((result) => {
            //성공후 실행할 코드
            console.log(result);
            window.location.href = "./product.html";
          })
          .catch((err) => {
            //실패후 실행할 코드

            console.log(err);
            alert("내용을 입력해주세요.");
          });
      });
    }
  );
}); // 제목을 db에 넣음 그리고 add를 넣음으로 이름은 기억없이 바로 나옴
