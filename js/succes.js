$(document).ready(function () {
    function submitData(data) {
    $.ajax({
        type: "POST",
        url: "Models/appointment.php",
        data: {
            data : JSON.stringify(data),
        },
        dataType: "json",
        success: function (response) {
            let state = response['pass'] ;
            console.log(state['state']);
            if (state['state'] == 1) {
                localStorage.setItem('succes', "Notre equipe prendra contact avec vous prochainement");
                window.location.href = "index.php?action=RDV" ;
            }
            else {
                localStorage.setItem('echec', "Vous avez déjà reservé dans ce jour");
                window.location.href = "index.php?action=RDV" ;
            }
        },
        error: function(xhrs,state, error) {
            console.log(error);
        }
    });
    }
    
    let identifiant = 0 ;
    function handleError(error){
        identifiant = 1 ;
        let appointment = document.querySelector("#appointment");
        let alertWarning = document.querySelector(".alert-danger") ;
        if (alertWarning) {
            alertWarning.remove();
        }
        let div = `<div class="alert alert-danger" role="alert">
        `+error+`
        </div>` ;
        appointment.insertAdjacentHTML("beforebegin",div);
        window.scroll(appointment.offsetTop , 0) ;
        
    }
    function verifyCin(cin) {
        if (cin.length != 0) {
            let regex = /^[a-zA-Z]{2}\d{4,6}$/;
            if (regex.test(cin)) {
            
            }  
            else {
                handleError("CIN est invalide");
            }
        }
    
    }
    function verifyPhone(phone_number) {
        if (phone_number.length != 0) {
            let regex = /^(\(\+\d{3}\)|0)\d{9}$/;
            if (regex.test(phone_number)) {
            
            }  
            else {
                handleError("le numéro de téléphone est invalide");
            }
        }
    } 
    
    $('button[name="valider"]').click(function() {
        var data = {
            firstName: $('#inputFirstName').val(),
            lastName: $('#inputLastName').val(),
            cin: $('#inputCin').val(),
            id : $('#inputCin').attr('data_id'),
            dateBirth: $('#inputDateOfbirth').val(),
            address: $('#inputAddress').val(),
            tel: $('#inputNumber').val(),
            service: $('#inputService').val(),
            date: $('#datepicker').val(),
            heure: $('#form-select-hour').val()
        };
        
        for (var d in data) {
            if (data[d].length === 0 ) {
                let appointment = document.querySelector("#appointment");
                let alertWarning = document.querySelector(".alert-danger") ;
                if (alertWarning) {
                    alertWarning.remove();
                }
                let div = `<div class="alert alert-danger" role="alert">
                Veuillez remplir tous les champs !
                </div>` ;
                appointment.insertAdjacentHTML("beforebegin",div);
                window.scroll(appointment.offsetTop , 0) ;
                identifiant = 1 ;
                break ;
            }
        }


        verifyCin(data['cin']);
        verifyPhone(data['tel']) ;
        if (identifiant === 0 ) {
            $(this).trigger('reset');
            submitData(data) ;
        } 
                
    });  
    
});
