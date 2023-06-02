const selectServices = document.getElementById("select-services");
const title = document.getElementById("title");
const desciption = document.getElementById("description");
const file = document.getElementById("my_image");
const submit = document.getElementById("submit");

let service_id = "";
if (sessionStorage.selectVal != null && sessionStorage.selectVal != "all") {
  selectServices.value = sessionStorage.selectVal;
} else {
  sessionStorage.selectVal = selectServices.value;
}

function validate() {
  if (
    title.value.length >= 5 &&
    selectServices.value != "" &&
    file.files.length > 0
  ) {
    submit.disabled = false;
  } else {
    submit.disabled = true;
  }
}
validate();
title.addEventListener("input", validate);
selectServices.addEventListener("change", validate);
file.addEventListener("change", validate);
