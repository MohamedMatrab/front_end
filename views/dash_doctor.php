<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Centre";
ob_start();
?>

<?php
include_once "Models/connect.php";
$conn = new connect();
$conn->doctorTable();
$conn->reAutoIncrement('doctor');
$conn = new connect();
$sql = "select * from doctor ;";
$stmt = $conn->getConnect()->prepare($sql);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="style/style-portfolio.css">
<link rel="stylesheet" href="style/add-doctor.css">
<div class="landing-page">
    <h2 class="main-header">Dentiste</h2>
</div>
<?php include_once 'views/p_message.php' ?>
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
                    <div>
                        <a class="btn btn-primary editer" href="dashboard.php?action=edit_doctor&&id=<?= $doctor['id'] ?>">Editer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div><a class="btn btn-primary" href="dashboard.php?action=add_doctor">Ajouter un membre</a></div>
    </div>
<?php else : ?>
    <div class="container alert-doctor">
    <div class="alert alert-info" style="margin:1rem;text-align:center;" role="alert" >Pas de dentiste !<b>Pour ajouter des informations sur le button ci dessous</b></div>
    <div><a class="btn btn-primary" href="dashboard.php?action=add_doctor">Ajouter un membre</a></div>
    </div>

<?php endif; ?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>
