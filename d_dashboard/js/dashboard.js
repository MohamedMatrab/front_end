const navSections = document.querySelectorAll(".nav-section");
const down_icons = document.querySelectorAll(".fa-chevron-down");
const nextElements = Array.from(navSections).map(
  (section) => section.nextElementSibling
);
const selections = document.querySelectorAll(".sub-title");

let rotateCdts = Array(down_icons.length).fill(true);
let visibilityCdts = Array(nextElements.length).fill(true);
let previous = document.querySelector(".dashboard");
let previousSec = document.querySelector(".dashboard");
previousSec.style.fontWeight = "600";
//Navigation sections having sub titles
navSections.forEach((navSection, index) => {
  //Only nav sections having subtitles under
  if (index !== 0) {
    navSection.addEventListener("click", () => {
      //for visibility of  the elemts under
      if (visibilityCdts[index]) {
        nextElements[index].style.display = "flex";
        visibilityCdts[index] = false;
      } else {
        nextElements[index].style.display = "none";
        visibilityCdts[index] = true;
      }
      //for rotating the arrow
      if (rotateCdts[index - 1]) {
        down_icons[index - 1].style.transform = "rotate(180deg)";
        rotateCdts[index - 1] = false;
      } else {
        down_icons[index - 1].style.transform = "rotate(0deg)";
        rotateCdts[index - 1] = true;
      }
    });
  } else {
    navSection.addEventListener("click", () => {
      previousSec.style.fontWeight = "normal";
      navSection.style.fontWeight = "600";
      previous.style.fontWeight = "normal";
      previousSec = navSection;
    });
  }
});

//keep color of selected subtitle
selections.forEach((element) => {
  element.addEventListener("click", () => {
    // Font Weight Of selected subtitle's Parent Title
    const navSection =
      element.parentNode.parentNode.querySelector(".nav-section");
    previousSec.style.fontWeight = "normal";
    navSection.style.fontWeight = "600";
    previousSec = navSection;
    //backgroung color of selected subtitle
    element.style.backgroundColor = "#f0f0f0";
    element.style.fontWeight = "bold";
    previous.style.backgroundColor = "transparent";
    previous.style.fontWeight = "normal";
    previous = element;
  });
});

//hiding SideBar
// header_pane.addEventListener("click", () => {
//   titlesText.forEach((title) => {
//     setInvisible(title);
//   });
//   titlesIcon.forEach((icon) => {
//     icon.style.fontSize = "2rem";
//     icon.style.margin = "auto";
//   });
//   down_icons.forEach((icon) => {
//     icon.style.display = "none";
//   });
//   navSections.forEach((navSection) => {
//     navSection.style.height = "fit-content";
//     navSection.style.width = "100%";
//   });
//   titles.forEach((title) => {
//     title.style.width = "5rem";
//     title.style.height = "5rem";
//     // title.style.boxShadow = "0px 0px 6px #dedede";
//     // title.style.padding = "20%";
//     title.style.margin = "auto";
//   });
//   navigation_title.textContent = "";
//   profile_img.style.margin = "auto";
//   profile_img.style.width = "3.5rem";
//   admin_data.style.display = "none";
//   navigationBar.style.width = "8%";
//   contentSection.style.width = "90%";
// });
