<?php
session_start();
include_once 'connect.php';
$obj=new connect();
$link = "../dashboard.php?action=service";
if(isset($_POST['delete'])){
    $IID=$_POST['delete_id'];
    $delete_query=$obj->getConnect()->prepare("DELETE FROM services WHERE ID='$IID'");
    $delete_query->execute();
    $delete_query1=$obj->getConnect()->prepare("DELETE FROM service_details WHERE id_service='$IID'");
    $delete_query1->execute();
    $delete_from_portfolio=$obj->getConnect()->prepare("DELETE FROM portfolio WHERE service_id='$IID'");
    $delete_from_portfolio->execute();
    if($delete_query && $delete_query1){
        $_SESSION['message']="service est supprimer avec succés";
        header("location: $link");
        exit(0);
    }
    else{
        $_SESSION['message']="something went wrong!";
        header("location: $link");
        exit(0);
    }
}

?>