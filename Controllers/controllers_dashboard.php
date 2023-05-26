<?php
require_once 'Models/connect.php';
require ('controllers_data.php') ;
    

    
    function dashb_history(){
        Show_Data('historique') ;
    }

    function dashb_appointment(){
        Show_Data('rendez_vous') ;
    }


    function Delete_from_rendez($id) {
        $obj = new connect(); 
        $obj->Delete_rendez($id);
    }

    function Ajout_History($id) {
        $obj = new connect(); 
        $obj->historiqueTable() ;
        $obj->insert_into_history($id);
    }

?>