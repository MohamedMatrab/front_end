<?php
session_start();
header("Content-Type: application/json");
require_once 'connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // if (isset($_FILES['my_image'] ) &&  isset($_POST['submit'] ) ) {
        $name = $_FILES['my_image']['name'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $type = $_FILES['my_image']['type'];
        $size = $_FILES['my_image']['size'];
        $error = $_FILES['my_image']['error'];
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $allowed_exs = array('jpeg', 'jpg', 'png');
        if (!in_array($extension, $allowed_exs)) {
            $em = "This Format is not allowed ,provide an image.";
            $_SESSION['message'] = $em;
            header("Location: ../dashboard.php?action=centre");
        } elseif ($size >  4 * 1024 * 1024) {
            $em = "File is Too Large, Maximum Size 4MB .";
            $_SESSION['message'] = $em;
            header("Location: ../dashboard.php?action=centre");
        } else {
            $obj = new connect();
            $DataImage = file_get_contents($tmp_name);
            $query = 'insert into photos_centre(photo_centre) value(:image)' ;
            $stmt = $obj->getConnect()->prepare($query);
            $stmt->bindValue(':image', $DataImage, PDO::PARAM_LOB);
            $stmt->execute();
            $obj->close_connection();
            $em = "image est ajouté avec succés";
            $_SESSION['message'] = $em;
            header("Location: ../dashboard.php?action=centre");
        }
    // }
}


if (isset($_GET['id_photo'])) {
    $obj = new connect();
    $query = 'DELETE FROM photos_centre
    WHERE id_photo =:id' ;
    $stmt = $obj->getConnect()->prepare($query);
    $stmt->bindValue(':id', $_GET['id_photo']);
    $stmt->execute();
    $obj->close_connection();
    $em = "image est supprimé avec succés";
    $_SESSION['message'] = $em;
    header("Location: ../dashboard.php?action=centre");
}
    
?>