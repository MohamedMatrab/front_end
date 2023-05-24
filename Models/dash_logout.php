<?php
session_start();
header("Content-type: application/json");
if (isset($_POST['logout'])) {
    if (isset($_SESSION['USER'])) {
        unset($_SESSION['USER']);
    }
    echo json_encode(true);
}
?>