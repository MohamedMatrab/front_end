<?php
session_start();
$title = "dashboard | membre";
ob_start();
?>
<?php
include_once "Models/connect.php";
$conn = new connect();
$sql2 = "select * from services" ;
$stmt2 = $conn->getConnect()->prepare($sql2);
$stmt2->execute();
$services = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
    <link rel="stylesheet" href="style/add-doctor.css">
</head>
<?php include_once 'views/p_message.php' ?>

<div class="form-container container">
    <form action="Models/add_doctor.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="image">photo de profil :</label>
            <input type="file" class="form-control" name="image" id="image" ></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label for="cin">CIN :</label>
            <input type = "text" class="form-control" name="cin" id="cin" ></textarea>
        </div>
        <div class="mb-3 ">
            <label for="nom">Nom : <span>*</span></label>
            <input type="text" class="form-control" name="nom" id="nom" required ></textarea>
        </div>
        <div class="mb-3">
            <label for="prenom">Prénom : <span>*</span></label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="" required >
        </div>
        <div class="mb-3">
            <label for="email">adresse e-mail : <span>*</span></label>
            <input type="text" class="form-control" name="email" id="email" value="" required >
        </div>
        <div class="mb-3">
            <label for="num">numéro de téléphone : <span>*</span></label>
            <input type="text" class="form-control" name="num" id="num"  value="" required >
        </div>
        <div class="mb-3">
            <label for="spec">spécialités : <span>*</span></label>
            <input type="text" class="form-control" name="spec" id="spec" value="" required >
            <p style="color:#dc354596;">choisir un numéro dans la case à droite</p>
        </div>
        <div class="mt-3">
            <input style="float:right;" type="submit" id="submit" name="submit" class="btn btn-primary" value="Ajouter">
        </div>
        

    </form>
    <div class="services">
        <h6>spécialités : </h6>
        <div class="container-services">
            <?php foreach($services as $service) :
            ?>
            <div class="service">
                <p><?=$service['ID']?> . </p>
                <p class="ms-1"> <?=$service['Nom_du_service']?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>
