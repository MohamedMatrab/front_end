<?php
function validate($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = trim($data);
    return $data;
}
function valiatePhoneNum($phone_num)
{
    global $link;
    if (preg_match('/^(?:\+?\d{1,3})?\d{9}$/', $phone_num)) {
        return $phone_num;
    }
    $_SESSION['message'] = 'Numero de telephone invalide !';
    header("location: $link");
    exit(0);
}
function validatePassword($password)
{
    global $link;
    if (preg_match('/^(?=.*\d)(?=.*[$@$!%*#?&])(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        return $password;
    }
    $_SESSION['message'] = "Mot de Passe Invalide !";
    header("location: $link");
    exit(0);
}
function validateEmail($email)
{
    global $link;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    }
    $_SESSION['message'] = "Adresse Email Invalide !";
    header("location: $link");
    exit(0);
}
function validateId($id)
{
    global $link;
    if (preg_match('/^\d+$/', $id)) {
        return $id;
    }
    $_SESSION['message'] = "Id Invalid !";
    header("location: $link");
    exit(0);
}
