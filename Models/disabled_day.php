<?php
header("Content-Type: application/json");
require_once 'connect.php';
    // appoint info 
    // if (isset($_POST['ckeck'])) {
        $obj = new connect();
        $array = $obj->Verifiy_Full_Day();
        $Full_Day = array();
        // Loop through the $array and extract dates with 2 appointments
        for ($i=0 ; $i < count($array) ; $i++) {
            if ($array[$i]['Nbr_Rdv_in_day'] === 2 ) {
                array_push($Full_Day,$array[$i]['date_rendez']);
            }
        } 
        // delete Date before current Date 
        foreach ($Full_Day as $day) {
            if ($day < date("Y-m-d")) {
                $Full_Day = \array_diff($Full_Day, [$day]) ;
            }
        }
        
        echo json_encode(['day' => $Full_Day]);
    // }


    
?>