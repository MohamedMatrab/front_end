<?php 
   require 'Controllers/controllers_page.php' ;
   

if (isset($_GET['action'])) {
   $action = $_GET['action'] ;

   switch ($action) {
      case 'aboutcentre' : aboutCentreAction() ; break ;
      case 'aboutdoctor' : aboutDoctorAction() ; break ;
      case 'appoint' : appointAction() ; break ;

   }
}else {
   indexAction();
}