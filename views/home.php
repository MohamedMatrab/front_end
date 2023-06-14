<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$title = "Dentiste:Home Page";
ob_start();
include_once 'Models/connect.php';
$obj=new connect();
$obj->serviceTable();
$sql = "SELECT 	description,address,localisation,numero_1,email from centre";
$stmt = $obj->getConnect()->prepare($sql);
$stmt->execute();
$coord= $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="landing">
  <div class="content row">
    <div class="text col-12">
      <h1>Atteindre le sourire parfait désiré</h1>
      <p>Bienvenue dans dentall</p>
      <div class="row">
        <a class="col-lg-5 col-sm-12 btn btn-lang  me-lg-2 me-md-2 px-3 py-2 mb-sm-1 mb-lg-0" href="#service">Services</a>
        <a href="index.php?action=appoint" class="col-lg-6 col-sm-12 btn btn-lang px-3 py-2 ">Prendre un rendez-vous</a>
      </div>
    </div>
  </div>
</div>

<section id="about" class="about">
  <h2 class="main-heading px-3 py-1 text-align-center">A propos</h2>
  <div class="container ">
    <div class="row">
      <img src="assets/about/about.jpg" class="col-lg-6 col-sm-12" alt="">
      <div class="information col-lg-6 col-sm-12">
        <p><?php echo isset($coord['description']) ? $coord['description'] : "Pas d'information "?>
        </p>
        <a href="index.php?action=aboutcentre" class="More">Lire plus</a>
      </div>
    </div>
  </div>

</section>

<!--service secttion-->

<link rel="stylesheet" href="style/style.css">
<!--service secttion-->
<section id="service" class="services pt-0">
        <div class="container" data-aos="fade-up">
        <h2 class="main-heading px-3 py-1 text-align-center">Notre service</h2>
            <div class="row gy-4">
                <?php
                $table=$obj->getConnect()->prepare("SELECT * FROM services");
                $table->execute();
                $table=$table->fetchAll(PDO::FETCH_ASSOC);

                $table1=$obj->getConnect()->prepare("SELECT * FROM service_details");
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

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container">
  <h2 class="main-heading px-3 py-1 text-align-center">Contact</h2>
    <div class="section-title mt-5">
      <p> contactez nous pour plus d'informations</p>
    </div>

    <div class="row">

      <div class="col-lg-5 d-flex align-items-stretch">
        <div class="info">
          <div class="address">
            <div><i class="bi bi-geo-alt"></i></div>

            <div class="text-contact">
              <h4>Location:</h4>
              <p><?php echo isset($coord['address'])? $coord['address'] : '?' ;?></p>
            </div>

          </div>

          <div class="email">
            <div><i class="bi bi-envelope"></i></div>

            <div class="text-contact">
              <h4>Email:</h4>
              <p><a href="mailto:<?php echo isset($coord['email'])? $coord['email'] : '?' ;?>"><?php echo isset($coord['email'])? $coord['email'] : '?' ;?></a>
              <p>
            </div>

          </div>

          <div class="phone">
            <div><i class="bi bi-phone"></i></div>
            <div class="text-contact">
              <h4>appel:</h4>
              <p><a href="tel:<?php echo isset($coord['numero_1'])? $coord['numero_1'] : '?' ;?>"><?php echo isset($coord['numero_1'])? $coord['numero_1'] : '?' ;?></a>
              <p>
            </div>

          </div>

          <iframe src="<?php echo isset($coord['localisation'])? $coord['localisation'] : 'http://localhost/front_end/index.php?action=contact' ;?>" width="330" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
      </div>

      <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
        <form action="contact.php" method="POST" role="form" class="php-email-form">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name">Votre Nom</label>
              <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group col-md-6 mt-3 mt-md-0">
              <label for="email">Votre adresse e-mail</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
          </div>

          <div class="form-group mt-3">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="10" id="message" required></textarea>
          </div>


          <div class="text-center"><button type="submit">Envoyer Message</button></div>
        </form>
      </div>

    </div>

  </div>
</section><!-- End Contact Section -->

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>