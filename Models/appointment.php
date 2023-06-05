<?php
header("Content-Type: application/json");
require_once 'connect.php';
    try {
        if (isset($_POST['data'])) {
            $data = json_decode($_POST['data']);
            // Créer un nouvel objet de la classe "connect" pour se connecter à la base de données
            $obj = new connect(); 
            $obj->rendezVousTable() ;
                
            // Insérer les données du formulaire dans la base de données
            $obj->insertRendezVous($data->cin,$data->firstName,$data->lastName,$data->dateBirth, $data->tel,$data->address, $data->date, $data->heure, $data->service); 
            echo json_encode(['pass' => ['state' => true ]]) ;
        }
        else {
            echo json_encode(['pass' => ['state' => false ]]) ;
        }
} catch (PDOException $e) { 
    echo "Not Connected :" . $e->getMessage(); 
}

    
?>