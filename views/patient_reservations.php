<?php
session_start();
$title = "Mes reservations";
ob_start();
?>
<?php
if (!isset($_SESSION['USER'])) {
    $_SESSION['message'] = "Il faut etre connecté pour accéder à cette Page !";
    header('Location: index.php');
    exit(0);
}
?>

<div class="landing-page">
    <h2 class="main-header">Mes Reservations</h2>
</div>

<?php include_once 'Models/get_users_reservations.php' ?>



<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>