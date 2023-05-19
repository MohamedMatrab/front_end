<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-m6p+QbLb8/Q5WbSXvS5N1Kdrmla+nZwA5TrAtXegD7h0grwG0BCxYX9v5SSzs6RWwr6UQ6teMw4EyfPq1OqQDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarRightAlignExample"
      aria-controls="navbarRightAlignExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarRightAlignExample">
      <!-- Left links -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <!-- Navbar dropdown -->
        <?php if(isset($_SESSION['auth_user'])) :?>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
             <?= $_SESSION['auth_user']['user_name']; ?> 
          </a>
          <!-- Dropdown menu -->
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="#">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="logout.php">logout</a>
            </li>
            
          </ul>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sign_up.php">register</a>
        </li>
        <?php endif; ?>
      </ul>
     
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>

<?php include 'message.php'; ?>

<script src="jsb/bootstrap.min.js"></script>


</body>
</html>