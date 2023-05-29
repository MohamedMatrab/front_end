<?php
session_start();
$title = "Welcome To Dashboard";
ob_start();
?>

<?php include_once 'views/p_message.php' ?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>