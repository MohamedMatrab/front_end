<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>log in</title>
</head>
<link rel="stylesheet" href="style/style-login.css" >
<link rel="stylesheet" href="style/bootstrap.min.css" >
<link rel="stylesheet" href="style/bootstrap.min.css" >

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<div class= "row justify-content-center">
  <div class="col-md-5">
    <?php include 'message.php'; ?>
    
</div>
</div>
<div class="container log">
    <div class="titling">
      <h1 style="color: #0f4883">
        Dent<span style="color: #65d8ea">All</span>
      </h1>
      <h1 style="font-size: 1.7rem">Rejoignez-nous</h1>
    </div>
    <form action="index2.php" method="post" class="form-login">
      <div class="mb-3 mt-3">
        <!-- <label for="email" class="form-label">Email :</label> -->
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required />
      </div>
      <div class="mb-3">
        <!-- <label for="pswd" class="form-label">Password :</label> -->
        <input type="password" id="pswd" class="form-control" name="password" placeholder="Enter Password" />
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
        Don't have account ?<a href="sign_up.php"> sign up</a>
      </div>
    </form>
  </div>
<script src="js/all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>