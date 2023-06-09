<?php
session_start();
$title = "Add Information about center";
ob_start();
?>
<?php
include_once "Models/connect.php";
$obj = new connect();
$obj->centreTable();
$sql = "SELECT * FROM centre;";
$stmt = $obj->getConnect()->prepare($sql);
$stmt->execute();
$centre = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
</head>
<?php include_once 'views/p_message.php' ?>

<div class="form-container container">
    <form action="Models/add_centre.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="description">Description : <span>*</span> :</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="6"  ><?php echo (isset($centre['description']) ? $centre['description'] : " " ); ?></textarea>
        </div>
        <div class="mb-3 ">
            <label for="description">Motivation : <span>*</span></label>
            <textarea class="form-control" name="motivation" id="description" cols="30" rows="6" ><?php echo (isset($centre['motivation']) ? $centre['motivation'] : " " ); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="localisation">localisation : <span>*</span></label>
            <input type="text" class="form-control" name="localisation" id="localisation" value="<?php echo (isset($centre['localisation']) ? $centre['localisation'] : " " ); ?>" required >
        </div>
        <div class="mb-3">
            <label for="address">address : <span>*</span></label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo (isset($centre['address']) ? $centre['address'] : " " ); ?>" required >
        </div>
        <div class="mb-3">
            <label for="numéro_1">numéro de téléphone : <span>*</span></label>
            <input type="text" class="form-control" name="numero_1" id="numero_1"  value="<?php echo (isset($centre['numero_1']) ? $centre['numero_1'] : " " ); ?>" required >
        </div>
        <div class="mb-3">
            <label for="numéro_2">numéro de téléphone en cas d'urgence : <span>*</span></label>
            <input type="text" class="form-control" name="numero_2" id="numero_2" value="<?php echo (isset($centre['numero_2']) ? $centre['numero_2'] : " " ); ?>" required >
        </div>
        <div class="mb-3">
            <label for="mail">adresse e-mail : <span>*</span></label>
            <input type="text" class="form-control" name="mail" id="mail" value="<?php echo (isset($centre['email']) ? $centre['email'] : " " );; ?>" required >
        </div>
        <div class="mb-3">
            <label for="facebook">lien Facebook  : </label>
            <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo (isset($centre['facebook']) ? $centre['facebook'] : " " );; ?>" >
        </div>
        <div class="mb-3">
            <label for="instagram">lien Instagram  : </label>
            <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo (isset($centre['instagram']) ? $centre['instagram'] : " " );; ?>" >
        </div>
        <div class="mb-3">
            <label for="twitter">lien Twitter  : </label>
            <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo (isset($centre['twitter']) ? $centre['twitter'] : " " );; ?>" >
        </div>
        <?php if(!(isset($centre['description']))){  ?> 
            <div class="mb-3">
                <label for="my_image">Select Image<span>*</span> : </label>
                <input type="file" class="form-control" name="my_image" value="my_image" id="my_image" required>
            </div>
        <?php } ?>
        
        <div class="mt-3">
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="<?php echo isset($centre['description'])? "Edit Information" : "Add Information" ; ?>">
        </div>

    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>