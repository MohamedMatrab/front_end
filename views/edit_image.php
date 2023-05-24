<?php
session_start();
$title = "Add Image";
ob_start();
?>
<?php
if (!isset($_GET['id'])) {
    header("Location: dashboard.php?action=portfolio");
    exit(0);
}
?>
<?php
include_once "Models/connect.php";
$obj = new connect();
$id = $_GET['id'];
$stmt_el = $obj->getConnect()->prepare("SELECT * FROM portfolio WHERE id=:id");
$stmt_el->bindValue(':id', $id);
$success_el = $stmt_el->execute();
if (!$success_el) {
    $em = "Prolem Getting this elements data ! it was deleted Probably!";
    header("Location: dashboard.php?action=portfolio&error=$em");
    exit(0);
}
$element = $stmt_el->fetch(PDO::FETCH_ASSOC);
?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
</head>
<?php include_once 'views/p_message.php' ?>
<div class="form-container">
    <form action="Models/update_pics.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="title">Title<span>*</span> :</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $element['title'] ?>" maxlength="50" required>
        </div>
        <div class="mb-3 ">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="6" maxlength="250"><?= $element['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="service_id">Select Service<span>*</span> :</label>
            <select name="service_id" class="form-select form-control" id="service_id" required>
                <?php
                $stmt = $obj->getConnect()->prepare("SELECT * FROM service");
                $success = $stmt->execute();
                if (!$success) {
                    $em = "Prolem Getting Services to Show ! make sure that services data exist !";
                    header("Location: dashboard.php?action=portfolio&error=$em");
                    exit(0);
                }
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $val = $row['service_id'];
                    $s_title = $row['title'];
                    $selected = $row['service_id'] == $element['service_id'] ? 'selected' : '';
                    echo "<option value='$val' $selected>$s_title</option>";
                }
                $obj->close_connection();
                ?>
            </select>

        </div>
        <div class="mb-3">
            <label for="my_image">Select Image<span>*</span> : </label>
            <input type="file" class="form-control" name="my_image" value="my_image" id="my_image">
        </div>
        <div class="mt-3">
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Update Image">
        </div>

    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>