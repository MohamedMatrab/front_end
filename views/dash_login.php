<?php
session_start();
include_once "Models/verify_permissions.php";
if (isset($_SESSION['USER']) && $_SESSION['USER']['role'] != 0) {
    header("Location: dashboard.php");
    exit(0);
}
include_once "Models/connect.php";
$obj = new connect();
$obj->usersTable();
?>

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
    <?php include_once 'views/p_message.php' ?>
    <div class="container" style=" height: 30rem;">
        <div class="titling">
            <h1 style="color: #0f4883">
                Dent<span style="color: #65d8ea">All</span>
            </h1>
            <h1 style="font-size: 1.7rem">Dashboard</h1>
        </div>
        <form action="Models/dash_login_action.php" method="post" class="form-login">
            <div class="mb-3 mt-3">
                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required />
            </div>
            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required />
            </div>
            <button type="submit" value="login" name="dash_login" class="btn btn-primary">
                Login
            </button>
        </form>
    </div>
</body>

<script src="js/bootstrap.min.js"></script>

</html>