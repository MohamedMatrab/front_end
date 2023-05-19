<?php
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
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add admin/secrétaire
                        <a href="dashboard_2.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php include 'message.php'; ?>
                <form action="code_edituser.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fname">First name</label>
                            <input type="text" name="fname" value="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname">Last name</label>
                            <input type="text" name="lname" value="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <select name="role" required class="form-control" id="role">
                                <option value="">Select
                                <option value="1" >Admin</option>
                                <option value="0" >User</option>
                                <option value="2" >Secrétaire</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="submit" name="add_admin" class="btn btn-primary">Add </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>