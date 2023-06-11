<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "connect.php";
    include_once 'validation_functions.php';
    $obj = new connect();
    $obj->usersTable();
    $obj->reAutoIncrement('users');

    $link = '../index.php?action=account';
    $sessCdt = isset($_SESSION['USER']);
    $dataCdt = isset($_POST['valider'])
        && $sessCdt
        && isset($_POST['first-name'])
        && isset($_POST['last-name'])
        && isset($_POST['email_patient'])
        && isset($_POST['tel_patient'])
        && isset($_POST['CIN'])
        && isset($_POST['Sexe'])
        && isset($_POST['DateNaissance'])
        && isset($_POST['Ville'])
        && isset($_POST['address']);
    $imgCdt = $sessCdt
        && isset($_FILES['profile_img'])
        && !empty($_FILES['profile_img']['name']);
    $pswdCdt = $sessCdt
        && isset($_POST['patient_password'])
        && isset($_POST['patient_pswd_confirm'])
        && $_POST['patient_password'] != ''
        && $_POST['patient_pswd_confirm'] != '';

    $id = $_SESSION['USER']['id'];
    include_once 'get_user_info.php';

    if ($dataCdt) {

        $first_name = validate($_POST['first-name']);
        $last_name = validate($_POST['last-name']);
        $email_patient = validateEmail($_POST['email_patient']);
        $tel_patient = valiatePhoneNum($_POST['tel_patient']);
        $CIN = validateCIN($_POST['CIN']);
        $Sexe = (validate($_POST['Sexe']));
        $DateNaissance = validate($_POST['DateNaissance']);
        $Ville = validate($_POST['Ville']);
        $address = validate($_POST['address']);

        occurence_email($email_patient, $user['email']);
        occurence_phone_num($tel_patient, $user['phone_num']);

        $query = "UPDATE users 
        SET fname=:fname ,
        lname=:lname ,
        email=:email ,
        phone_num=:phone_num ,
        cin=:cin ,
        ville=:ville ,
        adresse=:adresse ,
        date_naissance=:date_naissance ,
        sexe=:sexe 
        WHERE id=:id";

        $stmt_1 = $obj->getConnect()->prepare($query);
        $stmt_1->bindValue(':fname', $first_name);
        $stmt_1->bindValue(':lname', $last_name);
        $stmt_1->bindValue(':email', $email_patient);
        $stmt_1->bindValue(':phone_num', $tel_patient);
        $stmt_1->bindValue(':cin', $CIN);
        $stmt_1->bindValue(':ville', $Ville);
        $stmt_1->bindValue(':adresse', $address);
        $stmt_1->bindValue(':date_naissance', $DateNaissance);
        $stmt_1->bindValue(':sexe', $Sexe);
        $stmt_1->bindValue(':id', $id);

        $success_1 = $stmt_1->execute();

        if ($success_1 && !$imgCdt && !$pswdCdt) {
            $_SESSION['message'] = "Données Editées avec succès !";
            header("Location: $link");
            exit(0);
        }
    }
    if ($imgCdt) {
        $name = $_FILES['profile_img']['name'];
        $tmp_name = $_FILES['profile_img']['tmp_name'];
        $type = $_FILES['profile_img']['type'];
        $size = $_FILES['profile_img']['size'];
        $error = $_FILES['profile_img']['error'];
        $exctention = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed_exs = array('jpeg', 'jpg', 'png');

        if (!in_array($exctention, $allowed_exs)) {
            $_SESSION['message'] = "Ce format n'est pas autorisé, fournissez une image.";
            header("Location: $link");
            exit(0);
        } elseif ($size >  4 * 1024 * 1024) {
            $_SESSION['message'] = "L'image est trop volumineux, taille maximale 4 Mo.";
            header("Location: $link");
            exit(0);
        } else {
            $imageData = file_get_contents($tmp_name);

            $query_2 = "UPDATE users SET img=:img WHERE id=:id";
            $stmt_2 = $obj->getConnect()->prepare($query_2);
            $stmt_2->bindValue(':img', $imageData, PDO::PARAM_LOB);
            $stmt_2->bindValue(':id', $id);

            $success_2 = $stmt_2->execute();
            if ($success_2 && !$pswdCdt) {
                $_SESSION['message'] = "Données et image Editées avec succès !";
                header("Location: $link");
                exit(0);
            }
        }
    }
    if ($pswdCdt) {
        $password = validatePassword($_POST['patient_password']);
        $confirm_password = similarity($_POST['patient_pswd_confirm'], $password);
        $hached_password = password_hash($password, PASSWORD_BCRYPT);

        $query_3 = "UPDATE users SET password=:password WHERE id=:id";
        $stmt_3 = $obj->getConnect()->prepare($query_3);
        $stmt_3->bindValue(':password', $hached_password);
        $stmt_3->bindValue(':id', $id);

        $success_3 = $stmt_3->execute();
        if ($success_3) {
            $_SESSION['message'] = "Données et mot de passe Editées avec succès !";
            header("Location: $link");
            exit(0);
        }
    }
}
