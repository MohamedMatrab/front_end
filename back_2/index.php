<?php
session_start();
include_once 'connect.php';

if (isset($_POST['login'])){
    $fname=$_POST['first-name'];
    $lname=$_POST['last-name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];


    if($password == $confirm_password){ 
        $check_email=$connect->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $check_email->bindValue(':email',$email);
        $check_email->execute();

        //if ($check_email_run === false) {
           // die("Erreur d'execution de la requête : ");
        //}
        //else{
            //echo"done";
        //}

        
        $count=$check_email->fetchColumn();

        if($count > 0){
            $_SESSION['message']="already email exists";
            header("location: sign_up.php");
            exit(0);

        }

        else{
            $user_query=$connect->prepare("INSERT INTO users (fname, lname, email, password) VALUES(:fname, :lname, :email, :password)");
            $user_query->bindValue(':fname',$fname);
            $user_query->bindValue(':lname',$lname);
            $user_query->bindValue(':email',$email);
            $user_query->bindValue(':password',$password);
            
            $user_query_run=$user_query->execute();

            if($user_query_run){
                $_SESSION['message']="registerd successfully";
                header("location: login.php");
                exit(0);

            }

            else{
                $_SESSION['message']="something went wrong!";
                header("location: sign_up.php");
                exit(0);
            }
        }
    }
    else{
        $_SESSION['message']="password and confirm does not match";
        header("location: sign_up.php");
        exit(0);
        
        
    }
}
else{
    header("location: sign_up.php");
    exit(0);
}
