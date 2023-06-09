<?php
header("Content-Type: application/json");
require_once 'connect.php';


    if (isset($_POST['service_id'])) {
        // SELECT SERVICE 
        $obj = new connect();
        $doctor = $obj->selectDoctor($_POST['service_id']) ;
        $doctor = [
            'Nom' => $doctor->Nom  ,
            'Prenom' => $doctor->Prenom
        ] ;

        echo json_encode(['doctor' => $doctor]);
        
    }else{
        echo json_encode(['doctor' => ['<h1 style="margin:auto;margin-top:3rem;">pas de membre </h1>']]);
    }


?>