<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Edit user's info";
ob_start();
?>
<?php
include_once "Models/connect.php";
$obj = new connect();
?>
<div class="container-fluid px-4" style="margin-top: 2rem;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $user_id = $_GET['id'];
                        $requet_user = $obj->getConnect()->prepare("SELECT * FROM users WHERE id='$user_id'");
                        $requet_user->execute();
                        $count = $requet_user->rowCount();
                        if ($count > 0) {
                            foreach ($requet_user as $user) {
                    ?>
                                <form action="Models/handle_users.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fname">First name</label>
                                            <input type="text" name="fname" value="<?= $user['fname']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lname">Last name</label>
                                            <input type="text" name="lname" value="<?= $user['lname']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="role">Role</label>
                                            <select name="role" required class="form-control" id="role">
                                                <option value="">Select
                                                    <?php
                                                    if ($_SESSION['USER']['role'] == 1) {
                                                        echo "<option value='1' " . ($user['role'] == '1' ? 'selected' : '') . ">Admin</option>";
                                                    }
                                                    ?>
                                                <option value="0" <?= $user['role'] == '0' ? 'selected' : ''; ?>>User</option>
                                                <option value="2" <?= $user['role'] == '2' ? 'selected' : ''; ?>>Secrétaire</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" name="update" class="btn btn-primary">Update User</button>
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