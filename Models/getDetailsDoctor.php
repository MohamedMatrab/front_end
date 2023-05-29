<?php
header("Content-Type: application/json");
require_once 'connect.php';


    if (isset($_POST['service'])) {
        // SELECT SERVICE 
        $obj = new connect();
        $id_service = $obj->selectId($_POST['service']);
        $doctor = $obj->selectDoctor($id_service->service_id);
        $doctor = [
            'Nom' => $doctor->Nom  ,
            'Prenom' => $doctor->Prenom
        ] ;

        echo json_encode(['doctor' => $doctor]);
        
    }else{
        echo json_encode(['data' => ['<h1 style="margin:auto;margin-top:3rem;">There are No Pictures To show ! </h1>']]);
    }


?>