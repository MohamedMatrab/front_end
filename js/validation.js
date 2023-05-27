// Récupérer toutes les entrées du formulaire
const Inputs = document.querySelectorAll("#formulaire input");
const InputsHours = document.getElementById("form-select-hour");
document.addEventListener("keydown", function (event) {
  if (event.key === "ArrowDown") {
    event.preventDefault();

    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );

    if (activeIndex !== -1 && activeIndex < Inputs.length - 1) {
      Inputs[activeIndex + 1].focus();
    }
  }
  if (event.key === "ArrowUp") {
    event.preventDefault();
    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );
    if (activeIndex !== -1 && activeIndex < Inputs.length - 1) {
      Inputs[activeIndex - 1].focus();
    }
  }

  if (event.key === "ArrowRigh") {
    event.preventDefault();

    const activeIndex = Array.from(Inputs).findIndex(
      (input) => document.activeElement === input
    );

    if (activeIndex !== -1 && activeIndex === formInputs.length - 2) {
      Inputs[activeIndex + 1].focus();
    }
  }
});

Inputs.forEach((el) => {
  el.addEventListener("focus", (e) => {
    e.target.placeholder = " ";
    console.log(e.target.parentElement.childElementCount);
    if (e.target.parentElement.childElementCount === 2) {
      let alert = document.querySelector("#appointment .row .col-8 span");
      alert.remove();
    }
  });
  el.addEventListener("blur", () => {
    if (
      !(
        el.classList.contains("datepicker") ||
        el.classList.contains("timepicker") ||
        el.classList.contains("form-select")
      )
    ) {
      if (el.value.length === 0 || el.value.length === null) {
        let error = document.createElement("span");
        let i = document.createElement("i");
        i.className = "bi bi-exclamation-circle";
        let text = document.createTextNode(" veuillez remplir ce champ");
        error.appendChild(i);
        error.appendChild(text);
        error.style.fontSize = "12px";
        el.parentElement.appendChild(error);
      }
      el.placeholder = el.getAttribute("data");
    }
  });
});
