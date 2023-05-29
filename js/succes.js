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
            console.log(state);
            
            if (state['state'] == true) {
                window.location.href = "index.php?action=RDV" ;
            }
        }
    });
    }
    $('button[name="valider"]').click(function() {
            var formData = $('#formulaire').serialize();
            var data = {
                firstName: $('#inputFirstName').val(),
                lastName: $('#inputLastName').val(),
                email: $('#email').val(),
                cin: $('#inputCin').val(),
                dateBirth: $('#inputDateOfbirth').val(),
                // city : $('#inputCity').val(),
                address: $('#inputAddress').val(),
                tel: $('#inputNumber').val(),
                service: $('#inputService').val(),
                date: $('#datepicker').val(),
                heure: $('#form-select-hour').val()
            };
            $(this).trigger('reset');
            submitData(data) ;               
    });  
    
});