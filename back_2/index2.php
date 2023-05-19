<?php
session_start();
include_once 'connect.php';
if(isset($_POST['login'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];

    $login_query=$connect->prepare("SELECT * FROM users where email= '$email'AND password= '$password' LIMIT 1");
    //$login_query->bindValue(':email',$email);
    //$login_query->bindValue(':password',$password);
    $login_query->execute();
    $count=$login_query->rowCount();
    if($count > 0 ){

        foreach($login_query as $tab){
            $id = $tab['id'];
            $full_name = $tab['fname'].' '.$tab['lname'];
            $user_email = $tab['email'];
            $role = $tab['role'];

            var_dump($id, $full_name, $user_email);

        }

        $_SESSION['auth'] = true;
        $_SESSION['role'] = $role; 
        $_SESSION['auth_user'] = [
            'user_id' => $id,
            'user_name' => $full_name,
            'user_email' => $user_email,

        ];
        if($_SESSION['role'] == 1){
            $_SESSION['message']="welcome to your dashboard";
            echo $_SESSION['message'];
            header('location: dashboard_2.php');
            exit(0);

        }
        elseif($_SESSION['role'] == 0){
            $_SESSION['message']="welcome to your dashboard";
            echo $_SESSION['message'];
            header('location: login.php');
            exit(0);

        }


    }
    else{
        $_SESSION['message'] = "invalid email or password !";
        header('location:login.php');
        exit(0);
    }

}
else{
    $_SESSION['message'] = "you are no allowd to acces this page!";
    header('location: login.php');
    exit(0);
}