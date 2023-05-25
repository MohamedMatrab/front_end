$(document).ready(function () {
  function disabledDay() {
    $.ajax({
      type: "POST",
      url: "Models/disabled_day.php",
      dataType: "json",
      success: function (response) {
        let datesForDisable = response["day"];
        // console.log(datesForDisable);
        // Initialize a datepicker using jQuery Datepicker plugin with options
        $(".datepicker").datepicker({
          format: "yyyy-mm-dd",
          autoclose: true,
          //todayHighlight: true,
          datesDisabled: datesForDisable,
          startDate: new Date(),
          daysOfWeekDisabled: [0]
        });
        $(".timepicker").timepicker({
          altField: "#timeslot",
          timeFormat: "h:mm",
          interval: 30,
          // minTime: '9',
          maxTime: "6:00pm",
          defaultTialtField: "#timeslot",
          timeFormat: "HH:mm",
          interval: 30,
          minTime: "9",
          maxTime: "6:00pm",
          // defaultTime: '11',
          startTime: "9:00",
          dynamic: false,
          dropdown: true,
          scrollbar: true
        });
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  }

  function getService() {
    $.ajax({
      type: "POST",
      url: "Models/getService.php",
      dataType: "json",
      success: function (response) {
        let services = response["service"];
        let inputService = document.querySelector(".all-Services input");
        let boxinputService = document.querySelector(
          ".all-Services .col-8"
        );
        inputService.addEventListener("click", (e) => {
          if (boxinputService.classList.contains("inactive")) {
            boxinputService.classList.add("active");
            boxinputService.classList.remove("inactive");
            let div = document.createElement("div");
            div.className = "select-services";
            boxinputService.appendChild(div);

            let ul = document.createElement("ul");
            ul.className = "all-items";
            div.appendChild(ul);

            services.forEach((el) => {
              let li = document.createElement("li");
              li.className = "ui-item";
              ul.appendChild(li);

              let a = document.createElement("a");
              a.className = "item";
              a.innerHTML = el["title"];
              li.appendChild(a);
            });
          }else {
            boxinputService.classList.add("inactive");
            boxinputService.classList.remove("active");
            let Div = document.querySelector(".select-services");
            console.log(Div);
            Div.remove();
          }
        });
      }
    });
  }
  disabledDay();
  getService();
});
