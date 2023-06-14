<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'Models/connect.php';
$obj = new connect();
$title = "Users";
ob_start();
?>

    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item ">Dashboard</li>
            <li class="breadcrumb-item ">Users</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include 'views/p_message.php'; ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Registered User
                            <a href="dashboard.php?action=add_admin" class="btn btn-primary float-end">Add admin</a>
                        </h4>
                        <div class="card-body">
                        <div class="mb-4">
                            <form method="GET" action="">
                                <div class="input-group">
                                    <input type="hidden" name="action" class="form-control" value="users">
                                    <input type="text" name="search_email" class="form-control" placeholder="Search by email">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                        <div class="card-body">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>CIN</th>
                                        <th>Image</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_SESSION['USER']['id'];
                                    
                                    if($_SESSION['USER']['role'] == 2){
                                        $request = $obj->getConnect()->prepare("SELECT * FROM users WHERE role IN (0, 2) AND id != $id ");
                                    }
                                    else
                                        $request = $obj->getConnect()->prepare("SELECT * FROM users WHERE id != $id");

                                    $search_email = isset($_GET['search_email']) ? $_GET['search_email'] : '';
                                    if (!empty($search_email)) {
                                        $request = $obj->getConnect()->prepare("SELECT * FROM users WHERE id != :id AND email LIKE :search_email");
                                        $request->bindValue(':id', $id);
                                        $request->bindValue(':search_email', "%$search_email%", PDO::PARAM_STR);
                                    }

                                    $request->execute();


                                    $count = $request->rowCount();
                                    if ($count > 0) {
                                        foreach ($request as $row) {
                                            if (!empty($search_email) && stripos($row['email'], $search_email) === false) {
                                                continue;
                            }
                                    ?>
                                            <tr>
                                                <td><?= $row['cin']; ?></td>
                                                <td class="image-cell img"><img src="<?= empty($row['img']) ? "assets/images/user_image.png" : 'data:image/jpg;base64,' . base64_encode($row['img']); ?>" alt="profile" class="profile-img" /></td>
                                                <td><?= $row['fname']; ?></td>
                                                <td><?= $row['lname']; ?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td>
                                                    <?php
                                                    if($row['role'] == 1){
                                                        echo 'Admin';
                                                    }
                                                    elseif($row['role'] == 0){
                                                        echo 'User';
                                                    }
                                                    else{
                                                        echo 'Secrétaire';
                                                    }
                                                    ?>
                                                </td>
                                                <td><a href="dashboard.php?action=edit_user_info&id=<?= $row['id']; ?>" class="btn btn-success">Edit</a></td>
                                                <td>
                                                    <form action="Models/handle_users.php" method="POST">
                                                        <button type="submit" name="delete_user" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }  if ($request->rowCount() === 0) {
                                        ?>
                                        <tr>
                                            <td colspan="6">No records found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>
