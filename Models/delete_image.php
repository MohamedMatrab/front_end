<?php
session_start();
header('Content-Type: application/json');
if (isset($_POST['image_id'])) {
    include_once "../Models/connect.php";
    $id = $_POST['image_id'];
    $obj = new connect();
    try {
        $stmt = $obj->getConnect()->prepare('DELETE FROM portfolio WHERE id=' . $id);
        $success = $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur Survenue :" . $e->getMessage();
    }
    if ($success) {
        echo json_encode(['success' => true]);
        $_SESSION['message'] = "Supprimé avec succès !";
    } else {
        echo json_encode(['success' => false]);
        $_SESSION['message'] = "Erreur lors de la suppression de l'image !";
    }
}
