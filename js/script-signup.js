const password = document.getElementById("pswd");
const passC = document.getElementById("pswd-confirm");

function verifySimilar() {
  const password_similar = document.getElementById("password_similar");
  let color = "";
  let passwordSimilar = "";
  if (pass !== passC) {
    color = "red";
    passwordSimilar = "passwords are not similar";
  } else {
    color = "";
  }
}

function CheckPasswordStrength() {
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
  } else {
    color = "red";
    passwordStrength = "Mot de passe faible !";
  }

  if (passwordStrength === "") {
    password_strength.style.innerHTML = "";
  } else {
    password_strength.innerHTML = passwordStrength;
    password_strength.style.color = color;
  }
}
const input_password = document.getElementById("pswd");
input_password.addEventListener("change", CheckPasswordStrength);
