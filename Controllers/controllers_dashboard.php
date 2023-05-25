<?php
require_once 'Models/connect.php';
require ('controllers_data.php') ;
    

    
    function dashb_history(){
        Show_Data('historique') ;
        // require_once 'views/history.php' ;
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
        // Delete_from_rendez($id) ;
    }

    function dashWelcomeAction(){
        require_once 'views/dash_welcome.php' ;
    }
    function dash_portfolio(){
        require_once 'views/dash_portfolio.php' ;
    }
    function editImageAction(){
        require_once 'views/edit_image.php' ;
    }
    function addImageAction(){
        require_once 'views/add_image.php' ;
    }

?>