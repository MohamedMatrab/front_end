<?php 
    require 'dashboard_controllers/controllers_dashboard.php' ;


    if (isset($_GET['action'])) {
        $action = $_GET['action'] ;

        switch ($action) {
            case 'dash_appointment' : 
                dashb_appointment() ; 
                break ;
            case 'historique' : 
                dashb_history() ; 
                break ;
            case 'details' : 
                details_patient($_GET['Code']) ; 
                break ;
            case 'more_details' :
                insert_more_details($_POST['poids'],$_POST['taille'],$_GET['ID']) ;
                break ;
        }
    }else {
        dashboard() ;
    }


    if (isset($_GET['id'])) {

        if ($_GET['fun'] === 'annuler') {
            Delete_from_rendez($_GET['id']) ;
        }else if ($_GET['fun'] === 'visiter') {
            Ajout_History($_GET['id']);
        }
    }