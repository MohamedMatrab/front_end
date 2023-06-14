<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include_once "Models/connect.php";
$conn = new connect();
$sql = "SELECT address,localisation,numero_1,email from centre";
$stmt = $conn->getConnect()->prepare($sql);
$stmt->execute();
$coord= $stmt->fetch(PDO::FETCH_ASSOC);
$title = "Dentiste:Appointment Page";
ob_start();
?>
<link rel="stylesheet" href="style/style.css">
<div class="landing-page" style="margin-bottom:2rem">
  <h2 class="main-header">Contact</h2>
</div>
<?php include_once 'in_contact.php'?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>