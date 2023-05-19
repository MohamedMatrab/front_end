<?php
session_start();
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
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
     <li class="breadcrumb-item active">Dashboard</li>
     <li class="breadcrumb-item ">Users</li>
</ol>
<div class ="row">
    <div class="col-md-12">
        <?php include 'message.php'; ?>
        <div class="card">
            <div class="card-header">
                <h4>Registered User
                   <a href="add_admin.php"  class="btn btn-primary float-end">Add admin</a>
                   </h4>
            <div class ="card-body">
            </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $request = $connect->prepare("SELECT * FROM users ");
                        $request->execute(); 
                        $count = $request->rowCount();
                        if ($count > 0) {
                            foreach ($request as $row) {
                                ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['fname']; ?></td>
                                    <td><?= $row['lname']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td>
                                        <?php
                                        if($row['role'] == 1){
                                            echo 'Admin';
                                        }
                                        elseif($row['role'] == 0){
                                            echo 'user';
                                        }
                                        else{
                                            echo 'secrétaire';
                                        }
                                        ?>
                                    </td>
                                    <td><a href="edit_register.php?id=<?= $row['id']; ?>" class="btn btn-success">Edit</a></td>
                                    <td>
                                    <form action="code_edituser.php" method="POST">
                                        <button type="submit" name="delete_user" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
                                    </form>
</td>
                                </tr>
                                <?php
                            }
                        } else {
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
</body>
</html>
