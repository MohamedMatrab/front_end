<?php
require 'Controllers/controllers_page.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'portfolio':
            dash_portfolio();
            break;
        case 'edit_image':
            editImageAction();
            break;
        case 'add_image':
            addImageAction();
            break;
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
    }
} else {
    dashWelcomeAction();
}
