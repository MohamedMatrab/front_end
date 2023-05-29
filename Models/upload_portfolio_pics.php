<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = '../dashboard.php';
    if (isset($_POST['submit']) && isset($_POST['service_id']) && isset($_POST['title']) && isset($_FILES['my_image']) && !empty($_FILES['my_image']['name'])) {

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
        if (!in_array($exctention, $allowed_exs)) {
            $em = "Ce format n'est pas autorisé, fournissez une image.";
            $_SESSION['message'] = $em;
            header("Location: $link?action=add_image");
        } elseif ($size >  4 * 1024 * 1024) {
            $em = "Le fichier est trop volumineux, taille maximale 4 Mo.";
            $_SESSION['message'] = $em;
            header("Location: $link?action=add_image");
        } else {
            include_once "connect.php";
            $obj = new connect();
            $obj->portfolioTable();
            $obj->serviceTable();
            $obj->reAutoIncrement('portfolio');

            $imageData = file_get_contents($tmp_name);
            $query = "INSERT INTO portfolio(image,title,description,service_id) VALUES(:image,:title,:description,:service_id)";
            $stmt = $obj->getConnect()->prepare($query);
            $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':service_id', $service_id);
            $stmt->execute();
            $obj->close_connection();
            

            $em = "Edité avec succès !";
            $_SESSION['message'] = $em;
            header("Location: $link?action=portfolio");
        }
    } else {
        $em = "Vous n'avez pas choisi une image !";
        $_SESSION['message'] = $em;
        header("Location: $link?action=add_image");
    }
}
