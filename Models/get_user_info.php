<?php
if (isset($_SESSION['USER'])) {
    include_once 'Models/connect.php';
    $obj = new connect();
    $id = $_SESSION['USER']['id'];
    $info_query = $obj->getConnect()->prepare("SELECT * FROM users WHERE id=$id LIMIT 1");
    $sucess = $info_query->execute();
    $user = $info_query->fetch(PDO::FETCH_ASSOC);
}
