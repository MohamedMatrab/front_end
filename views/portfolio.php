<?php

$title = "Dentiste: Portfolio";
ob_start();
?>
<link rel="stylesheet" href="style/style-portfolio.css">
<div class="landing-page">
  <h2 class="main-header">Works Portfolio</h2>
</div>
<div id="porfolio-page">
  <div class=" mt-3 mb-3 mygroup-select">
    <label for="Type Of Service">Services : </label>
    <select class="form-select" name="select-services" id="select-services">
      <option value="all">Tous</option>
      <option value="esthetique">Esthetique Dentaire</option>
      <option value="facettes">Facettes Dentaires</option>
      <option value="implants">Implants Dentaires</option>
      <option value="protheses">Protheses Dentaire</option>
      <option value="hollywood">Hollywood Smile</option>
      <option value="blanchiment">Blanchiment Dentaire</option>
      <option value="orthodontie">Orthodontie Invisible</option>
      <option value="soins">Soins Dentaires</option>
      <option value="pedodontie">Pédodontie</option>
    </select>
  </div>
  <div class="galerie-group">

    <div class="image-section esthetique all">
      <img src="assets\portfolio\photo19.jpg" alt="before and after" />
      <div class="description-image">
        <span>Esthetique Dentaire</span>
      </div>
    </div>
    <div class="image-section hollywood all">
      <img src="assets\portfolio\photo20.jpg" alt="before and after" />
      <div class="description-image">
        <span>hollywood smile</span>
      </div>
    </div>
    <div class="image-section facettes all">
      <img src="assets\portfolio\photo21.jpg" alt="before and after" />
      <div class="description-image">
        <span>Facettes Dentaires</span>
      </div>
    </div>
    <div class="image-section implants all">
      <img src="assets\portfolio\photo22.jpg" alt="before and after" />
      <div class="description-image">
        <span>Implants Dentaires</span>
      </div>
    </div>
    <div class="image-section protheses all">
      <img src="assets\portfolio\photo23.jpg" alt="before and after" />
      <div class="description-image">
        <span>Protheses Dentaires</span>
      </div>
    </div>
    <div class="image-section blanchiment all">
      <img src="assets\portfolio\photo24.jpg" alt="before and after" />
      <div class="description-image">
        <span>Blanchiment Dentaire</span>
      </div>
    </div>
    <div class="image-section orthodontie all">
      <img src="assets\portfolio\photo25.jpg" alt="before and after" />
      <div class="description-image">
        <span>Orthodontie Invisible</span>
      </div>
    </div>
    <div class="image-section soins all">
      <img src="assets\portfolio\photo26.jpg" alt="before and after" />
      <div class="description-image">
        <span>Soins Dentaires</span>
      </div>
    </div>
    <div class="image-section esthetique all">
      <img src="assets\portfolio\photo27.jpg" alt="before and after" />
      <div class="description-image">
        <span>Esthetique Dentaire</span>
      </div>
    </div>
    <div class="image-section pedodontie all">
      <img src="assets\portfolio\photo28.jpg" alt="before and after" />
      <div class="description-image">
        <span>Pédodontie</span>
      </div>
    </div>
  </div>
</div>
<script src="js/scriptP.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>