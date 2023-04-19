<?php

   $title = "Dentiste:Appointment Page" ;
   ob_start();
?>


  
  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Bootstrap Datepicker CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <div class="landing-page">
    <h2 class="main-header">Rendez-vous</h2>
  </div>
   
  <div class="container pt-5 pb-5">
    <div class="desp">
      <h3 class="fs-5">Formulaire de prise de rendez vous :</h3>
      <p class="mb-0">Veuillez compléter attentivement les données ci-après.</p>
      <p><span>*</span> Veuillez noter que toutes les données du formulaire sont obligatoires.</p>
    </div>
    <h3 class="fs-5 mb-5 br">Informations personnelles : </h3>

    <form class="g-3" method="post" action="index.php?action=RDV">
      <div class="row br-top py-4 br-bott">
        <div class="col-4" ><label for="inputLastName" class="form-label">Prénom <span>*</span></label></div>
        <div class="col-8"><input type="text" class="form-control" id="inputLastName" required placeholder="Prénom" name="Prénom"></div>
      </div>

      <div class="row  py-4 br-bott">
        <div class="col-4"><label for="inputFirstName" class="form-label">Nom <span>*</span></label></div>
        <div class="col-8"><input type="text" class="form-control" id="inputFirstName" required placeholder="Nom" name="Nom"></div>
      </div>

      <div class="row  py-4 br-bott">
        <div class="col-4"><label for="inputCin" class="form-label">CIN (Carte d'identité nationale) <span>*</span></label></div>
        <div class="col-8"><input type="text" class="form-control" id="inputCin" required placeholder="CIN (Carte d'identité nationale)" name="CIN"></div>
      </div>

      <div class="row  py-4 br-bott">
        <div class="col-4"><label for="inputSexe" class="form-label">Sexe <span>*</span></label></div>
        <div class="col-8">
          <select class="form-select" aria-label="Default select example" name="Sexe">
            <option value="1">--please choose an option--</option>
            <option value="2">Homme</option>
            <option value="3">Femme</option>
          </select>
        </div>
      </div>

      <div class="row py-4 br-bott">
        <div class="col-4"><label for="inputDateOfbirth" class="form-label">Date Naissance <span>*</span></label></div>
        <div class="col-8"><input type="date" class="form-control" id="inputDateOfbirth" required name="Date Naissance"></div>
      </div>

      <div class="row  py-4 br-bott">
        <div class="col-4"><label for="inputCity" class="form-label">Ville <span>*</span></label></div>
        <div class="col-8"><input type="text" class="form-control" id="inputCity" required placeholder="Ville" name="Ville"></div>
      </div>

      <div class="row py-4 br-bott">
        <div class="col-4"><label for="inputAddress" class="form-label">Adresse</label></div>
        <div class="col-8"><input type="text" class="form-control" id="inputAddress" placeholder="Adresse" name="Adresse"></div>
      </div>

      <div class="row py-4 br-bott">
        <div class="col-4"><label for="inputNumero" class="form-label">Numéro <span>*</span></label></div>
        <div class="col-8"><input type="tel" class="form-control" id="inputNumber" required placeholder="tél" name="tél"></div>
      </div>

      <div class="row py-4 br-bott">
        <div class="col-4"><label for="floatingTextarea" class="form-label">Message</label></div>
        <div class="form-floating col-8">
          <textarea class="form-control" placeholder="Leave a message here" id="floatingTextarea"></textarea>
        </div>
      </div>

      <div class="row  py-4 br-bott">
        <div class="col-4"><label for="inputServive" class="form-label">Services <span>*</span></label></div>
        <div class="col-8">
          <select class="form-select" aria-label="Default select example" name="id_medecin" autocomplete="off">
            <option value="1">--please choose a service--</option>
            <option value="2">esthétique dentaire</option>
            <option value="3">hollywood smile</option>
          </select>
        </div>
      </div>

      <div class="row hours py-4 br-bott date">
        <div class="col-4"><label for="from" class="form-label">Rendez-vous<span>*</span></label></div>
        <div class="col-4">
          <div class="form-group">
            <input type="text" class="form-control datepicker" placeholder="Date" name="date_rendez" autocomplete="off">
          </div>
        </div>
        <div class="col-4 error_hour">
          <div class="form-group">
            <select class="form-select" 
                    aria-label="Default select example"
                    name="Heure_rendez" id="form-select-hour" autocomplete="off"> 
            </select>
          </div>
          
        </div>
      </div>

      <div class="col-12 py-4 mb-5 ">
        <button type="submit" class="btn btn-primary px-3 py-2 fs-5" data = "valider" name="valider">Valider</button>
      </div>
    </form>
    <div class="modification">
      <h3 class="fs-5">Modification de Rendez-vous :</h3>
      <p>Si vous êtes dans l’impossibilité d’être présent à un rendez-vous,
        nous vous demandons de nous prévenir au minimum 24h avant celui-ci,
        ceci nous permettra de faire bénéficier de votre plage horaire
        à un autre patient en attente de soins.</p>
    </div>
    <div class="urgence">
      <h3 class="fs-5" style="color : red  ;">En cas d’urgence :</h3>
      <p>En cas d’urgence, et en dehors des horaires de permanence contactez
        le Dr. Bellemlih au 0661 145 362, nous ferons l’impossible
        pour vous recevoir dans les meilleurs délais.</p>
    </div>
  </div>
  
    
  




  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Bootstrap 4 JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap Datepicker JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  
  <script src="js/main.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 

    