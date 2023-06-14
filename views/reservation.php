<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "All reservations";
ob_start();
?>
<?php include_once 'views/p_message.php' ?>
<section class="appointment" id="appointment">
    <div class="container">
        <div class="mb-5">
            <p>Metrics for</p>
            <h2><?php
                setlocale(LC_TIME, 'fr_FR');
                date_default_timezone_set('Europe/Paris');
                $date = utf8_encode(strftime('%A, %e %B %Y', strtotime(date('Y-m-d'))));                
                echo $date;
                ?></h2>
        </div>
        <?= $allReservation ?>
    </div>

</section>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>