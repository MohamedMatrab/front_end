<?php
session_start();
include_once 'connect.php';
include 'validation_functions.php';
$obj=new connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = '../dashboard.php?action=edit_account';

    if (isset($_POST['modifier'])) {
        $admin_id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $cin = $_POST['cin'];
        $phone = $_POST['phone'];

        validateEmail($email);
        validateCIN($cin);
        valiatePhoneNum($phone);

        // Vérifier si une nouvelle image a été téléchargée
        if ($_FILES['image']['size'] > 0) {
            $name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $type = $_FILES['image']['type'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowed_extensions = array('jpeg', 'jpg', 'png');

            if (!in_array($extension, $allowed_extensions)) {
                $em = "Ce format n'est pas autorisé, veuillez fournir une image.";
                $_SESSION['message'] = $em;
                header("Location: $link");
                exit;
            } elseif ($size > 4 * 1024 * 1024) {
                $em = "Le fichier est trop volumineux, taille maximale 4 Mo.";
                $_SESSION['message'] = $em;
                header("Location: $link");
                exit;
            }

            // Lecture du contenu de la nouvelle image
            $imageData = file_get_contents($tmp_name);
        } else {
            // Utiliser l'image existante dans la base de données
            $query = $obj->getConnect()->prepare("SELECT img FROM users WHERE id=:id");
            $query->bindParam(':id', $admin_id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $imageData = $row['img'];
        }

        // Requête de mise à jour
        $query = $obj->getConnect()->prepare("UPDATE users SET fname=:fname, lname=:lname, email=:email, cin=:cin, img=:image, phone_num=:phone WHERE id=:id");
        $query->bindParam(':fname', $fname);
        $query->bindParam(':lname', $lname);
        $query->bindParam(':email', $email);
        $query->bindParam(':cin', $cin);
        $query->bindParam(':image', $imageData, PDO::PARAM_LOB);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':id', $admin_id);
        $query = $query->execute();

        if ($query) {
            $em = "Modifié avec succès !";
            $_SESSION['message'] = $em;
            header("Location: $link");
            exit;
        } else {
            $_SESSION['message'] = "Une erreur s'est produite lors de la modification.";
            header("Location: $link");
            exit;
        }
    } else {
        $em = "Vous n'avez pas choisi une image !";
        $_SESSION['message'] = $em;
        header("Location: $link");
        exit;
    }
}
?>
