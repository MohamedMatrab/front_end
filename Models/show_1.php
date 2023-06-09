<?php
header("Content-Type: application/json");
session_start() ;
require_once 'connect.php';
    try {
        $obj = new connect(); 
        $sql = "UPDATE rendez_vous
        SET `show` = '1'   
        WHERE `show` = '0' ;" ;
        $stmt = $obj->getConnect()->prepare($sql);
        $stmt->execute();
        echo json_encode([ 'resp' => ['action' => 1 ] ]) ;
    } catch (PDOException $e) { 
        echo json_encode([ 'resp' => ['action' => 0 ] ]) ;
    }

    
?>