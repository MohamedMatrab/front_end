<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mon compte</title>
    <link rel="stylesheet" href="account.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <style>
        .imge{
            text-align: center;
}

        .imge img{
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

   
</head>
<body>

<div class="container-fluid px-4">
    <h1 class="mt-4">account</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">acount</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>les informations</h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])){
                        $user_id=$_GET['id'];
                        $requet_user=$connect->prepare("SELECT * FROM users WHERE id='$user_id'");
                        $requet_user->execute();
                        $count=$requet_user->rowCount();
                        if($count > 0){
                            foreach($requet_user as $user){
                                ?>
                            <form action="modifier_infos.php" enctype="multipart/form-data" method="POST">
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
                                        <label for="cin">CIN</label>
                                        <input type="text" name="cin" value="<?= $user['cin']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">phone</label>
                                        <input type="text" name="phone" value="<?= $user['phone_num']; ?>" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="imge">
                                            
                                            <label for="image">Image</label>
                                            <?php if (!empty($user['img'])): ?>
                                                <img src="data:image/jpg;base64,<?= base64_encode($user['img']); ?>" alt="User Image">
                                            <?php else: ?>
                                                <img src="images/user.png" alt="Default Image">
                                            <?php endif; ?>
                                            <input type="file" name="image" accept="image/jpeg, image/jpg, image/png"  class="form-control" /> 
                                        </div>
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

</body>
</html>