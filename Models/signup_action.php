<?php
session_start();
$link = '../index.php';
include_once 'connect.php';
$obj = new connect();
$obj->usersTable();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $fname = $_POST['first-name'];
        $lname = $_POST['last-name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password == $confirm_password) {
            //check email
            $check_email = $obj->getConnect()->prepare('SELECT * FROM users WHERE email = :email');
            $check_email->bindValue(':email', $email);
            $check_email->execute();

            $countE = $check_email->rowCount();

            if ($countE > 0) {
                $_SESSION['message'] = "Email already exists !";
                header("location: $link?action=signup");
                exit(0);
            }
            //check phone number
            $check_phone = $obj->getConnect()->prepare('SELECT * FROM users WHERE phone_num=:phone_num');
            $check_phone->bindValue(':phone_num', $phone);
            $check_phone->execute();

            $countPh = $check_phone->rowCount();

            if ($countPh > 0) {
                $_SESSION['message'] = "Phone Number already exists !";
                header("location: $link?action=signup");
                exit(0);
            }
            //if information not repeated 
            $hached_password = password_hash($password,PASSWORD_BCRYPT);
            $user_query = $obj->getConnect()->prepare("INSERT INTO users (fname, lname, email,phone_num,password,role) VALUES(:fname, :lname, :email,:phone_num, :password,:role)");
            $user_query->bindValue(':fname', $fname);
            $user_query->bindValue(':lname', $lname);
            $user_query->bindValue(':email', $email);
            $user_query->bindValue(':phone_num', $phone);
            $user_query->bindValue(':password', $hached_password);
            $user_query->bindValue(':role', '0');

            $user_query_run = $user_query->execute();

            if ($user_query_run) {
                $_SESSION['message'] = "Registerd Successfully !";
                header("location: $link?action=signup");
                exit(0);
            } else {
                $_SESSION['message'] = "Something went wrong when registering!";
                header("location: $link?action=signup");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Passwords provided do not match !";
            header("location: $link?action=signup");
            exit(0);
        }
    }
} else {
    $_SESSION['message'] = "You can't access that page !";
    header("location: $link?action=signup");
    exit(0);
}
