const dbchat = firebase.firestore();
const storagea = firebase.storage();

var 내uid = JSON.parse(localStorage.getItem("user")).uid;
var userName = JSON.parse(localStorage.getItem("user")).displayName;
var 채팅방id;
$("#send").click(function () {
  var 데이터 = {
    content: $("#chat-input").val(),
    date: new Date(),
    uid: 내uid,
  };

  dbchat
    .collection("chatroom")
    .doc(채팅방id)
    .collection("messages")
    .add(데이터);
  $("#chat-input").val("");
});

dbchat
  .collection("chatroom")
  .where("who", "array-contains", 내uid)
  .get()
  .then((result) => {
    //내uid 가 있는 채팅방 전부 가져옴
    result.forEach((a) => {
      var template = `<li class="list-group-item">
            <h6>${a.data().product}</h6>
            <h6 class="text-small">${a.id}</h6>
          </li>`;
      $(".chat-list").append(template);

      $(".list-group-item").click(function (e) {
        채팅방id = $(this).children(".text-small").text();

        e.stopImmediatePropagation();

        dbchat
          .collection("chatroom")
          .doc(채팅방id)
          .collection("messages")
          .orderBy("date")
          .onSnapshot((result) => {
            // 실시간으로 db 새로고침

            $(".chat-content").html("");
            result.forEach((a) => {
              console.log(a.id, 내uid);

              if (a.data().uid == 내uid) {
                var 템플릿 = `<li><span class="chat-box mine">${
                  // 채팅 메세지 가져옴
                  a.data().content
                }</span></li>`;
              } else {
                var 템플릿 = `<li><span class="chat-box">${
                  // 채팅 메세지 가져옴
                  a.data().content
                }</span></li>`;
              }
              $(".chat-content").append(템플릿);
            });
          });
      });
    });
  });
