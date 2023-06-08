<?php
include_once 'connect.php';

$table = $connect->prepare("SELECT * FROM services");
$table->execute();
$services = $table->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentcare</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/main.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">

    <script src="https://example.com/fontawesome/v5.15.4/js/all.js" data-search-pseudo-elements ></script>

    
</head>
<body>
    
<nav class="navbar navbar-expand-lg sticky-top navbar-light">
        <div class="container">
            <div class="head-top mb-1 row">
                <div class="contact col-8 ">
                    <i class="fa-solid fa-phone fs-6 "></i>
                    <a class="fs-6" href="tel:+212648256644">Call Us +212 6 48 25 66 44</a>
                </div>
                <div class="social d-flex justify-content-between align-items-center col-2">
                    <a  href=""><i class="fa-brands fa-instagram"></i></a>
                    <a  class="d-block ms-2" href=""><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
            <div class="logo-toggler">
                    <a class="nav-link me-3  " aria-current="page" href="index.php">Dent<span>All</span></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        <div class="collapse navbar-collapse shadow p-2 mb-1 mt-1 " id="navbarSupportedContent">
            <ul class="navbar-nav me-3 mb-2 mb-lg-0 align-items-center ">
                <li class="logo">
                    <a class="nav-link me-3" aria-current="page" href="index.php">Dent<span>All</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Centre</a></li>
                        <li><a class="dropdown-item" href="#">Doctor</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Spécialités
                </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Esthétique dentaire</a></li>
                        <li><a class="dropdown-item" href="#">Blanchement</a></li>
                        <li><a class="dropdown-item" href="#">Hollywood smile</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Réalistaions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Actualités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Témoingnages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Contact</a>
                </li>
                <li class="nav-item mt-sm-2 mt-lg-0">
                    <a class="nav-link rdv" aria-current="page" href="index.php?action=appoint">Rendez-vous</a>
                </li>
                <div class="d-flex align-items-center ms-1 mt-sm-2 mt-lg-0">
                    <a class=" btn-log   " aria-current="page" href="#">LOGIN</a>
                </div>
            </ul>
            
        </div>
    </div>
    </nav>
    

  <main id="main">

  <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h3>Service Details</h3>
          
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="service.php">Home</a></li>
            <li>Service Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Service Details Section ======= -->
    <section id="service-details" class="service-details">
        <div class="container" data-aos="fade-up">
  
          <div class="row gy-4">
  
            <div class="col-lg-4">
            <div class="services-list">
                <?php foreach ($services as $service): ?>
                    <?php
                    $isActive = false;
                    if (isset($_GET['service']) && $_GET['service'] == $service['ID']) {
                    $isActive = true;
                    }
                    ?>
                    <a href="service_details.php?service=<?= $service['ID'] ?>" <?= $isActive ? 'class="active"' : '' ?>>
                    <?= $service['Nom_du_service'] ?>
                    </a>
                <?php endforeach; ?>
                </div>
              <?php
              if (isset($_GET['service'])) {
                $selectedService = $_GET['service'];
                $table_detail = $connect->prepare("SELECT * FROM service_details WHERE id_service = :service_id");
                $table_detail->bindParam(':service_id', $selectedService);
                $table_detail->execute();
                $details = $table_detail->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($details)) {
                    $detail = $details[0];
                    ?>

                    <h4><?= $detail['proverb'] ?></h4>
                    <p></p>
                    </div>

  
                    <div class="col-lg-8">
                    <img src="upload/<?= $detail['image2']; ?>" alt="" class="img-fluid services-img">
                    
                    <p>
                        <?=$detail['descr1']; ?>
                    </p>

                   <section id="features" class="features">
                        <div class="container">

                            <div class="row gy-4 align-items-center features-item" data-aos="fade-up">

                            <div class="col-md-5">
                                <img src="upload/<?= $detail['image3']; ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-7">
                                <h3><?= $detail['title1']; ?></h3>
                                <p class="fst-italic">
                                   <?=$detail['descr2']; ?>
                                </p>
                                
                            </div>
                            </div><!-- Features Item -->
                            </div>
                            <?php
                }}
                            ?>
      </section><!-- End Service Details Section -->
              
            
                
          </div>

          
    
  
    </main><!-- End #main -->

    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>



  

    
</body>
</html>

