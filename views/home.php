<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$title = "Dentiste:Home Page";
ob_start();
include_once 'Models/connect.php';
$obj = new connect();
$obj->serviceTable();
$sql = "SELECT 	description,address,localisation,numero_1,email from centre";
$stmt = $obj->getConnect()->prepare($sql);
$stmt->execute();
$coord = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="landing">
  <div class="content row">
    <div class="text col-12">
      <h1>Atteindre le sourire parfait désiré</h1>
      <p>Bien au-delà des montagnes, loin des vastes étendues rurales</p>
      <div class="row">
        <a class="col-lg-5 col-sm-12 btn btn-lang  me-lg-2 me-md-2 px-3 py-2 mb-sm-1 mb-lg-0" href="#service">VOIR NOS SERVICES</a>
        <a href="index.php?action=appoint" class="col-lg-6 col-sm-12 btn btn-lang px-3 py-2 ">PRENEZ RENDEZ-VOUS</a>
      </div>
    </div>
  </div>
</div>

<section id="about" class="about">
  <h2 class="main-heading px-3 py-1 text-align-center">ABOUT</h2>
  <div class="container ">
    <div class="row">
      <img src="assets/about/about.jpg" class="col-lg-6 col-sm-12" alt="">
      <div class="information col-lg-6 col-sm-12">
        <p><?php echo isset($coord['description']) ? $coord['description'] : "Pas d'information "?></p>
        <a href="index.php?action=aboutcentre" class="More">Afficher plus</a>
      </div>
    </div>
  </div>

</section>

<!--service secttion-->

<link rel="stylesheet" href="style/style.css">
<!--service secttion-->
<section id="service" class="services pt-0">
  <h2 class="main-heading px-3 py-1 text-align-center">CONSULTEZ NOS SERVICES</h2>
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">
      <?php
      $table = $obj->getConnect()->prepare("SELECT * FROM services");
      $table->execute();
      $table = $table->fetchAll(PDO::FETCH_ASSOC);

      $table1 = $obj->getConnect()->prepare("SELECT * FROM service_details");
      $table1->execute();
      $table1 = $table1->fetchAll(PDO::FETCH_ASSOC);

      foreach ($table as $key1 => $tabb) {
      ?>
        <div class="col-lg-3 col-md-3" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <div class="card-img">
              <img src="upload/<?= $table1[$key1]['image1']; ?>" alt="" class="img-fluid">
            </div>
            <h3><a href="index.php?action=service&service=<?= $tabb['ID'] ?>" class="stretched-link"><?= $tabb['Nom_du_service']; ?></a></h3>
            <p><?= substr($table1[$key1]['descr1'], 0, 100) ?>...</p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<!-- ======= Contact Section ======= -->
<h2 class="main-heading px-3 py-1 mb-0 text-align-center">CONTACT</h2>
<div class="section-title">
  <p> contactez nous pour plus d'informations</p>
</div>
    
<?php include_once 'in_contact.php'?>

<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>