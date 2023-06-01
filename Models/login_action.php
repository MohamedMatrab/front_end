<?php
session_start();
require_once 'connect.php';
include_once 'validation_functions.php';
$obj = new connect();
$link = "../index.php?action=login";
if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {

    $email = validateEmail($_POST['email']);
    $password = $_POST['password'];

    $login_query = $obj->getConnect()->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
    $login_query->bindValue(':email', $email);
    $success = $login_query->execute();
    if (!$success) {
        $_SESSION['message'] = "Problème lors de l'obtention des données de l'utilisateur !";
        header("Location: $link");
        exit(0);
    }
    $row = $login_query->fetch(PDO::FETCH_ASSOC);
    $db_password = $row['password'];
    $count = $login_query->rowCount();

    if ($count > 0 && password_verify($password, $db_password)) {

        $_SESSION['USER']['id'] = $row['id'];
        $_SESSION['USER']['role'] = $row['role'];
        if ($row['role'] == 0) {
            $_SESSION['message'] = "Connecté avec succès !";
            header("location: ../index.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Connecté avec succès !";
            header("location: ../dashboard.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Email ou mot de passe invalide !";
        header("location: $link");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Vous ne pouvez pas accéder à cette page !";
    header("location: ../index.php");
    exit(0);
}
