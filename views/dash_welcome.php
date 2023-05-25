<?php
$title = "Welcome To Dashboard";
ob_start();
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>