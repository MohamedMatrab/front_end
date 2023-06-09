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
        let regex = /^[A-Z]{1,2}\d{6}$/;
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
let phone_number = document.querySelector("#num") ;
let cin = document.querySelector("#cin");
if (cin){
    cin.addEventListener("blur",verifyCin);
}
if (phone_number){
    phone_number.addEventListener("blur",verifyPhone) ;
}

console.log(1);