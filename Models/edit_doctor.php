<?php 
include_once "connect.php";
include_once 'validation_functions.php';
session_start();

        include_once "connect.php";
            $obj = new connect();

            $qu_ery = 'SELECT CIN,Gmail,tel FROM doctor where id <> ? ';
            $st_mt = $obj->getConnect()->prepare($qu_ery);
            $st_mt->execute(array($_GET['id']));
            $response = $st_mt->fetchAll(PDO::FETCH_ASSOC);
            $found_email = false;
            $found_cin = false ;
            $found_phone = false ;
            foreach ($response as $row) {
                if ($row['Gmail'] === validateEmail($_POST['email'])) {
                    $found_email = true;
                    break;
                }
            }
            foreach ($response as $row) {
                if ($row['CIN'] === validateCin($_POST['cin'])) {
                    $found_cin = true;
                    break;
                }
            }
            foreach ($response as $row) {
                if ($row['tel'] === valiatePhoneNumappoint($_POST['num'])) {
                    $found_phone = true;
                    break;
                }
            }
            if ($found_email && $found_cin && $found_phone) {
                $em = "Email et CIN et numéro de téléphone sont déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor&&id=".$_GET['id']);
            }elseif($found_email && $found_cin ){
                $em = "Email est CIN sont déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }elseif($found_cin && $found_phone){
                $em = "CIN et numéro de téléphone sont déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }elseif($found_email && $found_phone){
                $em = "email et numéro de téléphone sont déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }elseif($found_email){
                $em = "email est déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }elseif($found_cin){
                $em = "CIN est déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }elseif($found_phone){
                $em = "numéro de téléphone est déjà existé";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor".$_GET['id']);
            }
            else{
                $query = 'UPDATE doctor
                    SET CIN = ? , Nom = ? , Prenom = ? ,Gmail = ?,tel = ? ,id_service = ?
                    WHERE id = ? ';
                $stmt = $obj->getConnect()->prepare($query);
                $stmt->execute(array(validateCin($_POST['cin']) ,
                                    validate($_POST['nom']) ,
                                    validate($_POST['prenom']),
                                    validateEmail($_POST['email']),
                                    valiatePhoneNumappoint($_POST['num']),
                                    $_POST['spec'],
                                    $_GET['id'] 
                            ));
            $name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $type = $_FILES['image']['type'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $allowed_exs = array('jpeg', 'jpg', 'png');
            if (!in_array($extension, $allowed_exs)) {
                $em = "This Format is not allowed ,provide an image.";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor&&id=" . $_GET['id']);
            } elseif ($size >  4 * 1024 * 1024) {
                $em = "File is Too Large, Maximum Size 4MB .";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=edit_doctor&&id=" . $_GET['id']);
            } else {
                $DataImage = file_get_contents($tmp_name);
                $query2 = 'UPDATE doctor
                SET image = :image
                WHERE CIN = :cin' ;
                $stmt2 = $obj->getConnect()->prepare($query2);
                $stmt2->bindValue(':image', $DataImage, PDO::PARAM_LOB);
                $stmt2->bindValue(':cin', validateCin($_POST['cin']));
                $stmt2->execute();
                $obj->close_connection();
                $em = "édité avec succés";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=doctor");
            }
            }