<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$title = "Dentiste:Services";
ob_start();
?>
<?php
include_once 'Models/connect.php';
$obj = new connect();
$obj->serviveDetailsTabele();
$table = $obj->getConnect()->prepare("SELECT * FROM services");
$table->execute();
$services = $table->fetchAll(PDO::FETCH_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="style/main.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">

<div class="landing-page">
  <h2 class="main-header">Nos Spécialités</h2>
</div>
<main id="main">

  <!-- ======= Service Details Section ======= -->
  <section id="service-details" class="service-details">
    <div class="container" data-aos="fade-up">

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="services-list">
            <?php foreach ($services as $service) : ?>
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
            <?= $detail['descr1']; ?>
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
                    <?= $detail['descr2']; ?>
                  </p>

                </div>
              </div><!-- Features Item -->
            </div>
        <?php
            }
          }
        ?>
          </section><!-- End Service Details Section -->



        </div>


</main><!-- End #main -->

<script src="https://example.com/fontawesome/v5.15.4/js/all.js" data-search-pseudo-elements></script>
<script src="js/main.js"></script>


<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>