<?php
include_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentcare</title>
    <link rel="stylesheet" href="style.css">
    <link href="ASSET/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <!--service secttion-->
    <section id="service" class="services pt-0">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Check our services</h2>
            </div>
            <div class="row gy-4">
                <?php
                $table=$connect->prepare("SELECT * FROM services");
                $table->execute();
                $table=$table->fetchAll(PDO::FETCH_ASSOC);
                
                
                $table1=$connect->prepare("SELECT * FROM service_details");
                $table1->execute();
                $table1=$table1->fetchAll(PDO::FETCH_ASSOC);
                
                
                
                foreach($table as $key1 => $tabb){
                    ?>
                    <div class="col-lg-3 col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="upload/<?= $table1[$key1]['image1']; ?>" alt="" class="img-fluid">
                            </div>
                            <h3><a href="service_details.php?service=<?= $tabb['ID'] ?>" class="stretched-link"><?= $tabb['Nom_du_service']; ?></a></h3>
                            <p><?= substr($table1[$key1]['descr1'],0,100) ?>...</p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>