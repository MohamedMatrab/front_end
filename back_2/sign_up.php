<?php
session_start();
?>
<head>
    <title>Dentiste : Sing up</title>
</head>

<link rel="stylesheet" href="style/style-signup.css" >
<link rel="stylesheet" href="style/bootstrap.min.css" >
<link rel="stylesheet" href="style/bootstrap.min.css" >

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<div class= "row justify-content-center">
  <div class="col-md-5">
    <?php include 'message.php'; ?>
    
</div>
</div>
<div class="container sign-up">
  <div class="titling">
    <h1 class="color-h1">
      Dent<span class="color-span">All</span>
    </h1>
    <h1 class="fs-h1">Bienvenue</h1>
  </div>
  <form action="index.php" method="post" class="form-login">
    
    <div class="form-group">
      <input
        type="text"
        class="form-control"
        id="first-name"
        placeholder="First Name"
        name="first-name"
      />
      <input
        type="text"
        class="form-control"
        id="last-name"
        placeholder="Last Name"
        name="last-name"
      />
    </div>
    <div class="mb-3 mt-3">
      <!-- <label for="email" class="form-label">Email :</label> -->
      <input
        type="email"
        class="form-control"
        id="email"
        placeholder="Enter Email"
        name="email"
      />
    </div>
    <div class="mb-3">
      <input
        type="password"
        id="pswd"
        class="form-control"
        placeholder="Enter Password"
        name="password"
      />
      <label for="pswd" class="form-label" id="password_strength"></label>
    </div>
    <div class="mb-3">
      <input
        type="password"
        id="pswd-confirm"
        class="form-control"
        placeholder="Confirm Password"
        name="confirm_password"
      />
      <label for="pswd" class="form-label" id="password_similar"></label>
    </div>
    <div class="agreement">
      <label
        for="accept agreements"
        class="form-check-label"
        id="accept-agreement"
      >
        <input type="checkbox" checked="cheched" class="form-check-input" />
        <p class="terms-conditions">
          J'accepte Les <a href="">Termes et Conditions</a>
        </p>
      </label>
    </div>
    <button
      type="submit"
      value="login"
      name="login"
      class="btn btn-primary"
      name="login"
    >
      Sign Up 
    </button>
    <div class="signin">Already have account ?<a href="login.php"> Sign In</a></div>
  </form>
</div>
<script src="js/script-signup.js"></script>
<script src="js/all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>