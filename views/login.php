<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style/bootstrap.min.css" />
  <link rel="stylesheet" href="style/style-login.css" />
</head>

<body>
  <div class="container">
    <div class="titling">
      <h1 style="color: #0f4883">
        Dent<span style="color: #65d8ea">All</span>
      </h1>
      <h1 style="font-size: 1.7rem">Rejoignez-nous</h1>
    </div>
    <form action="" method="post" class="form-login">
      <div class="mb-3 mt-3">
        <!-- <label for="email" class="form-label">Email :</label> -->
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" />
      </div>
      <div class="mb-3">
        <!-- <label for="pswd" class="form-label">Password :</label> -->
        <input type="password" id="pswd" class="form-control" placeholder="Enter Password" />
      </div>
      <div class="form-check mb-3">
        <label class="form-check-label">
          <div>
            <input class="form-check-input" type="checkbox" name="remember" />
            Remember me
          </div>
          <a href="#">Forgot Password ?</a>
        </label>
      </div>
      <button type="submit" value="login" name="login" class="btn btn-primary">
        Login
      </button>
      <div class="signup">
        Don't have account ?<a href="index.php?action=signup"> sign up</a>
      </div>
    </form>
  </div>
</body>

<script src="js/bootstrap.min.js"></script>

</html>