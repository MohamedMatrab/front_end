<?php
header("Content-Type: application/json");
require_once 'connect.php';

    if (isset($_POST['id'])) {

        $obj = new connect(); 
        $patient = $obj->select_code($_POST['id']);
        $name = $patient->First_Name ." " . $patient->Last_Name;
        $CIN = $_POST['id'] ;
        $date_Birth = $patient->Date_Of_birth ;
        $tel = $patient->tel ;
        $address = $patient->address ;
        $services = $patient->service ;
        $poids = $patient->poids ;
        $taille = $patient->taille ;


        $data = [
            'CIN' => $CIN,
            'name' => $name,
            'date_Birth' => $date_Birth,
            'tel' => $tel,
            'address' => $address,
            'service' => $services,
            'poids' => $poids,
            'taille' => $taille,
        ];

        echo json_encode(['patient' => $data ]);
    }
    else {
        echo json_encode(['patient' => 'error']);
    }
    
?>