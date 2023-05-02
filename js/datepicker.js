document.getElementById("form-select-hour").addEventListener("focus", (e)=> {
  let Heure = ["09:00","09:45","10:30","10:15","11:00","11:45","12:30","13:15","14:00","14:45","15:30"];
  for (let i = 0 ; i < Heure.length ; i++ ) {
    const option = document.createElement("option");
    option.value = Heure[i];
    option.innerHTML = Heure[i];
    e.target.appendChild(option);
  }
  e.target.addEventListener("blur" , ()=>{
    e.stopPropagation();
  })
});

