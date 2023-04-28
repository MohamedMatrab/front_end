<?php
$title = "Dentiste: Portfolio";
ob_start();
?>

<?php
include_once "Models/connect.php";
function print_available_options()
{
  $conn = new connect();
  $sql = "SELECT * FROM service;";
  $stmt = $conn->getConnect()->prepare($sql);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $s_id = $row['service_id'];
    $s_title = $row['title'];
    echo "<option value='$s_id'>$s_title</option>";
  }
}
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
      <?php
      print_available_options();
      ?>
    </select>
  </div>
  <div class="galerie-group">
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/script_portfolio.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/layout.php'; ?>