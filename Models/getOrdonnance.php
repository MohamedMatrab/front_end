<?php 
header("Content-Type: application/json");
require_once 'connect.php';

if (isset($_POST['Data']) ) {
    $data = json_decode($_POST['Data']);
    $obj = new connect();
    $row = $obj->getOrdonnance($data->id,$data->date) ;
    
    if ($row && isset($row['ordonnance'])) {
        $image = 'data:image/jpg;base64,'.base64_encode($row['ordonnance']);
        $src = ['src' => $image ];
        $obj->close_connection();
        echo json_encode(['msg' => $src]);
        
    } else {
        echo json_encode(['msg' => null]);
    }

} else {
    echo json_encode(['msg' => 'Invalid request']);
}