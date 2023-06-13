<?php 
   require 'Controllers/controllers_page.php' ;
   require 'Controllers/controllers_reservations.php' ;

if (isset($_GET['action'])) {
   $action = $_GET['action'] ;

   switch ($action) {
      case 'aboutcentre' : aboutCentreAction() ; break ;
      case 'aboutdoctor' : aboutDoctorAction() ; break ;
      case 'appoint' : appointAction() ; break ;
      case 'login' : loginAction() ; break ;
      case 'signup' : signupAction() ; break ;
      case 'portfolio' : portfolioAction() ; break ;
      case 'service' : detailsAction() ; break ;
      case 'contact' : contactAction() ; break ; 

      case 'RDV' : PrendreRdv() ; break ;

      case 'alert' :  break ;


      // mohamed_part added

      case 'account':accountPatientAction();break;
      case 'reservations':reservationsPatientAction();break;
      // case 'request':requestPageAction();break;
      case 'del_reservation':
         if (isset($_GET['id'])) {
            delete_patient_reservation($_GET['id']);
         }
         header('Location: index.php?action=reservations');
         exit(0);

      case 'show_image':
         show_image();
         break;

   }
}else {
      indexAction();
}