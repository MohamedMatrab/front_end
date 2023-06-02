<?php
include_once "Models/connect.php";
$obj = new connect();
$obj->portfolioTable();
$obj->serviceTable();
function print_available_options($obj)
{
  $stmt = $obj->getConnect()->prepare("SELECT * FROM service");
  $success = $stmt->execute();
  if (!$success) {
    $_SESSION['message'] = "Problème d'affichage des services ! assurez-vous que les données des services existent !";
    header("Location: dashboard.php?action=portfolio");
    exit(0);
  }
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $val = $row['service_id'];
    $s_title = $row['title'];
    echo "<option value='$val'>$s_title</option>";
  }
}
function getElement($id,$obj)
{
  $stmt_el = $obj->getConnect()->prepare("SELECT * FROM portfolio WHERE id=:id");
  $stmt_el->bindValue(':id', $id);
  $success_el = $stmt_el->execute();
  if (!$success_el) {
    $_SESSION['message'] = "Problème d'obtention des données de cet élément ! il a été supprimé Probablement !";
    header("Location: dashboard.php?action=portfolio");
    exit(0);
  }
  return  $stmt_el->fetch(PDO::FETCH_ASSOC);
}
