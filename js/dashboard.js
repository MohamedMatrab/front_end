const navSections = document.querySelectorAll(".nav-section");
const down_icons = document.querySelectorAll(".fa-chevron-down");
const navBtn = document.querySelector(".nav-btn");
const headerContent = document.querySelector(".header_content");
const h_dropDowns = document.querySelectorAll(".drop-down");
const header_pane = document.querySelector(".header_pane");
const navigation = document.querySelector(".navigation");
const dashboardContent = document.querySelector(".dashboard-content");
const box = document.querySelector(".box");
const box_i = box.querySelector("i");
const box_input = box.querySelector(".input");
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

box.querySelector("i").addEventListener("click", () => {
  box_i.classList.add("i_box");
  box_input.classList.add("input_box");
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
  if (is_out_sec(box, e.target)) {
    box_i.classList.remove("i_box");
    box_input.classList.remove("input_box");
  }
});
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
