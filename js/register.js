var dbReg = firebase.firestore();

$("#register").click(() => {
  var name = $("#name-new").val();
  var email = $("#email-new").val();
  var password = $("#pw-new").val();

  firebase
    .auth()
    .createUserWithEmailAndPassword(email, password)
    .then((result) => {
      result.user.updateProfile({ displayName: name });

      dbReg.collection("user").add({
        name: name,
        email: email,
        password: password,
      });

      alert("회원가입이 완료되었습니다.");
      setTimeout(() => window.location.reload(), 1000);
    });
});
