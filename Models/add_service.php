<?php
session_start();
include_once 'connect.php';
$obj = new connect();
$obj->serviceTable();
$obj->serviveDetailsTabele();
$link = '../dashboard.php?action=service';
include_once 'validation_functions.php';

if (isset($_POST['save'])) {
    $obj->reAutoIncrement('services');
    $obj->reAutoIncrement('service_details');
    
    $service_name = validate($_POST['name']);
    $proverb =validate($_POST['proverb']);
    $img1 = validate($_FILES['img1']['name']);
    $desc1 = validate($_POST['desc1']);
    $title1 = validate($_POST["title1"]);
    $img2 = validate($_FILES['img2']['name']);
    $desc2 = validate($_POST['desc2']);
    $title2 = validate($_POST["title2"]);
    $img3 = validate($_FILES['img3']['name']);
    $query1 = $obj->getConnect()->prepare("INSERT INTO services (Nom_du_service) VALUES (:nom)");
    $query1->bindValue(':nom', $service_name);
    $sucess1 = $query1->execute();
    $id = $obj->getConnect()->lastInsertId();
    $query = $obj->getConnect()->prepare("INSERT INTO service_details (proverb, image1, descr1, title1, image2, descr2, title2, image3, id_service) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bindValue(1, $proverb);
    $query->bindValue(2, $img1);
    $query->bindValue(3, $desc1);
    $query->bindValue(4, $title1);
    $query->bindValue(5, $img2);
    $query->bindValue(6, $desc2);
    $query->bindValue(7, $title2);
    $query->bindValue(8, $img3);
    $query->bindValue(9, $id);
    $sucess2 = $query->execute();

    if ($sucess1 && $sucess2) {
        move_uploaded_file($_FILES['img1']['tmp_name'], "../upload/" . $_FILES['img1']['name']);
        move_uploaded_file($_FILES['img2']['tmp_name'], "../upload/" . $_FILES['img2']['name']);
        move_uploaded_file($_FILES['img3']['tmp_name'], "../upload/" . $_FILES['img3']['name']);
        $query1 = $obj->getConnect()->prepare("INSERT INTO Allservices (Nom_du_service) VALUES (:nom)");
        $query1->bindValue(':nom', $service_name);
        $sucess1 = $query1->execute();
        $_SESSION['message'] = "Service added";
        header("location: $link");
    } else {
        $_SESSION['message'] = "Service n'est pas ajouté";
        header("location: $link");
    }
} else {
    header("location: $link");
    exit(0);
}


