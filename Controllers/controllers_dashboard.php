<?php
require_once 'Models/connect.php';
require('controllers_data.php');


function dashWelcomeAction()
{
    require_once 'views/dash_welcome.php';
}
function dash_portfolio()
{
    require_once 'views/dash_portfolio.php';
}
function dash_centre(){
    require_once 'views/dash_centre.php' ;
}
function dash_doctor(){
    require_once 'views/dash_doctor.php' ;
}
function add_doctor(){
    require_once 'views/add_doctor.php' ;
}
function edit_doctor($id){
    ob_start() ; 
    echo $id ; 
    $code = ob_get_clean() ;
    require_once 'views/edit_doctor.php' ;
}
function editImageAction()
{
    require_once 'views/edit_image.php';
}
function addImageAction()
{
    require_once 'views/add_image.php';
}
function dashLoginAction()
{
    require_once 'views/dash_login.php';
}
function dashUsersAction()
{
    require_once 'views/users.php';
}
function addAdminsAction()
{
    require_once 'views/add_admin.php';
}
function EditUserInfoAction()
{
    require_once 'views/edit_user_info.php';
}
function dashb_history()
{
    Show_Data('historique');
}

function dashb_appointment()
{
    Show_Data('rendez_vous');
}


function Delete_from_rendez($id)
{
    $obj = new connect();
    $obj->Delete_rendez($id);
}

function Ajout_History($id)
{
    $obj = new connect();
    $obj->historiqueTable();
    $obj->insert_into_history($id);
}
