<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="style/bootstrap.min.css" />
  <link rel="stylesheet" href="style/style-signup.css" />
  <link rel="stylesheet" href="assets/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
    <div class="titling">
      <h1 id="dentall" style="color: #0f4883">
        Dent<span style="color: #65d8ea">All</span>
      </h1>
      <h1 style="font-size: 1.7rem">Rejoignez nous</h1>
    </div>
    <form action="Models/signup_action.php" method="post" class="form-signup">
      <div class="form-group mb-3">
        <input type="text" class="form-control" id="first-name" placeholder="Prénom" name="first-name" required />
        <input type="text" class="form-control" id="last-name" placeholder="Nom" name="last-name" required />
      </div>
      <div class="mb-3">
        <input type="email" class="form-control" id="email" placeholder="Entrez l'email" name="email" required />
        <label for="email" class="form-label" id="email_validate"></label>
      </div>
      <div class="mb-3">
        <input type="tel" class="form-control" id="phone" placeholder="Entrez le numéro de téléphone" name="phone" required />
        <label for="phone" class="form-label" id="phone_validate"></label>
      </div>
      <div class="mb-3">
        <input type="password" id="pswd" name="password" class="form-control" placeholder="Entrer le mot de passe" required />
        <label for="pswd" class="form-label" id="password_strength"></label>
      </div>
      <div class="mb-3">
        <input type="password" id="pswd-confirm" name="confirm_password" class="form-control" placeholder="Confirmez le mot de passe" required />
        <label for="pswd-confirm" class="form-label" id="password_similar"></label>
      </div>
      <div class="agreement mb-3">
        <label for="agreement" class="form-check-label" id="accept-agreement">
          <input type="checkbox" id="agreement" class="form-check-input" name="agreement" required />
          <p class="terms-conditions">
            J'accepte Les <a href="#">Termes et Conditions</a>
          </p>
        </label>
      </div>
      <button type="submit" id="signup_btn" value="signup" name="signup" class="btn btn-primary">
        S'inscrire
      </button>
      <div class="signin">Vous avez déjà un compte ?<a href="index.php?action=login"> Se Connecter</a></div>
    </form>
  </div>
</body>
<?php include_once 'views/floating_message.php' ?>
<script src="js/bootstrap.min.js"></script>
<script src="js/script-signup.js"></script>

</html>