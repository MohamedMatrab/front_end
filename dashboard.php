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
    }
} else {
    dashWelcomeAction();
}
