<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once "connect.php";
    include_once 'validation_functions.php';
    $obj = new connect();
    $obj->portfolioTable();
    $obj->serviceTable();
    $obj->reAutoIncrement('portfolio');

    $link = '../dashboard.php?action=edit_image';
    $dataCdt = isset($_GET['id']) && isset($_POST['submit']) && isset($_POST['service_id']) && isset($_POST['title']);
    $imgCdt = isset($_FILES['my_image']) && !empty($_FILES['my_image']['name']);

    if ($imgCdt && $dataCdt) {
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
        $id = validateId($_GET['id']);

        if (!in_array($exctention, $allowed_exs)) {
            $_SESSION['message'] = "Ce format n'est pas autorisé, fournissez une image.";
            header("Location: $link&id=$id");
        } elseif ($size >  4 * 1024 * 1024) {
            $_SESSION['message'] = "Le fichier est trop volumineux, taille maximale 4 Mo.";
            header("Location: $link&id=$id");
        } else {
            $imageData = file_get_contents($tmp_name);
            $query = "UPDATE portfolio SET image=:image ,title=:title ,description=:description ,service_id=:service_id  WHERE id=:id";
            $stmt = $obj->getConnect()->prepare($query);
            $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':service_id', $service_id);
            $stmt->bindValue(':id', $id);
            $success = $stmt->execute();

            if ($success) {
                $_SESSION['message'] = "Image Edité avec succès !";
                header("Location: ../dashboard.php?action=portfolio");
            } else {
                $_SESSION['message'] = "Un problème est survenu !";
                header("Location: $link");
            }
            exit(0);
        }
    } elseif ($dataCdt && !$imgCdt) {
        $title = validate($_POST['title']);
        $description = validate($_POST['description']);
        $service_id = validateId($_POST['service_id']);
        $id = validateId($_GET['id']);
        $query = "UPDATE portfolio SET title=:title ,description=:description ,service_id=:service_id  WHERE id=:id";
        $stmt = $obj->getConnect()->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':service_id', $service_id);
        $stmt->bindValue(':id', $id);
        $success = $stmt->execute();

        if ($success) {
            $_SESSION['message'] = "Image Edité avec succès !";
            header("Location: ../dashboard.php?action=portfolio");
        } else {
            $_SESSION['message'] = "Un problème est survenu !";
            header("Location: $link");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Données manquantes !";
        header("Location: $link");
    }
    $obj->close_connection();
}
