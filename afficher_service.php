<?php
session_start();
include_once 'connect.php';


$query=$connect->prepare("SELECT * FROM services");
$query->execute();
$query1=$connect->prepare("SELECT * FROM service_details");
$query1->execute();
$count=$query->rowCount();
$count1=$query1->rowCount();

$query=$query->fetchAll();
$query1=$query1->fetchAll();

$search = isset($_GET['search_name']) ? $_GET['search_name'] : '';
if(!empty($search)){
    $query = $connect->prepare("SELECT * FROM services WHERE Nom_du_service LIKE :search");
    $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $query->execute();
    $count = $query->rowCount();
    $query = $query->fetchAll();
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <style>
        tr th{
            width:70px;
        }
        
    </style>

</head>
<body>


        



                                    
    <!-- Modal -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            
            <form id="myForm" action="add_service.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Service name</label>
                    <textarea  name="name" class="form-control" rows="2" placeholder="Enter your service"></textarea>
                    
                </div>
                <div class="form-group">
                    <label>proverb</label>
                    <textarea name="proverb" class="form-control" rows="3" placeholder="Enter proverb"></textarea>
                </div>
                <div class="form-group">
                    <label>Image 1</label>
                    <input type="file" name="img1" class="form-control" name="image1">
                </div>
                <div class="form-group">
                    <label for="">description 1</label>
                    <textarea name="desc1" class="form-control" rows="12" placeholder="Enter your description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">title 1</label>
                    <textarea  cols="30" rows="4" name="title1" class="form-control" placeholder="Enter your title">
                </textarea>
                </div> 
                <div class="form-group">
                    <label>Image 2</label>
                    <input type="file" name="img2" class="form-control" name="image2">
                </div>
                <div class="form-group">
                    <label for="">title 2</label>
                    <textarea  cols="30" rows="4" name="title2" class="form-control" placeholder="Enter your title">
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">description 2</label>
                    <textarea name="desc2" class="form-control" rows="12" placeholder="Enter your description"></textarea>
                </div>
                <div class="form-group">
                    <label>Image 3</label>
                    <input type="file"  name="img3" class="form-control" name="image2">
                </div>
                <div class="form-group">
                    <label for="">title 3</label>
                    <textarea  cols="30" rows="4" name="title3" class="form-control" placeholder="Enter your title">
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">description 3</label>
                    <textarea name="desc3" class="form-control" rows="12" placeholder="Enter your description"></textarea>
                </div>
               
                
                
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" form="myForm" name="save" class="btn btn-primary">Save Changes</button>
        </div>
        </div>
    </div>
    </div>


    
    



    <div class="container-fluid px-4">
        <div>
        <h1 class="mt-4">Services</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item ">Services</li>
        </div>
        <div class="msg d-flex justify-content-center">
            <?php  include 'message.php'; ?>
        </div>
       
    </ol>
        <div class ="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="overflow-x: auto;">
                        <h4>Category
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            add service
                            </button>
                        </h4>
                        <div class="card-body">
                            <div class="mb-4">
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <input type="text" name="search_name" class="form-control" placeholder="Search by name">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class ="card-body">
                        <div class="table-respnsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            
                            
                            <th>Service name</th>
                            <th>proverb</th>
                            <th>Descripion 1</th>
                            <th>title 1</th>
                            <th>Descripion 2</th>
                            <th>title 2</th>
                            
                            <th>Image 1</th>
                            <th>Image 2</th>
                            <th>Image 3</th>
                            <th>Edit</th>
                            <th>delete</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            
                            if($count > 0 && $count1 >0){

                                foreach($query as $key=>$row ){
                                    $details = array_filter($query1, function ($details) use ($row) {
                                        return $details['id_service'] == $row['ID'];
                                    });
                                    if (!empty($details)) {
                                        $detail = current($details);
                                        
                                    ?>
                                <tr>
                                    
                                    <td><?= $row['Nom_du_service']; ?></td>
                                    <td><?=  $detail['proverb']; ?></td>
                                    <td>
                                        <?php
                                        $texte =  $detail['descr1'];
                                        $texte_tronque = substr($texte, 0, 50);
                                        echo $texte_tronque . '...';
                                        ?>
                                        <a href="#" data-texte="<?php echo $texte; ?>" onclick="showModal(this)">Afficher la suite</a>
                                    </td>

                                    <!-- Code HTML pour le modal -->
                                    <div id="myModal" style="display: none;">
                                        <div id="modalContent">
                                            <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
                                            <p id="modalText"></p>
                                        </div>
                                    </div>
                                    
                                    <td><?=  $detail['title1']; ?></td>

                                    <td>
                                        <?php
                                        $texte =  $detail['descr2'];
                                        $texte_tronque = substr($texte, 0, 50);
                                        echo $texte_tronque . '...';
                                        ?>
                                        <a href="#" data-texte="<?php echo $texte; ?>" onclick="showModal(this)">Afficher la suite</a>
                                    </td>

                                    <!-- Code HTML pour le modal -->
                                    <div id="myModal" style="display: none;">
                                        <div id="modalContent">
                                            <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
                                            <p id="modalText"></p>
                                        </div>
                                    </div>
                                   
                                    <td><?=  $detail['title2']; ?></td>
                                    
                                    
                                    <td><img src="upload/<?php echo  $detail['image1']; ?>" width="100px" height="100px"></td>
                                    <td><img src="upload/<?php echo $ $detail['image2']; ?>" width="100px" height="100px"></td>
                                    <td><img src="upload/<?php echo  $detail['image3']; ?>" width="100px" height="100px"></td>
                                    
                                    <td>
                                       <form action="update_service.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?= $row['ID']; ?>">
                                            <button type="submit" name="edit"  class="btn btn-success">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?= $row['ID']; ?>">
                                            <button type="submit" name="delete"  class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
</td>
                                </tr>
                                <?php
                                    }
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    function showModal(element) {
        var texte = element.getAttribute("data-texte");
        document.getElementById("modalText").innerText = texte;
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>






</body>
</html>

    