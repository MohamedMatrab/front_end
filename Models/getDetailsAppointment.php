<?php

header("Content-Type: application/json");
require_once 'connect.php';

    // appoint info 
    if (isset($_POST['id'])) {
        $obj = new connect();
        $appoint = $obj->appoint_info($_POST['id']);
        $appointment = array() ;
        foreach ($appoint as $p) {
            array_push($appointment , [ 
                        'date_rendez' => $p->date_rendez,
                        'service_id' => $p->service_id ,
                        'service' =>  $p->service
                    ]) ;
        };
        echo json_encode(['appointment' => $appointment]);
    }


    
?>