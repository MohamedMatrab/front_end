<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$title = "Dentiste:Appointment Page";
ob_start();
?>
<?php
if (!isset($_SESSION['USER'])) {
  $_SESSION['message'] = "Vous devez être connecté pour accéder à cette page !";
  header('Location: index.php');
  exit(0);
} elseif ($_SESSION['USER']['role'] != 0) {
  $_SESSION['message'] = "Gérer votre compte dans le tableau de bord !";
  header('Location: dashboard.php?action=account');
  exit(0);
}
?>
<?php include_once 'Models/get_user_info.php' ?>
<div class="landing-page">
  <h2 class="main-header">Dentall Compte</h2>
</div>
<div class="container pt-5 pb-5" id="account">
  <div class="desp" style="border:none;display:flex;flex-direction:row;align-items:center;justify-content:start;">
    <img src="<?= is_null($user['img']) ? "images/user_image.png" : 'data:image/jpg;base64,' . base64_encode($user['img']); ?>" alt="profile" style="width:6rem; height:6rem;border-radius:50%" />
    <p style="font-size:1.3rem;margin:0;margin-left:1rem;"><?= $user['fname'] . " " . $user['lname'] ?></p>
  </div>
  <h3 class="fs-5 mb-5 br">Informations personnelles : </h3>
  <form action="Models/update_patient_data.php" class="g-3" method="post" id="account_info" enctype="multipart/form-data">
    <div class="row br-top py-4 br-bott">
      <div class="col-4"><label for="first-name" class="form-label">Prénom <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" data-state="0" id="first-name" required placeholder="Prénom" data="Prénom" name="first-name" value="<?= $user['fname'] ?>"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="last-name" class="form-label">Nom <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" data-state="0" id="last-name" required placeholder="Nom" data="Nom" name="last-name" value="<?= $user['lname'] ?>"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputEmail" class="form-label">Email <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" data-state="0" id="inputEmail" required placeholder="Email" data="Email" name="email_patient" value="<?= $user['email'] ?>"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputNumber" class="form-label">Numéro <span>*</span></label></div>
      <div class="col-8"><input type="tel" class="form-control" data-state="0" id="inputNumber" required placeholder="tél" data="tél" name="tel_patient" value="<?= $user['phone_num'] ?>"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="user_cin" class="form-label">CIN (Carte d'identité nationale)</label></div>
      <div class="col-8"><input type="text" class="form-control" id="user_cin" placeholder="CIN (Carte d'identité nationale)" data="CIN (Carte d'identité nationale)" name="CIN" value="<?= is_null($user['cin']) ? '' : $user['cin']; ?>"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputSexe" class="form-label">Sexe</label></div>
      <div class="col-8">
        <select class="form-select" id="inputSexe" aria-label="Default select example" name="Sexe">
          <option value="" <?= is_null($user['sexe']) ? 'selected' : ''; ?>></option>
          <option value="1" <?= !is_null($user['sexe']) && $user['sexe'] == 1 ? 'selected' : ''; ?>>Homme</option>
          <option value="2" <?= !is_null($user['sexe']) && $user['sexe'] == 2 ? 'selected' : ''; ?>>Femme</option>
        </select>
      </div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputDateOfbirth" class="form-label">Date Naissance</label></div>
      <div class="col-8"><input type="date" class="form-control" id="inputDateOfbirth" name="DateNaissance" value="<?= is_null($user['date_naissance']) ? '' : $user['date_naissance']; ?>"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputCity" class="form-label">Ville</label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputCity" placeholder="Ville" data="Ville" name="Ville" value="<?= is_null($user['ville']) ? '' : $user['ville']; ?>"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputAddress" class="form-label">Adresse</label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputAddress" placeholder="Adresse" data="Adresse" name="address" value="<?= is_null($user['adresse']) ? '' : $user['adresse']; ?>"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="profile_img" class="form-label">Changer l'image De Profile</label></div>
      <div class="col-8"><input type="file" class="form-control" id="profile_img" data="profile_img" name="profile_img"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="patient_password" class="form-label">Mot de passe</label></div>
      <div class="col-8"><input type="password" class="form-control" id="patient_password" data="patient_password" placeholder="Laissez vide si vous ne souhaitez pas le modifier." name="patient_password"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="patient_pswd_confirm" class="form-label">Confirmer le mot de passe</label></div>
      <div class="col-8"><input type="password" class="form-control" id="patient_pswd_confirm" data="patient_pswd_confirm" placeholder="Laissez vide si vous ne souhaitez pas le modifier." name="patient_pswd_confirm"></div>
    </div>

    <div class="col-12 py-4 mb-5 ">
      <button type="submit" class="btn btn-primary px-3 py-2 fs-5" data="valider" id="valider" name="valider">Valider Mes Données</button>
    </div>
  </form>
  <!-- <div class="urgence">
    <h3 class="fs-5" style="color : red ;">Demande d'accés au Tableau de Bord :</h3>
    <p>Si vous faites partie de notre groupe Dentall et vous souhaitez accéder à notre tableau de bord en ligne , veuillez remplir le <a href="index.php?action=request" style="text-decoration:underline;color:cadetblue;">Formulaire de Demande </a>.<br>Et Nous Allons traiter votre demande et vous donner l'accés.</p>
  </div> -->
</div>
<script src="js/account_patient_script.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>