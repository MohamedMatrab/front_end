<?php
session_start();
require_once 'connect.php';
$obj = new connect();
$link = "../index.php";
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = $obj->getConnect()->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
    $login_query->bindValue(':email', $email);
    $success = $login_query->execute();
    if (!$success) {
        $_SESSION['message'] = "Problem when getting User's Data !";
        header("Location: $link?action=login");
        exit(0);
    }
    $row = $login_query->fetch(PDO::FETCH_ASSOC);
    $db_password = $row['password'];
    $count = $login_query->rowCount();

    if ($count > 0 && password_verify($password, $db_password)) {

        $_SESSION['USER']['id'] = $row['id'];
        $_SESSION['USER']['role'] = $row['role'];
        $_SESSION['message'] = "Connected Successfully !";
        header("location: $link");
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid Email or Password !";
        header("location: $link?action=login");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Not allowed to acces this page!";
    header("location: $link");
    exit(0);
}
