<?php
session_start();
$link = '../index.php?action=signup';
include_once 'connect.php';
include_once 'validation_functions.php';
$obj = new connect();
$obj->usersTable();
$obj->reAutoIncrement('users');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['signup']) && isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $fname = validate($_POST['first-name']);
        $lname = validate($_POST['last-name']);
        $email = validateEmail($_POST['email']);
        $phone = valiatePhoneNum($_POST['phone']);
        $password = validatePassword($_POST['password']);
        $confirm_password = $_POST['confirm_password'];
        if (!isset($_POST['agreement'])) {
            $_SESSION['message'] = "Il faut accepter les termes et conditions pour s'inscrire !";
            header("location: $link");
            exit(0);
        }
        if ($password == $confirm_password) {
            //check email
            $check_email = $obj->getConnect()->prepare('SELECT * FROM users WHERE email = :email');
            $check_email->bindValue(':email', $email);
            $check_email->execute();

            $countE = $check_email->rowCount();

            if ($countE > 0) {
                $_SESSION['message'] = "L'email existe déjà !";
                header("location: $link");
                exit(0);
            }
            //check phone number
            $check_phone = $obj->getConnect()->prepare('SELECT * FROM users WHERE phone_num=:phone_num');
            $check_phone->bindValue(':phone_num', $phone);
            $check_phone->execute();

            $countPh = $check_phone->rowCount();

            if ($countPh > 0) {
                $_SESSION['message'] = "Le numéro de téléphone existe déjà !";
                header("location: $link");
                exit(0);
            }
            //if information not repeated 
            $hached_password = password_hash($password, PASSWORD_BCRYPT);
            $user_query = $obj->getConnect()->prepare("INSERT INTO users (fname, lname, email,phone_num,password,role) VALUES(:fname, :lname, :email,:phone_num, :password,:role)");
            $user_query->bindValue(':fname', $fname);
            $user_query->bindValue(':lname', $lname);
            $user_query->bindValue(':email', $email);
            $user_query->bindValue(':phone_num', $phone);
            $user_query->bindValue(':password', $hached_password);
            $user_query->bindValue(':role', '0');

            $user_query_run = $user_query->execute();

            if ($user_query_run) {
                $_SESSION['message'] = "Inscrit(e) Avec Succès !";
                header("location: ../index.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Erreur lors de l'inscription !";
                header("location: $link");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Les mots de passe fournis ne correspondent pas !";
            header("location: $link");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Donnees insuffisants !";
        header("location: $link");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Vous ne pouvez pas accéder à cette page !";
    header("location: $link");
    exit(0);
}
