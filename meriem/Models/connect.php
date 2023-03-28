<?php
$host = "localhost";
$user = "root";
$pass = "meriem2002";
$db = "User";

try {
    $connect = new pdo("mysql:host=$host; dbname=$db",$user,$pass);
}catch (PDOException $e){
    echo "Not Connected :" . $e->getMessage();
}