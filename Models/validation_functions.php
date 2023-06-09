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
function validateCin($CIN){
    if (preg_match('/^[A-Z]{1,2}\d{6}$/', $CIN)) {
        return $CIN;
    }else {
        $_SESSION['message'] = "Id Invalid !";
        header("location: index.php?action=appoint");
        exit(0);
    }
    
}
function valiatePhoneNumappoint($phone_num)
{
    if (preg_match('/^(\(\+\d{3}\)|0)\d{9}$/', $phone_num)) {
        return $phone_num;
    }else{
        $_SESSION['message'] = 'Numero de telephone invalide !';
        header("location: index.php?action=appoint");
        exit(0);
    }
    
}
function occurence_users($value, $property, $obj, $link, $message)
{
    $check_property = $obj->getConnect()->prepare("SELECT COUNT(*) FROM users WHERE $property = :$property");
    $check_property->bindValue(":$property", $value);
    $check_property->execute();

    $count = $check_property->fetchColumn();

    if ($count > 0) {
        $_SESSION['message'] = $message;
        header("location: $link");
        exit(0);
    }
}
function occurence_email($email, $prevEmail = "")
{
    global $link;
    global $obj;
    if ($email != $prevEmail) {
        occurence_users($email, 'email', $obj, $link, "L'email est déjà utilisé !");
    }
}

function occurence_phone_num($phone_num, $prev_phone_num = "")
{
    global $link;
    global $obj;
    if ($phone_num != $prev_phone_num) {
        occurence_users($phone_num, 'phone_num', $obj, $link, "Le numéro de téléphone déjà utilisé !");
    }
}
function similarity($password_confirm, $password)
{
    global $link;
    if ($password === $password_confirm) {
        return $password_confirm;
    }
    $_SESSION['message'] = "Les mots de passe fournis ne correspondent pas !";
    header("location: $link");
    exit(0);
}
