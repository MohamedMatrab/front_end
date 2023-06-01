const password = document.getElementById("pswd");
const passC = document.getElementById("pswd-confirm");
const signUpBtn = document.getElementById("signup_btn");
const dentall = document.getElementById("dentall");
const checkBox = document.getElementById("agreement");
const email = document.getElementById("email");
const email_validate = document.getElementById("email_validate");
const phone = document.getElementById("phone");
const phone_validate = document.getElementById("phone_validate");
const inputsId = ["first-name", "last-name"];
let inputs = [];
for (i = 0; i < inputsId.length; i++) {
  inputs.push(document.getElementById(inputsId[i]));
}
let error_icon = "<span><i class='bi bi-exclamation-circle'></i></span>";
let similar = false,
  valid = false,
  emailValid = false,
  phoneValid = false,
  inputSet = false;

signUpBtn.disabled = true;

function validate() {
  if (
    inputSet &&
    valid &&
    similar &&
    phoneValid &&
    emailValid &&
    checkBox.checked
  ) {
    signUpBtn.disabled = false;
  } else {
    signUpBtn.disabled = true;
  }
}
function verifyEmail() {
  if (email.value.length == 0) {
    email_validate.innerHTML = "";
    emailValid=false;
    validate();
    return;
  }
  let emailValidation = "";
  let color = "";
  let regex = /^([a-zA-Z0-9_.+-]+)@([a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)$/;
  if (regex.test(email.value)) {
    color = "green";
    emailValidation ='';
    emailValid = true;
  } else {
    color = "red";
    emailValidation = error_icon+" Email Invalide !";
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
function verifyPhone() {
  if (phone.value.length == 0) {
    phone_validate.innerHTML = "";
    phoneValid=false;
    validate();
    return;
  }
  let phoneValidation = "";
  let color = "";
  let regex = /^(?:\+?\d{1,3})?\d{9}$/;
  if (regex.test(phone.value)) {
    color = "green";
    phoneValidation = '';
    phoneValid = true;
  } else {
    color = "red";
    phoneValidation = error_icon+" Numéro de Téléphone Invalide !";
    phoneValid = false;
  }
  validate();
  if (phoneValidation === "") {
    phone_validate.innerHTML = "";
  } else {
    phone_validate.innerHTML = phoneValidation;
    phone_validate.style.color = color;
  }
}
function verifyInput() {
  let cdt = true;
  for (i = 0; i < inputs.length; i++) {
    cdt = cdt && inputs[i].value.trim() != "";
  }
  inputSet = cdt;
  validate();
}
function verifySimilar() {
  var password_similar = document.getElementById("password_similar");

  //if textBox is empty
  if (passC.value.length == 0) {
    password_similar.innerHTML = "";
    similar = false;
    validate();
    return;
  }

  //Display of Status
  var color = "";
  var passwordStrength = "";
  //Validation for each Regular Expression
  if (password.value === passC.value) {
    color = "green";
    passwordStrength = '';
    similar = true;
  } else {
    color = "red";
    passwordStrength = error_icon+" Les mots de passe fournis sont differents !";
    similar = false;
  }

  validate();
  if (passwordStrength === "") {
    password_similar.innerHTML = "";
  } else {
    password_similar.innerHTML = passwordStrength;
    password_similar.style.color = color;
  }
}
function CheckPasswordStrength() {
  verifySimilar();
  var password_strength = document.getElementById("password_strength");

  //if textBox is empty
  if (password.value.length == 0) {
    password_strength.innerHTML = "";
    valid = false;
    validate();
    return;
  }

  //lenght 8 ,uppercase at least ,lowercase at least,spacial character at least,digit at least
  var regex = /^(?=.*\d)(?=.*[$@$!%*#?&])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

  //Display of Status
  var color = "";
  var passwordStrength = "";
  //Validation for each Regular Expression
  if (regex.test(password.value)) {
    color = "green";
    passwordStrength = '';
    valid = true;
  } else {
    color = "red";
    passwordStrength = error_icon+" Mot de passe faible !";
    valid = false;
  }
  validate();
  if (passwordStrength === "") {
    password_strength.innerHTML = "";
  } else {
    password_strength.innerHTML = passwordStrength;
    password_strength.style.color = color;
  }
}

passC.addEventListener("input", verifySimilar);
password.addEventListener("input", CheckPasswordStrength);
dentall.addEventListener("click", () => {
  let url = window.location.href;
  url = url.replace("index.php?action=signup", "");
  window.location.href = url;
});
checkBox.addEventListener("click", validate);
inputs.forEach((el) => {
  el.addEventListener("input", verifyInput);
});
email.addEventListener("input", verifyEmail);
phone.addEventListener("input", verifyPhone);
