<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'Models/connect.php';
$obj = new connect();
?>

<link rel="stylesheet" href="style/account.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <?php include 'floating_message.php'; ?>
                <?php
                if (isset($_SESSION['USER'])) {

                    $id_sel = $_SESSION['USER']['id'];

                    $req = $obj->getConnect()->prepare("SELECT * FROM users WHERE role = '1' AND id = :id_sel");
                    $req->bindValue(':id_sel', $id_sel, PDO::PARAM_INT);
                    $req->execute();

                    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

                        $admin_id = $row['id'];
                        $full_name = $row['fname'] . ' ' . $row['lname'];
                        $admin_email = $row['email'];
                        $admin_cin = $row['cin'];
                        $admin_phone = $row['phone_num'];
                        $image = $row['img'];
                    }
                ?>
                    <div class="profile-img2">
                        <img src="<?= empty($image) ? "assets/images/user_image.png" : 'data:image/jpg;base64,' . base64_encode($image); ?>" alt="profile" class="profile-img2" />

                    </div>
            </div>

            <div class="col-md-7 offset-md-1">
                <div class="row">
                    <div class="col-8">
                        <div class="profile-head">
                            <h5>
                                <?= $full_name; ?>
                            </h5>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="dashboard.php?action=edit_account" type="submit" class="btn btn-success" name="btnAddMore">Edit Profile</a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $full_name; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $admin_email; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>CIN</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= empty($admin_cin) ? 'champ vide' : $admin_cin; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $admin_phone; ?></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    <?php
                } ?>
                    </div>
                </div>
            </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>