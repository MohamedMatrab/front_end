<?php
header("Content-Type: application/json");
require_once 'connect.php';
    // appoint info 
    if (isset($_POST['date'])) {
        $data = json_decode($_POST['date']);
        $obj = new connect();
        $bool = $obj->import_Heures_occupees_dans_un_jour_donne($data->date,$data->hour);
        $resp = ['msg' => $bool] ;
        $obj->close_connection();
        echo json_encode(['state' => $resp]);
    }


    
?>