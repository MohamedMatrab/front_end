<?php
session_start();
include_once 'connect.php';
$obj = new connect();

$link = '../dashboard.php?action=service';
if (isset($_POST['save'])) {

    $obj->reAutoIncrement('services');
    $obj->reAutoIncrement('service_details');

    $service_name = $_POST['name'];
    $proverb = $_POST['proverb'];
    $img1 = $_FILES['img1']['name'];
    $desc1 = $_POST['desc1'];
    $title1 = $_POST["title1"];
    $img2 = $_FILES['img2']['name'];
    $desc2 = $_POST['desc2'];
    $title2 = $_POST["title2"];
    $img3 = $_FILES['img3']['name'];
    $desc3 = $_POST['desc3'];
    $title3 = $_POST["title3"];

    $query1 = $obj->getConnect()->prepare("INSERT INTO services (Nom_du_service) VALUES (:nom)");
    $query1->bindValue(':nom', $service_name);
    $sucess1 = $query1->execute();
    $id = $obj->getConnect()->lastInsertId();

    $query = $obj->getConnect()->prepare("INSERT INTO service_details (proverb, image1, descr1, title1, image2, descr2, title2, image3, descr3, title3, id_service) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sucess2 = $query->execute(array($proverb, $img1, $desc1, $title1, $img2, $desc2, $title2, $img3, $desc3, $title3, $id));

    if ($sucess1 && $sucess2) {
        move_uploaded_file($_FILES['img1']['tmp_name'], "../upload/" . $_FILES['img1']['name']);
        move_uploaded_file($_FILES['img2']['tmp_name'], "../upload/" . $_FILES['img2']['name']);
        move_uploaded_file($_FILES['img3']['tmp_name'], "../upload/" . $_FILES['img3']['name']);
        $_SESSION['message'] = "Service added";
        header("location: $link");
    } else {
        $_SESSION['message'] = "Service not added";
        header("location: $link");
    }
} else {
    header("location: $link");
    exit(0);
}
