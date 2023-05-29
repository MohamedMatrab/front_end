const password = document.getElementById("pswd");
const passC = document.getElementById("pswd-confirm");
const signUpBtn = document.getElementById("signup_btn");
let similar = false,
  valid = false;
signUpBtn.disabled = true;

function verifySimilar() {
  var password_similar = document.getElementById("password_similar");

  //if textBox is empty
  if (passC.value.length == 0) {
    password_similar.innerHTML = "";
    return;
  }

  //Display of Status
  var color = "";
  var passwordStrength = "";
  //Validation for each Regular Expression
  if (password.value === passC.value) {
    color = "green";
    passwordStrength = "Les mots de passe fournis sont les memes !";
    similar = true;
  } else {
    color = "red";
    passwordStrength = "Les mots de passe fournis sont differents !";
    similar = false;
  }

  if (valid && similar) {
    signUpBtn.disabled = false;
  } else {
    signUpBtn.disabled = true;
  }
  if (passwordStrength === "") {
    password_similar.style.innerHTML = "";
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
    return;
  }

  //lenght 8 ,uppercase at least ,lowercase at least,spacial character at least,digit at least
  var regex = "^(?=.*d)(?=.*[$@$!%*#?&])(?=.*[a-z])(?=.*[A-Z]).{8,}$";

  //Display of Status
  var color = "";
  var passwordStrength = "";
  //Validation for each Regular Expression
  if (new RegExp(regex).test(password.value)) {
    color = "green";
    passwordStrength = "Mot de passe fort !";
    valid = true;
  } else {
    color = "red";
    passwordStrength = "Mot de passe faible !";
    valid = false;
  }
  if (valid && similar) {
    signUpBtn.disabled = false;
  } else {
    signUpBtn.disabled = true;
  }
  if (passwordStrength === "") {
    password_strength.style.innerHTML = "";
  } else {
    password_strength.innerHTML = passwordStrength;
    password_strength.style.color = color;
  }
}

passC.addEventListener("change", verifySimilar);
password.addEventListener("change", CheckPasswordStrength);
