$(document).ready(function () {
    function showHistory() {
    $.ajax({
        type: "POST",
        url: "Models/show_history.php",
        data: {
            table : 'historique',
        },
        dataType: "json",
        success: function (response) {
            let history = response.history ;

            let table = document.querySelector("#appointment .table tbody");

            history.forEach(element => {
                
            });
        }
    });
    }


});