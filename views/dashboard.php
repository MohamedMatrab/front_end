<?php
include_once "Models/verify_permissions.php";
if (!isset($_SESSION['USER']) || $_SESSION['USER']['role'] == 0) {
  $_SESSION['message'] = "Access denied !";
  header("Location: dashboard.php?action=login");
  exit(0);
}
?>
<?php
include_once "Models/connect.php";
$obj = new connect();
$user_id = $_SESSION['USER']['id'];
$stmt = $obj->getConnect()->prepare("SELECT img,fname,lname,role FROM users WHERE id = $user_id LIMIT 1");
$success = $stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($title) ? $title : 'Dashboard'; ?></title>
  <link rel="stylesheet" href="style/bootstrap.min.css" />
  <link rel="stylesheet" href="style/dashboard.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>
  <div class="app-container">
    <!-- Start Header -->
    <div class="header">
      <div class="header_logo me-1">
        <div class="header_pane">
          <button class="btn_pane">
            <span class="hamburger-box"></span>
          </button>
        </div>
        <div class="logo">dent<span>All</span></div>
        <div class="nav-btn">
          <i class="bi bi-three-dots-vertical"></i>
        </div>
      </div>
      <div class="header_content">
        <div class="app-header-left">
          <ul class="mega-menu nav">
            <li class="nav-item me-3">
              <div class="box">
                <form name="search">
                  <input type="text" class="input" placeholder="Search" name="search" />
                </form>
                <i class="fas fa-search"></i>
              </div>
            </li>
            <li class="drop-down nav-item me-3">
              <span class="icon-header me-1">
                <i class="bi bi-gear"></i>
              </span>
              <span class="bar_name">Settings</span>
              <i class="bi bi-chevron-down ms-1"></i>
            </li>
            <div class="drop-down-content">Settings</div>
            <li class="drop-down nav-item me-3">
              <span class="icon-header me-1">
                <i class="bi bi-kanban"></i>
              </span>
              <span class="bar_name">Projects</span>
              <i class="bi bi-chevron-down ms-1"></i>
            </li>
            <div class="drop-down-content">Projects</div>
          </ul>
        </div>
        <div class="app-header-right">
          <ul class="right nav">
            <li class="drop-down nav-item me-3">
              <span class="icon-header me-1">
                <i class="bi bi-bell-fill"></i>
              </span>
            </li>
            <div class="drop-down-content">Notifications</div>
            <li class="nav-item me-3" id="logout">
              <span class="icon-header me-1">
                <i class="bi bi-box-arrow-right"></i>
              </span>
              <span class="bar_name">Log Out</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Header -->
    <!-- Start Sidebar -->
    <div class="navigation">
      <div class="profile">
        <img src="<?= is_null($row['img']) ? "images/user_image.png" : 'data:image/jpg;base64,' . base64_encode($row['$img']); ?>" alt="profile" class="profile-img" />
        <div class="admin-data">
          <span style="font-weight: 600"><?= $row['fname'] . " " . $row['lname'] ?></span>
          <span><?= $row['role'] == 1 ? 'Docteur' : 'Secrétaire '; ?></span>
        </div>
      </div>
      <div id="navigation-title">NAVIGATION</div>
      <ul class="nav-list">
        <li>
          <section class="nav-section sub_clicked linked" data-id="dashboard">
            <span class="title">
              <i class="fa-solid fa-house"></i>
              <span>Dashboard</span>
            </span>
          </section>
        </li>
        <li>
          <section class="nav-section">
            <span class="title">
              <i class="fa-solid fa-bookmark"></i>
              <span>Reservations</span>
            </span>
          </section>
          <ul>
            <li class="sub-title all-appoint linked" data-id="all_reservations">
              <span> Les Reservations </span>
            </li>
            <li class="sub-title history-appoint linked" data-id="historique">
              <span>Historique </span>
            </li>
          </ul>
        </li>
        <li>
          <section class="nav-section">
            <span class="title">
              <i class="fa-solid fa-pager"></i>
              <span>Pages</span>
            </span>
          </section>
          <ul>
            <li class="sub-title portfolio linked" data-id="portfolio">
              <span>Portfolio</span>
            </li>
            <li class="sub-title service linked" data-id="service">
              <span>Service</span>
            </li>
            <li class="sub-title centre linked" data-id="centre">
              <span>Centre</span>
            </li>
            <li class="sub-title doctor linked" data-id="doctor">
              <span>Doctor</span>
            </li>
          </ul>
        </li>
        <li>
          <section class="nav-section">
            <span class="title">
              <i class="fa-solid fa-lock"></i>
              <span>Authentication</span>
            </span>
          </section>
          <ul>
            <li class="sub-title users linked" data-id="users">
              <span>Users</span>
            </li>
            <li class="sub-title account linked" data-id="account">
              <span>Account</span>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="dashboard-content">
      <?= isset($content) ? $content : ''; ?>
    </div>
    <!-- End Sidebar -->
  </div>
  <script src="https://kit.fontawesome.com/10196ca7d5.js" crossorigin="anonymous"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>