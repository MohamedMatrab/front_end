<?php
header("Content-Type: application/json");
session_start() ;
require_once 'connect.php';
    try {
        $obj = new connect(); 
        $sql = " SELECT COUNT(*) as appoint_validate FROM rendez_vous WHERE rendez_vous.show is null ;" ;
        $stmt = $obj->getConnect()->prepare($sql);
        $stmt->execute();
        $nbr = $stmt->fetch(PDO::FETCH_ASSOC) ;

        $sql2 = " SELECT CIN,date_rendez,Heure_rendez,service FROM rendez_vous WHERE rendez_vous.show = '0' ;" ;
        $stmt2 = $obj->getConnect()->prepare($sql2);
        $stmt2->execute();
        $patient = $stmt2->fetchAll(PDO::FETCH_ASSOC) ;
        $new_appoint = [] ;
        foreach ($patient as $p){
            $data = [
                'CIN' => $p['CIN'],
                'date_rendez' => $p['date_rendez'] ,
                'Heure_rendez' => $p['Heure_rendez'] ,
                'service' => $p['service']
            ] ;
            array_push($new_appoint , $data);
        }
        
        echo json_encode([ 'nbr' => ['appoint' => $nbr['appoint_validate'] ,
                                    'patients' => $new_appoint 
                                    ] 
                        ]) ;
        
    } catch (PDOException $e) { 
            echo json_encode([ 'nbr' => ['appoint' => "Not Connected :" . $e->getMessage() ]]) ;
    }

    
?>