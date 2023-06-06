<?php

   $title = "Dentiste:Centre Page" ;
   ob_start();

    include_once "Models/connect.php";



    $conn = new connect();
    $conn->photos_centreTable() ;
    $sql = "select photo_centre from photos_centre;";
    $stmt = $conn->getConnect()->prepare($sql);
    $stmt->execute();
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_2 = "select * from centre;";
    $stmt_2 = $conn->getConnect()->prepare($sql_2);
    $stmt_2->execute();
    $centre = $stmt_2->fetch(PDO::FETCH_ASSOC);
?>
<div class="landing-page">
    <h2 class="main-header">Centre</h2>
</div>
<div class="About">
    <div class="container">
        <div class="content mt-5">
            <p class="cl-h2 fs-6 fw-bold">Bienvenue dans DentAll</p>
            <h2 class="bv fs-4 pb-1">Nous Sommes DentAll à dentaire clinique</h2>
        </div>
        <div class="row">
            <div class="slide">
                <?php  if (count($photos) > 0 ) : ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php 
                            foreach( $photos as $key=>$value) {
                                if ($key == 0 ){
                            ?>   
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <?php
                            }else {
                                ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$key?>" aria-label="Slide <?=$key?>"></button>
                                <?php
                            }
                            } ?>
                    </div>
                    <div class="carousel-inner pb-3">
                    <?php   
                                foreach( $photos as $key=>$value) { 
                                    $image = 'data:image/jpg;base64,'.base64_encode($value['photo_centre']);
                                    echo $key ;
                                    if ($key == 0 ){
                                        ?>
                                            <div class="carousel-item active">
                                                <img src="<?=$image?>" class="d-block w-100" alt="...">
                                            </div>
                                        <?php 
                                    }else {
                                        ?>
                                            <div class="carousel-item">
                                                <img src="<?=$image?>" class="d-block w-100" alt="...">
                                            </div> 
                                        <?php
                                    }
                                    
                                } ?>
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> 
                <?php  endif ; ?>
                <?php  if (isset($centre['description']) &&  isset($centre['motivation'])) : ?>
                <div>
                    <h2 class="bv fs-4">Bienvenue à notre centre dentaire</h2>
                    <p><?php echo ($centre['description']); ?></p>
                </div>
                <div class="content">
                    <h2 class="bv fs-4">Pourquoi nous choisir ?</h2>
                    <p><?php echo ($centre['motivation']); ?></p>
                </div>
                <?php  endif ; ?>
            </div>
        </div> 
    </div>
    <?php  if (isset($centre['localisation']) &&  isset($centre['numero_1'])) : ?>
    <div class="bg-tr-txt pt-2 pb-2 mt-5 mb-5">
        <h1 class="contact-nous fs-4 fw-bold mb-5 mt-4">Contactez nous</h1>
        <div>
            <div class="local mb-2">
                <a href="<?php echo ($centre['localisation']); ?> "><i class="fas fa-map-marker-alt me-2"></i><?php echo ($centre['address']); ?></a>
            </div>
            <div class="tel mb-2">
                <a href="tel:<?php echo ($centre['numero_1']); ?> "><i class="fa-solid fa-phone me-2"></i><?php echo ($centre['numero_1']); ?> </a>
                <a  href="tel:<?php echo ($centre['numero_2']); ?>"><i class="fa-solid fa-phone me-2"></i><?php echo ($centre['numero_2']); ?></a>
            </div>
            <div class="mail mb-2">
                <a  href="mailto:<?php echo ($centre['email']); ?>"><i class="fa-solid fa-envelope me-2"></i><?php echo ($centre['email']); ?></a>
            </div>
        </div>
        <div>
            <a class="to-contact" href="">Contactez-nous +</a>
        </div>
    </div>
    <?php  endif ; ?>
</div>



<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 