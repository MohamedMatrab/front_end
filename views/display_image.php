<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
$title = "Image";
ob_start();
?>

<?php
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Accune image à afficher !";
    header("Location: index.php");
    exit(0);
}
$id = $_GET['id'];
include_once 'Models/connect.php';
$obj = new connect();
$stmt_img = $obj->getConnect()->prepare("SELECT * FROM historique WHERE id=$id");
$stmt_img->execute();
$image = $stmt_img->fetch(PDO::FETCH_ASSOC)['ordonnance'];
?>
<style>
    .container-image{
        text-align: center;
        margin-top: 8rem;
    }
    .image {
        width: 80%;
        height: auto;
        border-radius: 1rem;
    }
</style>

<div class="container-image">
    <img src="<?= 'data:image/jpg;base64,' . base64_encode($image) ?>" class="image">
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>
