<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Add Admin";
include_once "Models/connect.php";
$obj = new connect();
ob_start();
?>

<?php $_SESSION['message'] = 'This page is for ading admin'; ?>
<?php include_once 'views/p_message.php' ?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>