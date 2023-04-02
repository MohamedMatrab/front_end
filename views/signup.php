<?php

   $title = "Dentiste:Centre Page" ;
   ob_start();
?>
<link rel="stylesheet" href="style/style-signup.css" >
<div class="container">
  <div class="titling">
    <h1 class="color-h1">
      Dent<span class="color-span">All</span>
    </h1>
    <h1 class="fs-h1">Bienvenue</h1>
  </div>
  <form action="" method="post" class="form-login">
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
      />
      <label for="pswd" class="form-label" id="password_strength"></label>
    </div>
    <div class="mb-3">
      <input
        type="password"
        id="pswd-confirm"
        class="form-control"
        placeholder="Confirm Password"
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
    >
      Sign Up
    </button>
    <div class="signin">Already have account ?<a href=""> Sign In</a></div>
  </form>
</div>
<script src="js/script-signup.js"></script>
<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 
