<?php
include_once 'connect.php';
$obj = new connect();
if (isset($_SESSION['USER'])) {
    $id = $_SESSION['USER']['id'];
    $login_query = $obj->getConnect()->prepare("SELECT role FROM users WHERE id=$id LIMIT 1");
    $succuess = $login_query->execute();
    if (!$succuess || $login_query->rowCount() == 0) {
        unset($_SESSION['USER']);
    } else {
        $role = $login_query->fetch(PDO::FETCH_ASSOC)['role'];
        $_SESSION['USER']['role'] = $role;
    }
}
