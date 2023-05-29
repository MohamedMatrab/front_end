<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = '../dashboard.php';
    $dataCdt = isset($_GET['id']) && isset($_POST['submit']) && isset($_POST['service_id']) && isset($_POST['title']);
    $imgCdt = isset($_FILES['my_image']) && !empty($_FILES['my_image']['name']);
    include_once "connect.php";
    $obj = new connect();
    $obj->portfolioTable();
    $obj->serviceTable();
    if ($imgCdt && $dataCdt) {
        $name = $_FILES['my_image']['name'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $type = $_FILES['my_image']['type'];
        $size = $_FILES['my_image']['size'];
        $error = $_FILES['my_image']['error'];
        $exctention = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed_exs = array('jpeg', 'jpg', 'png');
        $title = $_POST['title'];
        $description = $_POST['description'];
        $service_id = $_POST['service_id'];
        $id = $_GET['id'];

        if (!in_array($exctention, $allowed_exs)) {
            $em = "Ce format n'est pas autorisé, fournissez une image.";
            $_SESSION['message']=$em;
            header("Location: $link?action=edit_image&id=$id");
        } elseif ($size >  4 * 1024 * 1024) {
            $em = "Le fichier est trop volumineux, taille maximale 4 Mo.";
            $_SESSION['message']=$em;
            header("Location: $link?action=edit_image&&id=$id");
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
                $em = "Edité avec succès !";
                $_SESSION['message']=$em;
                header("Location: $link?action=portfolio");
            } else {
                $em = "Un problème est survenu !";
                $_SESSION['message']=$em;
                header("Location: $link?action=edit_image");
            }
            exit(0);
        }
    } elseif ($dataCdt && !$imgCdt) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $service_id = $_POST['service_id'];
        $id = $_GET['id'];
        $query = "UPDATE portfolio SET title=:title ,description=:description ,service_id=:service_id  WHERE id=:id";
        $stmt = $obj->getConnect()->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':service_id', $service_id);
        $stmt->bindValue(':id', $id);
        $success = $stmt->execute();

        if ($success) {
            $em = "Edité avec succès !";
            $_SESSION['message']=$em;
            header("Location: $link?action=portfolio");
        } else {
            $em = "Un problème est survenu !";
            $_SESSION['message']=$em;
            header("Location: $link?action=edit_image");
        }
        exit(0);
    } else {
        $em = "Data Missing !";
        $_SESSION['message']=$em;
        header("Location: $link?action=edit_image");
    }
    $obj->close_connection();
}
?>