const dentall = document.getElementById("dentall");
const connect = document.getElementById("connect");
const password = document.getElementById("pswd");
const password_strength = document.getElementById("password_strength");
const email = document.getElementById("email");
const email_validate = document.getElementById("email_validate");
connect.disabled = true;
let emailValid = false,
  validP = false;
let error_icon = "<span><i class='bi bi-exclamation-circle'></i></span>";
function validate() {
  if (emailValid && validP) {
    connect.disabled = false;
  } else {
    connect.disabled = true;
  }
}
function verifyEmail() {
  if (email.value.length == 0) {
    email_validate.innerHTML = "";
    return;
  }
  let emailValidation = "";
  let color = "";
  let regex = /^([a-zA-Z0-9_.+-]+)@([a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)$/;
  if (regex.test(email.value)) {
    color = "green";
    emailValidation = "";
    emailValid = true;
  } else {
    color = "red";
    emailValidation = error_icon + " Email Invalide !";
    emailValid = false;
  }
  validate();
  if (emailValidation === "") {
    email_validate.innerHTML = "";
  } else {
    email_validate.innerHTML = emailValidation;
    email_validate.style.color = color;
  }
}
function verifyPassword() {
  if (password.value.length < 8) {
    password_strength.innerHTML = '';
    validP = false;
  } else {
    password_strength.innerHTML = "";
    validP = true;
  }
  validate();
}
email.addEventListener("input", verifyEmail);
password.addEventListener("input", verifyPassword);
dentall.addEventListener("click", () => {
  let url = window.location.href;
  url = url.replace("index.php?action=login", "");
  url = url.replace("dashboard.php?action=login", "");
  window.location.href = url;
});
