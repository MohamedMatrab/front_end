const select = document.getElementById("select-services");
const esthetique = document.querySelectorAll(".esthetique");
const facettes = document.querySelectorAll(".facettes");
const implants = document.querySelectorAll(".implants");
const protheses = document.querySelectorAll(".protheses");
const hollywood = document.querySelectorAll(".hollywood");
const blanchiment = document.querySelectorAll(".blanchiment");
const orthodontie = document.querySelectorAll(".orthodontie");
const soins = document.querySelectorAll(".soins");
const pedodontie = document.querySelectorAll(".pedodontie");
const all = document.querySelectorAll(".all");

function setInvisible(myArr) {
  for (ele of myArr) {
    ele.style.display = "none";
  }
}
function setVisible(myArr) {
  for (ele of myArr) {
    ele.style.display = "block";
  }
}

select.addEventListener("change", (event) => {
  let selected = event.target.value;
  setInvisible(all);
  switch (selected) {
    case "all":
      setVisible(all);
      break;
    case "esthetique":
      setVisible(esthetique);
      break;
    case "facettes":
      setVisible(facettes);
      break;
    case "implants":
      setVisible(implants);
      break;
    case "protheses":
      setVisible(protheses);
      break;
    case "hollywood":
      setVisible(hollywood);
      break;
    case "blanchiment":
      setVisible(blanchiment);
      break;
    case "orthodontie":
      setVisible(orthodontie);
      break;
    case "soins":
      setVisible(soins);
      break;
    case "pedodontie":
      setVisible(pedodontie);
      break;
  }
});
