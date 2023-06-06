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
            if (state['state']) {
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
        var identifiant = 0 ;
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
        if (identifiant === 0 ) {
            $(this).trigger('reset');
            submitData(data) ;
        } 
                
    });  
    
});