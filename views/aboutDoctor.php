<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Dentiste:Centre Page";
ob_start();
include_once "Models/connect.php";
$conn = new connect();
$sql = "select * from doctor ;";
$stmt = $conn->getConnect()->prepare($sql);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- <link rel="stylesheet" href="style/style-portfolio.css"> -->
<link rel="stylesheet" href="style/add-doctor.css">
<div class="landing-page">
    <h2 class="main-header">Doctor</h2>
</div>
<div class="About">
    <div class="container mt-4">
        <h1 class="cl-h2 fs-6 fw-bold">Bienvenue dans l’univers auquel on crée la sourire.</h1>
        <h3 class="bv fs-4 pb-1">Votre sourire est la première chose que les gens remarquent, il est l’expression de votre bien être, vous ne pouvez l’exprimer pleinement que si vous êtes à l’aise avec.</h3>
    </div>
    <?php if (count($doctors) > 0) : ?>
        <div class="container" id="doctor">
            <div class="doctors">
                <?php foreach ($doctors as $doctor) :
                    $image = 'data:image/jpg;base64,' . base64_encode($doctor['image']);
                    $service = $conn->selectService($doctor['id_service'])['Nom_du_service'];
                ?>
                    <div class="box">
                        <div class="image">
                            <?php if ($doctor['image'] == null) : ?>
                                <img src="images_profil/user_image.png" alt="">
                            <?php else : ?>
                                <img src="<?= $image ?>" alt="" srcset="">
                            <?php endif; ?>
                        </div>
                        <div class="nom">
                            <?= 'D. ' . $doctor['Nom'] . ' ' . $doctor['Prenom'] ?>
                        </div>
                        <div class="spe">
                            <?= $service ?>
                        </div>
                        <div class="email">
                            <a href="mailto:<?= $doctor['Gmail'] ?>"><?= $doctor['Gmail'] ?></a>
                        </div>
                        <div class="phone">
                            <a href="tel:+<?= $doctor['tel'] ?>"><?= $doctor['tel'] ?></a>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="container">
            Pas de membre
        </div>
    <?php endif; ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script defer src="js/dash_portfolio.js"></script> -->
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>