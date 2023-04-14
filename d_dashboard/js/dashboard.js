// let Sections = document.querySelectorAll("section div");
// let sidebarSections = document.querySelectorAll(".disabled");
// let Dropdown = [["toutes les résérvations","historique"] , ["Users","account"] , ["Portfolio","Servive","Centre"]] ;

// for (let i = 0 ; i < sidebarSections.length ; i++) {
//     sidebarSections[i].addEventListener("click" ,() => {
//             if (sidebarSections[i].classList.contains("disabled")){
//                 sidebarSections.forEach((el) => {
//                     el.classList.remove("active") ;
//                     el.classList.add("disabled") ;
//                 }) 
//                 Sections.forEach((el) => {
//                     el.innerHTML = "" ;
//                 })
//                 sidebarSections[i].classList.remove("disabled") ;
//                 sidebarSections[i].classList.add("active") ;

//                 const ul = document.createElement("ul");
//                 ul.className = "drop-down" ;
//                 Sections[i].appendChild(ul);
//                 for (let j = 0 ; j < Dropdown[i].length ; j++) {
//                 const li = document.createElement("li");
//                 const a = document.createElement("a");
//                 a.href = "#" ;
//                 const text = document.createTextNode(Dropdown[i][j]);
//                 a.appendChild(text);
//                 li.appendChild(a);
//                 ul.appendChild(li);
//                 }
//             } else {
//                 sidebarSections[i].classList.remove("active") ;
//                 sidebarSections[i].classList.add("disabled") ;
//                 Sections[i].innerHTML = "" ;
//             }





        
//     }) ;
// }

const pagesSection = document.querySelector(".pages");
const reservationsSection = document.querySelector(".reservations");
const authenticationSection = document.querySelector(".authentication");

const pagesList = pagesSection.nextElementSibling;
const reservationsList = reservationsSection.nextElementSibling;
const authenticationList = authenticationSection.nextElementSibling;

let pS = true,
  pR = true,
  pA = true;
pagesSection.addEventListener("click", () => {
  if (pS) {
    pagesList.style.display = "flex";
    pS = false;
  } else {
    pagesList.style.display = "none";
    pS = true;
  }
});
reservationsSection.addEventListener("click", () => {
  if (pR) {
    reservationsList.style.display = "flex";
    pR = false;
  } else {
    reservationsList.style.display = "none";
    pR = true;
  }
});
authenticationSection.addEventListener("click", () => {
  if (pA) {
    authenticationList.style.display = "flex";
    pA = false;
  } else {
    authenticationList.style.display = "none";
    pA = true;
  }
});

const selections = document.querySelectorAll(".sub-title");
let previous = document.querySelector(".all-appoint");
selections.forEach((element) => {
  element.addEventListener("click", () => {
    previous.style.backgroundColor = "transparent";
    element.style.backgroundColor = "#f0f0f0";
    previous = element;
    element.classList.add("sub-title");
  });
});

const burgerMenu = document.getElementById("burger-menu");

burgerMenu.addEventListener("click", () => {
  burgerMenu.classList.toggle("toggled");
});