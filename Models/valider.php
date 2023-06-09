<?php
header("Content-Type: application/json");
    session_start();
    include_once "connect.php";
    if (isset($_POST['id']) ) {
    try {
        $conn = new connect();
        $sql = "UPDATE rendez_vous SET rendez_vous.state = '1' where CIN = ? " ;
        $stmt = $conn->getConnect()->prepare($sql);
        // $em = "validate succesfuly";
        // $_SESSION['message'] = $em;
        $stmt->execute(array($_POST['id']));

        echo json_encode(['state' => true ]) ;
    }catch(Exception $e ){
        echo json_encode(['state' => false ]) ;
    } 
}