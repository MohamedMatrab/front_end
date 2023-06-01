<?php
session_start();
$link = "../index.php";
if (isset($_GET['logout'])) {
    if (isset($_SESSION['USER'])) {
        unset($_SESSION['USER']);
    }
    $_SESSION['message'] = "Déconnecté avec succès";
    if ($_GET['logout'] == 0) {
        header("Location: $link");
    } else {
        header("Location: ../dashboard.php?action=login");
    }
    exit(0);
} else {
    $_SESSION['message'] = "Non autorisé à accéder à cette page !";
    header("location: $link");
    exit(0);
}
