const navSections = document.querySelectorAll(".nav-section");
const down_icons = document.querySelectorAll(".fa-chevron-down");
const nextElements = Array.from(navSections).map(
  (section) => section.nextElementSibling
);
const selections = document.querySelectorAll(".sub-title");

let visibilityCdts = Array(nextElements.length).fill(true);
let previous = document.querySelector(".dashboard");

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
