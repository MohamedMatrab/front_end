<?php
require_once 'Models/connect.php';
    
    function upload_details($Code){
        ob_start() ; 
        echo $Code ; 
        $code = ob_get_clean() ;
        require_once 'views/details.php';
    }  
    function insert_more_details($poids,$taille,$code) {
        $obj = new connect(); 
        
        $obj->insert_more_detail($taille,$poids,$code);
        upload_details($code);
    }

    // function insert_ordonnance($file_name ,$ID , $date ) {
    //     $obj = new connect(); 
    //     $obj->insertOrdonnance($file_name ,$ID , $date);
    // }
    

        