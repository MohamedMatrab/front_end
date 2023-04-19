let body_container = document.querySelector("body") ;

const Html_succes = `<div class="succes">
<div>
  <div class="succes_icons"><i class="bi bi-person-check-fill"></i></div>
  <h2>Congratulations!</h2>
  <p>Notre équipe prendra contact avec vous prochainement</p>
  <a href="index.php?action=appoint">Ok</a>
</div>
</div>` ;

let container = document.querySelector(".app_container_") ;
container.classList.add("app_fixe") ;
body_container.insertAdjacentHTML("beforeend",Html_succes);