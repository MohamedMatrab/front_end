<?php
header("Content-Type: application/json");
require_once 'connect.php';
include_once 'validation_functions.php';
    try {
        if (isset($_POST['data'])) {
            $data = json_decode($_POST['data']);
            $obj = new connect(); 
            $id_service = $obj->selectIdService($data->service);
            $response = $obj->insertRendezVous(validateCinAppoint($data->cin),
                                                validate($data->firstName),
                                                validate($data->lastName),
                                                $data->dateBirth, 
                                                valiatePhoneNumappoint($data->tel),
                                                $data->address, 
                                                $data->date, 
                                                $data->heure,
                                                $id_service->ID, 
                                                $data->service , 
                                                $data->id
                                            );



            echo json_encode(['pass' => ['state' => $response ]]) ;
        }else {
            echo json_encode(['pass' => ['state' => 'Essayer une autre fois ' ]]) ;
        }
    } catch (PDOException $e) { 
            echo json_encode(['pass' => ['state' =>  $e->getMessage() ]]) ;
    }


    
?>