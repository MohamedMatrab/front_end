<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/main.css" >
    <link rel="stylesheet" href="assets/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">
</head>
<body>
<div class="app_container_">
<nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <div class="head-top mb-1 row">
                <div class="contact col-8 ">
                    <i class="fa-solid fa-phone fs-6 "></i>
                    <a class="fs-6" href="tel:+212648256644">Call Us +212 6 48 25 66 44</a>
                </div>
                <div class="social d-flex justify-content-between align-items-center col-2">
                    <a  class="a-icon" href=""><i class="fa-brands fa-instagram"></i></a>
                    <a  class="d-block ms-2 a-icon" href=""><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
            <div class="logo-toggler">
                    <a class="nav-link me-3  " aria-current="page" href="index.php" data-lg ="logo">Dent<span>All</span></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        <div class="collapse navbar-collapse shadow p-2 mb-1 mt-1 " id="navbarSupportedContent">
            <ul class="navbar-nav me-3 mb-2 mb-lg-0 align-items-center ">
                <li class="logo">
                    <a class="nav-link me-3" aria-current="page" href="index.php" data-lg ="logo">Dent<span>All</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?action=aboutcentre">Centre</a></li>
                        <li><a class="dropdown-item" href="index.php?action=aboutdoctor">Doctor</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Spécialités
                </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?action=ésthétique dentaire">Esthétique dentaire</a></li>
                        <li><a class="dropdown-item" href="#">Blanchement</a></li>
                        <li><a class="dropdown-item" href="#">Hollywood smile</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php?action=portfolio">Réalistaions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Actualités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Témoingnages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php?action=contact">Contact</a>
                </li>
                <li class="nav-item mt-sm-2 mt-lg-0">
                    <a class="nav-link rdv" aria-current="page" href="index.php?action=appoint">Rendez-vous</a>
                </li>
                <div class="d-flex align-items-center ms-1 mt-sm-2 mt-lg-0">
                    <a class=" btn-log   " aria-current="page" href="index.php?action=login">LOGIN</a>
                </div>
            </ul>
            
        </div>
    </div>
    </nav>
    <?=$content;?>

    <?php include_once "views/footer.php" ; ?>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js" type="module"></script>
</div>
</body>
</html>
