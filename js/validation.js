// RÃ©cupÃ©rer toutes les entrÃ©es du formulaire
const Inputs = document.querySelectorAll("#formulaire input");
const InputsHours = document.getElementById("form-select-hour");
document.addEventListener("keydown", function (event) {
  if (event.key === "ArrowDown") {
    event.preventDefault();

    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );

    if (activeIndex !== -1 && activeIndex < Inputs.length - 1) {
      Inputs[activeIndex + 1].focus();
    }
  }
  if (event.key === "ArrowUp") {
    event.preventDefault();
    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );
    if (activeIndex !== -1 && activeIndex < Inputs.length - 1) {
      Inputs[activeIndex - 1].focus();
    }
  }

  if (event.key === "ArrowRigh") {
    event.preventDefault();

    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );

    if (activeIndex !== -1 && activeIndex === formInputs.length - 2) {
      Inputs[activeIndex + 1].focus();
    }
  }
});


function removeErrorPhone(){
  if(phone_number.nextElementSibling){
    phone_number.nextElementSibling.remove();
  }
}
function removeErrorCin(){
  if(cin.nextElementSibling){
    cin.nextElementSibling.remove();
  }
}
function verifyPhone() {
  removeErrorPhone();
  if (phone_number.value.length != 0) {
    var messageErreur = document.createElement('div');
    messageErreur.textContent = "" ;
    let regex = /^(\(\+\d{3}\)|0)\d{9}$/;
    if (regex.test(phone_number.value)) {
      
    }  
    else {
      messageErreur.textContent = "numéro de téléphone est invalde " ;
      messageErreur.style.color = "red" ;
      phone_number.parentElement.appendChild(messageErreur);
      phone_number.addEventListener("input",()=>{
        removeErrorPhone();
      })
    }
  }

}
function verifyCin() {
  removeErrorCin();
  if (cin.value.length != 0) {
    var messageErreur = document.createElement('div');
    messageErreur.textContent = "" ;
    let regex = /^[A-Za-z]{2}\d{4,6}$/;
    if (regex.test(cin.value)) {
      
    }  
    else {
      messageErreur.textContent = "CIN est invalde " ;
      messageErreur.style.color = "red" ;
      cin.parentElement.appendChild(messageErreur);
      cin.addEventListener("input",()=>{
        removeErrorCin();
      })
    }
  }

}
let phone_number = document.querySelector("#inputNumber") ;
let cin = document.querySelector("#inputCin");
if (cin){
  cin.addEventListener("input",verifyCin);
}
if (phone_number){
  phone_number.addEventListener("input",verifyPhone) ;
}
