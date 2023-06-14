<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Add Image";
ob_start();
?>
<?php
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Pas d'image Selectionnée !";
    header("Location: dashboard.php?action=portfolio");
    exit(0);
}
?>
<?php
$link = "dashboard.php?action=edit_image";
include_once "view_functions.php";
$id = $_GET['id'];
$element = getElement($id, $obj);
?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
</head>
<div class="landing-page">
    <h2 class="main-header">Works Portfolio</h2>
</div>
<div class="app_container_">
    <h1 class="fs-5 mb-5 mt-4 br heading_text">Informations sur l'image : </h1>
    <div class="form-container">
        <form action="Models/update_pics.php?id=<?= $id ?>" class="my_form" method="POST" enctype="multipart/form-data">
            <div class="row br-top py-4 br-bott ">
                <div class="col-4">
                    <label for="title">Nouveau Titre<span>*</span> :</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="title" id="title" value="<?= $element['title'] ?>" maxlength="50" required>
                </div>
            </div>
            <div class="row py-4 br-bott ">
                <div class="col-4">
                    <label for="description">Nouvelle description :</label>
                </div>
                <div class="col-8">
                    <textarea class="form-control" name="description" id="description" cols="30" rows="6" maxlength="250"><?= $element['description'] ?></textarea>
                </div>
            </div>
            <div class="row py-4 br-bott">
                <div class="col-4">
                    <label for="service_id">Changer le service<span>*</span> :</label>
                </div>
                <div class="col-8">
                    <select name="service_id" class="form-select form-control" id="select-services" required>
                        <?php
                        print_available_options($obj);
                        ?>
                    </select>
                    <?= $num==0?"<span style='color:red;'><i class='bi bi-exclamation-circle'></i>Pas de Services Disponibles !</span>":'';?>
                </div>

            </div>
            <div class="row py-4 br-bott">
                <div class="col-4">
                    <label for="my_image">changer l'image : </label>
                </div>
                <div class="col-8">
                    <input type="file" class="form-control" name="my_image" accept="image/jpeg, image/jpg, image/png" value="my_image" id="my_image">
                </div>
            </div>
            <div class="row py-4 br-bott">
                <div class="col-12">
                    <input type="submit" id="submit" name="submit" class="btn btn-primary submit" value="Update Image">
                </div>
            </div>

        </form>

    </div>
</div>

<script src="js/edit_image_script.js"></script>
<?php include_once 'views/floating_message.php' ?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>