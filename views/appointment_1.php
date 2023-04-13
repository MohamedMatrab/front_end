<?php

   $title = "Dentiste:Appointment Page" ;
   ob_start();
?>

<?php $contenu = ob_get_clean() ; ?>
<?php include_once 'views/Appointment.php' ; ?> 