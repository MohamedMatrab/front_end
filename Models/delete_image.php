<?php
header('Content-Type: application/json');
if (isset($_POST['image_id'])) {
    include_once "../Models/connect.php";
    $id = $_POST['image_id'];
    $obj = new connect();
    try {
        $stmt = $obj->getConnect()->prepare('DELETE FROM portfolio WHERE id=' . $id);
        $success = $stmt->execute();
    } catch (PDOException $e) {
        echo "ther is an error " . $e->getMessage();
    }
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
