<?php
header("Content-Type: application/json");
require_once 'connect.php';
    try {
        if (isset($_POST['data'])) { 
            $data = json_decode($_POST['data']);
            $obj = new connect(); 
            $id_service = $obj->selectId($data->service);
            $response = $obj->insertRendezVous($data->cin,$data->firstName,$data->lastName,$data->dateBirth, $data->tel,$data->address, $data->date, $data->heure,$id_service->ID, $data->service , $data->id);
            echo json_encode(['pass' => ['state' => $response ]]) ;
        }
    } catch (PDOException $e) { 
            echo json_encode(['pass' => ['state' => "Not Connected :" . $e->getMessage() ]]) ;
    }


    
?>