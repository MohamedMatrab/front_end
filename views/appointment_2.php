<?php

   $title = "Dentiste:Appointment Page" ;
   ob_start();
?>

    <div class="alert alert-danger mt-3" role="alert">
      Veuillez Modifier l'heure l'horaire qu vous choisissez est déjà occupé !
    </div>

<?php $contenu = ob_get_clean() ; ?>
<?php include_once 'views/Appointment.php' ; ?> 