<?php
session_start();
$title = "Add Image";
ob_start();
?>

<?php
$link = "dashboard.php?action=add_image";
include_once 'view_functions.php';
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
        <form action="Models/upload_portfolio_pics.php" class="my_form" method="POST" enctype="multipart/form-data">
            <div class="row br-top py-4 br-bott">
                <div class="col-4">
                    <label for="title">Titre<span>*</span></label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" name="title" id="title" maxlength="50" required>
                </div>
            </div>
            <div class="row py-4 br-bott ">
                <div class="col-4">
                    <label for="description">Description </label>
                </div>
                <div class="col-8">
                    <textarea class="form-control" name="description" id="description" cols="30" rows="4" maxlength="250"></textarea>
                </div>
            </div>
            <div class="row py-4 br-bott">
                <div class="col-4">
                    <label for="select-services">Selectionner un Service<span>*</span></label>
                </div>
                <div class="col-8">
                    <select name="service_id" class="form-select form-control" id="select-services" required>
                        <?php print_available_options($obj) ?>
                    </select>
                    <?= $num==0?"<span style='color:red;'><i class='bi bi-exclamation-circle'></i>Pas de Services Disponibles !</span>":'';?>
                </div>
            </div>
            <div class="row py-4 br-bott">
                <div class="col-4">
                    <label for="my_image">Selectionner une Image<span>*</span></label>
                </div>
                <div class="col-8">
                    <input type="file" class="form-control" name="my_image" accept="image/jpeg, image/jpg, image/png" value="my_image" id="my_image" required>
                </div>
            </div>
            <div class="row  py-4 br-bott">
                <div class="col-12">
                    <input type="submit" id="submit" name="submit" class="btn btn-primary submit" value="Ajouter l'image">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="js/add_image_script.js"></script>
<?php include_once 'views/floating_message.php' ?>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>