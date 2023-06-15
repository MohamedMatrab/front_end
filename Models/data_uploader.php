<?php
    include_once 'connect.php';
    $obj=new connect();
    $obj->usersTable();
    $pswd = password_hash('Dentall2002@',PASSWORD_BCRYPT);
    $users_query ="INSERT INTO users (email,password) VALUES (dentall@dentall.com,$pswd)";
    $stmt=$obj->getConnect()->prepare($users_query);
    $stmt->execute();
?>