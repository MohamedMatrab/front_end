let hour = document.querySelector(".error_hour") ;
const error = `<div class="alert alert-danger mt-3" role="alert">
Veuillez Modifier l'heure l'horaire qu vous choisissez est déjà occupé !
</div>` ;
hour.insertAdjacentHTML('beforeend', error);