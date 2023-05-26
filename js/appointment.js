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
        let div = document.createElement("div");
        div.classList.add(...['select-services','inactive']);
        boxinputService.appendChild(div);
        let ul = document.createElement("ul");
        ul.className = "all-items";
        div.appendChild(ul);
        let AllServices = [];
        services.forEach((el) => {
          let li = document.createElement("li");
          li.className = "ui-item";
          ul.appendChild(li);

          let a = document.createElement("a");
          a.className = "item";
          a.innerHTML = el["title"];
          li.appendChild(a);
          AllServices.push(li);
        }) ;
        inputService.addEventListener("focus", (e) => {
          div.classList.remove('inactive');
          div.classList.add('active');
          AllServices.forEach((el) => {
            el.addEventListener('click' , (element)=>{
              e.target.value = element.target.innerHTML ;
              div.classList.add('inactive');
              div.classList.remove('active');
            })
          })
        });
        let app_container = document.querySelector(".app_container_");
        app_container.addEventListener("click", (e)=> {
          if (!(e.target.classList.contains("form-select") || e.target.classList.contains("ui-item") )) {
            div.classList.add('inactive');
            div.classList.remove('active');
          }
        })
      }
    });
  }
  disabledDay();
  getService();
});
