<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = 'Editer Service';
ob_start();
?>
<?php
include_once 'Models/connect.php';
$obj = new connect();

if (isset($_POST['update'])) {

    $service_name = $_POST['name'];
    $Id = $_POST['id'];
    $proverb = $_POST['proverb'];
    $desc1 = $_POST['desc1'];
    $title1 = $_POST["title1"];
    $desc2 = $_POST['desc2'];
    $title2 = $_POST["title2"];
    $desc3 = $_POST['desc3'];
    $title3 = $_POST["title3"];

    // Vérifier si de nouvelles images sont sélectionnées pour chaque champ
    if (!empty($_FILES['img1']['name'])) {
        $new_img1 = $_FILES['img1']['name'];
        move_uploaded_file($_FILES['img1']['tmp_name'], "upload/" . $new_img1);
    } else {
        // Vérifier s'il y a une image existante pour ce champ
        $query_img1 = $obj->getConnect()->prepare("SELECT image1 FROM service_details WHERE id_service = :Id");
        $query_img1->bindParam(':Id', $Id, PDO::PARAM_INT);
        $query_img1->execute();
        $result_img1 = $query_img1->fetch(PDO::FETCH_ASSOC);

        if ($result_img1['image1']) {
            $new_img1 = $result_img1['image1']; // Conserver l'image existante
        } else {
            $new_img1 = NULL; // Pas d'image existante ni nouvelle image sélectionnée
        }
    }

    if (!empty($_FILES['img2']['name'])) {
        $new_img2 = $_FILES['img2']['name'];
        move_uploaded_file($_FILES['img2']['tmp_name'], "upload/" . $new_img2);
    } else {
        // Vérifier s'il y a une image existante pour ce champ
        $query_img2 = $obj->getConnect()->prepare("SELECT image2 FROM service_details WHERE id_service = :Id");
        $query_img2->bindParam(':Id', $Id, PDO::PARAM_INT);
        $query_img2->execute();
        $result_img2 = $query_img2->fetch(PDO::FETCH_ASSOC);

        if ($result_img2['image2']) {
            $new_img2 = $result_img2['image2']; // Conserver l'image existante
        } else {
            $new_img2 = NULL; // Pas d'image existante ni nouvelle image sélectionnée
        }
    }
    if (!empty($_FILES['img3']['name'])) {
        $new_img3 = $_FILES['img3']['name'];
        move_uploaded_file($_FILES['img3']['tmp_name'], "upload/" . $new_img3);
    } else {
        // Vérifier s'il y a une image existante pour ce champ
        $query_img3 = $obj->getConnect()->prepare("SELECT image3 FROM service_details WHERE id_service = :Id");
        $query_img3->bindParam(':Id', $Id, PDO::PARAM_INT);
        $query_img3->execute();
        $result_img3 = $query_img3->fetch(PDO::FETCH_ASSOC);

        if ($result_img3['image3']) {
            $new_img3 = $result_img3['image3']; // Conserver l'image existante
        } else {
            $new_img3 = NULL; // Pas d'image existante ni nouvelle image sélectionnée
        }
    }

    // Mettre à jour les données dans la base de données
    $query_run = $obj->getConnect()->prepare("UPDATE services SET Nom_du_service = :service_name WHERE ID = :Id");
    $query_run->bindParam(':service_name', $service_name);
    $query_run->bindParam(':Id', $Id, PDO::PARAM_INT);
    $sucess_run = $query_run->execute();

    $query2 = $obj->getConnect()->prepare("UPDATE service_details SET proverb = :proverb, descr1 = :desc1, title1 = :title1, descr2 = :desc2, title2 = :title2, image1 = :new_img1, image2 =:new_img2, image3 =:new_img3 WHERE id_service = :Id");
    $query2->bindParam(':proverb', $proverb);
    $query2->bindParam(':desc1', $desc1);
    $query2->bindParam(':title1', $title1);
    $query2->bindParam(':desc2', $desc2);
    $query2->bindParam(':title2', $title2);
    $query2->bindParam(':new_img1', $new_img1);
    $query2->bindParam(':new_img2', $new_img2);
    $query2->bindParam(':new_img3', $new_img3);
    $query2->bindParam(':Id', $Id, PDO::PARAM_INT);
    $sucess2 = $query2->execute();

    // Rediriger vers la page services.php après la mise à jour
    if ($sucess2 && $sucess_run) {
        $_SESSION['message'] = 'Runned Successflly';
        header("Location: dashboard.php?action=service");
    } else {
        $_SESSION['message'] = 'Problem !';
        header("Location: dashboard.php?action=update_service");
    }
    exit(0);
}
?>

<style>
    tr th {
        width: 70px;
    }
</style>

<div class="landing-page">
  <h2 class="main-header">Editer Le Service</h2>
</div>
<div class="container-fluid px-4" style="margin-top:3rem">
    <div class="msg d-flex justify-content-center">
        <?php include 'views/floating_message.php'; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category
                        <!-- Button trigger modal -->
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['edit'])) {
                        $id = $_POST['edit_id'];


                        $query = $obj->getConnect()->prepare("SELECT * FROM services WHERE ID='$id'");
                        $query->execute();
                        $query1 = $obj->getConnect()->prepare("SELECT * FROM service_details WHERE id_service='$id'");
                        $query1->execute();
                        $count = $query->rowCount();
                        $count1 = $query1->rowCount();
                        $query = $query->fetchAll();
                        $query1 = $query1->fetchAll();

                        if ($count > 0 && $count1 > 0) {
                            foreach ($query as $key => $row) {
                    ?>
                                <form action="dashboard.php?action=update_service" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="edit_id" value="<?= $row['ID']; ?>">
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Service name :</b></label>
                                        <textarea name="name" rows="2" class="form-control"><?= $row['Nom_du_service']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>proverb :</b></label>
                                        <textarea name="proverb" rows="4" class="form-control"><?= $query1[$key]['proverb']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Description 1 :</b></label>
                                        <textarea name="desc1" rows="7" class="form-control"><?= $query1[$key]['descr1']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>title 1 :</b></label>
                                        <textarea name="title1" rows="2" class="form-control"><?= $query1[$key]['title1']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Description 2: </b></label>
                                        <textarea name="desc2" rows="7" class="form-control"><?= $query1[$key]['descr2']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>title 2:</b></label>
                                        <textarea name="title2" rows="2" class="form-control"><?= $query1[$key]['title2']; ?></textarea>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Image 1: </b></label>
                                        <input type="file" name="img1" class="form-control">
                                        <img src="upload/<?php echo $query1[$key]['image1']; ?>" width="100px" height="100px">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Image 2: </b></label>
                                        <input type="file" name="img2" class="form-control">
                                        <img src="upload/<?php echo $query1[$key]['image2']; ?>" width="100px" height="100px">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for=""><b>Image 3: </b></label>
                                        <input type="file" name="img3" class="form-control">
                                        <img src="upload/<?php echo $query1[$key]['image3']; ?>" width="100px" height="100px">
                                    </div>
                                    <br>
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" name="update" class="btn btn-success">Update</button>
                                        <a href="dashboard.php?action=service" class="btn btn-danger">CANCEL</a>
                                    </div>
                </div>
                </form>
    <?php

                            }
                        }
                    }


    ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>