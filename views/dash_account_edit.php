<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Account";
ob_start();
?>

<?php
include_once 'Models/connect.php';
$obj = new connect();
?>
<link rel="stylesheet" href="account.css">

<style>
    .imge {
        text-align: center;
    }
    .imge img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }
    .container-fluid{
        margin-top: 2rem !important;
    }
</style>
<div class="landing-page">
    <h2 class="main-header">Account</h2>
</div>
<div class="container-fluid px-4" >
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>les informations</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['USER'])) {
                        $user_id = $_SESSION['USER']['id'];
                        $requet_user = $obj->getConnect()->prepare("SELECT * FROM users WHERE id='$user_id'");
                        $requet_user->execute();
                        $count = $requet_user->rowCount();
                        if ($count > 0) {
                            foreach ($requet_user as $user) {
                    ?>
                                <form action="Models/modifier_infos.php" enctype="multipart/form-data" method="POST">
                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fname">First name</label>
                                            <input type="text" name="fname" id="fname" value="<?= $user['fname']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lname">Last name</label>
                                            <input type="text" name="lname" id="lname" value="<?= $user['lname']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" value="<?= $user['email']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cin">CIN</label>
                                            <input type="text" name="cin" id="cin" value="<?= $user['cin']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone">phone</label>
                                            <input type="text" name="phone" id="phone" value="<?= $user['phone_num']; ?>" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" id="image" name="image" accept="image/jpeg, image/jpg, image/png" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <button type="submit" name="modifier" class="btn btn-primary">Update informations</button>
                                            <a href="account.php" class="btn btn-danger">CANCEL</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>