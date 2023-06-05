<?php
session_start();
$title = "Mes reservations";
ob_start();
?>



<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/index.php' ; ?> 