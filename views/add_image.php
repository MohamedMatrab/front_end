<?php
$title = "Add Image";
ob_start();
?>
<?php
include_once "Models/connect.php";
$obj = new connect();
?>

<head>
    <link rel="stylesheet" href="style/add-img-style.css">
</head>

<div class="form-container">
    <form action="Models/upload_portfolio_pics.php" method="POST" enctype="multipart/form-data">
        <?= isset($_GET['error']) ? '<h4 class="error" >' . $_GET['error'] . '</h4>' : ''; ?>
        <div class="mb-3 mt-3">
            <label for="title">Title<span>*</span> :</label>
            <input type="text" class="form-control" name="title" id="title" maxlength="50" required>
        </div>
        <div class="mb-3 ">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="6" maxlength="250"></textarea>
        </div>
        <div class="mb-3">
            <label for="description">Select Service<span>*</span> :</label>
            <select name="service_id" class="form-select form-control" id="service_id" required>
                <?php
                $stmt = $obj->getConnect()->prepare("SELECT * FROM service");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $val = $row['service_id'];
                    $s_title = $row['title'];
                    echo "<option value='$val'>$s_title</option>";
                }
                $obj->close_connection();
                ?>
            </select>

        </div>
        <div class="mb-3">
            <label for="image">Select Image<span>*</span> : </label>
            <input type="file" class="form-control" name="my_image" value="my_image" id="my_image" required>
        </div>
        <div class="mt-3">
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Add Image">
        </div>

    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>