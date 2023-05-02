<?php 
   require 'Controllers/controllers_page.php' ;
   

   if (isset($_GET['action'])) {
      $action = $_GET['action'] ;

      switch ($action) {
         case 'aboutcentre' : aboutCentreAction() ; break ;
         case 'aboutdoctor' : aboutDoctorAction() ; break ;
         case 'appoint' : appointAction() ; break ;
         case 'login' : loginAction() ; break ;
         case 'signup' : signupAction() ; break ;
         case 'portfolio' : portfolioAction() ; break ;
         case 'service' : serviceAction() ; break ;
         case 'ésthétique dentaire' : detailsAction() ; break ; 
         case 'contact' : contactAction() ; break ; 

         case 'RDV' : PrendreRdv() ; break ;

         case 'index.php?action=dash_appointment' : dashb_appointment() ; break ;
      }
   }else {
      indexAction();
   }