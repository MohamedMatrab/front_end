<?php
header("Content-Type: application/json");
require_once 'connect.php';
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $obj = new connect();
            $service = $obj->getServices();
            $services = [] ;
            foreach ($service as $s) {
                array_push($services , ['title' => $s->Nom_du_service] );
            };
            echo json_encode(['service' => $services]);
        }
} catch (PDOException $e) { 
    echo "Not Connected :" . $e->getMessage(); 
}

    
?>