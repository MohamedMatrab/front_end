<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "connect.php";
    include_once 'validation_functions.php';
    $obj = new connect();
    $obj->usersTable();
    $obj->reAutoIncrement('users');

    $link = '../index.php?action=request';
    $sessCdt = isset($_SESSION['USER']);
    $dataCdt =  isset($_POST['valider'])
        && $sessCdt
        && isset($_POST['first-name'])
        && isset($_POST['last-name'])
        && isset($_POST['email_patient'])
        && isset($_POST['tel_patient'])
        && isset($_POST['CIN'])
        && isset($_POST['Sexe'])
        && isset($_POST['DateNaissance'])
        && isset($_POST['Ville'])
        && isset($_POST['address'])
        && isset($_POST['type_request'])
        && isset($_FILES['profile_img'])
        && !empty($_FILES['profile_img']['name']);

    $id = $_SESSION['USER']['id'];
    include_once 'get_user_info.php';

    if ($dataCdt) {

        $name = $_FILES['profile_img']['name'];
        $tmp_name = $_FILES['profile_img']['tmp_name'];
        $type = $_FILES['profile_img']['type'];
        $size = $_FILES['profile_img']['size'];
        $error = $_FILES['profile_img']['error'];
        $exctention = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed_exs = array('jpeg', 'jpg', 'png');

        $first_name = validate($_POST['first-name']);
        $last_name = validate($_POST['last-name']);
        $email_patient = validateEmail($_POST['email_patient']);
        $tel_patient = valiatePhoneNum($_POST['tel_patient']);
        $CIN = validateCIN(validate($_POST['CIN']));
        $Sexe = (validate($_POST['Sexe']));
        $DateNaissance = validate($_POST['DateNaissance']);
        $Ville = validate($_POST['Ville']);
        $address = validate($_POST['address']);
        $type_request = validateId($_POST['type_request']);

        if (!in_array($exctention, $allowed_exs)) {
            $_SESSION['message'] = "Ce format n'est pas autorisé, fournissez une image.";
            header("Location: $link");
            exit(0);
        } elseif ($size >  4 * 1024 * 1024) {
            $_SESSION['message'] = "L'image est trop volumineux, taille maximale 4 Mo.";
            header("Location: $link");
            exit(0);
        }



        occurence_email($email_patient, $user['email']);
        occurence_phone_num($tel_patient, $user['phone_num']);

        $imageData = file_get_contents($tmp_name);

        $query = "UPDATE users SET img=:img,
        fname=:fname,
        lname=:lname,
        email=:email,
        phone_num=:phone_num,
        cin=:cin,
        ville=:ville,
        adresse=:adresse,
        date_naissance=:date_naissance,
        sexe=:sexe,
        request_type=:request_type,
        request=1 
        WHERE id=:id";

        $stmt = $obj->getConnect()->prepare($query);
        $stmt->bindValue(':img', $imageData, PDO::PARAM_LOB);

        $stmt->bindValue(':fname', $first_name);
        $stmt->bindValue(':lname', $last_name);
        $stmt->bindValue(':email', $email_patient);
        $stmt->bindValue(':phone_num', $tel_patient);
        $stmt->bindValue(':cin', $CIN);
        $stmt->bindValue(':ville', $Ville);
        $stmt->bindValue(':adresse', $address);
        $stmt->bindValue(':date_naissance', $DateNaissance);
        $stmt->bindValue(':sexe', $Sexe);
        $stmt->bindValue(':request_type', $type_request);
        $stmt->bindValue(':id', $id);

        $success = $stmt->execute();

        if ($success) {
            $_SESSION['message'] = "Demande envoyèe avec succès ! \nVotre compte aura l'accès si les donnèes sont valides !";
            header("Location: $link");
            exit(0);
        }
    }
}
