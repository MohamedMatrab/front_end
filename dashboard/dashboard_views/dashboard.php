<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/dashboard.css" >
    <link rel="stylesheet" href="assets/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="app-container">
        <!-- Start Header -->
        <div class="header">
            <div class="header_logo me-1">
                <div class="logo">dent<span>All</span></div>
                <div class="header_pane">
                    <a  href="#off_canvas" role="button" >
                        <button class="btn_pane">
                            <span class="hamburger-box"></span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="header_content">
                <div class="app-header-left">
                    <ul class="mega-menu nav">
                    <li class="nav-item me-3 ms-5">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </li>
                    <li class="nav-item me-3">
                        <span class="icon-gift me-1">
                            <i class="bi bi-gift"></i>
                        </span>
                        Mega Menu
                        <i class="bi bi-chevron-down ms-1"></i>
                    </li>
                    <li class="nav-item settings me-3">
                        Settings
                        <i class="bi bi-chevron-down ms-1"></i>
                    </li>
                    <li class="nav-item me-3">
                        <span class="icon-sett me-1">
                            <i class="bi bi-brightness-low"></i>
                        </span>
                        Projects
                        <i class="bi bi-chevron-down ms-1"></i>
                    </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <ul class="right nav">
                        <li class="nav-item">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </li>
                        <li class="nav-item ms-3">
                            <i class="bi bi-bell-fill"></i>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        <!-- End Header -->
        <!-- Start Sidebar -->
        <div class="sidebar pt-1 ps-3 pe-3" id="off_canvas">
            <h3 class="main-color fs-5 mt-2">MENU</h3>
                <section class="section_1">
                        <h2 class="fs-6 disable">Reservation</h2>
                        <div class="opt">

                        </div>
                        <!--<ul class="drop-down">
                            <li>toutes les résérvations</li>
                            <li>historique</li>
                        </ul>-->
                </section>
                <section class="section_1">
                    <h2 class="fs-6 disable">Authentication</h2>
                    <div class="opt">

                    </div>
                    <!--<ul class="drop-down" >
                        <li>Users</li>
                        <li>account</li>
                    </ul>  -->
                </section class="section_1">
                <section>
                    <h2 class="fs-6 disable">Pages</h2>
                    <div class="opt">

                    </div>
                    <!--<ul class="drop-down">
                        <li>Portfolio</li>
                        <li>Servive</li>
                        <li>Centre</li>
                    </ul>  -->
                </section>
            

            

        </div>
        <!-- End Sidebar -->

        <!-- Start Content -->
        <?=$content?>
        <!-- End Content -->
    </div>




    <script src="js/all.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>