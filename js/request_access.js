const valider = document.getElementById("valider");
const email = document.getElementById("inputEmail");
const phone = document.getElementById("inputNumber");
const cin = document.getElementById("inputCin");
let my_inputs = Array.from(document.querySelectorAll("input"));
my_inputs.push(document.getElementById("inputSexe"));
my_inputs.push(document.getElementById("inputTypeRequest"));

let phoneValid = false,
  emailValid = false,
  cinValid = false;

function isInputsEmpty() {
  for (const el of my_inputs) {
    if (el.value.trim() == "") {
      return true;
    }
  }
  return false;
}

function validate() {
  if (cinValid && phoneValid && emailValid && !isInputsEmpty()) {
    valider.disabled = false;
  } else {
    valider.disabled = true;
  }
  console.log(cinValid && phoneValid && emailValid && !isInputsEmpty());
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
function verifyCIN() {
  if (cin.value.length == 0) {
    cinValid = false;
    validate();
    return;
  }
  let regex = /^[a-zA-Z]{2}\d{4,6}$/;
  if (!regex.test(cin.value)) {
    appendError(cin, " CIN Invalide !");
    cinValid = false;
  } else {
    deleteError(cin);
    cinValid = true;
  }
  validate();
}

function verifyInput(input) {
  if (input.value.trim() == "") {
    appendError(input, " veuillez remplir ce champ");
  } else {
    deleteError(input);
  }
  validate();
}


verifyCIN();
verifyEmail();
verifyPhone();
for(const input of my_inputs){
    verifyInput(input);
}


my_inputs.forEach((el) => {
  el.addEventListener("input", () => {
    verifyInput(el);
  }); 
});

email.addEventListener("input", verifyEmail);
phone.addEventListener("input", verifyPhone);
cin.addEventListener("input", verifyCIN);
