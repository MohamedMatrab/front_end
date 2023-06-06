<?php
require 'Controllers/controllers_page.php';
require 'Controllers/controllers_dashboard.php';
require 'Controllers/controllers_details.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'portfolio':
            dash_portfolio();
            break;
        case 'centre':
            dash_centre();
            break;
        case 'edit_image':
            editImageAction();
            break;
        case 'add_image':
            addImageAction();
            break;

        case 'all_reservations' : 
            if (isset($_GET['id'])) {

                if ($_GET['state'] === 'annuler') {
                    Delete_from_rendez($_GET['id']) ;
                }else if ($_GET['state'] === 'consulter') {
                    Ajout_History($_GET['id']);
                    Delete_from_rendez($_GET['id']) ;
                }
            }
            dashb_appointment() ; 
            break ;
        case 'historique' : 
            dashb_history() ; 
            break ;
        case 'ulpoad_details' : 
            upload_details($_GET['ID']) ;
            break ;
        break ;
        case 'more_details' :
            insert_more_details($_POST['poids'],$_POST['taille'],$_GET['ID']) ;
            break ;

        case 'login':
            dashLoginAction();
            break;
        case 'users':
            dashUsersAction();
            break;
        case 'add_admin':
            addAdminsAction();
            break;
        case 'edit_user_info':
            EditUserInfoAction();
            break;
        case 'addCentreInfo' :
            addCentreInfo();
            break ;

    }
} else {
    dashWelcomeAction();
}
