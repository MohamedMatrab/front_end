const valider = document.getElementById("valider");
const patient_password = document.getElementById("patient_password");
const patient_pswd_confirm = document.getElementById("patient_pswd_confirm");
const email = document.getElementById("inputEmail");
const phone = document.getElementById("inputNumber");
const my_inputs = document.querySelectorAll("input[data-state]");

let passwordValid = true,
  phoneValid = true,
  emailValid = true;

function isInputsEmpty() {
  for (const el of my_inputs) {
    if (el.value.trim() == "") {
      return true;
    }
  }
  return false;
}

function validate() {
  if (passwordValid && phoneValid && emailValid && !isInputsEmpty()) {
    valider.disabled = false;
  } else {
    valider.disabled = true;
  }
}

function deleteError(element) {
  let prevError = element.parentElement.querySelector(".error_message");
  if (prevError) {
    element.parentElement.removeChild(prevError);
  }
}
function appendError(element, error_message) {
  deleteError(element);
  let error = document.createElement("span");
  error.classList.add("error_message");
  let i = document.createElement("i");
  i.className = "bi bi-exclamation-circle";
  let text = document.createTextNode(error_message);
  error.appendChild(i);
  error.appendChild(text);
  error.style.fontSize = "12px";
  error.style.color = "red";
  element.parentElement.appendChild(error);
}

function verifyEmail() {
  if (email.value.length == 0) {
    emailValid = false;
    validate();
    return;
  }
  let regex = /^([a-zA-Z0-9_.+-]+)@([a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)$/;
  if (!regex.test(email.value)) {
    appendError(email, "Email Invalide !");
    emailValid = false;
  } else {
    deleteError(email);
    emailValid = true;
  }
  validate();
}
function verifyPhone() {
  if (phone.value.length == 0) {
    phoneValid = false;
    validate();
    return;
  }
  let regex = /^(?:\+?\d{1,3})?\d{9}$/;
  if (!regex.test(phone.value)) {
    appendError(phone, " Numéro de Téléphone Invalide !");
    phoneValid = false;
  } else {
    deleteError(phone);
    phoneValid = true;
  }
  validate();
}

function verifyInput(input) {
  if (input.value.trim() == "") {
    appendError(input, " veuillez remplir ce champ");
    input.setAttribute("data-state", "0");
  } else {
    deleteError(input);
    input.setAttribute("data-state", "1");
  }
  validate();
}
function verifySimilar() {
  if (patient_password.value === patient_pswd_confirm.value) {
    return true;
  }
  return false;
}
function CheckPasswordStrength() {
  //length  8 ,uppercase at least ,lowercase at least,spacial character at least,digit at least
  var regex = /^(?=.*\d)(?=.*[$@$!%*#?&])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

  //Validation for each Regular Expression
  if (regex.test(patient_password.value)) {
    return true;
  }
  return false;
}

function passwordValidation() {
  if (patient_password.value != "" || patient_pswd_confirm.value != "") {
    if (patient_password.value != "") {
      if (patient_pswd_confirm.value == "") {
        appendError(patient_pswd_confirm, " veuillez remplir ce champ");
      }
      if (!CheckPasswordStrength()) {
        appendError(patient_password, " a-z, A-Z et 0-9 au moins, un Caractère spécial ,Longueur de 8 au moins .");
        passwordValid = false;
      } else {
        deleteError(patient_password);
        passwordValid = verifySimilar();
      }
    } else {
      appendError(patient_password, " veuillez remplir ce champ");
      passwordValid = false;
    }
    if (patient_pswd_confirm.value != "") {
      if (patient_password.value == "") {
        appendError(patient_password, " veuillez remplir ce champ");
      }
      if (!verifySimilar()) {
        appendError(patient_pswd_confirm, " les mots de passe fournis sont differents !");
        passwordValid = false;
      } else {
        deleteError(patient_pswd_confirm);
        passwordValid = CheckPasswordStrength();
      }
    } else {
      appendError(patient_pswd_confirm, " veuillez remplir ce champ");
      passwordValid = false;
    }
  } else {
    deleteError(patient_password);
    deleteError(patient_pswd_confirm);
    passwordValid = true;
  }
  validate();
}

my_inputs.forEach((el) => {
  el.addEventListener("input", () => {
    verifyInput(el);
  });
});

email.addEventListener("input", verifyEmail);
phone.addEventListener("input", verifyPhone);
patient_password.addEventListener('input',passwordValidation);
patient_pswd_confirm.addEventListener('input',passwordValidation);
