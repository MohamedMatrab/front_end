<?php
header("Content-Type: application/json");
require_once 'connect.php';
        $obj = new connect();
        $hours = $obj->SelectHours();
        $start ;
        $end ;
        if (isset($hours['start']) && isset($hours['end'])){
            $start = $hours['start'];
            $end = $hours['end'];
        }else {
            $start = "09:00:00";
            $end = "18:00:00";
        }
        $horaire = ["start" => $start ,
                    "end" => $end
        ];

        $array = $obj->Verifiy_Full_Day();
        $Full_Day = array();
        // Loop through the $array and extract dates with 2 appointments
        for ($i=0 ; $i < count($array) ; $i++) {
            if ($array[$i]['Nbr_Rdv_in_day'] === parseInt(endTime) - parseInt(startTime) ) {
                array_push($Full_Day,$array[$i]['date_rendez']);
            }
        } 
        // delete Date before current Date 
        foreach ($Full_Day as $day) {
            if ($day < date("Y-m-d")) {
                $Full_Day = \array_diff($Full_Day, [$day]) ;
            }
        }

        echo json_encode(['day' => ['full_day' => $Full_Day , 'time' => $horaire]]);
        // echo json_encode(['day' => $Full_Day ]);

    
?>