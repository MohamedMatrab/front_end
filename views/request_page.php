<?php
session_start();
$title = "Dentiste:Appointment Page";
ob_start();
?>
<?php
if (!isset($_SESSION['USER'])) {
    $_SESSION['message'] = "Vous devez être connecté pour accéder à cette page !";
    if ($_SESSION['USER']['role'] != 0) {
        $_SESSION['message'] = "Vous avez déjà l'accès au tableau de bord !";
    }
    header('Location: index.php');
    exit(0);
}
?>
<?php include_once 'Models/get_user_info.php' ?>
<div class="landing-page">
    <h2 class="main-header">Demande d'accès</h2>
</div>
<div class="container pt-5 pb-5" id="account">
    <h3 class="fs-5 mb-5 br">Informations de la demande: </h3>
    <form action="Models/upload_request.php" class="g-3" method="post" id="account_info" enctype="multipart/form-data">
        <div class="row br-top py-4 br-bott">
            <div class="col-4"><label for="first-name" class="form-label">Prénom <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="first-name" required placeholder="Prénom" data="Prénom" name="first-name" value="<?= $user['fname'] ?>"></div>
        </div>

        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="last-name" class="form-label">Nom <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="last-name" required placeholder="Nom" data="Nom" name="last-name" value="<?= $user['lname'] ?>"></div>
        </div>

        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="inputEmail" class="form-label">Email <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="inputEmail" required placeholder="Email" data="Email" name="email_patient" value="<?= $user['email'] ?>"></div>
        </div>

        <div class="row py-4 br-bott">
            <div class="col-4"><label for="inputNumber" class="form-label">Numéro <span>*</span></label></div>
            <div class="col-8"><input type="tel" class="form-control" id="inputNumber" required placeholder="tél" data="tél" name="tel_patient" value="<?= $user['phone_num'] ?>"></div>
        </div>

        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="inputCin" class="form-label">CIN (Carte d'identité nationale) <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="inputCin" placeholder="CIN (Carte d'identité nationale)" data="CIN (Carte d'identité nationale)" name="CIN" value="<?= is_null($user['cin']) ? '' : $user['cin']; ?>"></div>
        </div>

        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="inputSexe" class="form-label">Sexe <span>*</span></label></div>
            <div class="col-8">
                <select class="form-select" id="inputSexe" aria-label="Default select example" name="Sexe">
                    <option value="" <?= is_null($user['sexe']) ? 'selected' : ''; ?>></option>
                    <option value="1" <?= !is_null($user['sexe']) && $user['sexe'] == 1 ? 'selected' : ''; ?>>Homme</option>
                    <option value="2" <?= !is_null($user['sexe']) && $user['sexe'] == 2 ? 'selected' : ''; ?>>Femme</option>
                </select>
            </div>
        </div>

        <div class="row py-4 br-bott">
            <div class="col-4"><label for="inputDateOfbirth" class="form-label">Date Naissance <span>*</span></label></div>
            <div class="col-8"><input type="date" class="form-control" id="inputDateOfbirth" name="DateNaissance" value="<?= is_null($user['date_naissance']) ? '' : $user['date_naissance']; ?>"></div>
        </div>

        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="inputCity" class="form-label">Ville <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="inputCity" placeholder="Ville" data="Ville" name="Ville" value="<?= is_null($user['ville']) ? '' : $user['ville']; ?>"></div>
        </div>

        <div class="row py-4 br-bott">
            <div class="col-4"><label for="inputAddress" class="form-label">Adresse <span>*</span></label></div>
            <div class="col-8"><input type="text" class="form-control" id="inputAddress" placeholder="Adresse" data="Adresse" name="address" value="<?= is_null($user['adresse']) ? '' : $user['adresse']; ?>"></div>
        </div>

        <div class="row py-4 br-bott">
            <div class="col-4"><label for="profile_img" class="form-label">Changer l'image De Profile <span>*</span></label></div>
            <div class="col-8"><input type="file" class="form-control" id="profile_img" data="profile_img" name="profile_img"></div>
        </div>
        
        <div class="row  py-4 br-bott">
            <div class="col-4"><label for="inputTypeRequest" class="form-label">Type d'accès <span>*</span></label></div>
            <div class="col-8">
                <select class="form-select" id="inputTypeRequest" aria-label="Default select example" name="type_request">
                    <option value="">Selectionner</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Secretaire</option>
                </select>
            </div>
        </div>

        <div class="col-12 py-4 mb-5 ">
            <button type="submit" class="btn btn-primary px-3 py-2 fs-5" data="valider" id="valider" name="valider">Envoyer</button>
        </div>
    </form>
    <div class="urgence">
        <h3 class="fs-5" style="color : red ;">Note :</h3>
        <p>Noter qu'il faut remplir tous les champs obligatoires pour que votre demande soit prise en compte. Nous Allons traiter votre demande.</p>
    </div>
</div>
<script src="js/request_access.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>