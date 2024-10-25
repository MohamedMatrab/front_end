<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$title = "Dentiste:Appointment Page";
include_once "Models/connect.php";
$conn = new connect();
$conn->rendezVousTable();
$conn->reAutoIncrement('rendez_vous');
if (!isset($_SESSION['USER'])) {
  $_SESSION['message'] = "Vous devez créer un compte tout d'abord pour prendre un rendez-vous";
  header("Location: index.php?action=login");
  exit(0);
}

$title = "Dentiste:Appointment Page";
ob_start();

?>



<!-- Bootstrap 4 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<div class="landing-page">
  <h2 class="main-header">Rendez-vous</h2>
</div>
<?php include_once 'views/p_message.php' ?>
<div class="container pt-5 pb-5" id="appointment">
  <div class="desp">
    <h3 class="fs-5">Formulaire de prise de rendez vous :</h3>
    <p class="mb-0">Veuillez compléter attentivement les données ci-après.</p>
    <p><span>*</span> Veuillez noter que toutes les données du formulaire sont obligatoires.</p>
  </div>
  <h3 class="fs-5 mb-5 br">Informations personnelles : </h3>
  <div class="g-3" method="post" id="formulaire">
    <div class="row br-top py-4 br-bott">
      <div class="col-4"><label for="inputLastName" class="form-label">Prénom <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputLastName" required placeholder="Prénom" data="Prénom" name="Prenom"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputFirstName" class="form-label">Nom <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputFirstName" required placeholder="Nom" data="Nom" name="Nom"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputCin" class="form-label">CIN (Carte d'identité nationale) <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputCin" required placeholder="CIN (Carte d'identité nationale)" data="CIN (Carte d'identité nationale)" data_id="<?= $_SESSION['USER']['id'] ?>" name="CIN"></div>
    </div>
    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputSexe" class="form-label">Sexe <span>*</span></label></div>
      <div class="col-8">
        <select class="form-select" aria-label="Default select example" name="Sexe" required>
          <option value="1"></option>
          <option value="2">Homme</option>
          <option value="3">Femme</option>
        </select>
      </div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputDateOfbirth" class="form-label">Date Naissance <span>*</span></label></div>
      <div class="col-8"><input type="date" class="form-control" id="inputDateOfbirth" required name="DateNaissance"></div>
    </div>

    <div class="row  py-4 br-bott">
      <div class="col-4"><label for="inputCity" class="form-label">Ville <span>*</span></label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputCity" required placeholder="Ville" data="Ville" name="Ville"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputAddress" class="form-label">Adresse</label></div>
      <div class="col-8"><input type="text" class="form-control" id="inputAddress" placeholder="Adresse" data="Adresse" name="address"></div>
    </div>

    <div class="row py-4 br-bott">
      <div class="col-4"><label for="inputNumero" class="form-label">Numéro <span>*</span></label></div>
      <div class="col-8"><input type="tel" class="form-control" id="inputNumber" required placeholder="tél" data="tél" name="tel"></div>
    </div>

    <!-- <div class="row py-4 br-bott">
        <div class="col-4"><label for="floatingTextarea" class="form-label">Message</label></div>
        <div class="form-floating col-8">
          <textarea class="form-control" placeholder="Leave a message here" id="floatingTextarea"></textarea>
        </div>
      </div> -->

    <div class="row  py-4 br-bott all-Services">
      <div class="col-4"><label for="inputService" class="form-label">Services <span>*</span></label></div>
      <div class="col-8 inactive " style="position: relative ;">
        <input type="text" class="form-select" name="services" required autocomplete="off" id="inputService">
      </div>
    </div>

    <div class="row hours py-4 br-bott date">
      <div class="col-4"><label for="from" class="form-label">Rendez-vous<span>*</span></label></div>
      <div class="col-4">
        <div class="form-group">
          <input type="text" class="form-control datepicker" placeholder="select a date" data="Date" name="date_rendez" required autocomplete="off" id="datepicker">
        </div>
      </div>
      <div class="col-4 horaire">
        <div class="form-group">
          <input type="text" class="form-select timepicker" placeholder="select an hour" name="Heure_rendez" required id="form-select-hour" autocomplete="off" id="time">
        </div>

      </div>
    </div>

    <div class="col-12 py-4 mb-5 ">
      <button type="submit" class="btn btn-primary px-3 py-2 fs-5" data="valider" name="valider">Valider</button>
    </div>
    </form>
    <div class="modification">
      <h3 class="fs-5">Modification de Rendez-vous :</h3>
      <p>Si vous êtes dans l’impossibilité d’être présent à un rendez-vous,
        nous vous demandons de nous prévenir au minimum 24h avant celui-ci,
        ceci nous permettra de faire bénéficier de votre plage horaire
        à un autre patient en attente de soins.</p>
    </div>
    
  </div>







  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Bootstrap 4 JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap Datepicker JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
  <script src="js/echec.js"></script>
  <script src="js/succes.js"></script>
  <script src="js/appointment.js"></script>
  <?php $content = ob_get_clean(); ?>
  <?php include_once 'views/layout.php'; ?>
