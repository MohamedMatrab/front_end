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
$table = $obj->getConnect()->prepare("SELECT * FROM services");
$table->execute();
$services = $table->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="style/style.css">

<div class="landing-page">
  <h2 class="main-header">Service Details
</h2>
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
              <a href="index.php?action=service&service=<?= $service['ID'] ?>" <?= $isActive ? 'class="active"' : '' ?>>
                <?= $service['Nom_du_service'] ?>
              </a>
            <?php endforeach; ?>
          </div>
          <?php
          if (isset($_GET['service'])) {
            $selectedService = $_GET['service'];
            $table_detail = $obj->getConnect()->prepare("SELECT * FROM service_details WHERE id_service = :service_id");
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


<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>