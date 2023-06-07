<?php
if (isset($_SESSION['USER'])) {
    include_once 'connect.php';
    $obj = new connect();
    $obj->rendezVousTable();
    $obj->historiqueTable();
    $id = $_SESSION['USER']['id'];

    $query = "SELECT * FROM rendez_vous WHERE id_user = :id";
    $stmt_get_reservations = $obj->getConnect()->prepare($query);
    $stmt_get_reservations->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt_get_reservations->execute();

    $reservations = $stmt_get_reservations->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM historique WHERE id_user = :id";
    $stmt_get_historiques = $obj->getConnect()->prepare($query);
    $stmt_get_historiques->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt_get_historiques->execute();

    $historiques = $stmt_get_historiques->fetchAll(PDO::FETCH_ASSOC);

}
