<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="style/bootstrap.min.css" />
  <link rel="stylesheet" href="style/style-signup.css" />
</head>

<body>
  <div class="container">
    <div class="titling">
    <h1 style="color: #0f4883">
        Dent<span style="color: #65d8ea">All</span>
      </h1>
      <h1 style="font-size: 1.7rem">Rejoignez nous</h1>
    </div>
    <form action="" method="post" class="form-login">
      <div class="form-group mb-3">
        <input type="text" class="form-control" id="first-name" placeholder="First Name" name="first-name" required/>
        <input type="text" class="form-control" id="last-name" placeholder="Last Name" name="last-name" required/>
      </div>
      <div class="mb-3">
        <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone" required/>
      </div>
      <div class="mb-3">
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required/>
      </div>
      <div class="mb-3">
        <input type="password" id="pswd" class="form-control" placeholder="Enter Password" required/>
        <label for="pswd" class="form-label" id="password_strength"></label>
      </div>
      <div class="mb-3">
        <input type="password" id="pswd-confirm" class="form-control" placeholder="Confirm Password" required/>
        <label for="pswd" class="form-label" id="password_similar"></label>
      </div>
      <div class="agreement mb-3 mt-3">
        <label for="accept agreements" class="form-check-label" id="accept-agreement">
          <input type="checkbox" checked="cheched" class="form-check-input" required/>
          <p class="terms-conditions">
            J'accepte Les <a href="#">Termes et Conditions</a>
          </p>
        </label>
      </div>
      <button type="submit" value="login" name="login" class="btn btn-primary">
        Sign Up
      </button>
      <div class="signin">Already have account ?<a href="index.php?action=login"> Sign In</a></div>
    </form>
  </div>
</body>

<script src="js/bootstrap.min.js"></script>
<script src="js/script-signup.js"></script>

</html>