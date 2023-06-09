<?php
header("Content-Type: application/json");
session_start() ;
require_once 'connect.php';

    try {
        if (isset($_POST['CIN'])) { 
            $obj = new connect(); 
            $sql = "SELECT * FROM rendez_vous WHERE CIN =:cin" ;
            $stmt = $conn->getConnect()->prepare($sql);
            $stmt->bindValue(':cin', $_POST['CIN']);
            $stmt->execute();
            $cin = $stmt->fetch(PDO::FETCH_ASSOC) ;
            if (isset($cin['CIN'])) {
                echo json_encode(['exist' => ['state' => true ]]) ;
            }else {
                echo json_encode(['exist' => ['state' => false ]]) ;
            }
            
        }
    } catch (PDOException $e) { 
        echo "Not Connected :" . $e->getMessage(); 
    }
    

    
?>