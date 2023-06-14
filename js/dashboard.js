const navSections = document.querySelectorAll(".nav-section");
const down_icons = document.querySelectorAll(".fa-chevron-down");
const navBtn = document.querySelector(".nav-btn");
const headerContent = document.querySelector(".header_content");
const h_dropDowns = document.querySelectorAll(".drop-down");
const header_pane = document.querySelector(".header_pane");
const navigation = document.querySelector(".navigation");
const dashboardContent = document.querySelector(".dashboard-content");
const linkeds = document.querySelectorAll(".linked");
const logo = document.querySelector(".logo");
const logout = document.getElementById("logout");

let prev = navSections[0];
let prevDrop = h_dropDowns[0].nextElementSibling;
let visibilityCdts = Array(navSections.length).fill(true);
let n_cdt = 0;

function is_out_sec(section, e_target) {
  return e_target != section && !section.contains(e_target);
}

const unCheckPrevs = function () {
  for (i = 1; i < navSections.length; i++) {
    navSections[i].nextElementSibling.style.display = "none";
    navSections[i].classList.remove("active");
    navSections[i].classList.add("disabled");
  }
};

//Navigation sections having sub titles
navSections.forEach((navSection, index) => {
  //Only nav sections having subtitles under
  if (index !== 0) {
    //the arrow down in nav-section
    const dropDown = navSection.nextElementSibling;
    navSection.classList.add("disabled");
    navSection.addEventListener("click", () => {
      if (navSection.classList.contains("disabled")) {
        unCheckPrevs();
        dropDown.style.display = "flex";
        navSection.classList.remove("disabled");
        navSection.classList.add("active");
      } else {
        dropDown.style.display = "none";
        navSection.classList.remove("active");
        navSection.classList.add("disabled");
      }
    });

    const dropDownElements = dropDown.querySelectorAll("li");
    dropDownElements.forEach((el) => {
      el.addEventListener("click", () => {
        prev.classList.remove("sub_clicked");
        el.classList.add("sub_clicked");
        prev = el;
      });
    });
  }

  //for dashboard nav-section
  else {
    navSection.addEventListener("click", () => {
      prev.classList.remove("sub_clicked");
      unCheckPrevs();
      navSection.classList.add("sub_clicked");
      prev = navSection;
    });
  }
});

navBtn.addEventListener("click", () => {
  headerContent.classList.toggle("h_btn_clicked");
});

h_dropDowns.forEach((dropDown) => {
  const div = dropDown.nextElementSibling;
  dropDown.addEventListener("click", () => {
    if (div.style.display === "flex") {
      div.style.display = "none";
    } else {
      prevDrop.style.display = "none";
      div.style.display = "flex";
    }
    prevDrop = div;
  });
});

header_pane.addEventListener("click", () => {
  let temp_cdt_1 =
    navigation.classList.contains("nav_show") &&
    dashboardContent.classList.contains("blured");
  let temp_cdt_2 =
    !navigation.classList.contains("nav_show") &&
    !dashboardContent.classList.contains("blured");
  if (temp_cdt_1 || temp_cdt_2) {
    dashboardContent.classList.toggle("blured");
  }
  navigation.classList.toggle("nav_show");
});


linkeds.forEach((linked) => {
  linked.addEventListener("click", () => {
    let action = linked.getAttribute("data-id");
    if (action == "dashboard") {
      window.location.href = "dashboard.php";
    } else {
      window.location.href = "dashboard.php?action=" + action;
    }
  });
});

logo.addEventListener("click", () => {
  window.location.href = "dashboard.php";
});

window.addEventListener("resize", () => {
  if (window.innerWidth >= 1000) {
    headerContent.classList.remove("h_btn_clicked");
  }
});

document.addEventListener("click", function (e) {
  if (is_out_sec(navigation, e.target) && is_out_sec(header_pane, e.target)) {
    navigation.classList.remove("nav_show");
    dashboardContent.classList.remove("blured");
  }

  if (is_out_sec(navBtn, e.target) && is_out_sec(headerContent, e.target)) {
    headerContent.classList.remove("h_btn_clicked");
  }
});

document.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("more_details").submit();
  }
});


let btn_valider = document.querySelectorAll(".valider") ;
btn_valider.forEach((el)=> {
    el.addEventListener("click" , ()=>{
      var id = el.getAttribute('data-id');
      $.ajax({
        type: "POST",
        url: "Models/valider.php",
        data: { 'id': id },
        dataType: "json",
        success: function (response) {
          console.log(response);
          if (response.state) {
            el.innerHTML = '';
            el.innerHTML = `<i class="bi bi-check-lg fs-5"></i>`;
            let alertprev = document.querySelector(".alert-info");
            if (alertprev){
              alertprev.remove();
            }
            var alert = `<div class="alert alert-info" style="margin:1rem;text-align:center;" role="alert" >validate succesfuly</div>` ;
            let section = document.querySelector("#appointment");
            section.insertAdjacentHTML("beforebegin",alert);
          }else{

          }
        },
      });
    });
})


document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); 
        document.getElementById('more_details').submit();
    } 
}) ;

console.log(logout);
$(document).ready(function () {
  logout.addEventListener("click", () => {
    $.ajax({
      type: "POST",
      url: "Models/dash_logout.php",
      data: { logout: true },
      dataType: "json",
      success: function (response) {
        if (response) {
          window.location.reload();
        }
        console.log("Hello World");
      },
    });
  });
});


let notification = document.querySelector(".notifications");
// $(document).ready( 
var intervalID = setInterval(fetchReservations , 100);
function fetchReservations() {
  $.ajax({
    type: "POST",
    url: "Models/nbr_appoint.php",
    dataType: "json",
    success: function (response) {
      let nbr = response.nbr ;
      console.log(nbr['appoint']);
      if ( window.location.href !== "http://localhost/front_end/dashboard.php?action=all_reservations") {
        if (nbr['appoint'] > 0){
          let count = document.querySelector(".count");
          if (count){
            count.remove();
          }
          let nbr_appoint = document.createElement("div") ;
          nbr_appoint.innerHTML = nbr['appoint'] ;
          nbr_appoint.className = "count";
          notification.parentElement.insertAdjacentElement("afterbegin",nbr_appoint);
        }
          $.ajax({
            type: "POST",
            url: "Models/show_0.php",
            dataType: "json",
            success: function (response) {
              notification.parentElement.addEventListener('click', (e) => {
                if (document.querySelector(".notification_content")){
                  document.querySelector(".notification_content").innerHTML = "";
                  document.querySelector(".notification_content").remove();
                }
                let nbr_appoint = document.querySelector(".count");
                if(nbr_appoint) {
                  nbr_appoint.remove() ;
                }
              let notifications = notification.parentElement.nextElementSibling;
              if (notification.parentElement.nextElementSibling.style.display === "flex") {
                let notification_content ;
                notification_content = document.createElement("div");
                notification_content.className = "notification_content" ;
                notifications.appendChild(notification_content);
                nbr['patients'].forEach( (e,index) => {
                  if (index < 3 ){
                    let new_appoint = document.createElement("div");
                    new_appoint.className = "new_appoint" ;
                    let a= document.createElement("a");
                    a.href = "dashboard.php?action=all_reservations" ;
                    a.innerHTML = "un nouveau rendez vous le "+ e['date_rendez'] +" \ " + e['Heure_rendez'] +"......";
                    new_appoint.appendChild(a);
                    notification_content.appendChild(new_appoint);
                  }
                });
                if (nbr['patients'].length > 0){
                  if (!document.querySelector(".see_all")){
                    let see_all = document.createElement("div");
                    see_all.className = "see_all pb-2 pt-2";
                    let a_all = document.createElement("a");
                    a_all.href = "dashboard.php?action=all_reservations" ;
                    a_all.innerHTML = "See all ..." ;
                    see_all.appendChild(a_all);
                    notification_content.appendChild(see_all);
                  }
                  document.querySelector(".see_all").addEventListener('click',()=>{
                    $.ajax({
                      type: "POST",
                      url: "Models/show_1.php",
                      dataType: "json",
                      success: function (response) {
                        let notif_content = document.querySelector(".notification_content");
                        notif_content.remove();                   
                      }
                    })
                  })
                }else{
                  let nodata = document.createElement("div");
                  nodata.innerHTML = "pas de nouveaux rendez-vous";
                  nodata.style.textAlign = "center";
                  notification_content.appendChild(nodata);
                }
                
              }
            })
            }
          })
        
      } 
    },
    error : function(xhrs,error,state) {
      console.log(state);
    }
  })
}





