<?php
include_once "Models/connect.php";
$conn = new connect();
$sql = "SELECT address,localisation,numero_1,email,facebook,instagram,twitter from centre";
$stmt = $conn->getConnect()->prepare($sql);
$stmt->execute();
$coord= $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DentAll</title>
  <!-- <link rel="stylesheet" href="style/bootstrap.min.css" /> -->
  <link rel="stylesheet" href="style/style-footer.css" />
</head>

<body>
  <!-- Footer -->
  <footer>
    <div class="footer-container">

      <!-- Center Info And Logo  -->

      <div class="footer-section">
        <h1>Dent<span id="dent_all">All</span></h1>
        <p>
          Far far away, behind the word mountains, far from the countries.
        </p>
        <section class="footer-icons">
          <a href="<?php echo isset($coord['facebook'])? $coord['facebook'] : '#' ;?>">
            <div class="icon-container">
              <i class="fa-brands fa-facebook fafooter"></i>
              <span class="tooltip">Facebook</span>
            </div>
          </a>
          <a href="<?php echo isset($coord['instagram'])? $coord['instagrem'] : '#' ;?>">
            <div class="icon-container">
              <i class="fa-brands fa-instagram fafooter"></i>
              <span class="tooltip">Instagram</span>
            </div>
          </a>
          <a href="<?php echo isset($coord['twitter'])? $coord['twitter'] : '#' ;?>">
            <div class="icon-container">
              <i class="fa-brands fa-twitter fafooter "></i>
              <span class="tooltip">Twitter</span>
            </div>
          </a>
        </section>
      </div>

      <!-- Explore Part -->
      <div class="footer-section">
        <h1>Explorer</h1>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>A props</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Contact</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Services</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Realisations</h3>
          </div>
        </a>

      </div>

      <!-- Heures d'ouvertures -->

      <div class="footer-section">
        <h1>Liens Utiles</h1>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Rejoignez-nous</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Blog</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Termes et Conditions</h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Privacy Policy</h3>
          </div>
        </a>
      </div>

      <!-- Adresse et info -->

      <div class="footer-section">
        <h1>Pour nous contacter :</h1>
        <a href="#">
          <div>
            <i class="fa-solid fa-location-dot"></i>
            <h3><?php echo isset($coord['address'])? $coord['address'] : '?' ;?></h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-phone"></i>
            <h3><?php echo isset($coord['numero_1'])? $coord['numero_1'] : '?' ;?></h3>
          </div>
        </a>
        <a href="#">
          <div>
            <i class="fa-solid fa-envelope"></i>
            <h3><?php echo isset($coord['email'])? $coord['email'] : '?' ;?></h3>
          </div>
        </a>
      </div>
    </div>
    <p id="rights-reserved">
      &copy; Centre Dentaire dentAll Casablanca. All rights reserved.
    </p>
  </footer>
</body>

</html>