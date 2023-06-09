<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once 'validation_functions.php';
    include_once "connect.php";
    $obj = new connect();
    $obj->portfolioTable();
    $obj->serviceTable();
    $obj->reAutoIncrement('portfolio');
    $link = '../dashboard.php?action=add_image';

    if (isset($_POST['submit']) && isset($_POST['service_id']) && isset($_POST['title']) && isset($_FILES['my_image']) && !empty($_FILES['my_image']['name'])) {

        $name = $_FILES['my_image']['name'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $type = $_FILES['my_image']['type'];
        $size = $_FILES['my_image']['size'];
        $error = $_FILES['my_image']['error'];
        $exctention = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed_exs = array('jpeg', 'jpg', 'png');
        $title = validate($_POST['title']);
        $description = validate($_POST['description']);
        $service_id = validateId($_POST['service_id']);
        if (!in_array($exctention, $allowed_exs)) {
            $_SESSION['message'] = "Ce format n'est pas autorisé, fournissez une image.";
            header("Location: $link");
        } elseif ($size >  4 * 1024 * 1024) {
            $_SESSION['message'] = "Le fichier est trop volumineux, taille maximale 4 Mo.";
            header("Location: $link");
        } else {
            $imageData = file_get_contents($tmp_name);
            $query = "INSERT INTO portfolio(image,title,description,service_id) VALUES(:image,:title,:description,:service_id)";
            $stmt = $obj->getConnect()->prepare($query);
            $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':service_id', $service_id);
            $sucess = $stmt->execute();
            if (!$sucess) {
                $_SESSION['message'] = "un problème est survenu !";
                header("Location: $link");
            }
            $obj->close_connection();

            $_SESSION['message'] = "Ajouté avec succès !";
            header("Location: ../dashboard.php?action=portfolio");
        }
    } else {
        $_SESSION['message'] = "Vous n'avez pas choisi une image !";
        header("Location: $link");
    }
}
