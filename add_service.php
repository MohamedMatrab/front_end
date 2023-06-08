<?php
session_start();
include_once 'connect.php';



if(isset($_POST['save'])){
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

    $query1 = $connect->prepare("INSERT INTO services (Nom_du_service) VALUES (:nom)");
    $query1->bindValue(':nom', $service_name);
    $query1->execute();
    $id=$connect->lastInsertId();


    $query = $connect->prepare("INSERT INTO service_details (proverb, image1, descr1, title1, image2, descr2, title2, image3, descr3, title3, id_service) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bindValue(1, $proverb);
    $query->bindValue(2, $img1);
    $query->bindValue(3, $desc1);
    $query->bindValue(4, $title1);
    $query->bindValue(5, $img2);
    $query->bindValue(6, $desc2);
    $query->bindValue(7, $title2);
    $query->bindValue(8, $img3);
    $query->bindValue(9, $desc3);
    $query->bindValue(10, $title3);
    $query->bindValue(11, $id);
    $query->execute();


    
    if($query1 && $query){
        move_uploaded_file($_FILES['img1']['tmp_name'], "upload/".$_FILES['img1']['name']);
        move_uploaded_file($_FILES['img2']['tmp_name'], "upload/".$_FILES['img2']['name']);
        move_uploaded_file($_FILES['img3']['tmp_name'], "upload/".$_FILES['img3']['name']);
        $_SESSION['message']="Service added";
        header('location: afficher_service.php');
    }
    else{
        $_SESSION['message']="Service not added";
        
    }
}

else{
    header('location: afficher_service.php');
    exit(0);
}