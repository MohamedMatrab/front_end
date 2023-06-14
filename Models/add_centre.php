<?php
    include_once 'connect.php' ;
    session_start();
    
        // if (isset($_POST['description']) && isset($_POST['motivation']) && isset($_POST['my_image']) && isset($_POST['submit']) && !empty($_FILES['my_image']['name'])) {
            include_once "connect.php";
            $obj = new connect();
            $query = 'INSERT INTO centre (description, motivation, localisation, address, numero_1, numero_2, email , facebook,instagram,twitter,start,end) VALUES (:description, :motivation, :localisation, :address, :numero_1, :numero_2, :email, :facebook,:instagram,:twitter,:start,:end)';
            $stmt = $obj->getConnect()->prepare($query);
            $stmt->bindValue(':description', $_POST['description']);
            $stmt->bindValue(':motivation', $_POST['motivation']);
            $stmt->bindValue(':localisation', $_POST['localisation']);
            $stmt->bindValue(':address', $_POST['address']);
            $stmt->bindValue(':numero_1', $_POST['numero_1']); 
            $stmt->bindValue(':numero_2', $_POST['numero_2']);
            $stmt->bindValue(':email', $_POST['mail']);
            $stmt->bindValue(':facebook', $_POST['facebook']);
            $stmt->bindValue(':instagram', $_POST['instagram']);
            $stmt->bindValue(':twitter', $_POST['twitter']);
            $stmt->bindValue(':start', $_POST['start']);
            $stmt->bindValue(':end', $_POST['end']);
            $stmt->execute();
            if (isset( $_FILES['my_image'])){
                $name = $_FILES['my_image']['name'];
                $tmp_name = $_FILES['my_image']['tmp_name'];
                $type = $_FILES['my_image']['type'];
                $size = $_FILES['my_image']['size'];
                $error = $_FILES['my_image']['error'];
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $allowed_exs = array('jpeg', 'jpg', 'png');
                if (!in_array($extension, $allowed_exs)) {
                $em = "Ce format n'est pas autorisé, fournissez une image.";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=addCentreInfo");
            } elseif ($size >  4 * 1024 * 1024) {
                $em = "Le fichier est trop volumineux, taille maximale 4 Mo.";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=addCentreInfo");
            } else {
                $DataImage = file_get_contents($tmp_name);
                $query = 'insert into photos_centre(photo_centre) value(:image)' ;
                $stmt = $obj->getConnect()->prepare($query);
                $stmt->bindValue(':image', $DataImage, PDO::PARAM_LOB);
                $stmt->execute();
                $obj->close_connection();
                $em = "Ajouté avec succés";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=centre");
            }
            }else{
                $em = "Ajouté avec succés";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=centre");
            }
            
        // }else {
        //     $em = "Veuillez entrer toute information";
        //     $_SESSION['message'] = $em;
        //     header("Location: ../dashboard.php?action=addCentreInfo");
        // }


?>