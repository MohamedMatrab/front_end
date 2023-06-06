<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $targetPath = '../dashboard.php' ;
        if ( isset($_FILES['ordonnance']) && !empty($_FILES['ordonnance']['name']) && isset($_GET['ID']) && isset($_GET['date']) ) {
            $name = $_FILES['ordonnance']['name'];
            $tmp_name = $_FILES['ordonnance']['tmp_name'];
            $type = $_FILES['ordonnance']['type'];
            $size = $_FILES['ordonnance']['size'];
            $error = $_FILES['ordonnance']['error'];
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $allowed_exs = array('jpeg', 'jpg', 'png');
            if (!in_array($extension, $allowed_exs)) {
                $em = "This Format is not allowed ,provide an image.";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=ulpoad_details");
            } elseif ($size >  4 * 1024 * 1024) {
                $em = "File is Too Large, Maximum Size 4MB .";
                $_SESSION['message'] = $em;
                header("Location: ../dashboard.php?action=ulpoad_details");
                
            } else {
                include_once "connect.php";
                $obj = new connect();
                $DataImage = file_get_contents($tmp_name);
                $query = 'UPDATE historique SET ordonnance = :ordonnance WHERE CIN = :CIN and date_rendez = :date_rendez ' ;
                $stmt = $obj->getConnect()->prepare($query);
                $stmt->bindValue(':ordonnance', $DataImage, PDO::PARAM_LOB);
                $stmt->bindValue(':CIN', $_GET['ID']);
                $stmt->bindValue(':date_rendez',$_GET['date']);
                $stmt->execute();
                $obj->close_connection();
                $em = "prescription added succesfuly ";
                $_SESSION['message'] = $em;
                header("Location:../dashboard.php?action=ulpoad_details&&ID=". $_GET['ID']) ;
            }

        }
        else {
            echo "error";
        }

    }