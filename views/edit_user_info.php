<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
$title = "Edit user's info";
include_once "Models/connect.php";
$obj = new connect();
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Users</li>
        </ol>
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
                                                    <option value="1" <?= $user['role'] == '1' ? 'selected' : ''; ?>>Admin</option>
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

</body>

</html>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>