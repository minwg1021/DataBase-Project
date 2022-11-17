function openRegisterForm() {
  const e = document.getElementById("myForm_register");
  e.style.display = e.style.display != "none" ? "none" : "block";
}

function closeRegisterForm() {
  document.getElementById("myForm_register").style.display = "none";
}
