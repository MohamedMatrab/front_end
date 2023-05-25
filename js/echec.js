$(document).ready(function () {
  function showHistory(heure, date) {
    $.ajax({
      type: "POST",
      url: "Models/FullDay.php",
      data: {
        date: JSON.stringify({ date: date, hour: heure }),
      },
      dataType: "json",
      success: function (response) {
        let resp = response["state"];
        console.log(resp["msg"]);
        if (resp["msg"] == true) {
          if (document.querySelector(".horaire .alert")) {
            document.querySelector(".horaire .alert").remove();
          }
          let hour = document.querySelector(".horaire");
          const error = `<div class="alert alert-danger mt-3" role="alert">
                Veuillez Modifier l'heure l'horaire qu vous choisissez est déja  occupée !
                        </div>`;
          hour.insertAdjacentHTML("beforeend", error);
        }else {
          if (document.querySelector(".horaire .alert")) {
            document.querySelector(".horaire .alert").remove();
          }  
        }
      },
    });
  }
  var heure = null;
  var date = null;

  
  $('.datepicker').on('change', function() {
    date = $('#datepicker').val() ;
    checkAndShowHistory();
    console.log(date);
  })  ;
  $(".timepicker").on('click',function() {
    $(".ui-menu-item").on('click',function() {
      var code = $(this).html() ;
      var debutBalise = code.indexOf('>') + 1;
      var finBalise = code.indexOf('</a>');
      heure = code.substring(debutBalise, finBalise);
      console.log(heure);
      checkAndShowHistory();
    }) ;
  }) ;
    
  

  function checkAndShowHistory() {
    if (heure && date) {
      showHistory(heure, date);
    }
  }
});
