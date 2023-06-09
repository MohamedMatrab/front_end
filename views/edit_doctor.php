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



$sql = "select * from doctor where id = ? ;";
$stmt = $conn->getConnect()->prepare($sql);
$stmt->execute(array($code));
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
    <link rel="stylesheet" href="style/add-doctor.css">
</head>
<?php include_once 'views/p_message.php' ?>

<div class="form-container container">
    <form action="Models/edit_doctor.php?id=<?=$code?>" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3 mt-3">
            <label for="image">photo de profil :</label>
            <?php if ($doctor['image'] == null) : ?>
            <div class="image">
                <img src="images_profil/user_image.png" alt="">
            </div>
            <?php else :?>
            <?php $image = 'data:image/jpg;base64,'.base64_encode($doctor['image']);?>

            <div class="image">
                <img src="<?=$image?>" alt="">
            </div>
            <?php endif ;?>
            <input type="file" class="form-control" name="image" id="image" ></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label for="cin">CIN :</label>
            <input type = "text" class="form-control" name="cin" id="cin" value="<?=$doctor['CIN']?>"></textarea>
        </div>
        <div class="mb-3 ">
            <label for="nom">Nom : <span>*</span></label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?=$doctor['Nom']?>" required ></textarea>
        </div>
        <div class="mb-3">
            <label for="prenom">Prénom : <span>*</span></label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?=$doctor['Prenom']?>" required >
        </div>
        <div class="mb-3">
            <label for="email">adresse e-mail : <span>*</span></label>
            <input type="text" class="form-control" name="email" id="email" value="<?=$doctor['Gmail']?>" required >
        </div>
        <div class="mb-3">
            <label for="num">numéro de téléphone : <span>*</span></label>
            <input type="text" class="form-control" name="num" id="num"  value="<?=$doctor['tel']?>" required >
        </div>
        <div class="mb-3">
            <label for="spec">spécialités : <span>*</span></label>
            <input type="text" class="form-control" name="spec" id="spec" value="<?=$doctor['id_service']?>" required >
            <p style="color:#dc354596;">choisir un numéro dans la case à droite</p>
        </div>
        <div class="mt-3" style="float:right;">
            <a class="btn btn-danger ms-2" href="dashboard.php?action=doctor">annuler</a>
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="editer">
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