<?php
require_once 'Models/connect.php';


// Require and include the 'home.php' view file
function indexAction()
{
    require_once 'views/home.php';
}

// Require and include the 'aboutCentre.php' view file
function aboutCentreAction()
{
    require_once 'views/aboutCentre.php';
}


 
    // function dash_portfolio(){
    //     require_once 'views/dash_portfolio.php' ;
    // }
    // function dash_centre(){
    //     require_once 'views/dash_centre.php' ;
    // }
    // function editImageAction(){
    //     require_once 'views/edit_image.php' ;
    // }
    // function addImageAction(){
    //     require_once 'views/add_image.php' ;
    // }
    // function dashLoginAction(){
    //     require_once 'views/dash_login.php' ;
    // }
    // function dashUsersAction(){
    //     require_once 'views/users.php' ;
    // }
    // function addAdminsAction(){
    //     require_once 'views/add_admin.php' ;
    // }
    // function EditUserInfoAction(){
    //     require_once 'views/edit_user_info.php' ;
    // }
    function aboutDoctorAction() {
        require_once 'views/aboutDoctor.php' ;
    }



// Function to handle appointment action
function appointAction()
{
    require_once 'views/Appointment.php';
    // disabled_day();
}

// Require and include the 'login.php' view file
function loginAction()
{
    require_once 'views/login.php';
}

// Require and include the 'signup.php' view file
function signupAction()
{
    require_once 'views/signup.php';
}

// Require and include the 'portfolio.php' view file
function portfolioAction()
{
    require_once 'views/portfolio.php';
}

// Require and include the 'service_details.php' view file
function detailsAction()
{
    require_once 'views/service_details.php';
}
function addCentreInfo() {
    require_once 'views/addCentre_dash_.php';
}

// Require and include the 'contact.php' view file
function contactAction()
{
    require_once 'views/contact.php';
}

// mohamed_part
// Require and include the 'contact.php' view file
function accountPatientAction()
{
    require_once 'views/account_patient.php';
}

// Require and include the 'contact.php' view file
function reservationsPatientAction()
{
    require_once 'views/patient_reservations.php';
}
