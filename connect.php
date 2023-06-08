<?php
    $source = "mysql:host=localhost;dbname=project";
    $login = "root";
    $mdp = "";
    try {
       $connect = new PDO($source, $login, $mdp);
       $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
       echo "error";
}
?>