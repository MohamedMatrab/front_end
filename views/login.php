<?php
session_start();
if (isset($_SESSION['USER']) && $_SESSION['USER']['role'] != 0) {
  header("Location: index.php");
  exit(0);
}
include_once "Models/connect.php";
$obj = new connect();
$obj->usersTable();
?>
<html lang="en">

<head>
  <title>Login</title>
  <link rel="stylesheet" href="style/bootstrap.min.css" />
  <link rel="stylesheet" href="style/style-login.css" />
</head>

<body>
  <?php include_once 'views/p_message.php' ?>
  <div class="container">
    <div class="titling">
      <h1 style="color: #0f4883">
        Dent<span style="color: #65d8ea">All</span>
      </h1>
      <h1 style="font-size: 1.7rem">Bienvenue</h1>
    </div>
    <form action="Models/login_action.php" method="post" class="form-login">
      <div class="mb-3 mt-3">
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" name="email" required />
      </div>
      <div class="mb-3">
        <input type="password" name="password" id="pswd" class="form-control" placeholder="Enter Password" required />
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