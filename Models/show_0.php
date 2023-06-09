<?php
header("Content-Type: application/json");
session_start() ;
require_once 'connect.php';
    try {
        $obj = new connect(); 
        $sql = "UPDATE rendez_vous
        SET `show` = '0'   
        WHERE `show` IS NULL  ;" ;
        $stmt = $obj->getConnect()->prepare($sql);
        $stmt->execute();
        echo json_encode([ 'resp' => ['mission' => 1 ] ]) ;
    } catch (PDOException $e) { 
        echo json_encode([ 'resp' => ['mission' => 0 ] ]) ;
    }

    
?>