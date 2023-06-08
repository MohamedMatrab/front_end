<?php
session_start();
include_once 'connect.php';
if(isset($_POST['delete'])){
    $IID=$_POST['delete_id'];
    $delete_query=$connect->prepare("DELETE FROM services WHERE ID='$IID'");
    $delete_query->execute();
    $delete_query1=$connect->prepare("DELETE FROM service_details WHERE id_service='$IID'");
    $delete_query1->execute();
    $delete_from_portfolio=$connect->prepare("DELETE FROM portfolio WHERE service_id='$IID'");
    $delete_from_portfolio->execute();
    if($delete_query && $delete_query1){
        $_SESSION['message']="service est supprimer avec succés";
        header('location: afficher_service.php');
    }
    else{
        $_SESSION['message']="something went wrong!";
        header('location: afficher-service.php');
    }
}

?>