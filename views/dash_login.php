<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style/style-login.css" />
</head>

<body>
    <div class="container" style=" height: 30rem;">
        <div class="titling">
            <h1 style="color: #0f4883" id="dentall">
                Dent<span style="color: #65d8ea">All</span>
            </h1>
            <h1 style="font-size: 1.7rem">Dashboard</h1>
        </div>
        <form action="Models/dash_login_action.php" method="post" class="form-login">
            <div class="field-input mt-3">
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required />
                <label for="email" class="form-label" id="email_validate"></label>
            </div>
            <div class="field-input">
                <input type="password" name="password" id="pswd" class="form-control" placeholder="Mot de Passe" required />
                <label for="pswd" class="form-label" id="password_strength"></label>
            </div>
            <button type="submit" value="login" id="connect" name="dash_login" class="btn btn-primary">
                Se Connecter
            </button>
        </form>
    </div>
</body>
<?php include_once 'views/floating_message.php' ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/script-login.js"></script>

</html>