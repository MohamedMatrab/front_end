<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Mes reservations";
ob_start();
?>
<?php
if (!isset($_SESSION['USER'])) {
    $_SESSION['message'] = "Il faut etre connecté pour accéder à cette Page !";
    header('Location: index.php');
    exit(0);
}
include_once 'Controllers/controllers_dashboard.php';
?>
<link rel="stylesheet" href="style/patient_reservation.css">
<?php include_once 'Models/get_users_reservations.php' ?>
<?php include_once 'Models/get_user_info.php' ?>
<?php
include_once 'Models/connect.php';
$obj = new connect();
$obj->rendezVousTable();
?>
<?php $obj->doctorTable() ?>
<div class="landing-page">
    <h2 class="main-header">Mes Reservations</h2>
</div>

<div class="container pt-5 pb-5" id="account">
    <div class="desp" style="border:none;display:flex;flex-direction:row;align-items:center;justify-content:start;">
        <img src="<?= is_null($user['img']) ? "images/user_image.png" : 'data:image/jpg;base64,' . base64_encode($user['img']); ?>" alt="profile" style="width:6rem; height:6rem;border-radius:50%" />
        <p style="font-size:1.3rem;margin:0;margin-left:1rem;"><?= $user['fname'] . " " . $user['lname'] ?></p>
    </div>
    <h3 class="fs-5 mb-5 br">Résérvations : </h3>
    <div class="fs-5 mb-5 br reservations">
        <?php
        if (count($reservations) == 0) {
        ?>
            <div class="text-center alert alert-info w-50 h-50" style="margin-top:2rem;">Pas de Résérvations à Afficher !</div>
        <?php
        } else {
        ?>
            <?php
            foreach ($reservations as $key => $reservation) {
                $id_service = $reservation['service_id'];
                $doctor = $obj->selectDoctor($id_service);
                if (isset($reservation)) {
                    // $class = is_null($reservation['state']) ? 'en_cours' : ($reservation['state'] == 0 ? 'annulee' : 'validee');
                    $State = is_null($reservation['state']) ? 'En cours de traitement' : ($reservation['state'] == 0 ? 'Résérvation Annulée' : 'Résérvation Validée');
            ?>
                    <section class="appointment" id="appointment">
                        <div class="container">
                            <div class="patient">
                                <div class="name action">
                                    <div class="en_cours"><?= $State ?></div>
                                    <a class="annuler" href="index.php?action=del_reservation&id=<?= $reservation['id_rendez'] ?>">Annuler</a>
                                </div>
                                <div class="description  ">
                                    <div class="box">
                                        <p><span style="color:rgb(15 116 143 / 70%);">Nom et Prénom : </span><?= !is_null($reservation['First_Name']) && !is_null($reservation['Last_Name']) ? $reservation['First_Name'] . " " . $reservation['Last_Name'] : 'Champ Vide'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">CIN : </span><?= !is_null($reservation['CIN']) ? $reservation['CIN'] : 'Champ Vide'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">Date de naissance : </span><?= !is_null($reservation['Date_Of_birth']) ? $reservation['Date_Of_birth'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">tél : </span><?= !is_null($reservation['tel']) ? $reservation['tel'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">date de rendez-vous : </span><?= !is_null($reservation['date_rendez']) ? $reservation['date_rendez'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">heure de rendez-vous : </span><?= !is_null($reservation['Heure_rendez']) ? $reservation['Heure_rendez'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">Nom et Prénom du docteur: </span><?= isset($doctor->Nom) && isset($doctor->Prenom) ? $doctor->Nom . " " . $doctor->Prenom  : 'Champ Vide !'; ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </section>
            <?php
                }
            }
            ?>
        <?php
        }
        ?>
    </div>
    <h3 class="fs-5 mb-5 br">Historique : </h3>
    <div class="fs-5 mb-5 br historique">
        <?php
        if (count($historiques) == 0) {
        ?>
            <div class="text-center alert alert-info w-50 h-50" style="margin-top:2rem;">Historique Vide !</div>
        <?php
        } else {
        ?>
            <?php
            foreach ($historiques as $key => $historique) {
                $id_service = $historique['service_id'];
                $doctor = $obj->selectDoctor($id_service);
                if (isset($historique)) {
                    // $class = is_null($historique['state']) ? 'en_cours' : ($historique['state'] == 0 ? 'annulee' : 'validee');
                    // $State = is_null($historique['state']) ? 'Validée' : ($historique['state'] == 0 ? 'Annulée' : 'Validée');
            ?>
                    <section class="appointment" id="appointment">
                        <div class="container">
                            <div class="patient">
                                <div class="name">
                                    <p style="margin-left: 1rem;"><?= $historique['First_Name'] . " " . $historique['Last_Name'] ?></p>
                                    <!-- <div class="">  </div> -->
                                </div>
                                <div class="description">
                                    <div class="box">
                                        <p><span style="color:rgb(15 116 143 / 70%);">Nom et Prénom : </span><?= !is_null($historique['First_Name']) && !is_null($historique['Last_Name']) ? $historique['First_Name'] . " " . $historique['Last_Name'] : 'Champ Vide'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">CIN : </span><?= !is_null($historique['CIN']) ? $historique['CIN'] : 'Champ Vide'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">Date de naissance : </span><?= !is_null($historique['Date_Of_birth']) ? $historique['Date_Of_birth'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">tél : </span><?= !is_null($historique['tel']) ? $historique['tel'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">date de rendez-vous : </span><?= !is_null($historique['date_rendez']) ? $historique['date_rendez'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">heure de rendez-vous : </span><?= !is_null($historique['heure_rendez']) ? $historique['heure_rendez'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">Spécialité : </span><?= !is_null($historique['service']) ? $historique['service'] : 'Champ Vide !'; ?></p>
                                        <p><span style="color:rgb(15 116 143 / 70%);">Nom et Prénom du docteur: </span><?= isset($doctor->Nom) && isset($doctor->Prenom) ? $doctor->Nom . " " . $doctor->Prenom  : 'Champ Vide !'; ?></p>
                                    </div>
                                    <?php if (!is_null($historique['ordonnance'])) { ?>
                                        <div class="action">
                                            <a class="annuler ordonnance" href="<?= 'index.php?action=show_image&id=' . $historique['id']; ?>">Voir Mon Ordonnance</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </section>
            <?php
                }
            }
            ?>
        <?php
        }
        ?>
    </div>
</div>

<?php include_once 'views/floating_message.php' ?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>