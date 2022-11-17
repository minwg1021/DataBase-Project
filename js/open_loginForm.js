function openLoginForm() {
  const e = document.getElementById("myForm_login");
  e.style.display = e.style.display != "none" ? "none" : "block";
}

function closeLoginForm() {
  document.getElementById("myForm_login").style.display = "none";
}
