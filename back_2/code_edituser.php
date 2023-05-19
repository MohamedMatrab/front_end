<?php
session_start();
include_once 'connect.php';

if(isset($_POST['delete_user'])){
    $user_id = $_POST['delete_user'];
    $query = $connect->prepare("DELETE FROM users WHERE id=:id");
    $query->bindParam(':id', $user_id);
    $query->execute();

    if($query){
        $_SESSION['message'] = "Admin/user/secritaire deleted successfully";
        header('location: dashboard_2.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header('location: dashboard_2.php');
        exit(0);
    }
}




if(isset($_POST['add_admin'])){
    $user_id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query_run=$connect->prepare("INSERT INTO users (fname,lname,email,password,role) VALUES ('$fname', '$lname', '$email', '$password', '$role')");
    $query_run->execute();
    if($query_run){
        $_SESSION['message']="Admin/user/secritaire added successfully";
        header('location: dashboard_2.php');
        exit(0);
    }
    else{
        $_SESSION['message']="something went wrong!";
        header('location: dashboard_2.php');
        exit(0);

    }


}


if(isset($_POST['update'])){
    $user_id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = $connect->prepare("UPDATE users SET fname=:fname, lname=:lname, email=:email, password=:password, role=:role WHERE id=:id");
    $query->bindParam(':fname', $fname);
    $query->bindParam(':lname', $lname);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':role', $role);
    $query->bindParam(':id', $user_id);
    $query->execute();

    if($query){
        $_SESSION['message'] = "Updated successfully";
        header('location: dashboard_2.php');
        exit(0);
    }
}
?>
